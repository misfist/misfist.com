<?php
/*
  Plugin Name: LikeBtn Like Button
  Plugin URI: http://likebtn.com
  Description: <strong><a href="http://likebtn.com" target="_blank" title="Like Button">LikeBtn.com</a></strong> - is the service providing a fully customizable like button widget for websites. The Like Button can be installed on any website for FREE. The service also offers a range of plans giving access to additional options and tools - see <a href="http://likebtn.com/en/#plans_pricing" target="_blank" title="Like Button Plans">Plans & Pricing</a>. This module allows to integrate the LikeBtn Like Button into your WordPress website to allow visitors to like and dislike pages, posts, custom post types and comments anonymously.
  Version: 1.8
  Author: likebtn
  Author URI: http://likebtn.com
 */

// i18n domain
define('LIKEBTN_LIKE_BUTTON_I18N_DOMAIN', 'likebtn-like-button');

// LikeBtn plans
define('LIKEBTN_LIKE_BUTTON_PLAN_TRIAL', 9);
define('LIKEBTN_LIKE_BUTTON_PLAN_FREE', 0);
define('LIKEBTN_LIKE_BUTTON_PLAN_PLUS', 1);
define('LIKEBTN_LIKE_BUTTON_PLAN_PRO', 2);
define('LIKEBTN_LIKE_BUTTON_PLAN_VIP', 3);
define('LIKEBTN_LIKE_BUTTON_PLAN_ULTRA', 4);

define('LIKEBTN_LIKE_BUTTON_ENTITY_POST', 'post');
define('LIKEBTN_LIKE_BUTTON_ENTITY_PAGE', 'page');
define('LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT', 'comment');

// position
define('LIKEBTN_LIKE_BUTTON_POSITION_TOP', 'top');
define('LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM', 'bottom');
define('LIKEBTN_LIKE_BUTTON_POSITION_BOTH', 'both');

// alignment
define('LIKEBTN_LIKE_BUTTON_ALIGNMENT_LEFT', 'left');
define('LIKEBTN_LIKE_BUTTON_ALIGNMENT_CENTER', 'center');
define('LIKEBTN_LIKE_BUTTON_ALIGNMENT_RIGHT', 'right');

// user
define('LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_FULL', 'full');
define('LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_EXCERPT', 'excerpt');
define('LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_BOTH', 'both');

// statistics page size
define('LIKEBTN_LIKE_BUTTON_STATISTIC_PAGE_SIZE', 50);

// custom fields names
define('LIKEBTN_LIKE_BUTTON_META_KEY_LIKES', 'Likes');
define('LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES', 'Dislikes');
define('LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES', 'Likes minus dislikes');
global $likebtn_like_button_custom_fields;
$likebtn_like_button_custom_fields = array(
    LIKEBTN_LIKE_BUTTON_META_KEY_LIKES,
    LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES,
    LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES,
);

// entities for which plugin can be enabled
global $likebtn_like_button_entities;
$likebtn_like_button_entities = array(
    'post' => __('Post'),
    'page' => __('Page'),
    'attachment' => __('Attachment'),
    'revision' => __('Revision'),
    'nav_menu_item' => __('Nav menu item'),
    //'comment' => __('Comment'),
);
$likebtn_like_button_entities = _likebtn_like_button_get_entities($likebtn_like_button_entities);

// post format: just to translate
$post_formats = array(
    'standard' => __('Standard'),
    'aside' => __('Aside'),
    'image' => __('Image'),
    'link' => __('Link'),
    'quote' => __('Quote'),
    'status' => __('Status'),
);

// languages
global $likebtn_like_button_page_sizes;
$likebtn_like_button_page_sizes = array(
    10,
    20,
    50,
    100,
    500,
    1000,
    5000,
);
global $likebtn_like_button_post_statuses;
$likebtn_like_button_post_statuses = array_reverse(get_post_statuses());

// likebtn settings
global $likebtn_like_button_settings;
$likebtn_like_button_settings = array(
    "lang" => array("default" => "en"),
    "group_identifier" => array("default" => ""),
    "local_domain" => array("default" => ''),
    "domain_from_parent" => array("default" => '0'),
    "subdirectory" => array("default" => ''),
    "item_url" => array("default" => ''),
    "share_enabled" => array("default" => '1'),
    "item_title" => array("default" => ''),
    "item_description" => array("default" => ''),
    "item_image" => array("default" => ''),
    "show_like_label" => array("default" => '1'),
    "show_dislike_label" => array("default" => '0'),
    "popup_dislike" => array("default" => '0'),
    "like_enabled" => array("default" => '1'),
    "dislike_enabled" => array("default" => '1'),
    "counter_clickable" => array("default" => '0'),
    "counter_show" => array("default" => '1'),
    "counter_type" => array("default" => "number"),
    "display_only" => array("default" => '0'),
    "unlike_allowed" => array("default" => '1'),
    "like_dislike_at_the_same_time" => array("default" => '0'),
    "style" => array("default" => 'white'),
    "addthis_pubid" => array("default" => ''),
    "addthis_service_codes" => array("default" => ''),
    "tooltip_enabled" => array("default" => '1'),
    "show_copyright" => array("default" => '1'),
    "popup_html" => array("default" => ''),
    "popup_donate" => array("default" => ''),
    "popup_content_order" => array("default" => 'popup_share,popup_donate,popup_html'),
    "popup_enabled" => array("default" => '1'),
    "popup_position" => array("default" => 'top'),
    "popup_style" => array("default" => 'light'),
    "popup_hide_on_outside_click" => array("default" => '1'),
    "event_handler" => array("default" => ''),
    "info_message" => array("default" => '1'),
    "i18n_like" => array("default" => ''),
    "i18n_dislike" => array("default" => ''),
    "i18n_like_tooltip" => array("default" => ''),
    "i18n_dislike_tooltip" => array("default" => ''),
    "i18n_unlike_tooltip" => array("default" => ''),
    "i18n_undislike_tooltip" => array("default" => ''),
    "i18n_share_text" => array("default" => ''),
    "i18n_popup_close" => array("default" => ''),
    "i18n_popup_text" => array("default" => ''),
    "i18n_popup_donate" => array("default" => '')
);

// plans
global $likebtn_like_button_plans;
$likebtn_like_button_plans = array(
    LIKEBTN_LIKE_BUTTON_PLAN_TRIAL => 'TRIAL',
    LIKEBTN_LIKE_BUTTON_PLAN_FREE => 'FREE',
    LIKEBTN_LIKE_BUTTON_PLAN_PLUS => 'PLUS',
    LIKEBTN_LIKE_BUTTON_PLAN_PRO => 'PRO',
    LIKEBTN_LIKE_BUTTON_PLAN_VIP => 'VIP',
    LIKEBTN_LIKE_BUTTON_PLAN_ULTRA => 'ULTRA',
);

// styles
global $likebtn_like_button_styles;
$likebtn_like_button_styles = array(
    "white",
    "lightgray",
    "gray",
    "black",
    "padded",
    "drop",
    "line",
    "github",
    "transparent",
    "youtube",
    "habr",
    "heartcross",
    "plusminus",
    "google",
    "greenred",
    "large"
);

// languages
global $likebtn_like_button_default_languages;
$likebtn_like_button_default_languages = array(
    'en' => 'en - English',
    'ru' => 'ru - Русский (Russian)',
    'de' => 'de - Deutsch (German)',
    'ja' => 'ja - 日本語 (Japanese)',
    'uk' => 'uk - Українська мова (Ukrainian)',
    'kk' => 'kk - Қазақ тілі (Kazakh)',
    'nl' => 'nl - Nederlands (Dutch)',
    'hu' => 'hu - Magyar (Hungarian)',
    'sv' => 'sv - Svenska (Swedish)',
    'tr' => 'tr - Türkçe (Turkish)',
    'es' => 'es - Español (Spanish)'
);

// languages
global $likebtn_like_button_sync_intervals;
$likebtn_like_button_sync_intervals = array(
    5,
    15,
    30,
    60,
    90,
    120,
);

// LikeBtn website locales available
global $likebtn_like_button_website_locales;
$likebtn_like_button_website_locales = array(
    'en', 'ru'
);

###############
### Backend ###
###############
// i18n function
/* function likebtn_like_button_trans($text, $params = null) {
  if (!is_array($params)) {
  $params = func_get_args();
  $params = array_slice($params, 1);
  }
  return vsprintf(__($text, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), $params);
  } */

// initicalization
function likebtn_like_button_init() {
    load_plugin_textdomain(LIKEBTN_LIKE_BUTTON_I18N_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');
    wp_enqueue_script('jquery');
}

add_action('init', 'likebtn_like_button_init');

// add Settings link to the plugin list page
function likebtn_like_button_links($links, $file) {
    $plugin_file = basename(__FILE__);
    if (basename($file) == $plugin_file) {
        $settings_link = '<a href="admin.php?page=likebtn_like_button_settings">' . __('Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . '</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}

add_filter('plugin_action_links', 'likebtn_like_button_links', 10, 2);

// admin options
function likebtn_like_button_admin_menu() {
    $logo_url = _likebtn_like_button_get_public_url() . 'img/menu_icon.png';

    add_menu_page(__('Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), 'LikeBtn', 'manage_options', 'likebtn_like_button_settings', '', $logo_url);
    //add_options_page('LikeBtn Like Button', __('LikeBtn Like Button', 'likebtn_like_button'), 'activate_plugins', 'likebtn_like_button', 'likebtn_like_button_admin_content');
    add_submenu_page(
            'likebtn_like_button_settings', __('Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . ' ‹ ' . __('LikeBtn Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), __('Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), 'manage_options', 'likebtn_like_button_settings', 'likebtn_like_button_admin_settings'
    );
    add_submenu_page(
            'likebtn_like_button_settings', __('Buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . ' ‹ ' . __('LikeBtn Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), __('Buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), 'manage_options', 'likebtn_like_button_buttons', 'likebtn_like_button_admin_buttons'
    );
    add_submenu_page(
            'likebtn_like_button_settings', __('Statistics', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . ' ‹ LikeBtn Like Button', __('Statistics', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN), 'manage_options', 'likebtn_like_button_statistics', 'likebtn_like_button_admin_statistics'
    );
    add_submenu_page(
            'likebtn_like_button_settings', __('Help') . ' ‹ LikeBtn Like Button', __('Help'), 'manage_options', 'likebtn_like_button_help', 'likebtn_like_button_admin_help'
    );
}

add_action('admin_menu', 'likebtn_like_button_admin_menu');

// plugin header
function likebtn_like_button_admin_head() {
    global $likebtn_like_button_website_locales;

    $url_css = _likebtn_like_button_get_public_url() . 'css/admin.css?v=' . _likebtn_like_button_get_plugin_version();
    $url_js = _likebtn_like_button_get_public_url() . 'js/admin.js?v=' . _likebtn_like_button_get_plugin_version();
    $likebtn_website_locale = substr(get_bloginfo('language'), 0, 2);

    if (!in_array($likebtn_website_locale, $likebtn_like_button_website_locales)) {
        $likebtn_website_locale = 'en';
    }

    echo '<link rel="stylesheet" type="text/css" href="' . $url_css . '" />';
    echo '<script src="' . $url_js . '" type="text/javascript"></script>';
    echo '<script src="//likebtn.com/' . $likebtn_website_locale . '/js/donate_generator.js" type="text/javascript"></script>';
}

add_action('admin_head', 'likebtn_like_button_admin_head');

// admin header
function likebtn_like_button_admin_header() {
    $logo_url = _likebtn_like_button_get_public_url() . 'img/logotype.png';
    $header = <<<HEADER
    <div class="wrap" id="likebtn_like_button">
        <h2 class="likebtn_logo">
            <a href="http://likebtn.com" target="_blank" title="LikeBtn Like Button">
                <img alt="" src="{$logo_url}">LikeBtn
            </a>
        </h2>
HEADER;

    $header .= '
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_like_button_settings' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_like_button_settings">' . __('Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . '</a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_like_button_buttons' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_like_button_buttons">' . __('Buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . '</a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_like_button_statistics' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_like_button_statistics">' . __('Statistics', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) . '</a>
            <a class="nav-tab ' . ($_GET['page'] == 'likebtn_like_button_help' ? 'nav-tab-active' : '') . '" href="' . admin_url() . 'admin.php?page=likebtn_like_button_help">' . __('Help') . '</a>
        </h2>';

    echo $header;
}

// uninstall hook
function likebtn_like_button_unistall() {
    global $likebtn_like_button_entities;
    global $likebtn_like_button_settings;

    // set default values for options
    delete_option('likebtn_like_button_plan');
    delete_option('likebtn_like_button_account_email');
    delete_option('likebtn_like_button_account_api_key');
    delete_option('likebtn_like_button_sync_inerval');
    delete_option('likebtn_like_button_local_domain');
    delete_option('likebtn_like_button_subdirectory');
    foreach ($likebtn_like_button_entities as $entity_name => $entity_title) {
        delete_option('likebtn_like_button_show_' . $entity_name);
        delete_option('likebtn_like_button_use_settings_from_' . $entity_name);
        delete_option('likebtn_like_button_post_view_mode_' . $entity_name);
        delete_option('likebtn_like_button_post_format_' . $entity_name);
        delete_option('likebtn_like_button_exclude_sections_' . $entity_name);
        delete_option('likebtn_like_button_exclude_categories_' . $entity_name);
        delete_option('likebtn_like_button_allow_ids_' . $entity_name);
        delete_option('likebtn_like_button_exclude_ids_' . $entity_name);
        delete_option('likebtn_like_button_user_logged_in_' . $entity_name);
        delete_option('likebtn_like_button_position_' . $entity_name);
        delete_option('likebtn_like_button_alignment_' . $entity_name);
        delete_option('likebtn_like_button_html_before_' . $entity_name);
        delete_option('likebtn_like_button_html_after_' . $entity_name);
        // settings
        foreach ($likebtn_like_button_settings as $option => $option_info) {
            delete_option('likebtn_like_button_settings_' . $option . '_' . $entity_name);
        }
    }
    delete_option('likebtn_like_button_last_sync_time');
    delete_option('likebtn_like_button_last_successfull_sync_time');
    delete_option('likebtn_like_button_last_locale_sync_time');
}

register_uninstall_hook(__FILE__, 'likebtn_like_button_unistall');

// activation hook
function likebtn_like_button_activation_hook() {

    global $likebtn_like_button_entities;
    global $likebtn_like_button_settings;

    // set default values for options
    add_option('likebtn_like_button_plan', LIKEBTN_LIKE_BUTTON_PLAN_TRIAL);
    add_option('likebtn_like_button_account_email', '');
    add_option('likebtn_like_button_account_api_key', '');
    add_option('likebtn_like_button_sync_inerval', '');
    add_option('likebtn_like_button_local_domain', '');
    add_option('likebtn_like_button_subdirectory', '');

    foreach ($likebtn_like_button_entities as $entity_name => $entity_title) {
        add_option('likebtn_like_button_show_' . $entity_name, '0');
        add_option('likebtn_like_button_use_settings_from_' . $entity_name, '');
        add_option('likebtn_like_button_post_view_mode_' . $entity_name, LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_BOTH);
        add_option('likebtn_like_button_post_format_' . $entity_name, array('all'));
        add_option('likebtn_like_button_exclude_sections_' . $entity_name, array());
        add_option('likebtn_like_button_exclude_categories_' . $entity_name, array());
        add_option('likebtn_like_button_allow_ids_' . $entity_name, '');
        add_option('likebtn_like_button_exclude_ids_' . $entity_name, '');
        add_option('likebtn_like_button_user_logged_in_' . $entity_name, '');
        add_option('likebtn_like_button_position_' . $entity_name, LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM);
        add_option('likebtn_like_button_alignment_' . $entity_name, LIKEBTN_LIKE_BUTTON_ALIGNMENT_LEFT);
        add_option('likebtn_like_button_html_before_' . $entity_name, '');
        add_option('likebtn_like_button_html_after_' . $entity_name, '');
        // settings
        foreach ($likebtn_like_button_settings as $option => $option_info) {
            add_option('likebtn_like_button_settings_' . $option . '_' . $entity_name, $option_info['default']);
        }
    }
    add_option('likebtn_like_button_last_sync_time', 0);
    add_option('likebtn_like_button_last_successfull_sync_time', 0);
}

register_activation_hook(__FILE__, 'likebtn_like_button_activation_hook');

// registering settings
function likebtn_like_button_register_settings() {
    global $likebtn_like_button_entities;
    global $likebtn_like_button_settings;

    register_setting('likebtn_like_button_settings', 'likebtn_like_button_plan');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_account_email');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_account_api_key');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_sync_inerval');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_local_domain');
    register_setting('likebtn_like_button_settings', 'likebtn_like_button_subdirectory');

    // entities settings
    foreach ($likebtn_like_button_entities as $entity_name => $entity_title) {
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_show_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_use_settings_from_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_post_view_mode_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_post_format_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_exclude_sections_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_exclude_categories_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_allow_ids_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_exclude_ids_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_user_logged_in_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_position_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_alignment_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_html_before_' . $entity_name);
        register_setting('likebtn_like_button_buttons', 'likebtn_like_button_html_after_' . $entity_name);

        // settings
        foreach ($likebtn_like_button_settings as $option => $option_info) {
            register_setting('likebtn_like_button_buttons', 'likebtn_like_button_settings_' . $option . '_' . $entity_name);
        }
    }
}

add_action('admin_init', 'likebtn_like_button_register_settings');

// admin content
function likebtn_like_button_admin_settings() {

    global $likebtn_like_button_plans;
    global $likebtn_like_button_sync_intervals;

    // reset sync interval
    if (!get_option('likebtn_like_button_account_email') || !get_option('likebtn_like_button_account_api_key')) {
        update_option('likebtn_like_button_sync_inerval', '');
    }

    likebtn_like_button_admin_header();
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            planChange(jQuery(":input[name='likebtn_like_button_plan']").val());
        });
    </script>
    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <form method="post" action="options.php">
            <?php settings_fields('likebtn_like_button_settings'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label><?php _e('Website Tariff Plan', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                    <td>
                        <select name="likebtn_like_button_plan" onChange="planChange(this.value)">
                            <?php foreach ($likebtn_like_button_plans as $plan_id => $plan_name): ?>
                                <option value="<?php echo $plan_id; ?>" <?php if (get_option('likebtn_like_button_plan') == $plan_id): ?>selected="selected"<?php endif ?> ><?php echo $plan_name; ?></option>
                            <?php endforeach ?>
                        </select>

                        <span class="description"><?php _e('Specify your website <a href="http://likebtn.com/en/#plans_pricing" target="_blank">plan</a>, the plan specified determines available settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
                        <br/>
                        <div class="description">
                            <?php _e('Options marked with tariff plan name (PLUS, PRO, VIP, ULTRA) are available only if your website is upgraded to the corresponding plan. Keep in mind that only websites upgraded to <a href="http://likebtn.com/en/#plans_pricing" target="_blank">PLUS</a> plan or higher are allowed to display more then 10 Like Buttons per page.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?><br/><br/>
                            <a href="javascript:toggleToUpgrade();void(0);"><?php _e('To upgrade your website...', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></a>
                            <ol id="likebtn_like_button_to_upgrade" class="hidden">
                                <li><?php _e('Register on <a href="http://likebtn.com/en/customer.php/register/" target="_blank">LikeBtn.com</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></li>
                                <li><?php _e('Add your website to your account and activate it on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites page</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></li>
                                <li><?php _e('Upgrade your website to the desired plan.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></li>
                            </ol>
                        </div>
                    </td>
                </tr>
            </table>

            <br/>

            <div class="postbox ">
                <h3><?php _e('Automatic syncing of likes into the local database', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (PRO, VIP, ULTRA)</h3>
                <div class="inside">
                    <?php _e('Enter this information in order to enable synchronization of likes from LikeBtn.com system into your database.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><label><?php _e('E-mail', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                            <td>
                                <input type="text" name="likebtn_like_button_account_email" value="<?php echo get_option('likebtn_like_button_account_email') ?>" size="60" onkeyup="accountChange(this)" class="likebtn_like_button_account plan_dependent plan_pro"/><br/>
                                <span class="description"><?php _e('Your LikeBtn.com account email. Can be found on <a href="http://likebtn.com/en/customer.php/profile/edit" target="_blank">Profile page</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('API key', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                            <td>
                                <input type="text" name="likebtn_like_button_account_api_key" value="<?php echo get_option('likebtn_like_button_account_api_key') ?>" size="60" onkeyup="accountChange(this)" class="likebtn_like_button_account plan_dependent plan_pro"/><br/>
                                <span class="description"><?php _e('Your website API key on LikeBtn.com. Can be obtained on <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites page</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label><?php _e('Synchronization interval', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                            <td>
                                <select name="likebtn_like_button_sync_inerval" <?php disabled((!get_option('likebtn_like_button_account_email') || !get_option('likebtn_like_button_account_api_key'))); ?> class="plan_dependent plan_pro">
                                    <option value="" <?php selected('', get_option('likebtn_like_button_sync_inerval')); ?> ><?php _e('Do not fetch likes/dislikes from LikeBtn.com into my database', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></option>
                                    <?php foreach ($likebtn_like_button_sync_intervals as $sync_interval): ?>
                                        <option value="<?php echo $sync_interval; ?>" <?php selected($sync_interval, get_option('likebtn_like_button_sync_inerval')); ?> ><?php echo $sync_interval; ?> <?php _e('min', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                    <?php endforeach ?>
                                </select>
                                <br/>
                                <span class="description"><?php _e('Time interval in minutes in which fetching of vote results from LikeBtn.com into your database is being launched. When synchronization is enabled you can view Statistics, number of likes and dislikes for each post as Custom Field, sort posts by vote results, use Like Button widgets. The less the interval the heavier your database load (60 minutes interval is recommended)', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
                                <br/>
                                <input class="button-primary" type="button" name="TestSync" value="<?php _e('Test synchronization', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" onclick="testSync('<?php echo _likebtn_like_button_get_public_url() ?>img/ajax_loader.gif')" /> &nbsp;<strong class="likebtn_like_button_test_sync_container"><img src="<?php echo _likebtn_like_button_get_public_url() ?>img/ajax_loader.gif" class="hidden"/></strong>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="postbox likebtn_like_button_account">
                <h3><?php _e('Local domain', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">&nbsp;</th>
                            <td>
                                <input type="text" name="likebtn_like_button_local_domain" value="<?php echo get_option('likebtn_like_button_local_domain') ?>" size="60" /><br/>
                                <strong class="description"><?php _e('Example:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?> localdomain!50f358d30acf358d30ac000001</strong>
                                <br/><br/>
                                <span class="description"><?php _e('Specify it if your website is located on a local server and is available from your local network only and NOT available from the Internet. You can find the domain on your <a href="http://likebtn.com/en/customer.php/websites" target="_blank">Websites</a> page after adding your local website to the panel. See <a href="http://likebtn.com/en/faq#local_domain" target="_blank">FAQ</a> for more details.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="postbox likebtn_like_button_account">
                <h3><?php _e('Website subdirectory', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">&nbsp;</th>
                            <td>
                                <input type="text" name="likebtn_like_button_subdirectory" value="<?php echo get_option('likebtn_like_button_subdirectory') ?>" size="60" /><br/>
                                <strong class="description"><?php _e('Example:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?> /subdirectory/</strong>
                                <br/><br/>
                                <span class="description"><?php _e('If your whole website is located in a subdirectory (for example http://website.com/subdirectory/), enter subdirectory (for example /subdirectory/). Required for path-based <a href="http://codex.wordpress.org/Create_A_Network" target="_blank">multisite networks</a> in which on-demand sites use paths.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <input class="button-primary" type="submit" name="Save" value="<?php _e('Save', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" />
        </form>

    </div>
    </div>
    <?php
}

// admin buttons
function likebtn_like_button_admin_buttons() {

    global $likebtn_like_button_entities;
    global $likebtn_like_button_styles;
    global $likebtn_like_button_default_languages;
    global $likebtn_like_button_settings;

    // retrieve post formats
    $post_formats = _likebtn_like_button_get_post_formats();

    // run sunchronization
    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncLocales();
    $likebtn->runSyncStyles();

    $locales = get_option('likebtn_like_button_locales');

    $languages = array();
    $languages['auto'] = 'auto - ' . __("Detect from client browser", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    if ($locales) {
        // Locales have been loaded using API.
        foreach ($locales as $locale_code => $locale_info) {
            $lang_option = $locale_code . ' - ' . $locale_info['name'];
            if ($locale_code != 'en') {
                $lang_option .= ' (' . $locale_info['en_name'] . ')';
            }
            $languages[$locale_code] = $lang_option;
        }
    } else {
        // Locales have not been loaded using API yet, load default languages.
        foreach ($likebtn_like_button_default_languages as $lang_code => $lang_title) {
            $languages[$lang_code] = $lang_title;
        }
    }

    // Get styles
    $styles = get_option('likebtn_like_button_styles');

    $style_options = array();
    if (!$styles) {
      // Styles have not been loaded using API yet, load default languages
      $styles = $likebtn_like_button_styles;
    }
    foreach ($styles as $style) {
      $style_options[] = $style;
    }

    likebtn_like_button_admin_header();
    ?>
    <script type="text/javascript">
        var reset_settings = [];
        reset_settings['post_view_mode'] = 'both';
        reset_settings['post_format'] = 'all';
        reset_settings['exclude_sections'] = '';
        reset_settings['exclude_categories'] = '';
        reset_settings['allow_ids'] = '';
        reset_settings['exclude_ids'] = '';
        reset_settings['position'] = 'bottom';
        reset_settings['alignment'] = 'left';
        reset_settings['user_logged_in'] = '';
    <?php foreach ($likebtn_like_button_settings as $option_name => $option_info): ?>
            reset_settings['settings_<?php echo $option_name ?>'] = '<?php echo $option_info['default'] ?>';
    <?php endforeach ?>

        jQuery(document).ready(function() {
            planChange('<?php echo get_option('likebtn_like_button_plan'); ?>');
        });
    </script>

    <div id="poststuff" class="metabox-holder has-right-sidebar">
        <form method="post" action="options.php">
            <?php settings_fields('likebtn_like_button_buttons'); ?>

            <?php
            foreach ($likebtn_like_button_entities as $entity_name => $entity_title):

                $excluded_sections = get_option('likebtn_like_button_exclude_sections_' . $entity_name);
                if (!is_array($excluded_sections)) {
                    $excluded_sections = array();
                }

                $excluded_categories = get_option('likebtn_like_button_exclude_categories_' . $entity_name);
                if (!is_array($excluded_categories)) {
                    $excluded_categories = array();
                }

                // just in case
                if (!is_array(get_option('likebtn_like_button_post_format_' . $entity_name))) {
                    update_option('likebtn_like_button_post_format_' . $entity_name, array('all'));
                }

                ?>

                <div class="postbox">
                    <h3><?php _e($entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                    <div class="inside">

                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row"><label><?php _e('Show Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                <td>
                                    <input type="checkbox" name="likebtn_like_button_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_show_' . $entity_name)); ?> onClick="entityShowChange(this, '<?php echo $entity_name; ?>')" />
                                </td>
                            </tr>
                        </table>

                        <div id="entity_container_<?php echo $entity_name; ?>" <?php if (!get_option('likebtn_like_button_show_' . $entity_name)): ?>style="display:none"<?php endif ?>>
                            <table class="form-table" >
                                <tr valign="top">
                                    <th scope="row"><label><?php _e('Use settings from', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                    <td>
                                        <select name="likebtn_like_button_use_settings_from_<?php echo $entity_name; ?>" onChange="userSettingsFromChange(this, '<?php echo $entity_name; ?>')">
                                            <option value="" <?php selected('', get_option('likebtn_like_button_use_settings_from_' . $entity_name)); ?> >&nbsp;</option>
                                            <?php foreach ($likebtn_like_button_entities as $use_entity_name => $use_entity_title): ?>
                                                <?php
                                                if ($use_entity_name == $entity_name) {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo $use_entity_name; ?>" <?php selected($use_entity_name, get_option('likebtn_like_button_use_settings_from_' . $entity_name)); ?> ><?php _e($use_entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <span class="description"><?php _e('Choose the entity you want to copy the Like Button settings from or leave it blank if you want to configure the Like Button.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                    </td>
                                </tr>
                            </table>
                            <div class="postbox" id="use_settings_from_container_<?php echo $entity_name; ?>" <?php if (get_option('likebtn_like_button_use_settings_from_' . $entity_name)): ?>style="display:none"<?php endif ?>>
                                <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>

                                <div class="inside hidden" >
                                    <table class="form-table" >

                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Post view mode', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <input type="radio" name="likebtn_like_button_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_FULL; ?>" <?php checked(LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_FULL, get_option('likebtn_like_button_post_view_mode_' . $entity_name)) ?> /> <?php _e('Full', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="likebtn_like_button_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_EXCERPT; ?>" <?php checked(LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_EXCERPT, get_option('likebtn_like_button_post_view_mode_' . $entity_name)) ?> /> <?php _e('Excerpt', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="likebtn_like_button_post_view_mode_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_BOTH; ?>" <?php checked(LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_BOTH, get_option('likebtn_like_button_post_view_mode_' . $entity_name)) ?> /> <?php _e('Both', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>


                                                <br/>
                                                <span class="description"><?php _e('Choose Post display mode for which you want to show the Like Button.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Post format', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <input type="checkbox" name="likebtn_like_button_post_format_<?php echo $entity_name; ?>[]" value="all" <?php if (in_array('all', get_option('likebtn_like_button_post_format_' . $entity_name))): ?>checked="checked"<?php endif ?> onClick="postFormatAllChange(this, '<?php echo $entity_name; ?>')" /> <?php _e('All', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                <span id="post_format_container_<?php echo $entity_name; ?>" <?php if (in_array('all', get_option('likebtn_like_button_post_format_' . $entity_name))): ?>style="display:none"<?php endif ?>>
                                                    <?php foreach ($post_formats as $post_format): ?>
                                                        <input type="checkbox" name="likebtn_like_button_post_format_<?php echo $entity_name; ?>[]" value="<?php echo $post_format; ?>" <?php if (in_array($post_format, get_option('likebtn_like_button_post_format_' . $entity_name))): ?>checked="checked"<?php endif ?> /> <?php _e(__(ucfirst($post_format), LIKEBTN_LIKE_BUTTON_I18N_DOMAIN)); ?>&nbsp;&nbsp;&nbsp;
                                                    <?php endforeach ?>
                                                </span>
                                                <br/>
                                                <span class="description"><?php _e('Select Post formats for which you want to show the Like Button.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                            </td>
                                        </tr>

                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Exclude on selected sections', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <input type="checkbox" name="likebtn_like_button_exclude_sections_<?php echo $entity_name; ?>[]" value="home" <?php if (in_array('home', $excluded_sections)): ?>checked="checked"<?php endif ?> /> <?php _e('Home'); ?>&nbsp;&nbsp;&nbsp;
                                                <input type="checkbox" name="likebtn_like_button_exclude_sections_<?php echo $entity_name; ?>[]" value="archive" <?php if (in_array('archive', $excluded_sections)): ?>checked="checked"<?php endif ?> /> <?php _e('Archive', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                                                <br/>
                                                <span class="description"><?php _e('Choose sections where you DO NOT want to show the Like Button.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Exclude in selected categories', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <select name='likebtn_like_button_exclude_categories_<?php echo $entity_name; ?>[]' multiple="multiple" size="4" style="height:auto !important;">
                                                    <?php
                                                    $categories = get_categories();

                                                    foreach ($categories as $category) {
                                                        $selected = (in_array($category->cat_ID, $excluded_categories)) ? 'selected="selected"' : '';
                                                        $option = '<option value="' . $category->cat_ID . '" ' . $selected . '>';
                                                        $option .= $category->cat_name;
                                                        $option .= ' (' . $category->category_count . ')';
                                                        $option .= '</option>';
                                                        echo $option;
                                                    }
                                                    ?>
                                                </select>
                                                <span class="description"><?php _e('Select categories where you do not want to show the Like Button. Use CTRL key to select/unselect categories.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Allow post/page IDs', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <input type="text" size="40" name="likebtn_like_button_allow_ids_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_like_button_allow_ids_' . $entity_name)); ?>" /><br/>
                                                <span class="description"><?php _e('Suppose you have a post which belongs to more than one categories and you have excluded one of those categories. So the Like Button will not be available for that post. Enter comma separated post ids where you want to show the Like Button irrespective of that post category being excluded.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Exclude post/page IDs', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <input type="text" size="40" name="likebtn_like_button_exclude_ids_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_like_button_exclude_ids_' . $entity_name)); ?>" />
                                                <span class="description"><?php _e('Comma separated post/page IDs where you do not want to show the Like Button.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('User authorization', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <input type="radio" name="likebtn_like_button_user_logged_in_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_user_logged_in_' . $entity_name)) ?> /> <?php _e('Logged in', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="likebtn_like_button_user_logged_in_<?php echo $entity_name; ?>" value="0" <?php checked('0', get_option('likebtn_like_button_user_logged_in_' . $entity_name)) ?> /> <?php _e('Not logged in', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="likebtn_like_button_user_logged_in_<?php echo $entity_name; ?>" value="" <?php checked('', get_option('likebtn_like_button_user_logged_in_' . $entity_name)) ?> /> <?php _e('For all', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                                                <br/>
                                                <span class="description"><?php _e('Show the Like Button when user is logged in, not logged in or show for all.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>

                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Position', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <input type="radio" name="likebtn_like_button_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POSITION_TOP ?>" <?php if (LIKEBTN_LIKE_BUTTON_POSITION_TOP == get_option('likebtn_like_button_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Top of Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="likebtn_like_button_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM ?>" <?php if (LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM == get_option('likebtn_like_button_position_' . $entity_name) || !get_option('likebtn_like_button_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Bottom of Content', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="likebtn_like_button_position_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_POSITION_BOTH ?>" <?php if (LIKEBTN_LIKE_BUTTON_POSITION_BOTH == get_option('likebtn_like_button_position_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Top and Bottom', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>

                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Alignment', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <input type="radio" name="likebtn_like_button_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_ALIGNMENT_LEFT; ?>" <?php if (LIKEBTN_LIKE_BUTTON_ALIGNMENT_LEFT == get_option('likebtn_like_button_alignment_' . $entity_name) || !get_option('likebtn_like_button_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Left'); ?>
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="likebtn_like_button_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_ALIGNMENT_CENTER; ?>" <?php if (LIKEBTN_LIKE_BUTTON_ALIGNMENT_CENTER == get_option('likebtn_like_button_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Center'); ?>
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="likebtn_like_button_alignment_<?php echo $entity_name; ?>" value="<?php echo LIKEBTN_LIKE_BUTTON_ALIGNMENT_RIGHT; ?>" <?php if (LIKEBTN_LIKE_BUTTON_ALIGNMENT_RIGHT == get_option('likebtn_like_button_alignment_' . $entity_name)): ?>checked="checked"<?php endif ?> /> <?php _e('Right'); ?>

                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Insert HTML before', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <textarea name="likebtn_like_button_html_before_<?php echo $entity_name; ?>" cols="40" rows="2"><?php echo get_option('likebtn_like_button_html_before_' . $entity_name); ?></textarea>
                                                <span class="description"><?php _e('HTML code to insert before the Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label><?php _e('Insert HTML after', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                            <td>
                                                <textarea name="likebtn_like_button_html_after_<?php echo $entity_name; ?>" cols="40" rows="2"><?php echo get_option('likebtn_like_button_html_after_' . $entity_name); ?></textarea>
                                                <span class="description"><?php _e('HTML code to insert after the Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                            </td>
                                        </tr>
                                    </table>
                                    <br/>
                                    <p class="description">&nbsp;&nbsp;<?php _e('You can find detailed description of the Like Button settings available below on <a href="http://likebtn.com/en/#settings" target="_blank">LikeBtn.com</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></p><br/>
                                    <div class="postbox">
                                        <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Style and language', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                        <div class="inside hidden">
                                            <table class="form-table">
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Style', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <select name="likebtn_like_button_settings_style_<?php echo $entity_name; ?>">
                                                            <?php foreach ($style_options as $style): ?>
                                                                <option value="<?php echo $style; ?>" <?php selected($style, get_option('likebtn_like_button_settings_style_' . $entity_name)); ?> ><?php echo $style; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <span class="description">style</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Language', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <select name="likebtn_like_button_settings_lang_<?php echo $entity_name; ?>">
                                                            <?php foreach ($languages as $lang_code => $lang_title): ?>
                                                                <option value="<?php echo $lang_code; ?>" <?php selected($lang_code, get_option('likebtn_like_button_settings_lang_' . $entity_name)); ?> ><?php echo $lang_title; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <span class="description">lang</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="postbox">
                                        <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Appearance and behaviour', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                        <div class="inside hidden">
                                            <table class="form-table">
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show "like"-label', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_show_like_label_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_show_like_label_' . $entity_name)); ?> />
                                                        <span class="description">show_like_label</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show "dislike"-label', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_show_dislike_label_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_show_dislike_label_' . $entity_name)); ?> />
                                                        <span class="description">show_dislike_label</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show Like Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_like_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_like_enabled_' . $entity_name)); ?> />
                                                        <span class="description">like_enabled</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show Dislike Button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_dislike_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_dislike_enabled_' . $entity_name)); ?> />
                                                        <span class="description">dislike_enabled</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Votes counter is clickable', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_counter_clickable_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_counter_clickable_' . $entity_name)); ?> />
                                                        <span class="description">counter_clickable</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show votes counter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_counter_show_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_counter_show_' . $entity_name)); ?> />
                                                        <span class="description">counter_show</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Counter type', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <select name="likebtn_like_button_settings_counter_type_<?php echo $entity_name; ?>">
                                                            <option value="number" <?php selected('number', get_option('likebtn_like_button_settings_counter_type_' . $entity_name)); ?> ><?php _e('number', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                            <option value="percent" <?php selected('percent', get_option('likebtn_like_button_settings_counter_type_' . $entity_name)); ?> ><?php _e('percent', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                            <option value="substract_dislikes" <?php selected('substract_dislikes', get_option('likebtn_like_button_settings_counter_type_' . $entity_name)); ?> ><?php _e('substract_dislikes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                            <option value="single_number" <?php selected('single_number', get_option('likebtn_like_button_settings_counter_type_' . $entity_name)); ?> ><?php _e('single_number', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                        </select>
                                                        <span class="description">counter_type</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Voting is disabled, display results only', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_display_only_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_display_only_' . $entity_name)); ?> />
                                                        <span class="description">display_only</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Allow to unlike and undislike', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_unlike_allowed_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_unlike_allowed_' . $entity_name)); ?> />
                                                        <span class="description">unlike_allowed</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Allow to like and dislike at the same time', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_like_dislike_at_the_same_time_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_like_dislike_at_the_same_time_' . $entity_name)); ?> />
                                                        <span class="description">like_dislike_at_the_same_time</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show copyright link in the share popup', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (VIP, ULTRA)</label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_show_copyright_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_show_copyright_' . $entity_name)); ?> class="plan_dependent plan_vip" />
                                                        <span class="description">show_copyright</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Custom HTML to insert into the popup', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (PRO, VIP, ULTRA)</label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_popup_html_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_popup_html_' . $entity_name); ?>" size="60" class="plan_dependent plan_pro"/>
                                                        <span class="description">popup_html</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Donate buttons to display in the popup', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (VIP, ULTRA)</label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_popup_donate_<?php echo $entity_name; ?>" value="<?php echo htmlspecialchars(get_option('likebtn_like_button_settings_popup_donate_' . $entity_name)); ?>" size="60" id="popup_donate_input" class="plan_dependent plan_vip"/> <a href="javascript:likebtnDG('popup_donate_input');void(0);"><img class="popup_donate_trigger" src="<?php echo _likebtn_like_button_get_public_url() ?>img/popup_donate.png" alt="<?php _e('Configure donate buttons', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>"></a>
                                                        <span class="description">popup_donate</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Order of the content in the popup', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_popup_content_order_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_popup_content_order_' . $entity_name); ?>" size="60" />
                                                        <span class="description">popup_content_order</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show popop after "liking"', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (VIP, ULTRA)</label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_popup_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_popup_enabled_' . $entity_name)); ?> class="plan_dependent plan_vip" />
                                                        <span class="description">popup_enabled</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Popup position', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <select name="likebtn_like_button_settings_popup_position_<?php echo $entity_name; ?>">
                                                            <option value="top" <?php selected('top', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('top', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                            <option value="right" <?php selected('right', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('right', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                            <option value="bottom" <?php selected('bottom', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('bottom', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                            <option value="left" <?php selected('left', get_option('likebtn_like_button_settings_popup_position_' . $entity_name)); ?> ><?php _e('left', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                        </select>
                                                        <span class="description">popup_position</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Popup style', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <select name="likebtn_like_button_settings_popup_style_<?php echo $entity_name; ?>">
                                                            <option value="light" <?php selected('light', get_option('likebtn_like_button_settings_popup_style_' . $entity_name)); ?> ><?php _e('light', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                            <option value="dark" <?php selected('dark', get_option('likebtn_like_button_settings_popup_style_' . $entity_name)); ?> ><?php _e('dark', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                                                        </select>
                                                        <span class="description">popup_style</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Hide popup when clicking outside', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_popup_hide_on_outside_click_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_popup_hide_on_outside_click_' . $entity_name)); ?> />
                                                        <span class="description">popup_hide_on_outside_click</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row">
                                                        <label>
                                                            <?php _e('JavaScript callback function serving as an event handler', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td class="description">
                                                        <input type="text" size="40" name="likebtn_like_button_settings_event_handler_<?php echo $entity_name; ?>" value="<?php _e(get_option('likebtn_like_button_settings_event_handler_' . $entity_name)); ?>" />
                                                        <span class="description">event_handler</span><br/>
                                                        <?php _e('The provided function receives the event object as its single argument. The event object has the following properties:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                                                        <code>type</code> – <?php _e('indicates which event was dispatched:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                                                        ● "likebtn.loaded"<br/>
                                                        ● "likebtn.like"<br/>
                                                        ● "likebtn.unlike"<br/>
                                                        ● "likebtn.dislike"<br/>
                                                        ● "likebtn.undislike"<br/>
                                                        <code>settings</code> – <?php _e('button settings', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
                                                        <code>wrapper</code> – <?php _e('button DOM-element', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show information message when the button is restricted by the tariff plan', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_info_message_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_info_message_' . $entity_name)); ?> />
                                                        <span class="description">info_message</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="postbox">
                                        <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Sharing', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                        <div class="inside hidden">
                                            <table class="form-table">
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show share buttons in the popup', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (PLUS, PRO, VIP, ULTRA)</label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_share_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_share_enabled_' . $entity_name)); ?> class="plan_dependent plan_plus" />
                                                        <span class="description">share_enabled</span><br/>
                                                        <span class="description"><?php _e('Use popup_enabled option to enable/disable popup.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show popup on disliking', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_popup_dislike_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_popup_dislike_' . $entity_name)); ?> />
                                                        <span class="description">popup_dislike</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('AddThis <a href="https://www.addthis.com/settings/publisher" target="_blank">Profile ID</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (PRO, VIP, ULTRA)</label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_addthis_pubid_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_addthis_pubid_' . $entity_name); ?>" size="60" class="plan_dependent plan_pro"/>
                                                        <span class="description">addthis_pubid</span><br/>
                                                        <span class="description"><?php _e('Allows to collect sharing statistics and view it on AddThis <a href="http://www.addthis.com/analytics" target="_blank">analytics page</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('AddThis <a href="http://www.addthis.com/services/list" target="_blank">service codes</a>', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (PRO, VIP, ULTRA)</label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_addthis_service_codes_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_addthis_service_codes_' . $entity_name); ?>" size="60" class="plan_dependent plan_pro"/>
                                                        <span class="description">addthis_service_codes</span><br/>
                                                        <span class="description"><?php _e('Service codes separated by comma (max 8). Used to specify which buttons are displayed in share popup.<br/>Example: google_plusone_share, facebook, twitter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="postbox">
                                        <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Tooltips', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                        <div class="inside hidden">
                                            <table class="form-table">
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Show tooltips', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_tooltip_enabled_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_tooltip_enabled_' . $entity_name)); ?> />
                                                        <span class="description">tooltip_enabled</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="postbox">
                                        <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Domains', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                        <div class="inside hidden">
                                            <table class="form-table">
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Use domain of the parent window', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="checkbox" name="likebtn_like_button_settings_domain_from_parent_<?php echo $entity_name; ?>" value="1" <?php checked('1', get_option('likebtn_like_button_settings_domain_from_parent_' . $entity_name)); ?> />
                                                        <span class="description">domain_from_parent</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="postbox">
                                        <h3 style="cursor:pointer" onclick="toggleCollapsable(this)" class="likebtn_like_button_collapse_trigger"><small>►</small> <?php _e('Labels', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                                        <div class="inside hidden">
                                            <table class="form-table">
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Like Button label', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_like_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_like_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_like</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Dislike Button label', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_dislike_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_dislike_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_dislike</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Like Button tooltip', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_like_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_like_tooltip_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_like_tooltip</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Dislike Button tooltip', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_dislike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_dislike_tooltip_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_dislike_tooltip</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Like Button tooltip after "liking"', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_unlike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_unlike_tooltip_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_unlike_tooltip</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Dislike Button tooltip after "disliking"', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_undislike_tooltip_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_undislike_tooltip_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_undislike_tooltip</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Text displayed in share popup after "liking"', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_share_text_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_share_text_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_share_text</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Popup close button', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_popup_close_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_popup_close_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_popup_close</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Popup text when sharing is disabled', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_popup_text_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_popup_text_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_popup_text</span>
                                                    </td>
                                                </tr>
                                                <tr valign="top">
                                                    <th scope="row"><label><?php _e('Text before donate buttons in the popup', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                                    <td>
                                                        <input type="text" name="likebtn_like_button_settings_i18n_popup_donate_<?php echo $entity_name; ?>" value="<?php echo get_option('likebtn_like_button_settings_i18n_popup_donate_' . $entity_name); ?>" size="60"/>
                                                        <span class="description">i18n_popup_donate</span>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <input class="button-secondary" type="button" name="Reset" value="<?php _e('Reset', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" onclick="return resetSettings('<?php echo $entity_name; ?>', reset_settings)" />

                                </div>
                            </div>
                            <?php if (get_option('likebtn_like_button_show_' . $entity_name) == '1'): ?>
                                <table class="form-table">
                                    <tr valign="top">
                                        <th scope="row"><label><?php _e('Demo', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></label></th>
                                        <td>
                                            <?php echo _likebtn_like_button_get_markup($entity_name, 'demo', array(), get_option('likebtn_like_button_use_settings_from_' . $entity_name)) ?>
                                        </td>
                                    </tr>
                                </table>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                 <input class="button-primary" type="submit" name="Save" value="<?php _e('Save', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" /><br/><br/>
            <?php endforeach ?>
        </form>

    </div>
    </div>
    <?php
}

// admin vote statistics
function likebtn_like_button_admin_statistics() {

    global $likebtn_like_button_entities;
    global $likebtn_like_button_page_sizes;
    global $likebtn_like_button_post_statuses;
    global $wpdb;

    // get parameters
    // For translation
    __('Comment');
    $entity_name = $_GET['likebtn_like_button_entity_name'];
    if (!array_key_exists($entity_name, $likebtn_like_button_entities)) {
        $entity_name = LIKEBTN_LIKE_BUTTON_ENTITY_POST;
    }

    // Resettings
    $reseted = '';
    if (!empty($_POST['item'])) {
        $reseted = likebtn_like_button_reset($entity_name, $_POST['item']);
    }

    // Run sunchronization
    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncVotes();

    // add comment statuses
    $likebtn_like_button_post_statuses['0'] = __('Comment not approved', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    $likebtn_like_button_post_statuses['1'] = __('Comment approved', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);

    $sort_by = $_GET['likebtn_like_button_sort_by'];
    if (!$sort_by) {
        $sort_by = 'likes';
    }

    $page_size = $_GET['likebtn_like_button_page_size'];
    if (!$page_size) {
        $page_size = LIKEBTN_LIKE_BUTTON_STATISTIC_PAGE_SIZE;
    }

    $post_id = '';
    if (isset($_GET['likebtn_like_button_post_id'])) {
        $post_id = trim(stripcslashes($_GET['likebtn_like_button_post_id']));
    }

    $post_title = '';
    if (isset($_GET['likebtn_like_button_post_title'])) {
        $post_title = trim(stripcslashes($_GET['likebtn_like_button_post_title']));
    }
    $post_status = '';
    if (isset($_GET['likebtn_like_button_post_status'])) {
        $post_status = trim($_GET['likebtn_like_button_post_status']);
    }

    // pagination
    require_once(dirname(__FILE__) . '/likebtn_like_button_pagination.class.php');

    $pagination_target = "admin.php?page=likebtn_like_button_statistics";
    foreach ($_GET as $get_parameter => $get_value) {
        $pagination_target .= '&' . $get_parameter . '=' . stripcslashes($get_value);
    }

    $p = new LikeBtnLikeButtonPagination();
    $p->limit($page_size); // Limit entries per page
    $p->target($pagination_target);
    $p->currentPage($_GET[$p->paging]); // Gets and validates the current page
    $p->prevLabel(__('Previous', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN));
    $p->nextLabel(__('Next', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN));

    if (!isset($_GET['paging'])) {
        $p->page = 1;
    } else {
        $p->page = $_GET['paging'];
    }

    //Query for limit paging
    $query_limit = "LIMIT " . ($p->page - 1) * $p->limit . ", " . $p->limit;

    // build statistics
    $statistics = array();

    // query parameters
    $query_where = '';

    if ($entity_name != LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
        $query_where .= ' AND p.post_type = %s ';
        $query_parameters[] = $entity_name;
    }

    if ($post_id) {
        $query_where .= ' AND p.ID = %d ';
        $query_parameters[] = $post_id;
    }
    if ($post_title) {
        if ($entity_name != LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
            $query_where .= ' AND LOWER(p.post_title) LIKE "%%%s%%" ';
        } else {
            $query_where .= ' AND LOWER(p.comment_content) LIKE "%%%s%%" ';
        }
        $query_parameters[] = strtolower($post_title);
    }
    if ($post_status !== '') {
        if ($entity_name != LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
            $query_where .= ' AND p.post_status = %s ';
        } else {
            $query_where .= ' AND p.comment_approved = %s ';
        }
        $query_parameters[] = $post_status;
    }

    // order by
    switch ($sort_by) {
        case 'likes':
            $query_orderby = 'likes';
            break;
        case 'dislikes':
            $query_orderby = 'dislikes';
            break;
        case 'last_updated':
            $query_orderby = 'pm_likes.meta_id';
            break;
    }

    if ($entity_name != LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
        // post
        $query = "
             SELECT SQL_CALC_FOUND_ROWS
                p.ID as 'post_id',
                p.post_title,
                pm_likes.meta_value as 'likes',
                pm_dislikes.meta_value as 'dislikes',
                pm_likes_minus_dislikes.meta_value as 'likes_minus_dislikes'
             FROM {$wpdb->prefix}postmeta pm_likes
             LEFT JOIN {$wpdb->prefix}posts p
                 ON (p.ID = pm_likes.post_id)
             LEFT JOIN {$wpdb->prefix}postmeta pm_dislikes
                 ON (pm_dislikes.post_id = pm_likes.post_id AND pm_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES . "')
             LEFT JOIN {$wpdb->prefix}postmeta pm_likes_minus_dislikes
                 ON (pm_likes_minus_dislikes.post_id = pm_likes.post_id AND pm_likes_minus_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES . "')
             WHERE
                pm_likes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES . "'
                {$query_where}
             ORDER BY
                {$query_orderby} DESC
             {$query_limit}";
    } else {
        // comment
        $query = "
             SELECT SQL_CALC_FOUND_ROWS
                p.comment_ID as 'post_id',
                p.comment_content as post_title,
                pm_likes.meta_value as 'likes',
                pm_dislikes.meta_value as 'dislikes',
                pm_likes_minus_dislikes.meta_value as 'likes_minus_dislikes'
             FROM {$wpdb->prefix}commentmeta pm_likes
             LEFT JOIN {$wpdb->prefix}comments p
                 ON (p.comment_ID = pm_likes.comment_id)
             LEFT JOIN {$wpdb->prefix}commentmeta pm_dislikes
                 ON (pm_dislikes.comment_id = pm_likes.comment_id AND pm_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES . "')
             LEFT JOIN {$wpdb->prefix}commentmeta pm_likes_minus_dislikes
                 ON (pm_likes_minus_dislikes.comment_id = pm_likes.comment_id AND pm_likes_minus_dislikes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES_MINUS_DISLIKES . "')
             WHERE
                pm_likes.meta_key = '" . LIKEBTN_LIKE_BUTTON_META_KEY_LIKES . "'
                {$query_where}
             ORDER BY
                {$query_orderby} DESC
             {$query_limit}";
    }
//    echo "<pre>";
//    echo $wpdb->prepare($query, $query_parameters);
    $statistics = $wpdb->get_results($wpdb->prepare($query, $query_parameters));

    $total_found = 0;
    if (isset($statistics[0])) {
        $query_found_rows = "SELECT FOUND_ROWS() as found_rows";
        $found_rows = $wpdb->get_results($query_found_rows);

        $total_found = (int) $found_rows[0]->found_rows;

        $p->items($total_found);
        $p->calculate(); // Calculates what to show
        $p->parameterName('paging');
        $p->adjacents(1); // No. of page away from the current page
    }

    likebtn_like_button_admin_header();
    ?>
    <div id="poststuff" class="metabox-holder has-right-sidebar">

        <a href="javascript:toggleToUpgrade();void(0);"><?php _e('To enable statistics...', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></a>
        <ol id="likebtn_like_button_to_upgrade" class="hidden">
            <li><?php _e('Upgrade your website to PRO or higher plan on <a href="http://likebtn.com/en/#plans_pricing" target="_blank" title="Like Button Plans">LikeBtn.com</a>.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <li><?php _e('Set your website tariff plan in Settings.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <li><?php _e('Enter E-mail and API key in Settings.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <li><?php _e('Set Synchronization interval in Settings.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li>
            <?php /* <li><?php _e('Run Synchronization test in Settings.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></li> */ ?>
        </ol>
        <br/><br/>
        <form action="" method="get" id="statistics_form">
            <input type="hidden" name="page" value="likebtn_like_button_statistics" />


            <label><?php _e('Type'); ?>:</label>
            <select name="likebtn_like_button_entity_name" >
                <?php foreach ($likebtn_like_button_entities as $entity_name_value => $entity_title): ?>
                    <option value="<?php echo $entity_name_value; ?>" <?php selected($entity_name, $entity_name_value); ?> ><?php _e($entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <?php endforeach ?>
            </select>
            &nbsp;&nbsp;
            <label><?php _e('Show first', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
            <select name="likebtn_like_button_sort_by" >
                <option value="likes" <?php selected('likes', $sort_by); ?> ><?php _e('Most liked', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <option value="dislikes" <?php selected('dislikes', $sort_by); ?> ><?php _e('Most disliked', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option>
                <?php /* <option value="last_updated" <?php selected('last_updated', $sort_by); ?> ><?php _e('Last updated', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></option> */ ?>
            </select>

            &nbsp;&nbsp;
            <label><?php _e('Page size', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
            <select name="likebtn_like_button_page_size" >
                <?php foreach ($likebtn_like_button_page_sizes as $page_size_value): ?>
                    <option value="<?php echo $page_size_value; ?>" <?php selected($page_size, $page_size_value); ?> ><?php echo $page_size_value ?></option>
                <?php endforeach ?>

            </select>
            <br/><br/>
            <div class="postbox statistics_filter_container">
                <h3><?php _e('Filter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></h3>
                <div class="inside">
                    <label><?php _e('ID', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
                    <input type="text" name="likebtn_like_button_post_id" value="<?php echo htmlspecialchars($post_id) ?>" size="8" />
                    &nbsp;&nbsp;
                    <label><?php _e('Title'); ?>:</label>
                    <input type="text" name="likebtn_like_button_post_title" value="<?php echo htmlspecialchars($post_title) ?>" size="60"/>
                    &nbsp;&nbsp;
                    <label><?php _e('Status', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>:</label>
                    <select name="likebtn_like_button_post_status" >
                        <option value=""></option>
                        <?php foreach ($likebtn_like_button_post_statuses as $post_status_value => $post_status_title): ?>
                            <option value="<?php echo $post_status_value; ?>" <?php selected($post_status, $post_status_value); ?> ><?php echo _e($post_status_title) ?></option>
                        <?php endforeach ?>
                    </select>

                    &nbsp;&nbsp;
                    <input class="button-secondary" type="button" name="reset" value="<?php _e('Reset filter', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" onClick="jQuery('.statistics_filter_container :input[type!=button]').val('');
                jQuery('#statistics_form').submit();"/>
                </div>
            </div>

            <input class="button-primary" type="submit" name="show" value="<?php _e('Show', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" />
        </form>
        <br/>
        <?php _e('Total found', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>: <strong><?php echo $total_found ?></strong>
        <br/>
        <?php if ($reseted !== ''): ?>
            <br/><span style="color: green"><?php _e('Likes and dislikes for the following number of items have been successfully reseted:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></span> <strong style="color: green"><?php echo $reseted ?></strong><br/>
        <?php endif ?>
        <form onsubmit="return statisticsSubmit('<?php echo get_option('likebtn_like_button_plan'); ?>', {
              confirm: '<?php _e("The votes count can not be recovered after resetting. Are you sure you want to reset likes and dislikes for the selected item(s)?", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>',
              items: '<?php _e("Select item(s) you want to reset", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>',
              upgrade: '<?php _e("Upgrade your website to VIP to be able to use the feature", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>'
        })" method="post" action="">
        <?php if (count($statistics) && $p->total_pages > 0): ?>
            <div class="tablenav">
                <input type="submit" class="button-secondary" onclick="" name="reset_selected" value="<?php _e('Reset selected', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>" title="<?php _e('Set to zero number of likes and dislikes for selected items', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>">
                <div class="tablenav-pages">
                    <?php echo $p->show(); ?>
                </div>
            </div>
        <?php endif ?>
        <table class="widefat" id="statistics_container">
            <thead>
                <tr>
                    <th><input type="checkbox" onclick="statisticsItemsCheckbox(this)" value="all" style="margin:0"></th>
                    <th>ID</th>
                    <?php if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_POST): ?>
                        <th><?php _e('Thumbnail') ?></th>
                    <?php endif ?>
                    <th><?php _e('Title') ?></th>
                    <th><?php _e('Likes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></th>
                    <th><?php _e('Dislikes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></th>
                    <th><?php _e('Likes minus dislikes', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statistics as $statistics_item): ?>
                    <?php if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT): ?>
                        <?php $post_url = get_comment_link($statistics_item->post_id); ?>
                    <?php else: ?>
                        <?php $post_url = get_permalink($statistics_item->post_id); ?>
                    <?php endif ?>
                    <?php if (mb_strlen($statistics_item->post_title) > 100): ?>
                        <?php $statistics_item->post_title = mb_substr($statistics_item->post_title, 0, 100) . '...'; ?>
                    <?php endif ?>
                    <?php if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')): ?>
                        <?php $statistics_item->post_title = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($statistics_item->post_title); ?>
                    <?php endif ?>
                    <tr id="item_<?php echo $statistics_item->post_id; ?>">
                        <td><input type="checkbox" class="item_checkbox" value="<?php echo $statistics_item->post_id; ?>" name="item[]"></td>
                        <td><?php echo $statistics_item->post_id; ?></td>
                        <?php if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_POST): ?>
                            <td><?php echo get_the_post_thumbnail($statistics_item->post_id, 'thumbnail'); ?>&nbsp;</td>
                        <?php endif ?>
                        <td><a href="<?php echo $post_url ?>" target="_blank"><?php echo htmlspecialchars($statistics_item->post_title); ?></a></td>
                        <td><a href="javascript:statisticsEdit('<?php echo $entity_name ?>', '<?php echo $statistics_item->post_id; ?>', 'like', '<?php echo get_option('likebtn_like_button_plan'); ?>', '<?php _e('Enter new value:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>', '<?php _e('Upgrade your website plan to the ULTRA plan to use the feature', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>', '<?php _e('Error occured. Please, try again later.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>');void(0);" title="<?php _e('Click to change', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>" class="item_like"><?php echo $statistics_item->likes; ?></a></td>
                        <td><a href="javascript:statisticsEdit('<?php echo $entity_name ?>', '<?php echo $statistics_item->post_id; ?>', 'dislike', '<?php echo get_option('likebtn_like_button_plan'); ?>', '<?php _e('Enter new value:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>', '<?php _e('Upgrade your website plan to the ULTRA plan to use the feature', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>', '<?php _e('Error occured. Please, try again later.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>');void(0);" title="<?php _e('Click to change', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>" class="item_dislike"><?php echo $statistics_item->dislikes; ?></a></td>
                        <td><?php echo $statistics_item->likes_minus_dislikes; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </form>
        <?php if (count($statistics) && $p->total_pages > 0): ?>
            <div class="tablenav">
                <div class="tablenav-pages">
                    <?php echo $p->show(); ?>
                </div>
            </div>
        <?php endif ?>

    </div>

    </div>
    <?php
}

// admin help
function likebtn_like_button_admin_help() {
    likebtn_like_button_admin_header();
    ?>
    <div id="poststuff" class="metabox-holder has-right-sidebar">

        <ol>
            <li><a href="#q1"><?php _e('How can I place the Like Button inside the post/page content using a shortcode?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
            <li><a href="#q2"><?php _e('How can I display a list the most liked content inside the post/page using a shortcode?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
            <li><a href="#q3"><?php _e('Identifier structure.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
            <li><a href="#q4"><?php _e('Sort posts by likes.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
            <li><a href="#q5"><?php _e('Sort comments by likes.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
            <li><a href="#q6"><?php _e('Using WordPress Like Button plugin in a Multisite network.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
            <li><a href="#q7"><?php _e('Display number of likes and dislikes in the post.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
            <li><a href="#q8"><?php _e('Where are the votes stored in the plugin?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
            <li><a href="#q9"><?php _e("I've activated the plugin and checked the 'both' choice on the post view format, but in excerpt version of the post the like button doesn't appear", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></a></li>
        </ol>

        <?php _e('See also <a href="http://likebtn.com/en/faq" target="_blank" title="Like Button FAQ">LikeBtn FAQ</a>.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN) ?>
        <br/><br/>
        <strong id="q1">1. <?php _e('How can I place the Like Button inside the post/page content using a shortcode?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong>
        <p>
            <?php _e('Use the following shortcode:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            <code>[likebtn]</code>
            <br/>
            <?php _e('You can pass Like Button setttings as parameters in the shortcode:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            <code>[likebtn identifier="my_button_in_post" style="large"]</code>
            <br/>
            <?php _e('If <code>identifier</code> parameter is not specified, post ID is used.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            <?php _e('Use space to separate parameters, do not use commas or any other characters.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
        </p>
        <br/>
        <strong id="q2">2. <?php _e('How can I display a list the most liked content inside the post/page using a shortcode?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> (PRO, VIP, ULTRA)</strong>
        <p>
            <?php _e('Use the following shortcode:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
            <code>[likebtn_most_liked content_types="post,comment" title="Most liked posts and comments on my website" show_date="1" show_likes="0" show_dislikes="1" number="3"]</code>
            <br/><br/>
            <?php _e('The following post types are available:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            <code>post, page, attachment, revision, nav_menu_item, comment</code>
        </p>
        <br/>
        <strong id="q3">3. <?php _e('Identifier structure.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong>
        <p>
            <?php _e('The <a href="http://likebtn.com/en/#settings_identifier" target="_blank">identifer</a> parameter in WordPress LikeBtn plugin has the following structure:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> <strong><?php _e('Post type', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?> + _ + <?php _e('Post ID', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong><br/><br/>
            <?php _e('Examples:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
            ● post_1<br/>
            ● page_7<br/>
            <br/>
            <?php _e('So if you need to insert the LikeBtn HTML-code directly into WordPress post template, you can specify <code>identifier</code> parameter as follows:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
            <code>data-identifier=&quot;post_&lt;?php the_ID()?&gt;&quot;</code>
        </p>
        <br/>
        <strong id="q4">4. <?php _e('Sort posts by likes.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong>
        <p>
            <?php _e('Upgrade your website to the tariff plan allowing to retrieve Statistics. On the plugin configuration page enable synchronization of likes into your website database.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/><br/>
            <?php _e('After enabling synchronization WordPress Like Button plugin adds 3 custom fields to posts:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
            ● Likes<br/>
            ● Dislikes<br/>
            ● Likes minus dislikes<br/><br/>
            <?php _e('You can sort posts in WordPress by custom fields values using <a href="http://codex.wordpress.org/Function_Reference/query_posts" target="_blank">query_posts()</a> function. At first determine the template for inserting the code, it can be index.php, page.php, archive.php or any other depending on your needs and WordPress theme you are using. Then find the <a href="http://codex.wordpress.org/The_Loop" target="_blank">Loop</a> in the template. Finally insert the query_posts() function call above the Loop:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/><br/>
            <code>&lt;?php query_posts($query_string . '&amp;meta_key=Likes&amp;orderby=meta_value&amp;order=DESC'); ?&gt;<br/>&lt;?php /* Start the Loop */ ?&gt;<br/>&lt;?php while ( have_posts() ) : the_post(); ?&gt;<br/>    &lt;?php get_template_part( 'content', get_post_format() ); ?&gt;<br/>&lt;?php endwhile; ?&gt;
            </code>
            <br/><br/>
            <?php _e('In <code>meta_key</code> parameter specify one of the 3 custom fields provided by LikeBtn plugin. In <code>order</code> parameter specify the desired sort order: DESC (descending), ASC (ascending).', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
        </p>
        <br/>
        <strong id="q5">5. <?php _e('Sort comments by likes.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong>
        <ol>
            <li>
               <?php _e('Upgrade your website to the tariff plan allowing to retrieve Statistics.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            </li>
            <li>
               <?php _e('Enable synchronization of likes into your WordPress database.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            </li>
            <li>
               <?php _e('Find the <code>comments.php</code> template of your current WordPress theme (for example <code>/wp-content/themes/twentytwelve/comments.php</code>)', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            </li>
            <li>
               <?php _e('Add the second argument to all the calls of <code>wp_list_comments()</code> function in <code>comments.php</code>:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/><br/>
               <code>// Before<br/>// wp_list_comments( array( 'callback' =&gt; 'twentytwelve_comment', 'style' =&gt; 'ol' ));<br/><br/>// After<br/>$comments_sorted = likebtn_comments_sorted_by_likes();<br/>wp_list_comments( array( 'callback' =&gt; 'twentytwelve_comment', 'style' =&gt; 'ol' ), $comments_sorted );
               </code>
               <br/><br/>
               <?php _e('Use <code>likebtn_comments_sorted_by_dislikes()</code> function to sort comments by dislikes.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            </li>
        </ol>
        <br/>
        <strong id="q6">6. <?php _e('Display number of likes and dislikes in the post.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong>
        <p>
            <?php _e('Upgrade your website to the tariff plan allowing to retrieve Statistics. Enable synchronization of likes into your WordPress database.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/><br/>
            <?php _e('To display number of likes and dislikes in the posts list, insert the following code:', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
            <code>&lt;?php $post_custom = get_post_custom( get_the_ID() ); ?&gt;<br/>Likes: &lt;?php echo (int)$post_custom['Likes'][0]; ?&gt; |<br/>Dislikes: &lt;?php echo (int)$post_custom['Dislikes'][0]; ?&gt;</code><br/><br/>
            <?php _e('into the posts loop in the index.php, page.php, home.php or any other template depending on the WordPress theme you are using (for example /wp-content/themes/twentytwelve/index.php):', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
            <code>&lt;?php /* Start the Loop */ ?&gt;<br/>&lt;?php while ( have_posts() ) : the_post(); ?&gt;<br/>    &lt;?php get_template_part( 'content', get_post_format() ); ?&gt;<br/><br/>    &lt;?php /* Get and display number of likes and dislikes */ ?&gt;<br/>    &lt;?php $post_custom = get_post_custom( get_the_ID() ); ?&gt;<br/>    Likes: &lt;?php echo (int)$post_custom['Likes'][0]; ?&gt; |<br/>    Dislikes: &lt;?php echo (int)$post_custom['Dislikes'][0]; ?&gt;<br/>&lt;?php endwhile; ?&gt;<br/></code><br/>
            <?php _e('To display number of likes and dislikes in excerpts and full posts, insert the following code into the content.php or any other template depending on the WordPress theme you are using (for example /wp-content/themes/twentytwelve/content.php):', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
            <code>&lt;?php $post_custom = get_post_custom( get_the_ID() ); ?&gt;<br/>Likes: &lt;?php echo (int)$post_custom['Likes'][0]; ?&gt; |<br/>Dislikes: &lt;?php echo (int)$post_custom['Dislikes'][0]; ?&gt;<br/></code>
        </p>
        <br/>
        <strong id="q7">7. <?php _e('Using WordPress Like Button plugin in a Multisite network.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong>
        <p>
            <?php _e('You can use LikeBtn plugin in a <a href="http://codex.wordpress.org/Create_A_Network" target="_blank">multisite networks</a>. Make sure to specify the "Subdirectory" on the plugin Settings page in a path-based multisite network in which on-demand sites use paths.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
        </p>
        <br/>
        <strong id="q8">8. <?php _e('Where are the votes stored in the plugin?', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong>
        <p>
            <?php _e('Votes are stored in the LikeBtn system and during synchronization plugin saves them in the Custom fields, which are stored in <code>postmeta</code> and <code>commentmeta</code> WordPress tables.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?><br/>
        </p>
        <br/>
        <strong id="q9">9. <?php _e("I've activated the plugin and checked the 'both' choice on the post view format, but in excerpt version of the post the like button doesn't appear", LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?></strong>
        <ol>
            <li>
               <?php _e('Install <a href="http://wordpress.org/plugins/advanced-excerpt/installation/" target="_blank">Advanced Excerpt</a> plugin.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            </li>
            <li>
               <?php _e('Go to "Excerpt" under the "Settings" menu of the plugin and check "Don\'t remove any markup" checkbox.', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN); ?>
            </li>
        </ol>
    </div>
    </div>
    <?php
}

// get URL of the public folder
function _likebtn_like_button_get_public_url() {
    $siteurl = get_option('siteurl');
    return $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/public/';
}

// get plugin version
function _likebtn_like_button_get_plugin_version() {
    $plugin_data = get_plugin_data(__FILE__);
    return $plugin_data['Version'];
}

// Get supported by current theme Post Formats
function _likebtn_like_button_get_post_formats() {
    $post_formats = get_theme_support('post-formats');
    if (is_array($post_formats[0])) {
        $post_formats = $post_formats[0];
    } else {
        $post_formats = array();
    }

    if (!is_array($post_formats)) {
        $post_formats = array();
    }

    // append Standard format
    array_unshift($post_formats, 'standard');

    return $post_formats;
}

// Get entity types
function _likebtn_like_button_get_entities($entities) {

    $post_types = get_post_types();
    if (!empty($post_types)) {
        foreach ($post_types as $post_type) {
            $entities[$post_type] = str_replace('_', ' ', ucfirst($post_type));
        }
    }

    // append Comments
    $entities[LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT] = ucfirst(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT);

    // translate entity names
    // does not work here
    /* load_plugin_textdomain(LIKEBTN_LIKE_BUTTON_I18N_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages');

      foreach ($entities as $entity_name => $entity_title) {
      $entities[$entity_name] = __($entity_title, LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
      } */

    return $entities;
}

// short code
function likebtn_like_button_shortcode($args) {
    $entity_name = get_post_type();
    $entity_id = get_the_ID();

    return _likebtn_like_button_get_markup($entity_name, $entity_id, $args, '', false);
}

add_shortcode('likebtn', 'likebtn_like_button_shortcode');

################
###  Widget  ###
################
require_once(dirname(__FILE__) . '/likebtn_like_button_most_liked_widget.class.php');

// most liked short code
function likebtn_like_button_most_liked_widget_shortcode($args) {
    global $LikeBtnLikeButtonMostLiked;
    $options = $args;

    $options['number'] = (int) $options['number'];
    $options['entity_name'] = array();
    if (isset($options['content_types'])) {
        $options['entity_name'] = explode(',', $options['content_types']);
    }
    return $LikeBtnLikeButtonMostLiked->widget(null, $options);
}

add_shortcode('likebtn_most_liked', 'likebtn_like_button_most_liked_widget_shortcode');


################
### Frontend ###
################

function _likebtn_like_button_get_markup($entity_name, $entity_id, $values = null, $use_entity_name = '', $use_entity_settings = true) {

    global $likebtn_like_button_settings;
    $prepared_settings = array();

    // Run sunchronization
    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $likebtn->runSyncVotes();

    if ($values && $values['identifier']) {
        $data = ' data-identifier="' . $values['identifier'] . '" ';
    } else {
        $data = ' data-identifier="' . $entity_name . '_' . $entity_id . '" ';
    }

    if (!$use_entity_name) {
        $use_entity_name = $entity_name;
    }

    // Local domain
    if (get_option('likebtn_like_button_local_domain')) {
        $data .= ' data-local_domain="' . get_option('likebtn_like_button_local_domain') . '" ';
    }

    // Website subdirectory
    if (get_option('likebtn_like_button_subdirectory')) {
        $data .= ' data-subdirectory="' . get_option('likebtn_like_button_subdirectory') . '" ';
    }

    foreach ($likebtn_like_button_settings as $option_name => $option_info) {

        if ($values && isset($values[$option_name])) {
            // if values passed
            $option_value = $values[$option_name];
        } elseif (!$use_entity_settings) {
            // Do not user entity value - use default. Usually in shortcodes.
            $option_value = $option_info['default'];
        } else {
            $option_value = get_option('likebtn_like_button_settings_' . $option_name . '_' . $use_entity_name);
        }

        $option_value_prepared = _likebtn_prepare_option($option_name, $option_value);
        $prepared_settings[$option_name] = $option_value_prepared;

        // do not add option if it has default value
        if ($option_value == $likebtn_like_button_settings[$option_name]['default'] ||
                ($option_value === '' && $likebtn_like_button_settings[$option_name]['default'] == '0')
        ) {
            // option has default value
        } else {
            $data .= ' data-' . $option_name . '="' . $option_value_prepared . '" ';
        }
    }

    // Add item options
    $entity = null;
    $entity_url = '';
    $entity_title = '';
    $entity_image = '';

    if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) {
        $entity = get_comment($entity_id);
        if ($entity) {
            $entity_url = get_comment_link($entity->comment_ID);
            $entity_title = $entity->comment_content;
        }
    } elseif ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_POST) {
        $entity = get_post($entity_id);
        if ($entity) {
            $entity_url = get_permalink($entity->ID);
            $entity_title = $entity->post_title;
            $entity_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($entity->ID), 'large');
            if (!empty($entity_image_url[0])) {
                $entity_image = $entity_image_url[0];
            }
        }
    }

    if ($entity_url && !$prepared_settings['item_url']) {
        $data .= ' data-item_url="' . $entity_url . '" ';
    }
    if ($entity_title && !$prepared_settings['item_title']) {
        $entity_title = preg_replace('/\s+/', ' ', $entity_title);
        $entity_title = htmlspecialchars($entity_title);
        $data .= ' data-item_title="' . $entity_title . '" ';
    }
    if ($entity_image && !$prepared_settings['item_image']) {
        $data .= ' data-item_image="' . $entity_image . '" ';
    }

    $public_url = _likebtn_like_button_get_public_url();

    $markup = <<<MARKUP
<!-- LikeBtn.com BEGIN --><span class="likebtn-wrapper" {$data}><img src="{$public_url}img/button_loader.gif" /></span><script type="text/javascript" src="//likebtn.com/js/widget.js" async="async"></script><script type="text/javascript">if (typeof(LikeBtn) != "undefined") { LikeBtn.init(); }</script><!-- LikeBtn.com END -->
MARKUP;

    // HTML before
    $html_before = '';
    if (isset($values['html_before'])) {
        $html_before = $values['html_before'];
    } elseif (get_option('likebtn_like_button_html_before_' . $use_entity_name)) {
        $html_before = get_option('likebtn_like_button_html_before_' . $use_entity_name);
    }
    if (trim($html_before)) {
        $markup = $html_before . $markup;
    }

    // HTML after
    $html_after = '';
    if (isset($values['html_after'])) {
        $html_after = $values['html_after'];
    } elseif (get_option('likebtn_like_button_html_after_' . $use_entity_name)) {
        $html_after = get_option('likebtn_like_button_html_after_' . $use_entity_name);
    }
    if (trim($html_after)) {
        $markup = $markup . $html_after;
    }

    // alignment
    $alignment = get_option('likebtn_like_button_alignment_' . $use_entity_name);
    if ($alignment == LIKEBTN_LIKE_BUTTON_ALIGNMENT_RIGHT) {
        $markup = '<div style="text-align:right" class="likebtn_container">' . $markup . '</div>';
    } elseif ($alignment == LIKEBTN_LIKE_BUTTON_ALIGNMENT_CENTER) {
        $markup = '<div style="text-align:center" class="likebtn_container">' . $markup . '</div>';
    } else {
        $markup = '<div class="likebtn_container">' . $markup . '</div>';
    }

    return $markup;
}

// prepare option value
function _likebtn_prepare_option($option_name, $option_value)
{
    global $likebtn_like_button_settings;

    $option_value_prepared = $option_value;

    // do not format i18n options
    if (!strstr($option_name, 'i18n') &&
       (!isset($likebtn_like_button_settings[$option_name]) || $likebtn_like_button_settings[$option_name]['default'] !== ''))
    {
        if (is_int($option_value)) {
            if ($option_value) {
                $option_value_prepared = 'true';
            } else {
                $option_value_prepared = 'false';
            }
        }
        if ($option_value === '1') {
            $option_value_prepared = 'true';
        }
        if ($option_value === '0' || $option_value === '') {
            $option_value_prepared = 'false';
        }
    }
    // Replace quotes with &quot; to avoid XSS.
    //$option_value_prepared = str_replace('"', '&quot;', $option_value_prepared);
    $option_value_prepared = htmlspecialchars($option_value_prepared);

    return $option_value_prepared;
}

// get Entity settings
function _likebtn_get_entity_settings($entity_name) {

    global $likebtn_like_button_settings;
    $settings = array();

    foreach ($likebtn_like_button_settings as $option_name => $option_info) {
        $settings[$option_name] = get_option('likebtn_like_button_settings_' . $option_name . '_' . $entity_name);
    }
    return $settings;
}

// add Like Button to the entity (except Comment)
function likebtn_like_button_the_content($content) {

    if (is_feed()) {
        return $content;
    }

    // detemine entity type
    $real_entity_name = get_post_type();

    // get entity name whose settings should be copied
    $use_entity_name = get_option('likebtn_like_button_use_settings_from_' . $real_entity_name);
    if ($use_entity_name) {
        $entity_name = $use_entity_name;
    } else {
        $entity_name = $real_entity_name;
    }

    if (get_option('likebtn_like_button_show_' . $real_entity_name) != '1'
        || get_option('likebtn_like_button_show_' . $entity_name) != '1')
    {
        return $content;
    }

    $entity_id = get_the_ID();

    // get the Posts/Pages IDs where we do not need to show like functionality
    $allow_ids = explode(",", get_option('likebtn_like_button_allow_ids_' . $entity_name));
    $exclude_ids = explode(",", get_option('likebtn_like_button_exclude_ids_' . $entity_name));
    $exclude_categories = get_option('likebtn_like_button_exclude_categories_' . $entity_name);
    $exclude_sections = get_option('likebtn_like_button_exclude_sections_' . $entity_name);

    if (empty($exclude_categories)) {
        $exclude_categories = array();
    }

    if (empty($exclude_sections)) {
        $exclude_sections = array();
    }

    // checking if section is excluded
    if ((in_array('home', $exclude_sections) && is_home()) || (in_array('archive', $exclude_sections) && is_archive())) {
        return $content;
    }

    // checking if category is excluded
    $categories = get_the_category();
    foreach ($categories as $category) {
        if (in_array($category->cat_ID, $exclude_categories) && !in_array($entity_id, $allow_ids)) {
            return $content;
        }
    }

    // check if post is excluded
    if (in_array($entity_id, $exclude_ids)) {
        return $content;
    }

    // check Post view mode
    switch (get_option('likebtn_like_button_post_view_mode_' . $entity_name)) {
        case LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_FULL:
            if (!is_single()) {
                return $content;
            }
            break;
        case LIKEBTN_LIKE_BUTTON_POST_VIEW_MODE_EXCERPT:
            if (is_single()) {
                return $content;
            }
            break;
    }

    // check Post format
    $post_format = get_post_format($entity_id);
    if (!$post_format) {
        $post_format = 'standard';
    }

    if (!in_array('all', get_option('likebtn_like_button_post_format_' . $entity_name)) &&
            !in_array($post_format, get_option('likebtn_like_button_post_format_' . $entity_name))
    ) {
        return $content;
    }

    // check user authorization
    $user_logged_in = get_option('likebtn_like_button_user_logged_in_' . $entity_name);

    if ($user_logged_in === '1' || $user_logged_in === '0') {
        if ($user_logged_in == '1' && !is_user_logged_in()) {
            return $content;
        }
        if ($user_logged_in == '0' && is_user_logged_in()) {
            return $content;
        }
    }

    $html = _likebtn_like_button_get_markup($real_entity_name, $entity_id, array(), $entity_name);

    $position = get_option('likebtn_like_button_position_' . $entity_name);

    if ($position == LIKEBTN_LIKE_BUTTON_POSITION_TOP) {
        $content = $html . $content;
    } elseif ($position == LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM) {
        $content = $content . $html;
    } else {
        $content = $html . $content . $html;
    }

    return $content;
}

add_filter('the_content', 'likebtn_like_button_the_content');

// add Like Button to the Comment
function likebtn_like_button_comment_text($content) {

    global $comment;

    if (is_feed()) {
        return $content;
    }

    // detemine entity type
    $real_entity_name = LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT;

    // get entity name whose settings should be copied
    $use_entity_name = get_option('likebtn_like_button_use_settings_from_' . $real_entity_name);
    if ($use_entity_name) {
        $entity_name = $use_entity_name;
    } else {
        $entity_name = $real_entity_name;
    }

    if (get_option('likebtn_like_button_show_' . $real_entity_name) != '1'
        || get_option('likebtn_like_button_show_' . $entity_name) != '1')
    {
        return $content;
    }

    $comment_id = $comment->comment_ID;
    //$comment = get_comment($comment_id, ARRAY_A);
    $post_id = $comment->comment_post_ID;

    // get the Posts/Pages IDs where we do not need to show like functionality
    $allow_ids = explode(",", get_option('likebtn_like_button_allow_ids_' . $entity_name));
    $exclude_ids = explode(",", get_option('likebtn_like_button_exclude_ids_' . $entity_name));
    $exclude_categories = get_option('likebtn_like_button_exclude_categories_' . $entity_name);
    $exclude_sections = get_option('likebtn_like_button_exclude_sections_' . $entity_name);

    if (empty($exclude_categories)) {
        $exclude_categories = array();
    }

    if (empty($exclude_sections)) {
        $exclude_sections = array();
    }

    // checking if section is excluded
    if ((in_array('home', $exclude_sections) && is_home()) || (in_array('archive', $exclude_sections) && is_archive())) {
        return $content;
    }

    // checking if category is excluded
    $categories = get_the_category();
    foreach ($categories as $category) {
        if (in_array($category->cat_ID, $exclude_categories) && !in_array($post_id, $allow_ids)) {
            return $content;
        }
    }

    // check if post is excluded
    if (in_array($post_id, $exclude_ids)) {
        return $content;
    }

    // check Post view mode - no need
    // check Post format
    $post_format = get_post_format($post_id);
    if (!$post_format) {
        $post_format = 'standard';
    }

    if (!in_array('all', get_option('likebtn_like_button_post_format_' . $entity_name)) &&
            !in_array($post_format, get_option('likebtn_like_button_post_format_' . $entity_name))
    ) {
        return $content;
    }

    $html = _likebtn_like_button_get_markup($real_entity_name, $comment_id, array(), $entity_name);

    $position = get_option('likebtn_like_button_position_' . $entity_name);

    if ($position == LIKEBTN_LIKE_BUTTON_POSITION_TOP) {
        $content = $html . $content;
    } elseif ($position == LIKEBTN_LIKE_BUTTON_POSITION_BOTTOM) {
        $content = $content . $html;
    } else {
        $content = $html . $content . $html;
    }

    return $content;
}

add_filter('comment_text', 'likebtn_like_button_comment_text');

// show the Like Button in Post/Page
// if Like Button is enabled in admin for Post/Page do not show button twice
function likebtn_post($post_id = NULL) {
    global $post;
    if (empty($post_id)) {
        $post_id = $post->ID;
    }

    // detemine entity type
    if (is_page()) {
        $entity_name = LIKEBTN_LIKE_BUTTON_ENTITY_PAGE;
    } else {
        $entity_name = LIKEBTN_LIKE_BUTTON_ENTITY_POST;
    }

    // check if the Like Button should be displayed
    // if Like Button enabled for Post or Page in Admin do not show Like Button twice
    if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_POST && get_option('likebtn_like_button_show_' . LIKEBTN_LIKE_BUTTON_ENTITY_POST) == '1') {
        return;
    }
    if ($entity_name == LIKEBTN_LIKE_BUTTON_ENTITY_PAGE && get_option('likebtn_like_button_show_' . LIKEBTN_LIKE_BUTTON_ENTITY_PAGE) == '1') {
        return;
    }

    // 'post' here is for the sake of backward compatibility
    $html = _likebtn_like_button_get_markup('post', $post_id);

    echo $html;
}

// get or echo the Like Button in comment
function likebtn_comment($comment_id = NULL) {
    //global $comment;
    if (empty($comment_id)) {
        $comment_id = get_comment_ID();
    }

    // if Like Button enabled for Comment in Admin do not show Like Button twice
    if (get_option('likebtn_like_button_show_' . LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT) == '1') {
        return;
    }

    $html = _likebtn_like_button_get_markup(LIKEBTN_LIKE_BUTTON_ENTITY_COMMENT, $comment_id);

    echo $html;
}

// test synchronization callback
function likebtn_like_button_test_sync_callback() {

    $likebtn_like_button_account_email = '';

    if (isset($_POST['likebtn_like_button_account_email'])) {
        $likebtn_like_button_account_email = $_POST['likebtn_like_button_account_email'];
    }
    $likebtn_like_button_account_api_key = '';
    if (isset($_POST['likebtn_like_button_account_api_key'])) {
        $likebtn_like_button_account_api_key = $_POST['likebtn_like_button_account_api_key'];
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $test_response = $likebtn->testSync($likebtn_like_button_account_email, $likebtn_like_button_account_api_key);

    if ($test_response['result'] == 'success') {
        $result_text = __('OK', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    } else {
        $result_text = __('Error', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    }

    $response = array(
        'result' => $test_response['result'],
        'result_text' => $result_text,
        'message' => $test_response['message'],
    );

    define( 'DOING_AJAX', true );
    ob_clean();
    wp_send_json($response);
}

add_action('wp_ajax_likebtn_like_button_test_sync', 'likebtn_like_button_test_sync_callback');

// edit item callback
function likebtn_like_button_edit_item_callback() {

    $entity_name = '';
    if (isset($_POST['entity_name'])) {
        $entity_name = $_POST['entity_name'];
    }

    $entity_id = '';
    if (isset($_POST['entity_id'])) {
        $entity_id = $_POST['entity_id'];
    }

    $identifier = likebtn_like_button_get_identifier($entity_name, $entity_id);

    $type = '';
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    }

    $value = '';
    if (isset($_POST['value'])) {
        $value = $_POST['value'];
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();
    $edit_response = $likebtn->edit($identifier, $type, $value);

    if ($edit_response['result'] == 'success') {
        $result_text = __('OK', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);

        // Update custom fields
        if ($type == '1') {
            $likes = $value;
            $dislikes = null;
        } else {
            $dislikes = $value;
            $likes = null;
        }
        $likebtn->updateCustomFields($identifier, $likes, $dislikes);
    } else {
        $result_text = __('Error', LIKEBTN_LIKE_BUTTON_I18N_DOMAIN);
    }

    $response = array(
        'result' => $edit_response['result'],
        'result_text' => $result_text,
        'message' => $edit_response['message'],
        'value' => $value
    );

    define( 'DOING_AJAX', true );
    ob_clean();
    wp_send_json($response);
}

add_action('wp_ajax_likebtn_like_button_edit_item', 'likebtn_like_button_edit_item_callback');

// reset items likes/dislikes
function likebtn_like_button_reset($entity_name, $items)
{
    $counter = 0;

    if (empty($entity_name) || empty($items)) {
        return false;
    }

    require_once(dirname(__FILE__) . '/likebtn_like_button.class.php');
    $likebtn = new LikeBtnLikeButton();

    // prepare an array for resettings in the CMS
    $reset_list = array();
    $reset_list['response'] = array('items'=>array());

    foreach ($items as $item_identifier) {
        $identifier = $entity_name . '_' . $item_identifier;
        // reset votes in LikeBtn
        $likebtn_result = $likebtn->reset($identifier);
        $reset_list['response']['items'][] = array(
            'identifier' => $identifier,
            'likes'      => 0,
            'dislikes'   => 0
        );
        if ($likebtn_result) {
            $counter++;
        }
    }

    if ($reset_list) {
        $likebtn->updateVotes($reset_list);
    }
    return $counter;
}

// get entity identifier
function likebtn_like_button_get_identifier($entity_name, $entity_id)
{
    $identifier = $entity_name . '_' . $entity_id;
    return $identifier;
}

// get comments sorted by likes
function likebtn_comments_sorted_by_likes()
{
    // function for sorting comments by Likes
    function sort_comments_by_likes($comment_a, $comment_b)
    {
        $comment_a_meta = get_comment_meta($comment_a->comment_ID, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES);
        $comment_b_meta = get_comment_meta($comment_b->comment_ID, LIKEBTN_LIKE_BUTTON_META_KEY_LIKES);

        $comment_a_likes = (int)$comment_a_meta[0];
        $comment_b_likes = (int)$comment_b_meta[0];

        if ($comment_a_likes > $comment_b_likes) {
            return -1;
        } elseif ($comment_a_likes < $comment_b_likes) {
            return 1;
        }
        return 0;
    }

    global $wp_query;
    $comments = $wp_query->comments;
    usort($comments, 'sort_comments_by_likes');

    return $comments;
}

// get comments sorted by dislikes
function likebtn_comments_sorted_by_dislikes()
{
    // function for sorting comments by Likes
    function sort_comments_by_dislikes($comment_a, $comment_b)
    {
        $comment_a_meta = get_comment_meta($comment_a->comment_ID, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES);
        $comment_b_meta = get_comment_meta($comment_b->comment_ID, LIKEBTN_LIKE_BUTTON_META_KEY_DISLIKES);

        $comment_a_dislikes = (int)$comment_a_meta[0];
        $comment_b_dislikes = (int)$comment_b_meta[0];

        if ($comment_a_dislikes > $comment_b_dislikes) {
            return -1;
        } elseif ($comment_a_dislikes < $comment_b_dislikes) {
            return 1;
        }
        return 0;
    }

    global $wp_query;
    $comments = $wp_query->comments;
    usort($comments, 'sort_comments_by_dislikes');

    return $comments;
}