<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/admin/partials
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 * @since      1.0.0
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

if (isset($_GET['vuukle_tab'])) {
    $vuukle_tab = $_GET['vuukle_tab'];
} else {
    $vuukle_tab = 'tab1';
}

$url = esc_url_raw(remove_query_arg(array('vuukle_tab')));

if ('1' !== get_option('hide_vuukle_admin_notice')) {
    $date_activation_vuukle_plugin = get_option('Activated_Vuukle_Plugin_Date');
    $date_activation_vuukle_plugin = strtotime('+4 weeks', strtotime($date_activation_vuukle_plugin));
    $current_date = strtotime(gmdate('Y-m-d H:i:s'));
}
if ($current_date >= $date_activation_vuukle_plugin) {
    add_action('admin_notices', 'vuukleAdminNotice');
}

if (isset($this->settings['AppId']) && !$this->settings['AppId']) {
    $this->quickRegister(true);
    $this->settings = get_option($this->settings_name);
} elseif (!isset($this->settings['AppId'])) {
    $this->quickRegister(true);
    $this->settings = get_option($this->settings_name);
}

if (!is_array($this->settings)) {
    $this->settings = $this->settings_defaults;
} else {
    $this->settings = array_replace_recursive($this->settings_defaults, $this->settings);
}

if (!current_user_can('manage_options')) {
    wp_die(esc_html('You do not have sufficient permissions to access this page.'));
}

if (isset($_POST['nonce']) && !wp_verify_nonce(sanitize_key($_POST['nonce']), $this->settings_name)) { // Input var okay
    wp_die(esc_html('Security check failed! Settings not saved.'));
}
$wp_content_dir_array = explode('/', WP_CONTENT_DIR);
$wp_content_dir = $wp_content_dir_array[count($wp_content_dir_array) - 1];
$root_path = str_replace($wp_content_dir, '', WP_CONTENT_DIR);
$ads_txt_file = $root_path . 'ads.txt';
if (isset($_POST['ads-txt-console'])) {
    file_put_contents($ads_txt_file, $_POST['ads-txt-console']);
}
if (isset($_POST['action']) && 'VuukleSaveSettings' === $_POST['action']) { // Input var okay
    $app_id = isset($_POST) ? $_POST['AppId'] : '';
    $_POST['mobile_type']  = 'vertical';
    $_POST['desktop_type'] = 'vertical';
    $_POST['mobile_type_horizontal']  = 'horizontal';
    $_POST['desktop_type_horizontal'] = 'horizontal';
    if (isset($_POST['reset'])) { // Input var okay       
        $_POST = array_merge($_POST, $this->settings_defaults); // Input var okay
        $vuukle_tab = 'tab1';
        $url = remove_query_arg(array('vuukle_tab'));
        wp_redirect($url);
    }

    if (!isset($_POST['share_type'])) {
        $_POST['share_type'] = '';
    }
    if (!isset($_POST['share_type_vertical'])) {
        $_POST['share_type_vertical'] = '';
    }
    if (!isset($_POST['mobile_type'])) {
        $_POST['mobile_type'] = '';
    }
    if (!isset($_POST['desktop_type'])) {
        $_POST['desktop_type'] = '';
    }
    if (!isset($_POST['mobile_type_horizontal'])) {
        $_POST['mobile_type_horizontal'] = '';
    }
    if (isset($_POST['enable_h_v']) && $_POST['enable_h_v'] === 'yes') {
        
        $_POST['div_class_powerbar'] = '';
       
    }

    if ($_POST['div_class'] === '' && $_POST['embed_comments'] === '3') {
        $_POST['embed_comments'] = '1';
    }

    if ($_POST['div_id'] === '' && $_POST['embed_comments'] === '4') {
        $_POST['embed_comments'] = '1';
    }

    if (!isset($_POST['desktop_type_horizontal'])) {
        $_POST['desktop_type_horizontal'] = '';
    }

    foreach ($_POST as $key => $value) { // Input var okay
        if (array_key_exists($key, $this->settings_defaults)) {
            if (is_string($value)) {
                $value = trim(wp_strip_all_tags($value));
            }

            if ('text' === $key) {
                foreach ($value as $k => &$v) {
                    if ('timeAgo' === $k) {
                        continue;
                    }
                    if (is_array($v)) {
                        $v = array_map('trim', $v);
                        $v = array_map('wp_strip_all_tags', $v);
                    } else {
                        $v = trim(wp_strip_all_tags($v));
                    }
                }
            }
            $this->settings[$key] = $value;
        }
    }


    $this->settings['items_powerbar'] = $_POST['items_powerbar'];

    if ($_POST['AppId'] == '') { // Input var okay
        $this->settings['AppId'] = $app_id;
    }
    if (!isset($_POST['items_powerbar'])) { // Input var okay
        $this->settings['items_powerbar'] = '';
    }
    if (empty($_POST['share_position'])) { // Input var okay
        $this->settings['share_position'] = '';
    }
    if (empty($_POST['share_position2'])) { // Input var okay
        $this->settings['share_position2'] = '';
    }

    if (empty($_POST['emote_enabled1'])) { // Input var okay
        $this->settings['emote_enabled1'] = '';
    }

    if (empty($_POST['emote_enabled2'])) { // Input var okay
        $this->settings['emote_enabled2'] = '';
    }

    if (empty($_POST['emote_enabled3'])) { // Input var okay
        $this->settings['emote_enabled3'] = '';
    }

    if (empty($_POST['emote_enabled4'])) { // Input var okay
        $this->settings['emote_enabled4'] = '';
    }

    if (empty($_POST['emote_enabled5'])) { // Input var okay
        $this->settings['emote_enabled5'] = '';
    }

    if (empty($_POST['emote_enabled6'])) { // Input var okay
        $this->settings['emote_enabled6'] = '';
    }

    if (empty($_POST['embed_emotes_amp'])) {
        $this->settings['embed_emotes_amp'] = 'off';
    }

    if (empty($_POST['enable_seo'])) {
        $this->settings['enable_seo'] = 'off';
    }

    if (empty($_POST['non_article_pages'])) {
        $this->settings['non_article_pages'] = 'off';
    }

    if (empty($_POST['non_article_pages'])) {
        $this->settings['non_article_pages'] = 'off';
    }

    if (empty($_POST['checkboxTextEnabled'])) {
        $this->settings['checkboxTextEnabled'] = false;
    }

    if (update_option($this->settings_name, $this->settings)) {
        print '<div class="updated"><p><strong>Settings saved.</strong></p></div>';
    }
}
$vuukle_api_key = (isset($this->settings['AppId']) && $this->settings['AppId'] != '') ? false : true;
$checked_amp = (isset($this->settings['embed_emotes_amp']) && $this->settings['embed_emotes_amp'] == 'on') ? 'checked' : '';
$checked_seo = (isset($this->settings['enable_seo']) && $this->settings['enable_seo'] == 'on') ? 'checked' : '';
$non_article_pages = (isset($this->settings['non_article_pages']) && $this->settings['non_article_pages'] == 'on') ? 'checked' : '';

if (isset($_POST['action']) && 'VuukleSaveSettings1' === $_POST['action']) { // Input var okay
    $app_id = isset($_POST) ? $_POST['AppId'] : '';
    foreach ($_POST as $key => $value) { // Input var okay
        if (array_key_exists($key, $this->settings_defaults)) {
            if (is_string($value)) {
                $value = trim(wp_strip_all_tags($value));
            }
            $this->settings[$key] = $value;
        }
    }
    if (update_option($this->settings_name, $this->settings)) {
        print '<div class="updated"><p><strong>Settings saved.</strong></p></div>';
    }
}


?>

<style>
    #adminmenu a.toplevel_page_free-comments-for-wordpress-vuukle div.wp-menu-image img {
        width: 32px;
        padding: 1px 0 0;
        transition: .3s ease-in-out;
    }
</style>
<script type="text/javascript">
    var mailpoet_token = "383b2df0a9";
    var mailpoet_api_version = "v1";
</script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, document.getElementById('wp-admin-canonical').href + window.location.hash);
    }
</script>
<script type="text/javascript">
    var _wpColorScheme = {
        "icons": {
            "base": "#a0a5aa",
            "focus": "#00a0d2",
            "current": "#fff"
        }
    };
</script>
<script>
    function resetVisible(val) {
        document.getElementById('vis').style.display = 'none';
        let num = val.getAttribute('data-tab');
        let urlParams = new URLSearchParams(location.search);
        if (!urlParams.get('vuukle_tab')) {
            urlParams.append('vuukle_tab', num);
            let newurl = window.location.href + `&vuukle_tab=${num}`;
            window.history.pushState({
                path: newurl
            }, '', newurl);
        } else {
            let newurl = window.location.href.replace(urlParams.get('vuukle_tab'), num);
            window.history.pushState({
                path: newurl
            }, '', newurl);
        }
    }

    function resetVisibleBlock(val) {
        document.getElementById('vis').style.display = 'block';
        let num = val.getAttribute('data-tab');
        let urlParams = new URLSearchParams(location.search);
        if (!urlParams.get('vuukle_tab')) {
            urlParams.append('vuukle_tab', num);
            let newurl = window.location.href + `&vuukle_tab=${num}`;
            window.history.pushState({
                path: newurl
            }, '', newurl);
        } else {
            let newurl = window.location.href.replace(urlParams.get('vuukle_tab'), num);
            window.history.pushState({
                path: newurl
            }, '', newurl);
        }
    }
</script>
<style type="text/css" media="print">
    #wpadminbar {
        display: none;
    }
</style>
<div class="wrap">
    <img style="position: absolute; right: 40px; width: 35px;" src="<?php echo VUUKLE_ADMIN_URL; ?>/images/logo.png" />
    <h2>Vuukle Settings</h2>
    <p>Vuukle Commenting is automatically displayed in place of WordPress default comments. You can also insert Vuukle Commenting system to any other part of your website by using ShortCode <code>[vuukle]</code>.</p>
    <p>We use <code>&lt;og:image&gt;</code> tag as post image, so please make sure you have them ,otherwise we will display default "no-image" image.</p>
    <a target="_blank" style="background-color: #EB8D40; color: white" class="button" href="https://admin.vuukle.com/">Login to Vuukle Admin</a>
    <p>
        <a target="_blank" href="https://admin.vuukle.com/forgot-password.html"><button class="button button-primary">Forgot password</button></a>
        <span class="ajax-response"></span>
    </p>
    <?php if ($vuukle_api_key) : ?>
        <div class="vuukle_overlay">
            <div class="vuukle_popup">
                <div class="vuukle_popup_open">
                    <div class="vuukle_popup_info">
                        <h2 style="text-align:center;"><?php _e("To get your APIKEY please send us an email", esc_html($this->plugin_name)); ?> <a href="mailto:support@vuukle.com">support@vuukle.com</a></h2>
                    </div>
                </div>
                <div class="vuukle_popup_close">
                    <a class='vuukle_closer_icon'><i class="fas fa-times-circle vuukle_closer_icon"></i></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <form method="post" action="" id="vuukle-settings-form">

        <input type="hidden" name="vuukle_tab" value="<?php echo esc_html($vuukle_tab); ?>" id="hidden_tab">
        <input type="hidden" value="<?php echo esc_url($url); ?>" id="hidden_url">

        <?php require plugin_dir_path(__FILE__) . '/save-settings-modal.php'; ?>


        <div class="nav-tab-wrapper">
            <a href="#tab1" data-tab="tab1" onclick="resetVisibleBlock(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab1') ? 'nav-tab-active' : ''; ?>"><?php _e("General settings", esc_html($this->plugin_name)); ?></a>
            <a href="#tab2" data-tab="tab2" onclick="resetVisibleBlock(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab2') ? 'nav-tab-active' : ''; ?>"><?php _e("Share Bar widget settings", esc_html($this->plugin_name)); ?></a>
            <a href="#tab3" data-tab="tab3" onclick="resetVisibleBlock(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab3') ? 'nav-tab-active' : ''; ?>"><?php _e("Custom Sharing URLs", esc_html($this->plugin_name)); ?></a>
            <a href="#tab4" data-tab="tab4" onclick="resetVisibleBlock(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab4') ? 'nav-tab-active' : ''; ?>"><?php _e("Emote widget setting", esc_html($this->plugin_name)); ?></a>
            <a href="#tab5" data-tab="tab5" onclick="resetVisibleBlock(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab5') ? 'nav-tab-active' : ''; ?>"><?php _e("Comment widget settings", esc_html($this->plugin_name)); ?></a>
            <a href="#tab6" data-tab="tab6" onclick="resetVisibleBlock(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab6') ? 'nav-tab-active' : ''; ?>"><?php _e("Newsfeed Bar widget settings", esc_html($this->plugin_name)); ?></a>
            <a href="#tab7" data-tab="tab7" onclick="resetVisibleBlock(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab7') ? 'nav-tab-active' : ''; ?>"><?php _e("Enable only for endless scroll WP theme", esc_html($this->plugin_name)); ?></a>
            <a href="#tab8" data-tab="tab8" onclick="resetVisibleBlock(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab8') ? 'nav-tab-active' : ''; ?>"><?php _e("SEO", esc_html($this->plugin_name)); ?></a>
            <a href="#tab10" data-tab="tab10" onclick="resetVisible(this)" class="nav-tab <?php echo ($vuukle_tab == 'tab10') ? 'nav-tab-active' : ''; ?>"><?php _e("Change ads.txt", esc_html($this->plugin_name)); ?></a>
        </div>
        <div id="tab1" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab1') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th colspan="2">
                        <h2 class="title-setting">General settings</h2>
                    </th>
                </tr>

                <tr valign="top" style="">
                    <th scope="row">
                        API-KEY
                    </th>
                    <td>
                        <input name="AppId" type="text" value="<?php print esc_attr($this->settings['AppId']); ?>" class="regular-text" />
                        <?php if (!$this->settings['AppId']) : ?>
                            <button type="button" id="quick-register" class="button button-primary">Get API-KEY</button>
                        <?php endif ?>
                        <span class="ajax-response"></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Save comments (WP Database)<a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Turn on this option and your comments will be saved in your wordpress database", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </th>
                    <td>
                        Off
                        <input type="radio" name="save_comments" value="0" checked="checked" />
                        On
                        <input type="radio" name="save_comments" value="1" <?php checked($this->settings['save_comments'], 1); ?> />
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        OpenGraph Tags<a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Turn on to enable og:image, og:title tags on the page", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </th>
                    <td>
                        Off
                        <input type="radio" name="og_tags" value="0" checked="checked" />
                        On
                        <input type="radio" name="og_tags" value="1" <?php checked($this->settings['og_tags'], 1); ?> />
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Recommendations Protocol <a class="vuukle_help" data-toggle="tooltip" title="<?php _e(" Select the protocol that matches your site", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </th>
                    <td>
                        <select name="recomendations_protocol">
                            <option value="none" <?php selected($this->settings['recomendations_protocol'], 'none'); ?>>none</option>
                            <option value="http" <?php selected($this->settings['recomendations_protocol'], 'http'); ?>>http</option>
                            <option value="https" <?php selected($this->settings['recomendations_protocol'], 'https'); ?>>https</option>
                            <option value="http://www." <?php selected($this->settings['recomendations_protocol'], 'http://www.'); ?>>http://www.</option>
                            <option value="https://www." <?php selected($this->settings['recomendations_protocol'], 'https://www.'); ?>>https://www.</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Remove vuukle from the posts (ids, separated by comma) <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Select the posts from which you want to remove vuukle", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="text" name="post_exceptions" value="<?php echo esc_attr($this->settings['post_exceptions']); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Remove vuukle from the post types (slugs, separated by comma)<a class="vuukle_help" data-toggle="tooltip" title="<?php _e(" Select the post type from which you want to remove vuukle", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="text" name="post_type_exceptions" value="<?php echo esc_attr($this->settings['post_type_exceptions']); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Remove vuukle from posts by URL (put words comma separated)<a class="vuukle_help" data-toggle="tooltip" title="<?php _e(" Select the whole URL or some part of it from which you want to remove vuukle.", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="text" name="post_type_by_url_exceptions" value="<?php echo esc_attr($this->settings['post_type_by_url_exceptions']); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Remove vuukle from the categories (slugs, separated by comma) <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Select the categories  from which you want to remove vuukle", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="text" name="category_exceptions" value="<?php echo esc_attr($this->settings['category_exceptions']); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Export comments <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Select how many comments you want to export", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input style="width: 78px;height: 29px !important;min-height: 29px;" class="amount_comments" type="number" name="amount_comments" value="<?php echo esc_attr($this->settings['amount_comments']); ?>" />
                        <input type="button" id="export_button2" offset="0" class="button button-primary" name="export_botton" value="Download File" />
                        <span class="loader-animation" style="display: none;"><strong>Please wait ...</strong></span>
                    </td>
                </tr>
                <tr class="embed_fields_emotes">
                    <th>Enable for AMP
                        <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e($this->settings['embed_emotes_amp'] === 'on' ? "If you don't use Google AMP ( Accelerated Mobile Pages ) uncheck the checkbox please." : "If you use Google AMP ( Accelerated Mobile Pages ) check the checkbox please.", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </th>
                    <td>
                        <input type="checkbox" name="embed_emotes_amp" value="on" <?php echo esc_html($checked_amp); ?> />
                    </td>
                </tr>
                <tr>
                    <th>Track page views on non article pages
                        <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Tracks pages' views on non article pages", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </th>
                    <td>
                        <input type="checkbox" name="non_article_pages" value="on" <?php echo esc_html($non_article_pages); ?> />
                    </td>
                </tr>
            </table>
        </div>
        <div id="tab2" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab2') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th colspan="2">
                        <h2 class="title-setting">Share Bar widget settings</h2>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        Show Share Bar <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Choose to show share bar or not", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        Off
                        <input type="radio" name="share" value="0" checked="checked" />
                        On
                        <input type="radio" name="share" value="1" <?php checked($this->settings['share'], 1); ?> />
                        <img src="<?php echo VUUKLE_ADMIN_URL . '/images/share.png'; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        Share Bar Position <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Select the location where you want to display the share bar", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        After Content Post
                        <input type="checkbox" name="share_position" value="1" <?php
                                                                                if ('1' === $this->settings['share_position']) {
                                                                                    echo 'checked="checked"';
                                                                                }
                                                                                ?> />
                        Before Content Post
                        <input type="checkbox" name="share_position2" value="1" <?php
                                                                                if ('1' === $this->settings['share_position2']) {
                                                                                    echo 'checked="checked"';
                                                                                }
                                                                                ?> />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        Share Bar Type <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Choose the position to be displayed (horizontal or vertical)", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        Horizontal
                        <input type="checkbox" name="share_type" value="horizontal" <?php
                                                                                    if ('horizontal' === $this->settings['share_type']) {
                                                                                        echo 'checked="checked"';
                                                                                    } ?> />

                        Vertical
                        <input type="checkbox" name="share_type_vertical" value="vertical" <?php
                                                                                            if ('vertical' === $this->settings['share_type_vertical']) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />
                    </td>
                </tr>

                <script>
                    function handleChangeYes(src) {
                        document.getElementById("embed_powerbar1").disabled = true;
                        document.getElementById("div_class_powerbar1").disabled = true;  
                    }

                    function handleChangeNo(src) {
                        document.getElementById("embed_powerbar1").disabled = false;
                        document.getElementById("div_class_powerbar1").disabled = false;    
                    }
                </script>

                <tr valign="top">
                    <th scope="row">
                        Enable horizontal for mobile and vertical for desktop <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Choose the position to be displayed (horizontal or vertical)", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        Yes
                        <input type="radio" name="enable_h_v" onchange="handleChangeYes(this);" value="yes" <?php checked($this->settings['enable_h_v'], 'yes'); ?> />

                        No
                        <input type="radio" name="enable_h_v" value="no" onchange="handleChangeNo(this);" <?php checked($this->settings['enable_h_v'], 'no'); ?> />

                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        Share Bar Styles (only for vertical type) <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Write the styles of your preference(only for vertical type)", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        <textarea style="height:250px" name="share_vertical_styles"><?php echo esc_attr($this->settings['share_vertical_styles']); ?></textarea>
                    </td>
                </tr>

                <tr>
                    <th>DIV Container Class Horizontal<a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Specify the element Class under which you want the PowerBar to be displayed", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="radio" id="embed_powerbar1" name="embed_powerbar" value="1" <?php checked($this->settings['embed_powerbar'], '1'); ?> <?php checked($this->settings['embed_powerbar'], '1'); ?> <?php if (
                                                                                                                                                                                                                            $this->settings['enable_h_v'] === "yes"
                                                                                                                                                                                                                        ) {
                                                                                                                                                                                                                            echo 'disabled';
                                                                                                                                                                                                                        } ?> />
                        <input type="text" id="div_class_powerbar1" name="div_class_powerbar" value="<?php echo esc_attr($this->settings['div_class_powerbar']); ?>" <?php if (
                                                                                                                                                                            $this->settings['enable_h_v'] === "yes"
                                                                                                                                                                        ) {
                                                                                                                                                                            echo 'disabled';
                                                                                                                                                                        } ?>>
                    </td>
                </tr>
                <tr>
                    <th>DIV Container ID Horizontal <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Specify the element ID under which you want the PowerBar to be displayed", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="radio" id="embed_powerbar2" name="embed_powerbar" value="2" <?php checked($this->settings['embed_powerbar'], '2'); ?> >
                        <input type="text"  name="div_id_powerbar" value="<?php echo esc_attr($this->settings['div_id_powerbar']); ?>" >
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        Sharing option customization <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Select the sharing buttons you want to display", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>


                        <form method="get">

                            <input type="checkbox" name="items_powerbar[]" value="facebook" <?php if (in_array('facebook', $this->settings['items_powerbar'])) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />Facebook <br />

                            <input type="checkbox" name="items_powerbar[]" value="twitter" <?php if (in_array('twitter', $this->settings['items_powerbar'])) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />Twitter <br />

                            <input type="checkbox" name="items_powerbar[]" value="whatsapp" <?php if (in_array('whatsapp', $this->settings['items_powerbar'])) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />Whatsapp <br />

                            <input type="checkbox" name="items_powerbar[]" value="linkedin" <?php if (in_array('linkedin', $this->settings['items_powerbar'])) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />Linkedin <br />

                            <input type="checkbox" name="items_powerbar[]" value="reddit" <?php if (in_array('reddit', $this->settings['items_powerbar'])) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />Reddit <br />

                            <input type="checkbox" name="items_powerbar[]" value="messenger" <?php if (in_array('messenger', $this->settings['items_powerbar'])) {
                                                                                                    echo 'checked="checked"';
                                                                                                } ?> />Messenger <br />

                            <input type="checkbox" name="items_powerbar[]" value="telegram" <?php if (in_array('telegram', $this->settings['items_powerbar'])) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />Telegram <br />

                            <input type="checkbox" name="items_powerbar[]" value="pinterest" <?php if (in_array('pinterest', $this->settings['items_powerbar'])) {
                                                                                                    echo 'checked="checked"';
                                                                                                } ?> />Pinterest <br />

                            <input type="checkbox" name="items_powerbar[]" value="flipboard" <?php if (in_array('flipboard', $this->settings['items_powerbar'])) {
                                                                                                    echo 'checked="checked"';
                                                                                                } ?> />Flipboard <br />

                            <input type="checkbox" name="items_powerbar[]" value="email" <?php if (in_array('email', $this->settings['items_powerbar'])) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />Email <br />

                            <input type="checkbox" name="items_powerbar[]" value="gab" <?php if (in_array('gab', $this->settings['items_powerbar'])) {
                                                                                            echo 'checked="checked"';
                                                                                        } ?> />Gab <br />

                            <input type="checkbox" name="items_powerbar[]" value="parler" <?php if (in_array('parler', $this->settings['items_powerbar'])) {
                                                                                                echo 'checked="checked"';
                                                                                            } ?> />Parler <br />

                        </form>
                        <?php

                        $settings_powerbar = get_option('Vuukle');
                        $items_powerbar = array(
                            'facebook',
                            'twitter',
                            'whatsapp',
                            'linkedin',
                            'reddit',
                            'messenger',
                            'telegram',
                            'pinterest',
                            'flipboard',
                            'email',
                        );
                        $items_powerbar = isset($settings_powerbar['items_powerbar']) ? $settings_powerbar['items_powerbar'] : $items_powerbar;

                        ?>
                    </td>
                </tr>
            </table>
        </div>


        <div id="tab3" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab3') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th scope="row">
                        <h2 class="title-setting">Custom Sharing URLs</h2>
                    </th>

                </tr>

                <tr>
                    <th scope="row">
                        Twitter Handle <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Add your twitter handle", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </th>
                    <td>
                        <input type="text" name="twitter_handle" value="<?php echo esc_attr($this->settings['twitter_handle']); ?>" />
                    </td>
                </tr>
            </table>
        </div>
        <div id="tab4" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab4') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th colspan="2">
                        <h2 class="title-setting">Emote widget settings</h2>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        Show Emote at the end of each post
                        <a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Select this option to place Reactions at the end of each post․ (To disable Reactions uncheck the box)", esc_html($this->plugin_name)); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br>
                        <span style="font-weight: normal">(To disable emoji uncheck the box)</span>
                    </th>
                    <td colspan="3">
                        Off
                        <input type="radio" name="emote" value="false" checked="checked" />
                        On
                        <input type="radio" name="emote" value="true" <?php checked($this->settings['emote'], 'true'); ?> />

                        <img style="width: 400px" src="<?php echo VUUKLE_ADMIN_URL . '/images/emote.png'; ?>" />
                        <br>

                        <div style="margin-left: 98px;">
                            <label>
                                <input <?php echo ($this->settings['emote_enabled1'] == '1') ? "checked='checked'" : ''; ?> type="checkbox" name="emote_enabled1" value="1">
                                <?php esc_html_e(($this->settings['happy_text']), $this->plugin_name); ?>
                            </label>
                            <label>
                                <input <?php echo ($this->settings['emote_enabled2'] == '2') ? "checked='checked'" : ''; ?> type="checkbox" name="emote_enabled2" value="2">
                                <?php esc_html_e($this->settings['indifferent_text'], $this->plugin_name); ?>
                            </label>
                            <label>
                                <input <?php echo ($this->settings['emote_enabled3'] == '3') ? "checked='checked'" : ''; ?> type="checkbox" name="emote_enabled3" value="3">
                                <?php esc_html_e($this->settings['amused_text'], $this->plugin_name); ?>
                            </label>
                            <label>
                                <input <?php echo ($this->settings['emote_enabled4'] == '4') ? "checked='checked'" : ''; ?> type="checkbox" name="emote_enabled4" value="4">
                                <?php esc_html_e($this->settings['excited_text'], $this->plugin_name); ?>
                            </label>
                            <label>
                                <input <?php echo ($this->settings['emote_enabled5'] == '5') ? "checked='checked'" : ''; ?> type="checkbox" name="emote_enabled5" value="5">
                                <?php esc_html_e($this->settings['angry_text'], $this->plugin_name); ?>
                            </label>
                            <label>
                                <input <?php echo ($this->settings['emote_enabled6'] == '6') ? "checked='checked'" : ''; ?> type="checkbox" name="emote_enabled6" value="6">
                                <?php esc_html_e($this->settings['sad_text'], $this->plugin_name); ?>
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <th scope="row">
                        Emote first name
                        <br />
                    </th>
                    <td>
                        <input type="text" name="happy_text" value="<?php echo esc_attr($this->settings['happy_text']); ?>" placeholder="<?php esc_html_e($this->settings['happy_text'], $this->plugin_name); ?>">
                    </td>
                    <th scope="row">
                        Emote first url image
                        <br />
                    </th>
                    <td>
                        <input type="text" name="happy_url" value="<?php echo esc_attr($this->settings['happy_url']); ?>" placeholder="">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Emote second name
                        <br />
                    </th>
                    <td>
                        <input type="text" name="indifferent_text" value="<?php echo esc_attr($this->settings['indifferent_text']); ?>" placeholder="<?php esc_html_e($this->settings['indifferent_text'], $this->plugin_name); ?>">
                    </td>
                    <th scope="row">
                        Emote second url image
                        <br />
                    </th>
                    <td>
                        <input type="text" name="indifferent_url" value="<?php echo esc_attr($this->settings['indifferent_url']); ?>" placeholder="">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Emote third name
                        <br />
                    </th>
                    <td>
                        <input type="text" name="amused_text" value="<?php echo esc_attr($this->settings['amused_text']); ?>" placeholder="<?php esc_html_e($this->settings['amused_text'], $this->plugin_name); ?>">
                    </td>
                    <th scope="row">
                        Emote third url image
                        <br />
                    </th>
                    <td>
                        <input type="text" name="amused_url" value="<?php echo esc_attr($this->settings['amused_url']); ?>" placeholder="">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Emote fourth name
                        <br />
                    </th>
                    <td>
                        <input type="text" name="excited_text" value="<?php echo esc_attr($this->settings['excited_text']); ?>" placeholder="<?php esc_html_e($this->settings['excited_text'], $this->plugin_name); ?>">
                    </td>
                    <th scope="row">
                        Emote fourth url image
                        <br />
                    </th>
                    <td>
                        <input type="text" name="excited_url" value="<?php echo esc_attr($this->settings['excited_url']); ?>" placeholder="">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Emote fifth name
                        <br />
                    </th>
                    <td>
                        <input type="text" name="angry_text" value="<?php echo esc_attr($this->settings['angry_text']); ?>" placeholder="<?php esc_html_e($this->settings['angry_text'], $this->plugin_name); ?>">
                    </td>
                    <th scope="row">
                        Emote fifth url image
                        <br />
                    </th>
                    <td>
                        <input type="text" name="angry_url" value="<?php echo esc_attr($this->settings['angry_url']); ?>" placeholder="">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        Emote sixth name
                        <br />
                    </th>
                    <td>
                        <input type="text" name="sad_text" value="<?php echo esc_attr($this->settings['sad_text']); ?>" placeholder="<?php esc_html_e($this->settings['sad_text'], $this->plugin_name); ?>">
                    </td>
                    <th scope="row">
                        Emote sixth url image
                        <br />
                    </th>
                    <td>
                        <input type="text" name="sad_url" value="<?php echo esc_attr($this->settings['sad_url']); ?>" placeholder="">
                    </td>
                </tr>
                <tr>
                    <th>Emote size <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Specify the size of emojis", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="number" name="size_emote" value="<?php echo esc_attr($this->settings['size_emote']); ?>" placeholder="70"> px
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        Widget width <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Specify the Widget width", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        <input type="number" name="emote_widget_width" value="<?php echo esc_attr($this->settings['emote_widget_width']); ?>" placeholder="600"> px
                    </td>
                </tr>
                <tr>
                    <th>Reactions embed Method <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Select this option if you want to install Reactions after the content", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <label>
                            <input type="radio" name="embed_emotes" value="0" <?php checked($this->settings['embed_emotes'], '0'); ?> />
                            Insert After the Content
                        </label>
                    </td>
                </tr>
                <tr class="embed_fields_emotes">
                    <th>DIV Container Class <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Specify the element Class under which you want the Reactions to be displayed", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="radio" name="embed_emotes" value="1" <?php checked($this->settings['embed_emotes'], '1'); ?> />
                        <input type="text" <?php echo ('1' === $this->settings['embed_emotes']) ? 'class="reg1"' : ''; ?> name="div_class_emotes" value="<?php echo esc_attr($this->settings['div_class_emotes']); ?>">
                    </td>
                </tr>
                <tr class="embed_fields_emotes">
                    <th>DIV Container ID <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Specify the element ID under which you want the Reactions to be displayed", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="radio" name="embed_emotes" value="2" <?php checked($this->settings['embed_emotes'], '2'); ?> />
                        <input type="text" <?php echo ('2' === $this->settings['embed_emotes']) ? 'class="reg1"' : ''; ?> name="div_id_emotes" value="<?php echo esc_attr($this->settings['div_id_emotes']); ?>">
                    </td>
                </tr>
            </table>
        </div>
        <div id="tab5" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab5') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th colspan="2">
                        <h2 class="title-setting">Comment widget settings</h2>
                    </th>
                </tr>
                <tr>
                    <th>
                        Enable comments <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e(!empty($this->settings['enabled_comments']) && $this->settings['enabled_comments'] === "true" ? "Please choose option No if you don't want enable comments" : "Please choose option Yes if you want enable comments", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </th>
                    <td>
                        No
                        <input type="radio" name="enabled_comments" value="false" checked="checked" />
                        Yes
                        <input type="radio" name="enabled_comments" value="true" <?php checked($this->settings['enabled_comments'], 'true'); ?> />
                    </td>
                </tr>
                <tr>
                    <th>
                        Comments Embed Method <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Choose how comments are shown ․ Replace WordPress Comments  or Insert After the Content", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </th>
                    <td>
                        <label>
                            <input type="radio" name="embed_comments" value="1" <?php checked($this->settings['embed_comments'], '1'); ?> />
                            Replace WordPress Comments
                        </label>
                        <br><br>
                        <label>
                            <input type="radio" name="embed_comments" value="2" <?php checked($this->settings['embed_comments'], '2'); ?> />
                            Insert After the Content
                        </label>
                    </td>
                </tr>
                <tr class="embed_fields">
                    <th>DIV Container Class <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Specify the element Class under which you want the Comments to be displayed", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="radio" name="embed_comments" value="3" <?php checked($this->settings['embed_comments'], '3'); ?> />
                        <input type="text" <?php echo ('3' === $this->settings['embed_comments']) ? 'class="reg"' : ''; ?> name="div_class" value="<?php echo esc_attr($this->settings['div_class']); ?>">
                    </td>
                </tr>
                <tr class="embed_fields">
                    <th>DIV Container ID <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Specify the element ID under which you want the Comments to be displayed", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="radio" name="embed_comments" value="4" <?php checked($this->settings['embed_comments'], '4'); ?> />
                        <input type="text" <?php echo ('4' === $this->settings['embed_comments']) ? 'class="reg"' : ''; ?> name="div_id" value="<?php echo esc_attr($this->settings['div_id']); ?>">
                    </td>
                </tr>

            </table>
        </div>
        <div id="tab6" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab6') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th colspan="2">
                        <h2 class="title-setting">Newsfeed Bar widget settings</h2>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        Show Newsfeed Bar <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Select the following option if you want to display the Newsfeed widget", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        Off
                        <input type="radio" name="newsfeed" value="0" checked="checked" />
                        On
                        <input type="radio" name="newsfeed" value="1" <?php checked($this->settings['newsfeed'], 1); ?> />
                    </td>
                </tr>
                <tr>
                    <th>DIV Container Class <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Specify the element Class under which you want the Newsfeed widget to be displayed", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="radio" name="embed_newsfeed" value="1" <?php checked($this->settings['embed_newsfeed'], '1'); ?> />
                        <input type="text" name="div_class_newsfeed" value="<?php echo esc_attr($this->settings['div_class_newsfeed']); ?>">
                    </td>
                </tr>
                <tr>
                    <th>DIV Container ID <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Specify the element ID under which you want the Newsfeed widget to be displayed", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a></th>
                    <td>
                        <input type="radio" name="embed_newsfeed" value="2" <?php checked($this->settings['embed_newsfeed'], '2'); ?> />
                        <input type="text" name="div_id_newsfeed" value="<?php echo esc_attr($this->settings['div_id_newsfeed']); ?>">
                    </td>
                </tr>
            </table>
        </div>
        <div id="tab7" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab7') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th colspan="2">
                        <h2 class="title-setting">Enable only for endless scroll WP theme</h2>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        Endless <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("Enable if you have infinite story theme page", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        Off
                        <input type="radio" name="endless_mode" value="0" checked="checked" />
                        On
                        <input type="radio" name="endless_mode" value="1" <?php checked($this->settings['endless_mode'], 1); ?> />
                    </td>
                </tr>

                <tr valign="top" style="display:none">
                    <th scope="row">
                        Show Newsletter Bar <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("lorem ipsum", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        Off
                        <input disabled type="radio" name="newsletter" value="0" checked="checked" />
                        On
                        <input disabled type="radio" name="newsletter" value="1" <?php checked($this->settings['newsletter'], 1); ?> />
                    </td>
                </tr>
                <tr valign="top" style="display:none">
                    <th scope="row">
                        Newsletter Bar Position <a class="vuukle_help" data-toggle="tooltip" title="<?php esc_html_e("lorem ipsum", $this->plugin_name); ?>">
                            <i class="fas fa-info-circle"></i>
                        </a>
                        <br />
                    </th>
                    <td>
                        After Content Post
                        <input disabled type="radio" name="newsletter_position" value="1" checked="checked" />
                        Before Content Post
                        <input disabled type="radio" name="newsletter_position" value="2" <?php checked($this->settings['newsletter_position'], 2); ?> />
                    </td>
                </tr>

            </table>
        </div>
        <div id="tab8" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab8') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th scope="row">
                        <span>Enable SEO</span>
                    </th>
                    <td>
                        <input name="enable_seo" type="checkbox" value="on" class="regular-text" <?php echo esc_html($checked_seo) ?> />
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <h4 class="title-setting">Organization</h4>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <span>Facebook URL</span>
                    </th>
                    <td>
                        <input name="vuukle_facebook_url" type="text" value="<?php echo esc_attr($this->settings['vuukle_facebook_url']); ?>" class="regular-text" />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <span>Twitter URL</span>
                    </th>
                    <td>
                        <input name="vuukle_twitter_url" type="text" value="<?php print esc_attr($this->settings['vuukle_twitter_url']); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <span>Linkedin URL</span>
                    </th>
                    <td>
                        <input name="vuukle_linkedin_url" type="text" value="<?php print esc_attr($this->settings['vuukle_linkedin_url']); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <h4 class="title-setting">Publisher</h4>
                    </th>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <span>Logo URL (<span style="color:red;">*required</span>)</span>
                    </th>
                    <td>
                        <input name="vuukle_publisher_url" type="text" value="<?php print esc_attr($this->settings['vuukle_publisher_url']); ?>" class="regular-text" />
                    </td>
                </tr>
                <!-- <tr valign="top" >
                            <th scope="row">
                                <span>Twitter URL</span>
                            </th>
                            <td>
                                <input name="vuukle_user_twitter_url" type="text" value="<#?php print esc_attr($this->settings['vuukle_user_twitter_url']); ?>" class="regular-text" />
                            </td>
                        </tr> 
                        <tr valign="top" >
                            <th scope="row">
                                <span>Linkedin URL</span>
                            </th>
                            <td>
                                <input name="vuukle_user_linkedin_url" type="text" value="<#?php print esc_attr($this->settings['vuukle_user_linkedin_url']); ?>" class="regular-text" />
                            </td>
                        </tr> -->
            </table>
        </div>
        <style>
            .lined-textarea {
                background: url(http://i.imgur.com/2cOaJ.png);
                background-color: white;
                background-attachment: local;
                background-repeat: no-repeat;
                padding-left: 35px;
                padding-top: 10px;
                border-color: #ccc;
                font-size: 13px;
                line-height: 16px;
                resize: none;
            }
        </style>


        <div class="collapse-container" style="display: none!important;">
            <h3>
                Advanced settings
                <span style="cursor: pointer; color: #0073aa;" class="collapse dashicons dashicons-plus"></span>
            </h3>
            <div class="collapsed" style="display: none">
                <table class="form-table">
                    <tr>
                        <th>Priority</th>
                        <td>
                            <input type="text" name="priority" value="<?php echo $this->settings['priority'] ? esc_attr($this->settings['priority']) : 300; ?>">
                        </td>
                    </tr>
                </table>
                <h4 style="display: none">Common Text</h4>
                <table style="display: none" class="form-table">
                    <tr>
                        <th scope="row">
                            Name for user to enter
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][name]" value="<?php echo esc_attr($this->settings['text']['common']['name']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Email for user to enter
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][email]" value="<?php echo esc_attr($this->settings['text']['common']['email']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Place holder when a user is not logged in
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][me]" value="<?php echo esc_attr($this->settings['text']['common']['me']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message as placeholder for user to write comment
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][writeComment]" value="<?php echo esc_attr($this->settings['text']['common']['writeComment']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user attempts to log in without entering name
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][blankName]" value="<?php echo esc_attr($this->settings['text']['common']['blankName']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user attempts to log in without entering email
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][blankEmail]" value="<?php echo esc_attr($this->settings['text']['common']['blankEmail']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user attempts to comment without entering text
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][blankComment]" value="<?php echo esc_attr($this->settings['text']['common']['blankComment']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user write invalid email
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][invalidEmail]" value="<?php echo esc_attr($this->settings['text']['common']['invalidEmail']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user write invalid name
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][invalidName]" value="<?php echo esc_attr($this->settings['text']['common']['invalidName']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user doesn't agree to terms and conditions
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[common][checkTerms]" value="<?php echo esc_attr($this->settings['text']['common']['checkTerms']); ?>">
                        </td>
                    </tr>

                </table>
                <h4 style="display: none">Messages</h4>
                <table style="display: none" class="form-table">
                    <tr>
                        <th scope="row">
                            Message to show when a user write comment longer than the configured main comment length
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][charlimits]" value="<?php echo esc_attr($this->settings['text']['messages']['charlimits']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user tries to Up/Down votes more than once
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][alreadyVoted]" value="<?php echo esc_attr($this->settings['text']['messages']['alreadyVoted']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user tries to flag comment more than once
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][alreadyReported]" value="<?php echo esc_attr($this->settings['text']['messages']['alreadyReported']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when comments are closed
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][commentsClosed]" value="<?php echo esc_attr($this->settings['text']['messages']['commentsClosed']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user when the moderator closes the comments
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][commentsClosedModerator]" value="<?php echo esc_attr($this->settings['text']['messages']['commentsClosedModerator']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Placeholder for writing comment
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][writeComment]" value="<?php echo esc_attr($this->settings['text']['messages']['writeComment']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user tries to send the same comment again
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][alreadySubmitted]" value="<?php echo esc_attr($this->settings['text']['messages']['alreadySubmitted']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user tries to comment without signing in
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][loginFirst]" value="<?php echo esc_attr($this->settings['text']['messages']['loginFirst']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user is needed to sign in
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][loginTry]" value="<?php echo esc_attr($this->settings['text']['messages']['loginTry']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user tries to vote without signing in
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][loginToVote]" value="<?php echo esc_attr($this->settings['text']['messages']['loginToVote']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user flags a comment
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][flaggedMessage]" value="<?php echo esc_attr($this->settings['text']['messages']['flaggedMessage']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user tries to flag without signing in
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][loginToFlag]" value="<?php echo esc_attr($this->settings['text']['messages']['loginToFlag']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when an error happens in submitting comment
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][errorSubmitting]" value="<?php echo esc_attr($this->settings['text']['messages']['errorSubmitting']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user tries to login with invalid data
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][invalidLogin]" value="<?php echo esc_attr($this->settings['text']['messages']['invalidLogin']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            General error, contact us
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][errorContactVuukle]" value="<?php echo esc_attr($this->settings['text']['messages']['errorContactVuukle']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user is flagged as spammer, and blocked from commenting
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][spammerComment]" value="<?php echo esc_attr($this->settings['text']['messages']['spammerComment']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user tries to comment with any words, like aaaaa etc...
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][nonSenseComment]" value="<?php echo esc_attr($this->settings['text']['messages']['nonSenseComment']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Message to show when a user comments and the moderation is on
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[messages][moderationMessage]" value="<?php echo esc_attr($this->settings['text']['messages']['moderationMessage']); ?>">
                        </td>
                    </tr>
                </table>
                <h4 style="display:none">These config deal with showing date in the comments, ie: 5 minutes ago, 2 days ago, etc...</h4>
                <table style="display:none" class="form-table">
                    <tr>
                        <th scope="row">
                            Suffix ago
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][suffixAgo]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['suffixAgo']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Suffix From Now
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][suffixFromNow]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['suffixFromNow']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Seconds
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][seconds]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['seconds']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Minute
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][minute]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['minute']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Minutes
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][minutes]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['minutes']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Hour
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][hour]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['hour']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Hours
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][hours]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['hours']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Day
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][day]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['day']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Days
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][days]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['days']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Month
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][month]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['month']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Months
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][months]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['months']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Year
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][year]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['year']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Years
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[timeAgo][years]" value="<?php echo esc_attr($this->settings['text']['timeAgo']['years']); ?>">
                        </td>
                    </tr>
                </table>
                <h4 style="display:none">Tooltips for sharing icons</h4>
                <table style="display:none" class="form-table">
                    <tr>
                        <th scope="row">
                            Google
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[shareIcons][google]" value="<?php echo esc_attr($this->settings['text']['shareIcons']['google']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Facebook
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[shareIcons][facebook]" value="<?php echo esc_attr($this->settings['text']['shareIcons']['facebook']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Twitter
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[shareIcons][twitter]" value="<?php echo esc_attr($this->settings['text']['shareIcons']['twitter']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Linkedin
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[shareIcons][linkedin]" value="<?php echo esc_attr($this->settings['text']['shareIcons']['linkedin']); ?>">
                        </td>
                    </tr>
                </table>
                <h4 style="display:none">Tooltips for social logins</h4>
                <table style="display:none" class="form-table">
                    <tr>
                        <th scope="row">
                            Google
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[login][google]" value="<?php echo esc_attr($this->settings['text']['login']['google']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Facebook
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[login][facebook]" value="<?php echo esc_attr($this->settings['text']['login']['facebook']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Twitter
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[login][twitter]" value="<?php echo esc_attr($this->settings['text']['login']['twitter']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Linkedin
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[login][linkedin]" value="<?php echo esc_attr($this->settings['text']['login']['linkedin']); ?>">
                        </td>
                    </tr>
                </table>
                <h4 style="display:none">Comment Text</h4>
                <table style="display:none" class="form-table">
                    <tr>
                        <th scope="row">
                            Text at header of comment section when there is no comments
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[commentText][when0]" value="<?php echo esc_attr($this->settings['text']['commentText']['when0']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Text at header of comment section when there is 1 comment
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[commentText][when1]" value="<?php echo esc_attr($this->settings['text']['commentText']['when1']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Text at header of comment section when there is more than comment
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[commentText][whenX]" value="<?php echo esc_attr($this->settings['text']['commentText']['whenX']); ?>">
                        </td>
                    </tr>
                </table>
                <h4 style="display:none">Rating section strings to show to user, includes (Average rating 4.5 start from 123 users, etc...)</h4>
                <table style="display:none" class="form-table">
                    <tr>
                        <th scope="row">
                            Header
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[rating][header]" value="<?php echo esc_attr($this->settings['text']['rating']['header']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Average
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[rating][average]" value="<?php echo esc_attr($this->settings['text']['rating']['average']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Start From
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[rating][starsFrom]" value="<?php echo esc_attr($this->settings['text']['rating']['starsFrom']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Ratings
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[rating][ratings]" value="<?php echo esc_attr($this->settings['text']['rating']['ratings']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Your Rating
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[rating][yourRating]" value="<?php echo esc_attr($this->settings['text']['rating']['yourRating']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Stars
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[rating][stars]" value="<?php echo esc_attr($this->settings['text']['rating']['stars']); ?>">
                        </td>
                    </tr>
                </table>
                <h4 style="display:none">Texts for the buttons we have</h4>
                <table style="display:none" class="form-table">
                    <tr>
                        <th scope="row">
                            Load More
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[buttons][loadMore]" value="<?php echo esc_attr($this->settings['text']['buttons']['loadMore']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Sign in
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[buttons][singin]" value="<?php echo esc_attr($this->settings['text']['buttons']['singin']); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            Post
                            <br />
                        </th>
                        <td>
                            <input type="text" name="text[buttons][post]" value="<?php echo esc_attr($this->settings['text']['buttons']['post']); ?>">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                document.addEventListener("DOMContentLoaded", function() {
                    document.querySelector('#color-picker').iris({
                        width: 400,
                        hide: true,
                        change: function(event, ui) {
                            // event = standard jQuery event, produced by whichever control was changed.
                            // ui = standard jQuery UI object, with a color member containing a Color.js object
                            // change the headline color
                            let nextSibling = document.querySelector("#color-picker").nextElementSibling;
                            while (nextSibling) {
                                nextSibling = element.style.background = ui.color.toString();
                            }
                        }

                    });

                    event.currentTarget.addEventListener("click", function(event) {
                        if (!document.querySelector(e.target).matchesSelector("#color-picker")) {
                            document.querySelector('#color-picker').iris('hide');
                        } else {
                            document.querySelector('#color-picker').iris('show');
                        }
                    });
                });
            });
        </script>
        <input name="nonce" type="hidden" value="<?php echo esc_attr(wp_create_nonce($this->settings_name)); ?>" />
        <input name="action" type="hidden" value="VuukleSaveSettings" />


        <div class="submit" id="vis">
            <input id="save-settings" name="" type="submit" value="Save Settings" class="button-primary" />
            <input name="reset" type="submit" value="Reset to Default" class="button-primary" />
        </div>
    </form>

    <form method="post" action="" id="vuukle-settings-form1">
        <style>
            #vis {
                display: block;
            }
        </style>
        <div id="tab10" class="vuukle-tab-content <?php echo ($vuukle_tab == 'tab10') ? 'vuukle-tab-content-active' : ''; ?>">
            <table class="form-table settings-table">
                <tr>
                    <th scope="row">
                        <h2 class="title-setting">Change ads.txt settings</h2><br />
                        <span> Ads.txt file<a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Here you can add or change your ads.txt file.", esc_html($this->plugin_name)); ?>">
                                <i class="fas fa-info-circle"></i>
                            </a>
                        </span>
                    </th>
                </tr>
            </table>
            <tr>
                <th scope="row">
                    Ads.txt enable button<a class="vuukle_help" data-toggle="tooltip" title="<?php _e("Enable the button to make changes in ads.txt file", esc_html($this->plugin_name)); ?>">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </th>
                <td>
                    Off
                    <input type="radio" name="save_ads_txt" value="false" <?php checked($this->settings['save_ads_txt'], 'false'); ?> />
                    On
                    <input type="radio" name="save_ads_txt" value="true" <?php checked($this->settings['save_ads_txt'], 'true'); ?> />
                </td>
            </tr>
            <?php if ($this->settings['save_ads_txt'] == 'true') : ?>
            <textarea class="lined-textarea" name="ads-txt-console" style="width: 100%; height: 700px; font-size: 12px;"><?php
                                                                                                                        $wp_content_dir_array = explode('/', WP_CONTENT_DIR);
                                                                                                                        $wp_content_dir = $wp_content_dir_array[count($wp_content_dir_array) - 1];
                                                                                                                        $root_path = str_replace($wp_content_dir, '', WP_CONTENT_DIR);
                                                                                                                        $ads_txt_file = $root_path . 'ads.txt';
                                                                                                                        echo file_get_contents($ads_txt_file);
                                                                                                                        ?>
                 </textarea>
            <?php endif; ?>
            <br />
            <br />
            <div class="submit">
                <input name="action" type="hidden" value="VuukleSaveSettings1" />
                <input id="save_settings_ads" name="" type="submit" class="button-primary" value="Save settings Ads" />

            </div>
        </div>



    </form>
    <script src='<?php echo VUUKLE_ADMIN_URL; ?>/js/export.js'></script>
    <p>To export your comments to Vuukle please contact our support at support@vuukle.com</p>
</div>