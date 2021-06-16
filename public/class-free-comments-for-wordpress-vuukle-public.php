<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/public
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 * @since      1.0.0
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/public
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 */
class Free_Comments_For_Wordpress_Vuukle_Public
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
    //    private $content_check;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version     The version of this plugin.
     *
     * @since 1.0.0
     */
    public function __construct($plugin_name, $version)
    {
        //        $this->content_check = 0;
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->plugin_path   = dirname($this->plugin_name) . DIRECTORY_SEPARATOR;
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
            'embed_powerbar'              => '',
            'div_class_powerbar'          => '',
            'div_class_powerbar2'         => '',
            'div_class_emotes'            => '',
            'div_class_newsfeed'          => '',
            'lang'                        => '',
            'enabled_comments'            => 'true',
            'color'                       => '#108ee9',
            'emote'                       => 'true',
            'save_comments'               => '0',
			'save_ads_txt'                => ($this->settings['save_ads_txt'])?$this->settings['save_ads_txt']:'false',
            'recomendations_protocol'     => 'none',
            'amount_comments'             => 1000,
            'embed_comments'              => $comments_status == "open" ? '1' : '2',
            'embed_emotes'                => '0',
            'embed_newsfeed'              => '0',
            'embed_powerbar'              => '0',
            'mobile_type'                 => 'vertical',
            'desktop_type'                => 'vertical',
            'mobile_type_horizontal'      => 'horizontal',
            'desktop_type_horizontal'     => 'horizontal',
            'endless_mode'                => '0',
            'email_for_export_comments'   => 'support@vuukle.com',
            'start_date_comments'         => gmdate('Y-m-d', strtotime('-30 days')),
            'end_date_comments'           => gmdate('Y-m-d'),
            'og_tags'                     => '0',
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
            'desktop_type'                => 'vertical',
            'mobile_type_horizontal'      => 'horizontal',
            'desktop_type_horizontal'     => 'horizontal',
            'share_vertical_styles'       => 'position:fixed;                                                             z-index: 10001;                                                            width: 60px;                                                            max-width: 60px;                                                           left: 10px;                                                             top: 160px;',
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
            'facebook_url'                => '',
            'twitter_url'                 => '',
            'linkedin_url'                => '',
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

        if (!isset($this->settings['embed_comments'])) {
            $this->settings = $this->settings_defaults;
        }

        if ('true' == $this->settings['enabled_comments']) {
            if ('1' == $this->settings['embed_comments']) {
                add_filter('comments_open', '__return_false', 20, 2);
                add_filter('pings_open', '__return_false', 20, 2);
                add_filter('comments_array', '__return_empty_array', 10, 2);
                add_filter('the_content', array($this, 'vuukleCommentBox'), $this->settings['priority']);
                add_filter('comments_template', array($this, 'replaceWordpressComments'), 999);
            }
            if ('2' == $this->settings['embed_comments']) {
                add_filter('the_content', array($this, 'vuukleCommentBox'), $this->settings['priority']);
                add_filter('comments_template', array($this, 'commentsTemplate'), 999);
            }

            if ('3' == $this->settings['embed_comments']) {
                if (!empty($this->settings['div_class'])) {
                    add_filter('the_content', array($this, 'vuukleCommentBox'), $this->settings['priority']);
                }
                add_filter('comments_template', array($this, 'commentsTemplate'), 999);
            }

            if ('4' == $this->settings['embed_comments']) {
                if (!empty($this->settings['div_id'])) {
                    add_filter('the_content', array($this, 'vuukleCommentBox'), $this->settings['priority']);
                }
                add_filter('comments_template', array($this, 'commentsTemplate'), 999);
            }
        }
        add_action('wp_footer', array($this, 'createVuuklePlatform'));
        if ('1' == $this->settings['endless_mode']) {
            add_filter('the_content', array($this, 'addEndlessScript'), 20);
            add_filter('the_content', array($this, 'addEndlessBox'), 20);
        }
        if ($this->settings['emote'] && '2') {
            add_filter('the_content', array($this, 'addEmote'), 20);
        }
        if ('1' == $this->settings['newsfeed']) {
            add_filter('the_content', array($this, 'addNewsfeedBox'), 12);
        }




        //share bar mobile and desktop before Div & ID 


        if ($this->settings['enable_h_v'] === 'yes') {
            if (wp_is_mobile()) {
if ($this->settings['embed_powerbar'] === '2' && $this->settings['div_id_powerbar'] != ''){
  add_filter('the_content', array($this, 'addShareBefore'), 11);}
              else{  if ($this->settings['share']) {
                    add_filter('the_content', array($this, 'addOnlyBefore'), 11);
                }
                if ($this->settings['share']) {
                    add_filter('the_content', array($this, 'addOnlyAfter'), 11);
                }}
            } else {
                if ($this->settings['share']) {
                    add_filter('the_content', array($this, 'addOnlyVertical'), 11);
                }
            }
        } else {
            if (($this->settings['embed_powerbar'] === '1' && $this->settings['div_class_powerbar'] != '') || ($this->settings['embed_powerbar'] === '2' && $this->settings['div_id_powerbar'] != '')) {
                if (wp_is_mobile()) {
                    if ($this->settings['share'] && 'vertical' === $this->settings['mobile_type'] && $this->settings['share_type_vertical'] === 'vertical') {
                        add_filter('the_content', array($this, 'addShareBefore2'), 11);
                    }
                    if ($this->settings['share'] && 'horizontal' === $this->settings['mobile_type_horizontal'] && $this->settings['share_type'] === 'horizontal') {
                        add_filter('the_content', array($this, 'addShareBefore'), 11);
                    }
                } else {
                    if ($this->settings['share'] && 'vertical' === $this->settings['desktop_type'] && $this->settings['share_type_vertical'] === 'vertical') {
                        add_filter('the_content', array($this, 'addShareBefore2'), 11);
                    }

                    if ($this->settings['share'] && 'horizontal' === $this->settings['desktop_type_horizontal'] && $this->settings['share_type'] === 'horizontal') {
                        add_filter('the_content', array($this, 'addShareBefore'), 11);
                    }
                }
            } else {
                $isPut = false;

                if (wp_is_mobile()) {
                    if ($this->settings['share'] && 'vertical' === $this->settings['mobile_type'] && $this->settings['share_type_vertical'] === 'vertical') {
                        $isPut = true;
                        add_filter('the_content', array($this, 'addShareBefore2'), 11);
                    }
                    if ($this->settings['share'] && 'horizontal' === $this->settings['mobile_type_horizontal'] && $this->settings['share_type'] === 'horizontal' && $this->settings['share_position2'] === '1') {
                        add_filter('the_content', array($this, 'addShareBefore'), 11);
                    }
                } else {
                    if ($this->settings['share'] && 'vertical' === $this->settings['desktop_type'] && $this->settings['share_type_vertical'] === 'vertical' && !$isPut) {
                        add_filter('the_content', array($this, 'addShareBefore2'), 11);
                    }

                    if ($this->settings['share'] && 'horizontal' === $this->settings['desktop_type_horizontal'] && $this->settings['share_type'] === 'horizontal' && $this->settings['share_position2'] === '1') {
                        add_filter('the_content', array($this, 'addShareBefore'), 11);
                    }
                }


                if (wp_is_mobile()) {
                    if ($this->settings['share'] && 'vertical' === $this->settings['mobile_type'] && $this->settings['share_type_vertical'] === 'vertical' && !$isPut) {
                        add_filter('the_content', array($this, 'addShareAfter2'), 11);
                    }
                    if ($this->settings['share'] && 'horizontal' === $this->settings['mobile_type_horizontal'] && $this->settings['share_type'] === 'horizontal' && $this->settings['share_position'] === '1') {
                        add_filter('the_content', array($this, 'addShareAfter'), 11);
                    }
                } else {
                    if ($this->settings['share'] && 'vertical' === $this->settings['desktop_type'] && $this->settings['share_type_vertical'] === 'vertical' && $isPut) {
                        add_filter('the_content', array($this, 'addShareAfter2'), 11);
                    }

                    if ($this->settings['share'] && 'horizontal' === $this->settings['desktop_type_horizontal'] && $this->settings['share_type'] === 'horizontal' && $this->settings['share_position'] === '1') {
                        add_filter('the_content', array($this, 'addShareAfter'), 11);
                    }
                }
            }
        }


        // newsletter bar
        if ($this->settings['newsletter']) {
            add_filter('the_content', array($this, 'addNewsletter'));
        }
        if ('1' == $this->settings['og_tags']) {
            add_action('wp_head',  array($this, 'ogTags'));
        }
        if (isset($this->settings['enable_seo']) && $this->settings['enable_seo'] != 'off') {
            add_filter('the_content', array($this, 'addPostScript'), 20);
        }
        if (isset($this->settings['non_article_pages']) && $this->settings['non_article_pages'] != 'off') {
            add_action("wp_footer", array($this, 'track_page_view'));
        }
        include VUUKLE_INCLUDES_PATH . '/export-comments.php';
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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
    }


    /**
     * This function generates shortcode.
     *
     * @since  1.0.0.
     * @return void
     */
    public function generateShortcode()
    {

        add_shortcode('vuukle', array($this, 'shortCodeVuukle'));
    }

    /**
     * This function creates a block for shortcode.
     *
     * @param string $attr    this is attributes
     * @param string $content this is content
     *
     * @since  1.0.0.
     * @return string
     */
    public function shortCodeVuukle($attr, $content)
    {

        return '<div id="vuukle-comments"></div>';
    }

    /**
     * This function saves comments to DB.
     *
     * @since  1.0.0.
     * @return void
     */
    public function saveCommentToDb()
    {

        if (isset($_POST['_wpnonce']) && wp_verify_nonce(sanitize_key($_POST['_wpnonce']))) { // Input var okay
            global $wpdb;
            $post = $_POST; // Input var okay
            $data = array(
                'comment_post_ID'      => $post['comment_post_ID'],
                'comment_author'       => $post['comment_author'],
                'comment_author_email' => $post['comment_author_email'],
                'comment_author_url'   => $post['comment_author_url'],
                'comment_content'      => $post['comment_content'],
                'comment_type'         => $post['comment_type'],
                'comment_parent'       => $post['comment_parent_ID'],
                'user_id'              => $post['user_id'],
                'comment_author_IP'    => $post['comment_author_IP'],
                'comment_agent'        => $post['comment_agent'],
                'comment_date'         => gmdate('Y-m-d H:i:s', strtotime($post['comment_date'])),
                'comment_date_gmt'     => gmdate('Y-m-d H:i:s', strtotime($post['comment_date'])),
                'comment_approved'     => $post['comment_approved'],
                'comment_karma'        => $post['comment_karma'],
            );
            $comment_ID = wp_insert_comment($data);
            $vuukle_comment_ID = (int) $post['comment_ID'];
            $wpdb->query($wpdb->prepare("UPDATE" . $wpdb->prefix . "comments SET comment_ID=%s WHERE comment_ID=%s", $vuukle_comment_ID, $comment_ID));
            //$wpdb->query("UPDATE ".$wpdb->prefix."comments SET comment_ID = $vuukle_comment_ID WHERE comment_ID = '$comment_ID'");

            exit;
        }
    }

    /**
     * This function adds DNS.
     *
     * @since  1.0.0.
     * @return void
     */
    public function addDns()
    {
?>
        <link rel="preload" href="https://securepubads.g.doubleclick.net/tag/js/gpt.js" as="script">
        <link rel="preconnect" href="https://cdn.vuukle.com/">
        <link rel="dns-prefetch" href="https://cdn.vuukle.com/">
        <link rel="dns-prefetch" href="https://api.vuukle.com/">
        <link rel="preconnect" href="https://api.vuukle.com/">
        <link rel="prefetch preload" href="https://cdn.vuukle.com/platform.js" as="script">
<?php
    }
    public function defer_parsing_of_js($url)
    {
        if (is_user_logged_in()) return $url; //don't break WP Admin
        if (FALSE === strpos($url, '.js')) return $url;
        if (strpos($url, 'jquery.js')) return $url;
        return str_replace(' src', '  src', $url);
    }

    /**
     * This function adds scripts in the front.
     *
     * @since  1.0.0.
     * @return void
     */
    public function frontScripts()
    {
        if ($this->settings['AppId']) {
            if (is_single()) {
                wp_localize_script(
                    'wuukle-widget',
                    'param',
                    array(
                        'vuukle_version' => FREE_COMMENTS_FOR_WORDPRESS_VUUKLE_VERSION,
                        'api_key' => (bool)$this->settings['AppId'],
                    )
                );
            } else {
                wp_enqueue_script('comments_count', plugins_url('/js/count.js', __FILE__),  NULL, true);
                wp_localize_script(
                    'comments_count',
                    'params',
                    array(
                        'api_key' => $this->settings['AppId'],
                        'host' => str_replace(array('www.', 'http://', 'https://'), '', get_site_url()),
                    )
                );
            }
        }
    }

    /**
     * This function adds scripts in the front.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function vuukleCommentBox($content)
    {
        if (is_single()) {
            ob_start();
            $vuukle = $this;
            include VUUKLE_INCLUDES_PATH . '/commentbox.php';
            $commentbox = ob_get_contents();
            ob_end_clean();
            $content .= $commentbox;
        }
        return $content;
    }
    public function removePostone()
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


        if (in_array((string) $post->ID, $post_exceptions, true)) {
            return false;
        }

        if (count(array_intersect($category_exceptions, $post_categories))) {
            return false;
        }

        // post type exceptions
        $post_type_exceptions = explode(',', $this->settings['post_type_exceptions']);
        $post_type_exceptions = array_map('trim', $post_type_exceptions);
        if (in_array((string) $post->post_type, $post_type_exceptions, true)) {
            return false;
        }

        // post type by URL exceptions
        $post_type_by_url_exceptions = explode(',', $this->settings['post_type_by_url_exceptions']);
        $post_type_by_url_exceptions = array_map('trim', $post_type_by_url_exceptions);
        $link = str_replace(home_url(), '', get_permalink());
        if (in_array((string) $link, $post_type_by_url_exceptions, true)) {
            return false;
        }
        return true;
    }



    /**
     * This function adds emote.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function addEmote($content)
    {
        $emote_text = array(
            $this->settings['happy_text'],
            $this->settings['indifferent_text'],
            $this->settings['amused_text'],
            $this->settings['excited_text'],
            $this->settings['angry_text'],
            $this->settings['sad_text'],
        );



        $style_emote = '';
        if (is_single()) {
            if ($this->settings['emote_widget_width'] &&  $this->settings['emote'] === 'true' && $this->removePostone()) {
                $width = $this->settings['emote_widget_width'];
                $style_emote = "style='max-width:" . $width . "px;min-height:160px;'";
            }
        } else {
            $style_emote = '';
        }

        return $content . '<div id="vuukle-emote" ' . $style_emote . ' class="emotesBoxDiv"></div>';
    }



    /**
     * This function adds newsfeed box.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function addNewsfeedBox($content)
    {

        return $content . '<div id="vuukle-newsfeed" class="newsfeedBoxDiv"></div>';
    }

    /**
     * This function adds endless box.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function addEndlessBox($content)
    {
        global $post;

        return $content . ' <div class="vuukle-powerbar-' . $post->ID . '"></div>
                                <div id="vuukle-emote-' . $post->ID . '"></div>
                                <div id="vuukle-comments-' . $post->ID . '"></div>
                               ';
    }

    /**
     * This function adds endless script.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function addEndlessScript($content)
    {
        global $post;
        $tags     = wp_get_post_tags($post->ID);
        $arr_tags = array();
        if (!empty($tags)) {
            $k = 1;
            foreach ($tags as $taged) {
                if ($k < 4) {
                    $arr_tags[] = $taged->name;
                }
                $k++;
            }
            $tags = implode(', ', $arr_tags);
        } else {
            $tags = '';
        }

        return $content . '
            <script data-cfasync="false" >
            document.addEventListener("DOMContentLoaded", function() {
                    setTimeout(function(){
                        window.newVuukleWidgets({
                           elementsIndex: ' . $post->ID . ',
                           articleId: ' . $post->ID . ',
                           img: "' . get_the_post_thumbnail_url($post->ID, 'thumbnail') . '",
                           title: "' . get_the_title($post->ID) . '",
                           tags: "' . str_replace(['"', "'"], '', quotemeta(stripslashes($tags))) . '",
                           url: "' . get_permalink($post->ID) . '",
                        });
                    }, 2000);
                }); 
            </script>';
    }

    /**
     * This function adds share afther box.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function addShareAfter($content)
    {
        $type   = 'horizontal' === $this->settings['share_type'] ? 'vuukle-powerbar' : 'vuukle-powerbar-vertical';
        $styles = 'horizontal' === $this->settings['share_type'] ? '' : $this->settings['share_vertical_styles'];
        if (is_single() && $this->removePostone()) {
            $styles = $styles . "min-height: 50px;";
        } else {
            $styles = '';
        }
        return $content . '<div id="vuukle-powerbar" class="' . $type . ' powerbarBoxDiv" style="' . $styles . '" data-styles="' . $styles . '"></div>';
    }
    public function addShareAfter2($content)
    {
        $type   = 'vertical' === $this->settings['share_type_vertical'] ? 'vuukle-powerbar-vertical' : 'vuukle-powerbar';
        $styles = 'vertical' === $this->settings['share_type_vertical'] ? $this->settings['share_vertical_styles'] : '';
        $styles = $styles . "min-height: 50px;";
        return $content . '<div id="vuukle-powerbar" class="' . $type . ' powerbarBoxDiv" style="' . $styles . '" data-styles="' . $styles . '"></div>';
    }


    /**
     * This function adds share before box.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function addShareBefore($content)
    {
        $type   = 'horizontal' === $this->settings['share_type'] ? 'vuukle-powerbar' : 'vuukle-powerbar-vertical';
        $styles = 'horizontal' === $this->settings['share_type'] ? '' : $this->settings['share_vertical_styles'];
        if (is_single() && $this->removePostone()) {
            $styles = $styles . "min-height: 50px;";
        } else {
            $styles = '';
        }
        return '<div id="vuukle-powerbar" class="' . $type . ' powerbarBoxDiv" style="' . $styles . ' " data-styles="' . $styles . '"></div>' . $content;
    }
    public function addShareBefore2($content)
    {
        $type   = 'vertical' === $this->settings['share_type_vertical'] ? 'vuukle-powerbar-vertical' : 'vuukle-powerbar';
        $styles = 'vertical' === $this->settings['share_type_vertical'] ?  $this->settings['share_vertical_styles'] : '';
        $styles = $styles . "min-height: 50px;";
        return '<div id="vuukle-powerbar" class="' . $type . ' powerbarBoxDiv" style="' . $styles . ' " data-styles="' . $styles . '"></div>' . $content;
    }


    public function addOnlyAfter($content)
    {
        $type = 'vuukle-powerbar';
        $styles = '';
        return $content . '<div id="vuukle-powerbar" class="' . $type . ' powerbarBoxDiv" style="' . $styles . '" data-styles="' . $styles . '"></div>';
    }
    public function addOnlyBefore($content)
    {
        $type = 'vuukle-powerbar';
        $styles = '';
        return '<div id="vuukle-powerbar" class="' . $type . ' powerbarBoxDiv" style="' . $styles . ' " data-styles="' . $styles . '"></div>' . $content;
    }
    public function addOnlyVertical($content)
    {
        $type = 'vuukle-powerbar-vertical';
        $styles =  $this->settings['share_vertical_styles'];
        return $content . '<div id="vuukle-powerbar" class="' . $type . ' powerbarBoxDiv" style="' . $styles . '" data-styles="' . $styles . '"></div>';
    }


    /**
     * This function adds newsletter box.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function addNewsletter($content)
    {
        return ('1' === $this->settings['newsletter_position']) ? $content . '<div id="vuukle-subscribe"></div>' : '<div id="vuukle-subscribe"></div>' . $content;
    }

    /**
     * This function registers recent comments widget.
     *
     * @since  1.0.0.
     * @return void
     */
    public function registerRecentCommentsWidget()
    {
        unregister_widget('WP_Widget_Recent_Comments');
        register_widget('Recent_Comments_Widget');
        register_widget('Most_Commented_Stories_Widget');
    }

    /**
     * This function adds meta tags.
     *
     * @since  1.0.0.
     * @return void
     */
    public function ogTags()
    {
        global $post;
        $tags = '<meta property="og:title" content="' . get_the_title() . '" />
                     <meta property="og:type" content="article" />
                     <meta property="og:url" content="' . get_permalink() . '" />
                    ';
        if (has_post_thumbnail()) {
            $tags .= '<meta property="og:image" content="' . get_the_post_thumbnail_url() . '" />';
        }

        echo $tags;
    }

    /**
     * This function creates a VUUKLE platform.
     *
     * @param string $content this is a content
     *
     * @since  1.0.0.
     * @return string
     */
    public function createVuuklePlatform($content)
    {
        if (!is_single()) {
            return $content;
        }

        if (!is_singular()) {
            return $content;
        }

        if (!is_main_query()) {
            return $content;
        }

        global $post;

        $post_exceptions = explode(',', $this->settings['post_exceptions']);
        $post_exceptions = array_map('trim', $post_exceptions);

        $category_exceptions = explode(',', $this->settings['category_exceptions']);
        $category_exceptions = array_map('trim', $category_exceptions);
        $post_categories     = get_the_category($post->ID);
        $post_url = get_permalink($post->ID);
        foreach ($post_categories as $key => $category) {
            $post_categories[$key] = $category->slug;
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
        $post_type_by_url = (isset($this->settings['post_type_by_url_exceptions']) && $this->settings['post_type_by_url_exceptions'] != '') ? $this->settings['post_type_by_url_exceptions'] : '';
        if ($post_type_by_url != '') {
            $post_type_by_url_exceptions = explode(',', $this->settings['post_type_by_url_exceptions']);
            $post_type_by_url_exceptions = array_map('trim', $post_type_by_url_exceptions);
            if ($post_type_by_url_exceptions != '') {
                foreach ($post_type_by_url_exceptions as $key => $post_type) {
                    $result = strpos($post_url, $post_type);
                    if ($result !== false) {
                        return $content;
                        break;
                    }
                }
            }
        }
        ob_start();
        $vuukle = $this;
        $vuukle->settings = get_option($vuukle->settings_name);
        include VUUKLE_INCLUDES_PATH . '/vuukleplatform.php';
        $commentbox = ob_get_contents();
        ob_end_clean();
        $content .= $commentbox;
        echo $content; 
        return $content;
    }

    /**
     * This function replaces WORDPRESS comments.
     *
     * @param string $file this is a file
     *
     * @since  1.0.0.
     * @return string
     */
    public function replaceWordpressComments($file)
    {
        global $post;

        $post_exceptions = explode(',', $this->settings['post_exceptions']);
        $post_exceptions = array_map('trim', $post_exceptions);

        $category_exceptions = explode(',', $this->settings['category_exceptions']);
        $category_exceptions = array_map('trim', $category_exceptions);
        $post_categories     = get_the_category($post->ID);
        $post_url            = get_permalink($post->ID);
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
        $post_type_by_url = (isset($this->settings['post_type_by_url_exceptions']) && $this->settings['post_type_by_url_exceptions'] != '') ? $this->settings['post_type_by_url_exceptions'] : '';
        if ($post_type_by_url != '') {
            $post_type_by_url_exceptions = explode(',', $this->settings['post_type_by_url_exceptions']);
            $post_type_by_url_exceptions = array_map('trim', $post_type_by_url_exceptions);
            if ($post_type_by_url_exceptions != '') {
                foreach ($post_type_by_url_exceptions as $key => $post_type) {
                    $result = strpos($post_url, $post_type);
                    if ($result !== false) {
                        return $content;
                        break;
                    }
                }
            }
        }

        $vuukle = $this;
        $comments_file = VUUKLE_INCLUDES_PATH . '/commentbox.php';

        if (is_single()) {
            if ($this->settings['AppId'] && file_exists($comments_file)) {
                $file = $comments_file;
            }
        }
        return $file;
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
        $post_url = get_permalink($post->ID);
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
        $post_type_by_url = (isset($this->settings['post_type_by_url_exceptions']) && $this->settings['post_type_by_url_exceptions'] != '') ? $this->settings['post_type_by_url_exceptions'] : '';
        if ($post_type_by_url != '') {
            $post_type_by_url_exceptions = explode(',', $this->settings['post_type_by_url_exceptions']);
            $post_type_by_url_exceptions = array_map('trim', $post_type_by_url_exceptions);
            if ($post_type_by_url_exceptions != '') {
                foreach ($post_type_by_url_exceptions as $key => $post_type) {
                    $result = strpos($post_url, $post_type);
                    if ($result !== false) {
                        return $content;
                        break;
                    }
                }
            }
        }

        $comments_file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'comments-empty.php';

        if (is_single()) {
            if ($this->settings['AppId'] && file_exists($comments_file)) {
                $file = $comments_file;
            }
        }
        return $file;
    }

    public function addPostScript($content)
    {
        global $post;
        $setting = $this->settings;

        // get post atts
        $post_title     = isset($post->post_title) && $post->post_title ? $post->post_title : '';
        $post_excerpt   = isset($post->post_excerpt) && $post->post_excerpt ? $post->post_excerpt : '';
        $post_date      = isset($post->post_date) && $post->post_date ? $post->post_date : '';
        $post_modified  = isset($post->post_modified) && $post->post_modified ? $post->post_modified : '';
        $post_author_id = isset($post->post_author) && $post->post_author ? $post->post_author : '';
        $post_content   = isset($post->post_content) && $post->post_content ? sanitize_text_field($post->post_content) : '';

        // get custom option args organization
        $org_fb_url        = isset($setting['vuukle_facebook_url']) && $setting['vuukle_facebook_url'] != '' ? $setting['vuukle_facebook_url'] : '';
        $org_twitter_url   = isset($setting['vuukle_twitter_url']) && $setting['vuukle_twitter_url'] != '' ? $setting['vuukle_twitter_url'] : '';
        $org_linkedin_url  = isset($setting['vuukle_linkedin_url']) && $setting['vuukle_linkedin_url'] != '' ? $setting['vuukle_linkedin_url'] : '';
        $org_publisher_url = isset($setting['vuukle_publisher_url']) && $setting['vuukle_publisher_url'] != '' ? $setting['vuukle_publisher_url'] : '';

        // get custom option args user
        $user_fb_url       = isset($setting['vuukle_user_facebook_url']) && $setting['vuukle_user_facebook_url'] != '' ? $setting['vuukle_user_facebook_url'] : '';
        $user_twitter_url  = isset($setting['vuukle_user_linkedin_url']) && $setting['vuukle_user_linkedin_url'] != '' ? $setting['vuukle_user_linkedin_url'] : '';
        $user_linkedin_url = isset($setting['vuukle_user_twitter_url']) && $setting['vuukle_user_twitter_url'] != '' ? $setting['vuukle_user_twitter_url'] : '';

        // get user data
        $this_post_user    = get_userdata(intval($post_author_id));
        $get_this_site_url = get_site_url();
        $current_site_name = get_bloginfo($get_this_site_url);

        // get featured image
        $image_url    = '';
        $image_width  = '';
        $image_height = '';
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        if (!empty($image)) {
            $image_url    = isset($image[0]) && $image[0] != '' ? $image[0] : '';
            $image_width  = isset($image[1]) && $image[1] != '' ? $image[1] : '';
            $image_height = isset($image[2]) && $image[2] != '' ? $image[2] : '';
        }

        // get logo 
        $logo_img     = '';
        $logo_img_url = '';
        $logo_img_id  = get_theme_mod('custom_logo');
        if ($logo_img_id) {
            $logo_img = wp_get_attachment_image_src($logo_img_id, 'full');
            if (!empty($logo_img)) {
                $logo_img_url = isset($logo_img[0]) && $logo_img[0] != '' ? $logo_img[0] : '';
            }
        }

        // get user name
        $this_user_name = '';
        if ($this_post_user !== null) {
            $this_user_name = isset($this_post_user->data->display_name) && $this_post_user->data->display_name != '' ? $this_post_user->data->display_name : '';
        }

        $my_content_obj = array(
            "@context" => "https://schema.org",
            "@type"    => "Article",
        );
        if (function_exists("amp_is_request") && amp_is_request()) {
            $my_content_obj["mainEntityOfPage"] = array(
                "@type" => "WebPage",
                "@id" => get_permalink($post->ID),
            );
        }

        if ($post_title != '') {
            $my_content_obj["headline"] = $post_title;
        }

        if ($post_excerpt != '') {
            $my_content_obj["description"] = $post_excerpt;
        }

        if ($post_date != '') {
            $my_content_obj["datePublished"] = substr($post_date, 0, 10);
        }

        if ($post_modified != '') {
            $my_content_obj["datemodified"] = substr($post_modified, 0, 10);
        }

        $my_content_obj["image"] = array(
            "@type"  => "imageObject",
            "url"    => $image_url,
            "height" => $image_height,
            "width"  => $image_width,
        );
        $my_content_obj["publisher"] = array(
            "@type" => "Organization",
        );
        if ($current_site_name != '') {
            $my_content_obj["publisher"]["name"] = $current_site_name;
        }
        $my_content_obj["publisher"]["sameAs"] = array(
            $org_fb_url,
            $org_twitter_url,
            $org_linkedin_url,
        );
        // $my_content_obj["publisher"]["logo"] = array(
        //     "@type" => "imageObject",
        //     "url" => $logo_img_url,
        // );
        $my_content_obj["publisher"]["logo"] = array(
            "@type" => "imageObject",
            "url" => $org_publisher_url,
        );
        $my_content_obj["author"] = array(
            "@type" => "Person",
        );
        if ($this_user_name != '') {
            $my_content_obj["author"]['name'] = $this_user_name;
        }
        $my_content_obj["author"]['sameAs'] = array(
            $user_fb_url,
            $user_twitter_url,
            $user_linkedin_url,
        );
        $my_content_obj["articleBody"] = $post_content;
        $my_content = json_encode($my_content_obj);

        $my_content = '<script type="application/ld+json" >' . ($my_content) . '</script>';
        $content .= $my_content;

        return $content;
    }

    public function track_page_view()
    {
        $setting = $this->settings;
        $api_key = isset($setting['AppId']) && $setting['AppId'] != '' ? $setting['AppId'] : '';
        $content = '';
        $check_page = is_single();
        if (!$check_page) {
            $content .= "<script data-cfasync='false'>
                                var VUUKLE_CONFIG = {
                                    apiKey: '" . $api_key . "',
                                    articleId: '1',
                                    comments: {enabled: false},
                                    emotes: {'enabled': false},
                                    powerbar: {'enabled': false},
                                    ads:{noDefaults: true}
                                };
                                (function() {
                                    var d = document,
                                    s = d.createElement('script');
                                    s.async = true;
                                    s.src = 'https://cdn.vuukle.com/platform.js';
                                    s.setAttribute('data-cfasync', 'false');
                                    (d.head || d.body).appendChild(s);})
                                    ();
                            </script>";
        }

        echo $content;
    }
}
