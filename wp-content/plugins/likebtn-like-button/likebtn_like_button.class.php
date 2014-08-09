<?php

define('LIKEBTN_LIKE_BUTTON_LAST_SUCCESSFULL_SYNC_TIME_OFFSET', 57600);
define('LIKEBTN_LIKE_BUTTON_API_URL', 'http://api.likebtn.com/api/');
define('LIKEBTN_LIKE_BUTTON_LOCALES_SYNC_INTERVAL', 57600);
define('LIKEBTN_LIKE_BUTTON_STYLES_SYNC_INTERVAL', 57600);

class LikeBtnLikeButton {

    protected static $synchronized = false;
    // Cached API request URL.
    protected static $apiurl = '';

    /**
     * Constructor.
     */
    public function __construct() {
        // Do nothing.
    }

    /**
     * Running votes synchronization.
     */
    public function runSyncVotes() {
        if (!self::$synchronized && get_option('likebtn_like_button_account_email') && get_option('likebtn_like_button_account_api_key') && get_option('likebtn_like_button_sync_inerval') && $this->timeToSyncVotes(get_option('likebtn_like_button_sync_inerval') * 60)) {
            $this->syncVotes(get_option('likebtn_like_button_account_email'), get_option('likebtn_like_button_account_api_key'));
        }
    }

    /**
     * Check if it is time to sync votes.
     */
    public function timeToSyncVotes($sync_period) {

        $last_sync_time = get_option('likebtn_like_button_last_sync_time');

        //$now = time();
        //update_option('likebtn_like_button_last_sync_time', $now);
        //return true;

        $now = time();
        if (!$last_sync_time) {
            update_option('likebtn_like_button_last_sync_time', $now);
            self::$synchronized = true;
            return true;
        } else {

            if ($last_sync_time + $sync_period > $now) {
                return false;
            } else {
                update_option('likebtn_like_button_last_sync_time', $now);
                self::$synchronized = true;
                return true;
            }
        }
    }

    /**
     * Retrieve data.
     */
    public function curl($url) {

        global $wp_version;

        $cms_version = $wp_version;

        $likebtn_version = _likebtn_like_button_get_plugin_version;
        $php_version = phpversion();
        $useragent = "WordPress $wp_version; likebtn plugin $likebtn_version; PHP $php_version";

        try {
            $http = new WP_Http();
            $response = $http->request($url, array('headers' => array("User-Agent" => $useragent)));
        } catch (Exception $e) {
            return '';
        }

        if (is_array($response) && !empty($response['body'])) {
            return $response['body'];
        } else {
            return '';
        }
    }

    /**
     * Comment sync function.
     */
    public function syncVotes() {
        $sync_result = true;

        $last_sync_time = number_format(get_option('likebtn_like_button_last_sync_time'), 0, '', '');

        $email = trim(get_option('likebtn_like_button_account_email'));
        $api_key = trim(get_option('likebtn_like_button_account_api_key'));
        $subdirectory = trim(get_option('likebtn_like_button_subdirectory'));
        $parse_url = parse_url(get_site_url());
        $domain = $parse_url['host'].$subdirectory;

        $updated_after = '';

        if (get_option('likebtn_like_button_last_successfull_sync_time')) {
            $updated_after = get_option('likebtn_like_button_last_successfull_sync_time') - LIKEBTN_LIKE_BUTTON_LAST_SUCCESSFULL_SYNC_TIME_OFFSET;
        }

        $url = "output=json&last_sync_time=" . $last_sync_time;
        if ($updated_after) {
            $url .= '&updated_after=' . $updated_after;
        }

        // retrieve first page
        $response = $this->apiRequest('stat', $url);

        if (!$this->updateVotes($response)) {
            $sync_result = false;
        }

        // retrieve all pages after the first
        if (isset($response['response']['total']) && isset($response['response']['page_size'])) {
            $total_pages = ceil((int) $response['response']['total'] / (int) $response['response']['page_size']);

            for ($page = 2; $page <= $total_pages; $page++) {
                $response = $this->apiRequest('stat', $url . '&page=' . $page);

                if (!$this->updateVotes($response)) {
                    $sync_result = false;
                }
            }
        }

        if ($sync_result) {
            update_option('likebtn_like_button_last_successfull_sync_time', $last_sync_time);
        }
    }

    /**
     * Test synchronization.
     *
     * @param type $account_api_key
     * @param type $site_api_key
     */
    public function testSync($email, $api_key) {
        $email = trim($email);
        $api_key = trim($api_key);

        $response = $this->apiRequest('stat', 'output=json&page_size=1', $email, $api_key);

        return $response;
    }

    /**
     * Decode JSON.
     */
    public function jsonDecode($jsong_string) {
        return json_decode($jsong_string, true);
    }

    /**
     * Update votes in database from API response.
     */
    public function updateVotes($response) {
        $entity_updated = false;

        if (!empty($response['response']['items'])) {
            foreach ($response['response']['items'] as $item) {
                $likes = 0;
                if (!empty($item['likes'])) {
                    $likes = $item['likes'];
                }
                $dislikes = 0;
                if (!empty($item['dislikes'])) {
                    $dislikes = $item['dislikes'];
                }
                $entity_updated = $this->updateCustomFields($item['identifier'], $likes, $dislikes);
            }
        }
        return $entity_updated;
    }

    /**
     * Update entity custom fields
     */
    public function updateCustomFields($identifier, $likes, $dislikes) {
        global $likebtn_like_button_entities;
        global $likebtn_like_button_custom_fields;

        $identifier_parts = explode('_', $identifier);
        $entity_name = '';
        if (!empty($identifier_parts[0])) {
            $entity_name = $identifier_parts[0];
        }
        // check if entity is supported
        if (!array_key_exists($entity_name, $likebtn_like_button_entities)) {
            return false;
        }
        $entity_id = '';
        if (!empty($identifier_parts[1])) {
            $entity_id = $identifier_parts[1];
            if (!is_numeric($entity_id)) {
                return false;
            }
        }

        $likes_minus_dislikes = null;
        if ($likes !== null && $dislikes !== null) {
            $likes_minus_dislikes = $likes - $dislikes;
        }

        $entity_updated = true;

        // set Custom fields
        if ($entity_name == 'comment') {
            // entity is comment
            $comment = get_comment($entity_id);

            // check if post exists and is not revision
            if (!empty($comment) && $comment->comment_type != 'revision') {
                if ($likes !== null) {
                    if (count(get_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES)) > 1) {
                        delete_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES);
                        add_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES, $likes, true);
                    } else {
                        update_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES, $likes);
                    }
                }
                if ($dislikes !== null) {
                    if (count(get_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES)) > 1) {
                        delete_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES);
                        add_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES, $dislikes, true);
                    } else {
                        update_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES, $dislikes);
                    }
                }
                if ($likes_minus_dislikes !== null) {
                    if (count(get_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES)) > 1) {
                        delete_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES);
                        add_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes, true);
                    } else {
                        update_comment_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes);
                    }
                }
            } else {
                $entity_updated = false;
            }
        } else {
            // entity is post
            $post = get_post($entity_id);

            // check if post exists and is not revision
            if (!empty($post) && !empty($post->post_type) && $post->post_type != 'revision') {
                if ($likes !== null) {
                    if (count(get_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES)) > 1) {
                        delete_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES);
                        add_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES, $likes, true);
                    } else {
                        update_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES, $likes);
                    }
                }
                if ($dislikes !== null) {
                    if (count(get_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES)) > 1) {
                        delete_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES);
                        add_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES, $dislikes, true);
                    } else {
                        update_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES, $dislikes);
                    }
                }
                if ($likes_minus_dislikes !== null) {
                    if (count(get_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES)) > 1) {
                        delete_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES);
                        add_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes, true);
                    } else {
                        update_post_meta($entity_id, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES, $likes_minus_dislikes);
                    }
                }
            } else {
                $entity_updated = false;
            }
        }

        return $entity_updated;
    }

    /**
     * Run locales synchronization.
     */
    public function runSyncLocales() {
        if ($this->timeToSync(LIKEBTN_LIKE_BUTTON_LOCALES_SYNC_INTERVAL, 'likebtn_like_button_last_locale_sync_time')) {
            $this->syncLocales();
        }
    }

    /**
     * Run styles synchronization.
     */
    public function runSyncStyles() {
        if ($this->timeToSync(LIKEBTN_LIKE_BUTTON_STYLES_SYNC_INTERVAL, 'likebtn_like_button_last_style_sync_time')) {
            $this->syncStyles();
        }
    }

    /**
     * Check if it is time to sync.
     */
    public function timeToSync($sync_period, $sync_variable) {

        $last_sync_time = get_option($sync_variable);

        $now = time();
        if (!$last_sync_time) {
            update_option($sync_variable, $now);
            return true;
        } else {
            if ($last_sync_time + $sync_period > $now) {
                return false;
            } else {
                update_option($sync_variable, $now);
                return true;
            }
        }
    }

    /**
     * Locales sync function.
     */
    public function syncLocales() {
        $url = LIKEBTN_LIKE_BUTTON_API_URL . "?action=locale";

        $response_string = $this->curl($url);
        $response = $this->jsonDecode($response_string);

        if (isset($response['result']) && $response['result'] == 'success' && isset($response['response']) && count($response['response'])) {
            update_option('likebtn_like_button_locales', $response['response']);
        }
    }

    /**
     * Styles sync function.
     */
    public function syncStyles() {
        $url = LIKEBTN_LIKE_BUTTON_API_URL . "?action=style";

        $response_string = $this->curl($url);
        $response = $this->jsonDecode($response_string);

        if (isset($response['result']) && $response['result'] == 'success' && isset($response['response']) && count($response['response'])) {
            update_option('likebtn_like_button_styles', $response['response']);
        }
    }

    /**
     * Reset likes/dislikes using API
     *
     * @param type $account_api_key
     * @param type $site_api_key
     */
    public function reset($identifier) {
        $result = false;

        $email = trim(get_option('likebtn_like_button_account_email'));
        $api_key = trim(get_option('likebtn_like_button_account_api_key'));
        $subdirectory = trim(get_option('likebtn_like_button_subdirectory'));
        $parse_url = parse_url(get_site_url());
        $domain = $parse_url['host'].$subdirectory;

        $url = $this->getApiUrl() . "identifier_filter={$identifier}";

        // retrieve first page
        $response_string = $this->curl($url);
        $response = $this->jsonDecode($response_string);

        // check result
        if (isset($response['response']['reseted']) && $response['response']['reseted']) {
           $result = $response['response']['reseted'];
        }

        return $result;
    }

    /**
     * Edit likes/dislikes using API
     *
     * @param type $account_api_key
     * @param type $site_api_key
     */
    public function edit($identifier, $type, $value) {
        $response = $this->apiRequest('edit', "identifier_filter={$identifier}&type={$type}&value={$value}");
        return $response;
    }

    /**
     * Get API URL
     *
     * @param type $identifier
     * @return string
     */
    public function apiRequest($action, $request, $email = '', $api_key = '') {
        if (!self::$apiurl) {
            if (!$email) {
                $email = trim(get_option('likebtn_like_button_account_email'));
            }
            if (!$api_key) {
                $api_key = trim(get_option('likebtn_like_button_account_api_key'));
            }
            $subdirectory = trim(get_option('likebtn_like_button_subdirectory'));
            $local_domain = trim(get_option('likebtn_like_button_local_domain'));
            if ($local_domain) {
              $domain = $local_domain;
            }
            else {
              $parse_url = parse_url(get_site_url());
              $domain    = $parse_url['host'] . $subdirectory;
            }

            self::$apiurl = LIKEBTN_LIKE_BUTTON_API_URL . "?email={$email}&api_key={$api_key}&domain={$domain}&nocache=.php&source=wordpress&";
        }
        $url = self::$apiurl . "action={$action}&" . $request;

        $response_string = $this->curl($url);
        $response = $this->jsonDecode($response_string);

        return $response;
    }

}
