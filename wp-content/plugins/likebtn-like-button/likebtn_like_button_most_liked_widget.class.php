<?php

class LikeBtnLikeButtonMostLikedWidget extends WP_Widget {

    // Default thumbnail size
    const TUMBNAIL_SIZE = 32;
    // Default number of items to show
    const NUMBER_OF_ITEMS = 5;

    function LikeBtnLikeButtonMostLikedWidget() {
        load_plugin_textdomain(LIKEBTN_LIKE_BUTTON_I18N_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
        $widget_ops = array('description' => __('Most liked posts and comments', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN));
        parent::WP_Widget(false, $name = __('LikeBtn Most Liked Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), $widget_ops);
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        global $LikeBtnLikeButtonMostLiked;
        echo $LikeBtnLikeButtonMostLiked->widget($args, $instance);
    }

    function update($new_instance, $old_instance) {
        if ($new_instance['title'] == '') {
            $new_instance['title'] = __('Most Liked Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
        }

//        if ((int) $new_instance['number'] < 1) {
//            $new_instance['number'] = 5;
//        }

        return $new_instance;
    }

    function form($instance) {
        global $likebtn_like_button_entities;

        $time_range_list = array(
            'all' => __('All time', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '1' => __('1 day', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '2' => __('2 days', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '3' => __('3 days', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '7' => __('1 week', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '14' => __('2 weeks', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '21' => __('3 weeks', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '1m' => __('1 month', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '2m' => __('2 months', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '3m' => __('3 months', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '6m' => __('6 months', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN),
            '1y' => __('1 year', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN)
        );

        if ($instance['title'] == '') {
            $instance['title'] = __('Most Liked Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
        }

        if ((int)$instance['number'] < 1) {
            $instance['number'] = self::NUMBER_OF_ITEMS;
        }

        if (!$instance['entity_name'] || !is_array($instance['entity_name'])) {
            $instance['entity_name'] = array(LIKEBTN_LIKE_BUTTON_ENTITY_POST);
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('entity_name'); ?>"><?php _e('Items to show (use CTRL to select multiple entries)', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label><br/>
            <select name="<?php echo $this->get_field_name('entity_name'); ?>[]" id="<?php echo $this->get_field_id('entity_name'); ?>" multiple="multiple" size="6" style="height:auto !important;">
                <?php foreach ($likebtn_like_button_entities as $entity_name_value => $entity_title): ?>
                    <option value="<?php echo $entity_name_value; ?>" <?php echo (in_array($entity_name_value, $instance['entity_name']) ? 'selected="selected"' : ''); ?> ><?php _e($entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <?php endforeach ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of items to show:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
            <input type="text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" size="3" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('time_range'); ?>"><?php _e('Time range:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
            <select name="<?php echo $this->get_field_name('time_range'); ?>" id="<?php echo $this->get_field_id('time_range'); ?>">
                <?php foreach ($time_range_list as $time_range_value => $time_range_name): ?>
                    <option value="<?php echo $time_range_value; ?>" <?php selected($time_range_value, $instance['time_range']); ?> ><?php _e($time_range_name, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <?php endforeach ?>
            </select>
        </p>
        <p>
            <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('show_likes'); ?>" name="<?php echo $this->get_field_name('show_likes'); ?>" value="1" <?php checked($instance['show_likes']); ?> />
            <label for="<?php echo $this->get_field_id('show_likes'); ?>"><?php _e('Display likes count', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('show_dislikes'); ?>" name="<?php echo $this->get_field_name('show_dislikes'); ?>" value="1" <?php checked($instance['show_dislikes']); ?> />
            <label for="<?php echo $this->get_field_id('show_dislikes'); ?>"><?php _e('Display dislikes count', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_thumbnail']); ?> id="<?php echo $this->get_field_id('show_thumbnail'); ?>" name="<?php echo $this->get_field_name('show_thumbnail'); ?>" value="1" />
            <label for="<?php echo $this->get_field_id('show_thumbnail'); ?>"><?php _e('Display thumbnail', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_excerpt']); ?> id="<?php echo $this->get_field_id('show_excerpt'); ?>" name="<?php echo $this->get_field_name('show_excerpt'); ?>" value="1" />
            <label for="<?php echo $this->get_field_id('show_excerpt'); ?>"><?php _e('Display excerpt', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_date']); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" value="1" />
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Display item date', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label>
        </p>
        <input type="hidden" id="wti-most-submit" name="wti-submit" value="1" />
        <?php
    }

}

class LikeBtnLikeButtonMostLiked {

    const PLUGIN_NAME = 'likebtn-like-button';
    const TEMPLATE = 'most-liked-widget.php';

    function LikeBtnLikeButtonMostLiked() {
        add_action('widgets_init', array(&$this, 'init'));
    }

    function init() {
        register_widget("LikeBtnLikeButtonMostLikedWidget");
    }

    function widget($args, $instance = array()) {
        global $wpdb;

        if (is_array($args)) {
            extract($args);
        }
        if (is_array($instance)) {
            extract($instance);
        }

        /*$title = '';
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
        $show_thumbnail = '';
        if (isset($instance['show_thumbnail'])) {
            $show_thumbnail = $instance['show_thumbnail'];
        }
        $show_excerpt = '';
        if (isset($instance['show_excerpt'])) {
            $show_excerpt = $instance['show_excerpt'];
        }
        $show_date = '';
        if (isset($instance['show_date'])) {
            $show_date = $instance['show_date'];
        }
        $show_likes = '';
        if (isset($instance['show_likes'])) {
            $show_likes = $instance['show_likes'];
        }
        $show_dislikes = '';
        if (isset($instance['show_dislikes'])) {
            $show_dislikes = $instance['show_dislikes'];
        }

        // validate parameters
        if ($show_thumbnail == 'true') {
            $show_thumbnail = '1';
        }
        if ($show_date == 'true') {
            $show_date = '1';
        }
        if ($show_likes == 'true') {
            $show_likes = '1';
        }
        if ($show_dislikes == 'true') {
            $show_dislikes = '1';
        }*/

        foreach ($instance['entity_name'] as $entity_index => $entity_name) {
            $instance['entity_name'][$entity_index] = str_replace("'", '', trim($entity_name));
        }
        $query_post_types = "'" . implode("','", $instance['entity_name']) . "'";

        $query_limit = '';
        if (isset($instance['number']) && (int) $instance['number'] > 0) {
            $query_limit = "LIMIT " . (int) $instance['number'];
        }

        // getting the most liked content
        $query = '';
        if (in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name']) && count($instance['entity_name']) > 1) {
            $query .= "SELECT * FROM (";
        }
        if (!in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name']) || count($instance['entity_name']) > 1) {
            $query .= "
                 SELECT
                    p.ID as 'post_id',
                    p.post_title,
                    p.post_date,
                    CONVERT(pm_likes.meta_value, UNSIGNED INTEGER) as 'likes',
                    CONVERT(pm_dislikes.meta_value, UNSIGNED INTEGER) as 'dislikes',
                    p.post_type,
                    p.post_mime_type
                 FROM {$wpdb->prefix}postmeta pm_likes
                 LEFT JOIN {$wpdb->prefix}posts p
                     ON (p.ID = pm_likes.post_id)
                 LEFT JOIN {$wpdb->prefix}postmeta pm_dislikes
                     ON (pm_dislikes.post_id = pm_likes.post_id AND pm_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES . "')
                 WHERE
                    pm_likes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES . "'
                    AND p.post_type in ({$query_post_types}) ";
            if (!empty($instance['time_range']) && $instance['time_range'] != 'all') {
                $query .= " AND post_date >= '" . $this->timeRangeToDateTime($instance['time_range']) . "'";
            }
        }
        if (in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name']) && count($instance['entity_name']) > 1) {
            $query .= " UNION ";
        }
        if (in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name'])) {
            $query .= "
                 SELECT
                    p.comment_ID as 'post_id',
                    p.comment_content as post_title,
                    p.comment_date as 'post_date',
                    CONVERT(pm_likes.meta_value, UNSIGNED INTEGER) as 'likes',
                    CONVERT(pm_dislikes.meta_value, UNSIGNED INTEGER) as 'dislikes',
                    'comment' as post_type,
                    '' as post_mime_type
                 FROM {$wpdb->prefix}commentmeta pm_likes
                 LEFT JOIN {$wpdb->prefix}comments p
                    ON (p.comment_ID = pm_likes.comment_id)
                 LEFT JOIN {$wpdb->prefix}commentmeta pm_dislikes
                    ON (pm_dislikes.comment_id = pm_likes.comment_id AND pm_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES . "')
                 WHERE
                    pm_likes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES . "' ";
            if (!empty($instance['time_range']) && $instance['time_range'] != 'all') {
                $query .= " AND comment_date >= '" . $this->timeRangeToDateTime($instance['time_range']) . "'";
            }
        }
        if (in_array(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $instance['entity_name']) && count($instance['entity_name']) > 1) {
            $query .= "
                ) main_query";
        }
        $query .= "
            ORDER BY
                likes DESC
             {$query_limit}";

        $posts = $wpdb->get_results($query);

        $post_loop = array();

        if (count($posts) > 0) {
            foreach ($posts as $i=>$db_post) {
                $post = array(
                    'id' => $db_post->post_id,
                    'type' => $db_post->post_type,
                    'post_mime_type' => $db_post->post_mime_type,
                    'title' => '',
                    'link' => '',
                    'likes' => '',
                    'dislikes' => '',
                    'date' => '',
                    'excerpt' => '',
                );

                $post_title = stripslashes($db_post->post_title);

                if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
                    $post_title = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($post_title);
                }
                if ($db_post->post_type == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
                    if (mb_strlen($post_title) > 30) {
                        $post_title = mb_substr($post_title, 0, 30) . '...';
                    }
                }
                $post['title'] = $post_title;

                if ($db_post->post_type != LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
                    $permalink = get_permalink($db_post->post_id);
                } else {
                    $permalink = get_comment_link($db_post->post_id);
                }
                $post['link'] = $permalink;

                $post['likes'] = $db_post->likes;
                $post['dislikes'] = $db_post->dislikes;

                if ($show_date) {
                    $post['date'] = strtotime($db_post->post_date);
                }

                if ($show_excerpt) {
                    if ($db_post->post_type == 'comment') {
                        $post['excerpt'] = get_comment_excerpt($db_post->post_id);
                    } else {
                        // get_the_excerpt
                        $get_post = get_post($db_post->post_id);
                        $post['excerpt'] = apply_filters( 'get_the_excerpt', $get_post->post_excerpt );
                    }
                }

                $post_loop[$i] = $post;
            }
        }

        // Get and include the template we're going to use
		include( $this->getTemplateHierarchy(self::TEMPLATE) );
    }

    function timeRangeToDateTime($range) {
        $day = 0;
        $month = 0;
        $year = 0;
        switch ($range) {
            case "1":
                $day = 1;
                break;
            case "2":
                $day = 2;
                break;
            case "3":
                $day = 3;
                break;
            case "7":
                $day = 7;
                break;
            case "14":
                $day = 14;
                break;
            case "21":
                $day = 21;
                break;
            case "1m":
                $month = 1;
                break;
            case "2m":
                $month = 2;
                break;
            case "3m":
                $month = 3;
                break;
            case "6m":
                $month = 6;
                break;
            case "1y":
                $year = 1;
                break;
        }

        $now_date_time = strtotime(date('Y-m-d H:i:s'));
        $range_timestamp = mktime(date('H', $now_date_time), date('i', $now_date_time), date('s', $now_date_time), date('m', $now_date_time) - $month, date('d', $now_date_time) - $day, date('Y', $now_date_time) - $year);

        return date('Y-m-d H:i:s', $range_timestamp);
    }

	/**
	 * Loads theme files in appropriate hierarchy:
     * 1) child theme,
	 * 2) parent template
     * 3) plugin resources
     *
     * Will look in the PLUGIN_NAME directory in a theme
	 **/
	public function getTemplateHierarchy( $template ) {

		if ( $theme_file = locate_template( array( self::PLUGIN_NAME . '/' . $template ) ) ) {
			$file = $theme_file;
		} else {
			$file = 'templates/' . $template;
		}

		return $file;
	}

}

$LikeBtnLikeButtonMostLiked = new LikeBtnLikeButtonMostLiked();