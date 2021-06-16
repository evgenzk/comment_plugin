<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/admin
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/admin
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 */
class Free_Comments_For_Wordpress_Vuukle_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since  1.0.0
     * @access private
     * @var    string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version     The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->settings_url  = 'options-general.php?page=' . dirname(plugin_basename($this->plugin_name)) . '/' . basename($this->plugin_name);
        $this->settings_name = 'Vuukle';
        $this->settings      = get_option($this->settings_name);
        $comments_status = get_option('default_comment_status', false);
        $this->settings_defaults = array(
            'AppId'                       => '',
            'sso'                         => 'false',
            'div_id'                      => '',
            'div_class'                   => '',
            'div_id_powerbar'             => '',
            'div_id_emotes'               => '',
            'div_id_newsfeed'             => '',
            'div_class_powerbar'          => '',
            'div_class_powerbar2'         => '',
            'div_class_emotes'            => '',
            'div_class_newsfeed'          => '',
            'lang'                        => '',
            'emote'                       => 'true',
			'save_ads_txt'                => ($this->settings['save_ads_txt'])?$this->settings['save_ads_txt']:'false',
            'save_comments'               => '0',
            'recomendations_protocol'     => 'none',
            'enabled_comments'            => 'true',
            'amount_comments'             => 1000,
            'embed_comments'              => $comments_status == "open" ? '1' : '2',
            'embed_emotes'                => '0',
            'mobile_type'                 => 'vertical',
            'desktop_type'                => 'vertical',
            'embed_newsfeed'              => '0',
            'embed_powerbar'              => '0',
            'embed_powerbar_vertical'     => '0',
            'div_class_powerbar_vertical' => '0',
            'endless_mode'                => '0',
            'email_for_export_comments'   => 'support@vuukle.com',
            'start_date_comments'         => gmdate('Y-m-d', strtotime('-30 days')),
            'end_date_comments'           => gmdate('Y-m-d'),
            'og_tags'                     => '0',
            'vuukle_facebook_url'         => '',
            'vuukle_twitter_url'          => '',
            'vuukle_linkedin_url'         => '',
            'vuukle_publisher_url'        => '',
            'embed_emotes_amp'            => 'off',
            'enable_seo'                  => 'off',
            'non_article_pages'           => 'off',
            // 'vuukle_user_linkedin_url'    => '',
            // 'vuukle_user_twitter_url'     => '',
            'text'                        => array(
                'common'                  => array(
                    //Name for user to enter
                    'name'         => 'Name',
                    //Email for user to enter
                    'email'        => 'Email',
                    //Place holder when user is not logged in
                    'me'           => 'Me',
                    //Message as placeholder for user to write comment
                    'writeComment' => 'Write a comment',
                    //Message to show when user attempts to login without entering name  
                    'blankName'    => 'Name can not be blank',
                    //Message to show when user attempts to login without entering email
                    'blankEmail'   => 'Email can not be blank',
                    //Message to show when user attempts to comment without entering text
                    'blankComment' => 'Comment can not be blank',
                    //Message to show when user write invalid email
                    'invalidEmail' => 'Invalid email, please try again.',
                    //Message to show when user write invalid name
                    'invalidName'  => 'Name should not contain numbers, www., or special characters. Thank You.',
                    //Message to show when user doesn't agree to terms and conditions
                    'checkTerms'   => 'Please Check the T&C box to post comments',
                ),
                'messages'           => array(
                    //Message to show when user write comment longer than the configured man comment length
                    'charlimits'              => 'The moderator has set a character limit up to',
                    //Message to show when user tries to Up/Down votes more than once
                    'alreadyVoted'            => 'You have already Voted.',
                    //Message to show when user tries to flag comment more than once
                    'alreadyReported'         => 'You have already reported this comment to moderator.',
                    //Message to show when comments are closed
                    'commentsClosed'          => 'Comments are now closed.',
                    //Message to show when user when the moderator closes the comments
                    'commentsClosedModerator' => 'Comments have been closed by the site moderator.',
                    //Placeholder for writing comment
                    'writeComment'            => 'Please write a comment.',
                    //Message to show when user tries to send the samer comment again
                    'alreadySubmitted'        => 'Your comment has been already submitted for this article.',
                    //Message to show when user tries to comment without signing in
                    'loginFirst'              => 'Please enter your Name and Email or login to comment.',
                    //Message to show when user is needed to sign in
                    'loginTry'                => 'Please login and try again.',
                    //Message to show when user tries to vote without signing in
                    'loginToVote'             => 'Please sign in to vote.',
                    //Message to show when user flags a comment
                    'flaggedMessage'          => 'Thanks, the moderator will be notified',
                    //Message to show when user tries to flag without signing in
                    'loginToFlag'             => 'Please sign in to flag a comment.',
                    //Message to show when error happens in submitting comment
                    'errorSubmitting'         => 'There was an error while saving your comment, please refresh the page and try again',
                    //Message to show when user tries to login with invalid data
                    'invalidLogin'            => 'Invalid login, please log in again',
                    //General error, contact us
                    'errorContactVuukle'      => 'error - please notify us at support@vuukle.com',
                    //Message to show when user is flagged as spammer, and blocked from commenting
                    'spammerComment'          => 'Your comment is under moderation',
                    //Message to show when user tries to comment with any words, like aaaaa etc...
                    'nonSenseComment'         => 'Please enter a more descriptive comment.',
                    //Message to show when user comments and the moderation is on
                    'moderationMessage'       => 'Your comment is under moderation and will be approved by the site moderator. Thank you for your patience.',
                ),
                //These config deal with showing date in the comments, ie: 5 minutes ago, 2 days ago, etc...
                'timeAgo'           => array(
                    'suffixAgo'     => 'ago',
                    'suffixFromNow' => 'from now',
                    'seconds'       => 'less than a minute',
                    'minute'        => 'about a minute',
                    'minutes'       => '%d minutes',
                    'hour'          => 'about an hour',
                    'hours'         => 'about %d hours',
                    'day'           => 'a day',
                    'days'          => '%d days',
                    'month'         => 'about a month',
                    'months'        => '%d months',
                    'year'          => 'about a year',
                    'years'         => '%d years',
                ),
                //Tooltips for sharing icons
                'shareIcons'         => array(
                    'google'   => 'Share using Google Plus',
                    'facebook' => 'Share using Facebook',
                    'twitter'  => 'Share using Twitter',
                    'linkedin' => 'Share using Linkedin',
                ),
                //Tooltips for social logins
                'login'              => array(
                    'google'   => 'Login using Google',
                    'facebook' => 'Login using Facebook',
                    'twitter'  => 'Login using Twitter',
                    'linkedin' => 'Login using Linkedin',
                ),
                'commentText'        => array(
                    //Text at header of comment section when there is no comments
                    'when0' => 'Leave a comment',
                    //Text at header of comment section when there is 1 comment
                    'when1' => 'comment',
                    //Text at header of comment section when there is more than comment
                    'whenX' => 'comments',
                ),
                //Rating section strings to show to user, includes ( Average rating 4.5 start from 123 users, etc... )
                'rating'             => array(
                    'header'     => 'Give your rating:',
                    'average'    => 'Average',
                    'starsFrom'  => 'start from',
                    'ratings'    => 'ratings',
                    'yourRating' => 'Your rating',
                    'stars'      => 'stars',
                ),
                //Texts for the buttons we have
                'buttons'            => array(
                    'loadMore' => 'Load more',
                    'singin'   => 'Sign in',
                    'post'     => 'Post',
                ),

            ),
            'priority'                    => 300,
            'size_emote'                  => 70,
            'share'                       => '1',
            'enable_h_v'                  => 'no',
            'share_position'              => '1',
            'share_position2'             => '1',         
            'checkboxTextEnabled'         => false,
            'share_type'                  => 'horizontal',
            'share_type_vertical'         => 'vertical',
            'mobile_type'                 => 'vertical',
            'mobile_type_horizontal'      => 'horizontal',
            'desktop_type'                => 'vertical',
            'desktop_type_horizontal'     => 'horizontal',
            'share_vertical_styles'       => 'position:fixed;                                                          z-index: 10001;                                                            width: 60px;                                                            max-width: 60px;                                                           left: 10px;                                                             top: 160px;',
            'emote_widget_width'          => '600',
            'emote_enabled1'              => '1',
            'emote_enabled2'              => '2',
            'emote_enabled3'              => '3',
            'emote_enabled4'              => '4',
            'emote_enabled5'              => '5',
            'emote_enabled6'              => '6',
            'newsletter'                  => '0',
            'newsfeed'                    => '0',
            'newsletter_position'         => '1',
            'post_exceptions'             => '',
            'happy_text'                  => 'Happy',
            'happy_url'                   => '',
            'indifferent_text'            => 'Unmoved',
            'indifferent_url'             => '',
            'amused_text'                 => 'Amused',
            'amused_url'                  => '',
            'excited_text'                => 'Excited',
            'excited_url'                 => '',
            'angry_text'                  => 'Angry',
            'angry_url'                   => '',
            'sad_text'                    => 'Sad',
            'sad_url'                     => '',
            'category_exceptions'         => '',
            'post_type_exceptions'        => '',
            'post_type_by_url_exceptions' => '',
            'hide_chat'                   => 'true',
            'twitter_handle'              => '',
            'items_powerbar'              => array(
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
            ),
            'items_powerbar_no_active'    => array(
                'gab',
                'parler'
            ),
        );
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since  1.0.0
     * @return void
     */
    public function enqueueStyles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Free_Comments_For_Wordpress_Vuukle_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Free_Comments_For_Wordpress_Vuukle_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        if (current_user_can('editor') || current_user_can('administrator')) {
            wp_enqueue_style('vuukle_admin_font_awesome', 'https://use.fontawesome.com/releases/v5.2.0/css/all.css', array(), $this->version, 'all');
            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/free-comments-for-wordpress-vuukle-admin.css', array(), $this->version, 'all');
        }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since  1.0.0
     * @return void
     */
    public function enqueueScripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Free_Comments_For_Wordpress_Vuukle_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Free_Comments_For_Wordpress_Vuukle_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        if (current_user_can('editor') || current_user_can('administrator')) {
            wp_enqueue_script($this->plugin_name . "1", plugin_dir_url(__FILE__) . 'js/sortable.js', $this->version, false);
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-dialog');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/free-comments-for-wordpress-vuukle-admin.js', $this->version, false); // phpcs:ignore
            wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'https://securepubads.g.doubleclick.net/tag/js/gpt.js', $this->version, false);
        }
    }

    /**
     * This function creates a page in the admin dashboard.
     *
     * @since  1.0.0.
     * @return void
     */
    public function adminMenu()
    {
        add_submenu_page('options-general.php', 'Vuukle &rsaquo; Settings', 'Vuukle', 'manage_options', $this->plugin_name, array($this, 'adminPageVuukle'));
        add_menu_page('Vuukle Settings', 'Vuukle', 'manage_options', $this->plugin_name, array($this, 'adminPageVuukle'),  plugins_url('free-comments-for-wordpress-vuukle/admin/images/icon@2.png'));
    }

    /**
     * This function adds styles to the menu.
     *
     * @since  1.0.0.
     * @return void
     */
    public function adminMenuStyles()
    {
        if (current_user_can('editor') || current_user_can('administrator')) {
            echo "<style>


           #adminmenu a.toplevel_page_free-comments-for-wordpress-vuukle div.wp-menu-image img {
               width: 32px;
               padding: 1px 0 0;
               transition: .3s ease-in-out;
           }
       <style>";
        }
    }

    /**
     * This function  create an admin page.
     *
     * @since  1.0.0.
     * @return void
     */
    public function adminPageVuukle()
    {
        include_once 'partials/free-comments-for-wordpress-vuukle-admin-display.php';
    }

    /**
     * This function ensures quick registration.
     *
     * @param string $live Is there live or not
     *
     * @return string
     */
    public function quickRegister($live = false)
    {
        $site_url = get_site_url();
        $args = array(
            'name'     => str_replace(array('www.', 'http://', 'https://'), '', $site_url),
            'host'     => str_replace(array('www.', 'http://', 'https://'), '', $site_url),
            'avatar'   => '',
            'email'    => get_option('admin_email'),
            'password' => rand(0, 1000000),
        );
        $args = json_encode($args);


        $url = 'https://api.vuukle.com/api/v1/Publishers/registerWP';
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $args,
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    'Content-Length: ' . strlen($args)
                ),
            )
        );

        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);

        if ($err) {
            //            echo "cURL Error #:" . $err;
        } else {
            $output = json_decode($response, true);
        }

        $responseApiKey = $output['data']['apiKey'];

        if ($responseApiKey) {

            if (isset($responseApiKey)) {
                $settings          = get_option($this->settings_name);
                $settings['AppId'] = $responseApiKey;
                update_option($this->settings_name, $settings);
                $this->settings = get_option($this->settings_name);
            }
        }

        if (empty($responseApiKey)) {
            $site_url = get_site_url();
            $url = 'https://api.vuukle.com/api/v1/WP/alertSupport?subjectLine=' . str_replace(array('www.', 'http://', 'https://'), '', $site_url);
            // execute curl
            $ch = curl_init(); // phpcs:ignore WordPress.WP.AlternativeFunctions
            curl_setopt_array(
                $ch,
                array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json"
                    ),
                )
            );
            $output = curl_exec($ch); // phpcs:ignore WordPress.WP.AlternativeFunctions
            $output = json_decode($output, true); // phpcs:ignore WordPress.WP.AlternativeFunctions
            curl_close($ch); // phpcs:ignore WordPress.WP.AlternativeFunctions
        }

        if (!$live) {
            echo esc_html($responseApiKey);
            wp_die();
        }
    }

    /**
     * This function for change color.
     *
     * @since  1.0.0.
     * @return void
     */
    public function myColorPicker()
    {

        wp_enqueue_script('iris');
    }

    /**
     * For enabling.
     *
     * @since  1.0.0.
     * @return void
     */
    public function vuukleEnableFunction()
    {

        if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_key($_POST['_wpnonce']))) { // Input var okay
            $post = $_POST; // Input var okay
        }
        $option = get_option('Vuukle');
        if ('1' === $post['emote']) {
            $option['emote'] = 'true';
        } else {
            $option['emote'] = 'false';
        }
        if ('1' === $post['share']) {
            $option['share'] = '1';
        } else {
            $option['share'] = '0';
        }
        if (!empty($_POST['enable_h_v'])) {
            if ('no' === $post['enable_h_v']) {
                $option['enable_h_v'] = 'no';
            } else {
                $option['enable_h_v'] = 'yes';
            }
        }

        if ('1' === $post['enabled_comments']) {
            $option['enabled_comments'] = 'true';
        } else {
            $option['enabled_comments'] = 'false';
        }

        
    update_option('Vuukle', $option);

    wp_safe_redirect(admin_url('plugins.php'));
    exit;
    }

    /**
     * For deactivation.
     *
     * @since  1.0.0.
     * @return void
     */
    public function vuukleDeactivateFunction()
    {
        if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_key($_POST['_wpnonce']))) { // Input var okay
            $post = $_POST; // Input var okay
        }

        if ('confirm' === $post['vuukle_deactivate_function']) {
            deactivate_plugins(array($this->plugin_name . '/' . $this->plugin_name . '.php'));
            delete_option('Activated_Vuukle_Plugin_Date');
            delete_option('hide_vuukle_admin_notice');
            if (!empty($post['answer-deactivate-vuukle'])) {
                $vuukle_subject_message = 'Deactivate Vuukle plugin on the site ' . site_url();
                $vuukle_message         = '<strong>Type answer:</strong> ' . stripslashes($post['answer-deactivate-vuukle']);
                if (!empty($post['other-answer-deactivate-vuukle']) && 'Other' === $post['answer-deactivate-vuukle']) {
                    $vuukle_message .= '<br><strong>Text answer:</strong> ' . stripslashes($post['other-answer-deactivate-vuukle']);
                }
                $headers = array(
                    'From: ' . get_option('blogname') . ' <' . get_option('admin_email') . '>',
                    'content-type: text/html',
                );
                wp_mail('support@vuukle.com', $vuukle_subject_message, $vuukle_message, $headers);
            }
        }

        wp_safe_redirect(admin_url('plugins.php'));
        exit;
    }

    /**
     * Creating activation modal.
     *
     * @since  1.0.0.
     * @return void
     */
    public function activationModal()
    {

        if (is_admin() && '1' === get_option('Activated_Vuukle_Plugin')) {
            delete_option('Activated_Vuukle_Plugin');
            include VUUKLE_INCLUDES_PATH . '/free-comments-for-wordpress-vuukle-activate-modal.php';
        }
    }

    /**
     * Creating deactivation modal.
     *
     * @since  1.0.0.
     * @return void
     */
    public function deactivationModal()
    {

        if (is_admin()) {
            $screen = get_current_screen();
            if ('plugins' === $screen->base) {
                include VUUKLE_INCLUDES_PATH  . '/free-comments-for-wordpress-vuukle-deactivate-modal.php';
            }
        }
    }

    /**
     * For settings JS.
     *
     * @since  1.0.0.
     * @return void
     */
    public function settingsJs()
    {

        wp_enqueue_script('settings', plugins_url('js/settings.js', __FILE__));
    }

    /**
     * For dashicons.
     *
     * @since  1.0.0.
     * @return void
     */
    public function jkLoadDashicons()
    {
        wp_enqueue_style('dashicons');
    }

    /**
     * This function hides admin notice.
     *
     * @since  1.0.0.
     * @return void
     */
    public function hideVuukleVdminVotice()
    {

        add_option('hideVuukleVdminVotice', '1');
    }

    /**
     * This function creates admin notice.
     *
     * @since  1.0.0.
     * @return void
     */
    public function vuukleAdminNotice()
    {
?>
        <div class="notice notice-success is-dismissible vuukle-notice">
            <p>
                <img style="float:right; width:180px;" class="logo" src="<?php echo VUUKLE_ADMIN_URL; // WPCS: XSS ok
                                                                            ?>/images/vuukle-logo.svg" />
                <strong>
                    <p>Hello there! You’ve been using Vuukle widgets on your site for over a month now. If it sucked, you know what
                        to do but if it was a great experience - please rate it 5-stars and spread the positive vibes by leaving us
                        a comment.<br>We thank you for choosing us and helping us become a better product. Email us on <a href="mailto:support@vuukle.com">support@vuukle.com</a> if you have any suggestions.</p>
                </strong>
            <div style="clear: both"></div>
            </p>
            <ul>
                <li>
                    <a target="_blank" href="https://wordpress.org/plugins/free-comments-for-wordpress-vuukle/#reviews">
                        <strong>Post a review</strong>
                    </a>
                </li>
                <li>
                    <a href="#" class="pum2-dismiss">
                        <strong>Remind me later</strong>
                    </a>
                </li>
                <li>
                    <a href="#" class="pum2-dismiss">
                        <strong>Already did</strong>
                    </a>
                </li>
            </ul>
        </div>

        <script>
            function doAjaxRequest(type, data, url) {
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {

                };

                xmlhttp.open(type, url, true);
                if (data)
                    xmlhttp.send(data);
                else
                    xmlhttp.send();
            }
            document.addEventListener('click', function(event) {

                if (event.target.matches('.pum2-dismiss')) {
                    document.querySelector('.vuukle-notice button.notice-dismiss')?.click();
                } else if (event.target.matches('.vuukle-notice button.notice-dismiss')) {

                }
            });
        </script>
    <?php
    }

    /**
     * Action link.
     *
     * @param string $links formed link
     *
     * @return string
     */
    public function actionLinks($links)
    {

        $link = '<a href="' . $this->settings_url . '">Settings</a>';
        array_push($links, $link);
        return $links;
    }

    /**
     * This function for disabling.
     *
     * @since  1.0.0.
     * @return void
     */
    public function vuukleDisablePlugin()
    {

        deactivate_plugins(array('free-comments-for-wordpress-vuukle/free-comments-for-wordpress-vuukle.php'));
        delete_option('Activated_Vuukle_Plugin_Date');
        delete_option('hide_vuukle_admin_notice');
        wp_redirect(admin_url('admin.php'));

        exit;
    }

    /**
     * This function removes ver CSS and JS .
     *
     * @param string $src removed argument
     *
     * @since  1.0.0.
     * @return string
     */
    public function vuukleRemoveVerCssJs($src)
    {
        if (strpos($src, 'vuukle-admin.js?ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }

    /**
     * This function for comments template.
     *
     * @param string $file template
     *
     * @since  1.0.0.
     * @return string
     */
    public function commentsTemplate($file)
    {
        global $post;

        $post_exceptions = explode(',', $this->settings['post_exceptions']);
        $post_exceptions = array_map('trim', $post_exceptions);

        $category_exceptions = explode(',', $this->settings['category_exceptions']);
        $category_exceptions = array_map('trim', $category_exceptions);
        $post_categories     = get_the_category($post->ID);
        foreach ($post_categories as $key => $category) {
            $post_categories[$key] = $category->slug;
        }

        if (empty($content)) {
            $content = '';
        }

        if (in_array((string) $post->ID, $post_exceptions, true)) {
            return $content;
        }

        if (count(array_intersect($category_exceptions, $post_categories))) {
            return $content;
        }

        
        // post type exceptions
        $post_type_exceptions = explode(',', $this->settings['post_type_exceptions']);
        $post_type_exceptions = array_map('trim', $post_type_exceptions);
        if (in_array((string) $post->post_type, $post_type_exceptions, true)) {
            return $content;
        }

        // post type by URL exceptions
        $post_type_by_url_exceptions = explode(',', $this->settings['post_type_by_url_exceptions']);
        $post_type_by_url_exceptions = array_map('trim', $post_type_by_url_exceptions);
        if (in_array((string) $post->post_type, $post_type_by_url_exceptions, true)) {
            return $content;
        }

        $comments_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'comments-empty.php';

        if (is_single()) {
            if ($this->settings['AppId'] && file_exists($comments_file)) {
                $file = $comments_file;
            }
        }
        return $file;
    }

    /**
     * This function returns the content.
     *
     * @param string $content returned content
     *
     * @since  1.0.0.
     * @return string
     */
    public function theContent2($content)
    {
        $author_info = array(
            'name'  => get_the_author_meta('display_name', $post->post_author),
            'email' => get_the_author_meta('user_email', $post->post_author),
        );

        return $content;
    }

    /**
     * This function counts the posts..
     *
     * @since  1.0.0.
     * @return void
     */
    public function vuukleCommentsCountPost()
    {
        global $vuukle;
        global $post;
        $post_ids = get_posts( // phpcs:ignore WordPress.VIP.RestrictedFunctions
            array(
                'fields'         => 'ids',
                'posts_per_page' => -1, // phpcs:ignore WordPress.VIP.PostsPerPage
            )
        );
        $list     = $post_ids;
        $list     = implode(',', $list);
        if ($vuukle->settings['AppId']) {
            $url      = 'https://api.vuukle.com/api/v1/Comments/getCommentCountListByHost?host=' . str_replace(array('www.', 'http://', 'https://'), '', get_site_url()) . '&articleIds=' . $list;
            $args     = array('headers' => array('Cache-Control' => 'no-cache'));
            $response = wp_remote_retrieve_body(wp_safe_remote_get($url, $args));
            $count    = 0;
            $response = json_decode($response, true);

            if ($response['data']) {
                $response_data = $response['data'];
                if (!empty($response_data[$post->ID])) {
                    return $response_data[$post->ID];
                } else {
                    return $count;
                }
            }
        }
        return $count;
    }

    /**
     * This function for activating.
     *
     * @since  1.0.0.
     * @return void
     */
    public function activate()
    {

        if (is_array($this->settings)) {
            $settings = array_merge($this->settings_defaults, $this->settings);
            $settings = array_intersect_key($settings, $this->settings_defaults);
            update_option($this->settings_name, $settings);
        } else {
            add_option($this->settings_name, $this->settings_defaults);
        }

        $this->settings = get_option($this->settings_name);

        $args = array(
            'name'     => str_replace(array('www.', 'http://', 'https://'), '', get_site_url()),
            'host'     => str_replace(array('www.', 'http://', 'https://'), '', get_site_url()),
            'avatar'   => '',
            'email'    => get_option('admin_email'),
            'password' => rand(0, 1000000),
        );
        $args = json_encode($args);


        $url = 'https://api.vuukle.com/api/v1/Publishers/registerWP';
        $ch = curl_init(); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_setopt($ch, CURLOPT_URL, $url); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_setopt($ch, CURLOPT_POST, true); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type:application/json',
                'Content-Length: ' . strlen($args)
            )
        );
        $output = curl_exec($ch); // phpcs:ignore WordPress.WP.AlternativeFunctions
        $output = json_decode($output, true); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_close($ch); // phpcs:ignore WordPress.WP.AlternativeFunctions  

        $responseApiKey = $output['data']['apiKey'];

        if ($responseApiKey) {

            if (isset($responseApiKey)) {
                $settings          = get_option($this->settings_name);
                $settings['AppId'] = $responseApiKey;
                update_option($this->settings_name, $settings);
                $this->settings = get_option($this->settings_name);
            }
        }

        if (empty($responseApiKey)) {

            $url = 'https://api.vuukle.com/api/v1/WP/alertSupport?subjectLine=' . str_replace(array('www.', 'http://', 'https://'), '', get_site_url());;
            // execute curl
            $ch = curl_init(); // phpcs:ignore WordPress.WP.AlternativeFunctions
            curl_setopt($ch, CURLOPT_URL, $url); // phpcs:ignore WordPress.WP.AlternativeFunctions
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // phpcs:ignore WordPress.WP.AlternativeFunctions
            $output = curl_exec($ch); // phpcs:ignore WordPress.WP.AlternativeFunctions
            $output = json_decode($output, true); // phpcs:ignore WordPress.WP.AlternativeFunctions
            curl_close($ch); // phpcs:ignore WordPress.WP.AlternativeFunctions
        }
    }

    /**
     * This function for deactivating.
     *
     * @since  1.0.0.
     * @return void
     */
    public function deactivate()
    {

        $url  = 'https://api.vuukle.com/api/v1/WP/uninstallVuukle?';
        $url .= http_build_query(
            array(
                'email' => get_option('admin_email'),
            )
        );
        // execute curl
        $ch = curl_init(); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_setopt($ch, CURLOPT_URL, $url); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // phpcs:ignore WordPress.WP.AlternativeFunctions
        $output = curl_exec($ch); // phpcs:ignore WordPress.WP.AlternativeFunctions
        $output = json_decode($output, true); // phpcs:ignore WordPress.WP.AlternativeFunctions
        curl_close($ch); // phpcs:ignore WordPress.WP.AlternativeFunctions

    }
}

/**
 * The widget-specific functionality of the plugin.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/admin
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 */
class Recent_Comments_Widget extends WP_Widget
{

    /**
     * Initialize the class and set its properties.
     */
    function __construct()
    {
        parent::__construct(
            'recent_comments_widget',
            'Recent Comments',
            array('description' => 'Vuukle Recent Comments Widget')
        );
    }


    /**
     * This function creates the widget.
     *
     * @param array $args     this is an array
     * @param array $instance this is an array
     *
     * @since  1.0.0.
     * @return string
     */
    public function widget($args, $instance)
    {
        $widget_id    = $args['widget_id'];
        $title        = apply_filters('widget_title', $instance['title']);
        $tags         = $instance['tags'];
        $count        = $instance['count'];
        $style        = $instance['style'];
        $character    = $instance['character'];
        $display_type = 'List';
        $display_date = 'Yes';
        echo $args['before_widget']; // WPCS: XSS ok

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok
        }

        $api          = get_option('Vuukle');
        $api          = $api['AppId'];
        $url          = 'https://api.vuukle.com/api/v1/Comments/getRecentComments?host=' . str_replace(array('www.', 'http://', 'https://'), '', get_site_url()) . '&count=' . $count;
        $request_args = array('headers' => array('Cache-Control' => 'no-cache'));
        $response     = wp_remote_retrieve_body(wp_safe_remote_get($url, $request_args));
        $comments     = json_decode($response, true);
        $print_html   = '';


        if ('Carousel' === $display_type) {
            $stories_widget_carousel_items_width = count($comments) * 160;
            $print_html                          = '<div class="stories_widget_carousel">
						<div id="controllers" title="0">
								<span id="left" class="dashicons dashicons-arrow-left-alt2"></span>
								<span id="right" class="dashicons dashicons-arrow-right-alt2"></span>
						</div>
					  <div class="carousel_items" style="width:' . $stories_widget_carousel_items_width . 'px;">';

            foreach ($comments['data'] as $comment) {
                $__comment    = substr($comment['commentText'], 0, $character);
                $avatar_image = isset($comment['articleAvatar']) && '' !== $comment['articleAvatar'] ? $comment['articleAvatar'] : plugins_url('/noimage.jpg', __FILE__);
                $print_html  .= '<div class="carousel_item">
									<div class="carousel_item_img_div">
											<img class="carousel_item_img" src="' . $avatar_image . '">
											<div class="count">' . $__comment . '</div>
									</div>
									<div class="title"><a title="' . $comment['title'] . '" class="carousel_item_link"  href="' . str_replace(str_replace(array('www.', 'http://', 'https://'), '', get_site_url()), '', $comment['uri']) . '">' . substr($comment['title'], 0, 21) . '</a></div>
						  </div>';
            };
            $print_html .= '</div></div>';
            $print_html .= '<style>
							.stories_widget_carousel{width: 160px;height: 200px;overflow: hidden;position: relative;}
							.stories_widget_carousel #controllers{}
							.stories_widget_carousel #controllers > span {cursor: pointer;}
							.carousel_items{ position: absolute;left: 0;right: 0; transition: 1s;position: relative;}
							.carousel_item{display: inline-block;}
							.carousel_item_link{ position: absolute;}
							.carousel_item_img{width: 160px;height: 130px;}
							.carousel_item_img_div{    position: relative;}
							.carousel_item .count{position:absolute;bottom:0;padding: 3px;background: rgba( 33, 29, 29, 0.39 );border-radius: 10px 10px 0px 0px;color: white;font-size: 11px; right:7px;max-height: 38px;}
					   </style>';
        } elseif ('List' === $display_type) {
            $print_html .= '<ul id="' . $style . '">';


            foreach ($comments['data'] as $comment) {
                $__comment    = substr($comment['commentText'], 0, $character);
                $avatar_image = isset($comment['pictureUrl']) && '' !== $comment['pictureUrl'] ? $comment['pictureUrl'] : plugins_url('/images/noavatar.png', __FILE__);
                $comment_date = 'Yes' === $display_date ? $this->timeElapsedString(gmdate('Y-m-d H:i:s', $comment['createdTimestamp'])) : '';
                $url_profile = "https://vuukle.com/user/by/" . $comment['name'] . "/" . $comment['userId'];
                if ('theme1' === $instance['style']) {
                    $print_html .= '<li><div class="header"><a href="' . $url_profile . '"><img class="avatar" src="' . $avatar_image . '"/><span>' . $comment['name'] . '</span></a></div>';
                    $print_html .= $__comment;
                    $print_html .= '<div class="footer"><a href="' . str_replace(str_replace(array('www.', 'http://', 'https://'), '', get_site_url()), '', $comment['uri']) . '">' . $comment['title'] . '</a>' . $comment_date . '</div></li>';
                } elseif ('theme2' === $instance['style']) {
                    wp_enqueue_script('comments_count', plugins_url('/js/count.js', __FILE__));
                    wp_localize_script(
                        'comments_count',
                        'params',
                        array(
                            'host' => str_replace(array('www.', 'http://', 'https://'), '', get_site_url()),
                        )
                    );
                    $__comment   = strlen($__comment) > 80 ? substr($__comment, 0, 80) . '...' : $__comment;
                    $print_html .= '<li><div class="header"><a href="' .  $url_profile . '"><img class="avatar" src="' . $avatar_image . '"/><span>' . $comment['name'] . '</span></a></div>';
                    $print_html .= '<strong>( <span style="display: none" class="vuukle-postid" data-postid="' . esc_attr($comment['articleId']) . '"></span> )<a href="' . str_replace(str_replace(array('www.', 'http://', 'https://'), '', get_site_url()), '', $comment['uri']) . '">' . $comment['title'] . '</a> :</strong>';
                    $print_html .= $__comment . $comment_date . '</li>';
                }
            }
            $print_html .= '</ul>';
        }

        echo $print_html; // WPCS: XSS ok
        echo $args['after_widget']; // WPCS: XSS ok
    }

    /**
     * This function for  time elapsed.
     *
     * @param date   $datetime returned date
     * @param bulean $full     this is a bulean
     *
     * @since  1.0.0.
     * @return string
     */
    protected function timeElapsedString($datetime, $full = false)
    {

        if ($datetime) {
            $now      = new DateTime;
            $ago      = new DateTime($datetime);
            $diff     = $now->diff($ago);
            $diff->w  = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;

            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }

            if (!empty($full)) {
                $string = array_slice($string, 0, 1);
            }
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        } else {
            return '';
        }
    }

    /**
     * This function creates the form.
     *
     * @param array $instance this is an array
     *
     * @since  1.0.0.
     * @return void
     */
    public function form($instance)
    {
        $title        = isset($instance['title']) ? $instance['title'] : 'Recent Comments';
        $tags         = isset($instance['tags']) ? $instance['tags'] : '';
        $count        = isset($instance['count']) ? $instance['count'] : '10';
        $style        = isset($instance['style']) ? $instance['style'] : 'theme1';
        $character    = isset($instance['character']) ? $instance['character'] : '200';
        $display_type = isset($instance['display_type']) ? $instance['display_type'] : 'Carousel';
        $display_date = isset($instance['display_date']) ? $instance['display_date'] : 'No';
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo 'Title:'; ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php echo 'Style:'; ?></label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('style')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>">
                <option value="theme1" <?php selected($style, 'theme1'); ?>>Theme1</option>
                <option value="theme2" <?php selected($style, 'theme2'); ?>>Theme2</option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php echo 'Count:'; ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('character')); ?>"><?php echo 'Character:'; ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('character')); ?>" name="<?php echo esc_attr($this->get_field_name('character')); ?>" type="text" value="<?php echo esc_attr($character); ?>">
        </p>
        <p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('tags')); ?>"><?php echo 'Tags:'; ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" type="text" value="<?php echo esc_attr($tags); ?>">
        </p>
    <?php
    }

    /**
     * This function ensures the update.
     *
     * @param array $new_instance this is a new array
     * @param array $old_instance this is an old array
     *
     * @since  1.0.0.
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance                 = array();
        $instance['title']        = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['count']        = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']) : '';
        $instance['style']        = (!empty($new_instance['style'])) ? strip_tags($new_instance['style']) : '';
        $instance['tags']         = (!empty($new_instance['tags'])) ? strip_tags($new_instance['tags']) : '';
        $instance['character']    = (!empty($new_instance['character'])) ? strip_tags($new_instance['character']) : '';
        $instance['display_type'] = (!empty($new_instance['display_type'])) ? strip_tags($new_instance['display_type']) : '';
        $instance['display_date'] = (!empty($new_instance['display_date'])) ? strip_tags($new_instance['display_date']) : '';
        return $instance;
    }
}

/**
 * The widget-specific functionality of the plugin.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/admin
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 */
class Most_Commented_Stories_Widget extends WP_Widget
{

    /**
     * Initialize the class and set its properties.
     */
    function __construct()
    {
        parent::__construct(
            'most_commented_stories_widget',
            'Most Commented Stories',
            array('description' => 'Vuuke Most Commented Stories Widget')
        );
    }

    /**
     * This function creates the widget.
     *
     * @param array $args     this is an array
     * @param array $instance this is an array
     *
     * @since  1.0.0.
     * @return void
     */
    public function widget($args, $instance)
    {
        $widget_id    = $args['widget_id'];
        $title        = apply_filters('widget_title', $instance['title']);
        $hours        = $instance['hours'];
        $count        = $instance['count'];
        $display_type = $instance['display_type'];
        echo $args['before_widget']; // WPCS: XSS ok

        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title']; // WPCS: XSS ok
        }
        if (is_array(get_option('Vuukle'))) {
            $api = get_option('Vuukle');
            $api = $api['AppId'];
        };

        $url          = 'https://api.vuukle.com/api/v1/Articles/getRecentMostCommentedByHostByTime?host=' . str_replace(array('www.', 'http://', 'https://'), '', get_site_url()) . '&hours=' . $hours . '&start=0&pageSize=' . $count;
        $request_args = array('headers' => array('Cache-Control' => 'no-cache'));
        $response     = wp_remote_retrieve_body(wp_safe_remote_get($url, $request_args));
        $articles     = json_decode($response, true);

        $print_html = '';
        if ('Carousel' === $display_type) {
            $stories_widget_carousel_items_width = count($articles) * 160;
            $print_html                          = '<div class="stories_widget_carousel">
						<div id="controllers" title="0">
								   <span id="left" class="dashicons dashicons-arrow-left-alt2"></span>
								   <span id="right" class="dashicons dashicons-arrow-right-alt2"></span>
						</div>
					  <div class="carousel_items" style="width:' . $stories_widget_carousel_items_width . 'px;">';
            foreach ($articles['data'] as $article) {
                $article_image = isset($article['articleAvatar']) && '404' !== $article['articleAvatar'] ? $article['articleAvatar'] : plugins_url('/noimage.jpg', __FILE__);
                $print_html   .= '<div class="carousel_item">
									<div class="carousel_item_img_div">
											<img class="carousel_item_img" src="' . $article_image . '">
											<div class="count">' . $article['commentCount'] . ' Comments</div>
									</div>
									<div class="title"><a title="' . $article['title'] . '" class="carousel_item_link"  href="' . $article['uri'] . '">' . substr($article['title'], 0, 21) . '</a></div>
						  </div>';
            };
            $print_html .= '</div></div>';
            $print_html .= '<style>
							.stories_widget_carousel{width: 160px;height: 200px;overflow: hidden;position: relative;}
							.stories_widget_carousel #controllers{}
							.stories_widget_carousel #controllers > span {cursor: pointer;}
							.carousel_items{ position: absolute;left: 0;right: 0; transition: 1s;position: relative;}
							.carousel_item{display: inline-block;}
							.carousel_item_link{ position: absolute;}
							.carousel_item_img{width: 160px;height: 130px;}
							.carousel_item_img_div{    position: relative;}
							.carousel_item .count{position:absolute;bottom:0;padding: 3px;background: rgba( 33, 29, 29, 0.39 );border-radius: 10px 10px 0px 0px;color: white;font-size: 11px; right:7px;max-height: 38px;}
					   </style>';
        } elseif ('List' === $display_type) {
            $print_html .= '<ul>';
            foreach ($articles['data'] as $article) {
                echo '<li><img src="' . $article['articleAvatar'] . '"/>' . $article['commentCount'] . ' comments on <a href="' . $article['uri'] . '">' . $article['title'] . '</a>'; // WPCS: XSS ok
            }
            $print_html .= '</ul>';
        }

        echo $print_html; // WPCS: XSS ok
        echo $args['after_widget']; // WPCS: XSS ok
    }

    /**
     * This function creates the form.
     *
     * @param array $instance this is an array
     *
     * @since  1.0.0.
     * @return string
     */
    public function form($instance)
    {
        $title        = isset($instance['title']) ? $instance['title'] : 'Most Commented Stories';
        $hours        = ($instance['hours']) ? $instance['hours'] : '12';
        $count        = isset($instance['count']) ? $instance['count'] : '10';
        $display_type = isset($instance['display_type']) ? $instance['display_type'] : '10';
    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo 'Title:'; ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php echo 'Count:'; ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('hours')); ?>"><?php echo 'Hours:'; ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('hours')); ?>">
                <?php
                $hour_options = array('12', '24', '48', '96', '200', '500', '1000');
                foreach ($hour_options as $hour_option) :
                ?>
                    <option <?php echo $hours === $hour_option ? 'selected' : ''; // WPCS: XSS ok 
                            ?> value="<?php echo $hour_option; // WPCS: XSS ok 
                                        ?>"><?php echo $hour_option; // WPCS: XSS ok 
                                            ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('display_type')); ?>"><?php echo 'Display Type:'; ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('display_type')); ?>">
                <option <?php echo 'Carousel' === $display_type ? 'selected' : ''; ?> value="Carousel">Carousel</option>
                <option <?php echo 'List' === $display_type ? 'selected' : ''; ?> value="List">List</option>
            </select>
        </p>
<?php
    }

    /**
     * This function ensures the update.
     *
     * @param array $new_instance this is a new array
     * @param array $old_instance this is an old array
     *
     * @since  1.0.0.
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance                 = array();
        $instance['title']        = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['count']        = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']) : '';
        $instance['hours']        = (!empty($new_instance['hours'])) ? strip_tags($new_instance['hours']) : '';
        $instance['display_type'] = (!empty($new_instance['display_type'])) ? strip_tags($new_instance['display_type']) : '';
        return $instance;
    }
}
