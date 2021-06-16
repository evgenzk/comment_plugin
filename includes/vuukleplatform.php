<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/includes
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 * @since      1.0.0
 */

global $post;
$custom_text_default = $vuukle->settings_defaults['text'];
$custom_text         = $vuukle->settings['text'];
$custom_text         = ($custom_text_default === $custom_text) ? '' : wp_json_encode($custom_text);

$author_info = array(
    'name'      => get_the_author_meta('display_name', $post->post_author),
    'username'  => get_the_author_meta('user_login', $post->post_author),
    'email'     => get_the_author_meta('user_email', $post->post_author),
);
$author_info = wp_json_encode($author_info);



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


$author_info = json_decode($author_info);

$protocol = get_option('Vuukle');
if (!isset($protocol['recomendations_protocol'])) {
    $protocol = $this->settings['recomendations_protocol'];
} else {
    $protocol = $protocol['recomendations_protocol'];
}

$sso = $vuukle->settings['sso'];

$enabled_comments = $vuukle->settings['enabled_comments'];

$emotes_enabled = $vuukle->settings['emote'];

$size = $vuukle->settings['size_emote'];

$first_img = $vuukle->settings['happy_url'];

$first_name = $vuukle->settings['happy_text'];

$second_img = $vuukle->settings['indifferent_url'];

$second_name = $vuukle->settings['indifferent_text'];

$third_img = $vuukle->settings['amused_url'];

$third_name = $vuukle->settings['amused_text'];

$fourth_img = $vuukle->settings['excited_url'];

$fourth_name = $vuukle->settings['excited_text'];

$fifth_img = $vuukle->settings['angry_url'];

$fifth_name = $vuukle->settings['angry_text'];

$sixth_img = $vuukle->settings['sad_url'];

$sixth_name = $vuukle->settings['sad_text'];

if ($vuukle->settings['share']) {
    $powerbar_enable = 'true';
} else {
    $powerbar_enable = 'false';
}


$endless_mode        = $vuukle->settings['endless_mode'];
$twitter_handle      = $vuukle->settings['twitter_handle'];
$post_post_url       = $post_url;
$post_title          = get_the_title($post->ID);
$post_title_name     = $post_title;
$post_title_name     = str_replace("&#8217;", "'", $post_title_name);
$post_title_name     = str_replace("&#8216;", "'", $post_title_name);
$post_title_name     = str_replace('&"', "\"", $post_title_name);
$post_title_name     = str_replace("&#8220;", "\"", $post_title_name);
$post_title_name     = str_replace("#038;", "&", $post_title_name);
$post_title_name     = str_replace("#8221;", "\" ", $post_title_name);
$post_title_name     = str_replace("&&", "&", $post_title_name);
$post_title_name     = str_replace("@@", "@", $post_title_name);
$twitter_handle_name = $twitter_handle;
$twitter_handle_name = str_replace("@", "", $twitter_handle_name);
$post_url            = home_url();





if (isset(get_option('Vuukle')['items_powerbar'])) {
    $items_powerbar = get_option('Vuukle')['items_powerbar'];
} else {
    $items_powerbar = $this->settings['items_powerbar'];
}
//$items_powerbar = get_option( 'Vuukle' )['items_powerbar'];

$emote_enabled1 = $vuukle->settings['emote_enabled1'];
$emote_enabled2 = $vuukle->settings['emote_enabled2'];
$emote_enabled3 = $vuukle->settings['emote_enabled3'];
$emote_enabled4 = $vuukle->settings['emote_enabled4'];
$emote_enabled5 = $vuukle->settings['emote_enabled5'];
$emote_enabled6 = $vuukle->settings['emote_enabled6'];

$emote_enabled = array(
    $emote_enabled1,
    $emote_enabled2,
    $emote_enabled3,
    $emote_enabled4,
    $emote_enabled5,
    $emote_enabled6,
);

$emote_disabled = array(
    1 => 1,
    2 => 2,
    3 => 3,
    4 => 4,
    5 => 5,
    6 => 6
);

if (!empty($emote_enabled)) {
    foreach ($emote_enabled as $k => $v) {
        unset($emote_disabled[$v]);
    }
}


$lang = $vuukle->settings['lang'];
if ($lang) {
    $translated_strings = file_get_contents(VUUKLE_BASE_PATH . 'languages/' . $lang . '.json');
    $translated         = json_decode($translated_strings);
    $powerbar_translite = json_encode($translated->powerbar->customText, JSON_UNESCAPED_UNICODE);
    $emotes_translite   = json_encode($translated->emotes->customText, JSON_UNESCAPED_UNICODE);
    $comments_translite = json_encode($translated->comments->customText, JSON_UNESCAPED_UNICODE);
} else {
    $powerbar_translite = '';
    $emotes_translite   = '';
    $comments_translite = '';
} ?>

<script data-cfasync="false">
    var VUUKLE_CONFIG = {
        apiKey: "<?php echo esc_html($vuukle->settings['AppId']); ?>",
        articleId: "<?php echo esc_html($post->ID); ?>",
        title: <?php echo "'" . esc_html($post_title) . "'"; ?>,
        tags: "<?php echo  esc_html(str_replace(['"', "'"], '', quotemeta(stripslashes($tags)))); ?>",
        author: "<?php echo esc_html(str_replace(['"', "'"], '', quotemeta(stripslashes($author_info->name)))); ?>",
        <?php if ('1' === $endless_mode) : ?>
            endlessMode: true,
        <?php endif; ?>

        <?php if ('1' === $vuukle->settings['save_comments']) : ?>wordpressSync: true,
        eventHandler: function(e) {
            console.log(e);
            if (e.eventType == 'wpSync') {
                function loadXMLDoc() {
                    var xmlhttp = new XMLHttpRequest();
                    var url = "/wp-admin/admin-ajax.php";
                    var cache = false;
                    var formData = new FormData();
                    formData.append("action", "saveCommentToDb");
                    formData.append("comment_ID", e.comment_ID);
                    formData.append("comment_post_ID", e.comment_post_ID);
                    formData.append("comment_author", e.comment_author);
                    formData.append("comment_author_email", e.email);
                    formData.append("comment_author_url", e.comment_author_url);
                    formData.append("comment_content", e.comment_content);
                    formData.append("comment_type", e.comment_type);
                    formData.append("comment_parent_ID", e.comment_parent);
                    formData.append("user_id", e.user);
                    formData.append("comment_author_IP", e.comment_author_IP);
                    formData.append("comment_agent", e.comment_agent);
                    formData.append("comment_agent", e.comment_approved);
                    formData.append("comment_date", e.comment_date);
                    formData.append("comment_date_gmt", e.comment_date_gmt);
                    formData.append("comment_karma", e.comment_karma);
                    formData.append("_wpnonce", "<?php echo esc_attr(wp_create_nonce()); ?>");
                    xmlhttp.open("POST", url, cache);
                    xmlhttp.send(formData);
                }
                loadXMLDoc();
            }
        },
    <?php endif; ?>
    <?php if ('none' !== $protocol) : ?>
        recommendationsProtocol: "<?php echo esc_attr($protocol); ?>",
    <?php endif; ?>
    <?php if ($comments_translite) : ?>
        	 comments: {          
                customText: <?php echo esc_html($comments_translite); ?>,      
        }, <?php endif; ?>
        <?php if ($emotes_enabled === 'false' ||
                 $size != $vuukle->settings_defaults['size_emote'] || 
                 $first_img != $vuukle->settings_defaults['happy_url'] ||
                 $first_name != $vuukle->settings_defaults['happy_text'] ||
                 $second_img != $vuukle->settings_defaults['indifferent_url'] ||
                 $second_name != $vuukle->settings_defaults['indifferent_text'] ||
                 $third_img != $vuukle->settings_defaults['amused_url'] ||
                 $third_name != $vuukle->settings_defaults['amused_text'] ||
                 $fourth_img != $vuukle->settings_defaults['excited_url'] ||
                 $fourth_name != $vuukle->settings_defaults['excited_text'] ||
                 $fifth_img != $vuukle->settings_defaults['angry_url'] ||
                 $fifth_name != $vuukle->settings_defaults['angry_text'] ||
                 $sixth_img != $vuukle->settings_defaults['sad_url'] ||
                 $sixth_name != $vuukle->settings_defaults['sad_text'] ||
                 ($emote_enabled1 !== '1' || $emote_enabled2 !== '2' || $emote_enabled3 !== '3' || $emote_enabled4 !== '4' || $emote_enabled5 !== '5') ||
                 $emotes_translite 

         ) : ?>
     emotes: {
            <?php if ($emotes_enabled === 'false') : ?>
            enabled: <?php echo esc_attr($emotes_enabled); ?>,
<?php endif; ?>
<?php if ($size != $vuukle->settings_defaults['size_emote']) : ?>
            size: '<?php echo esc_attr($size); ?>', // icons size
<?php endif; ?>
<?php if ($first_img != $vuukle->settings_defaults['happy_url']) : ?>
    firstImg: '<?php echo esc_attr($first_img); ?>',
<?php endif; ?>
<?php if ($first_name != $vuukle->settings_defaults['happy_text']) : ?>
    firstName: '<?php echo esc_attr($first_name); ?>',
<?php endif; ?>
<?php if ($second_img != $vuukle->settings_defaults['indifferent_url']) : ?>
    secondImg: '<?php echo esc_attr($second_img); ?>',
<?php endif; ?>
<?php if ($second_name != $vuukle->settings_defaults['indifferent_text']) : ?>
    secondName: '<?php echo esc_attr($second_name); ?>',
<?php endif; ?>
<?php if ($third_img != $vuukle->settings_defaults['amused_url']) : ?>
    thirdImg: '<?php echo esc_attr($third_img); ?>',
<?php endif; ?>
<?php if ($third_name != $vuukle->settings_defaults['amused_text']) : ?>
    thirdName: '<?php echo esc_attr($third_name); ?>',
<?php endif; ?>
<?php if ($fourth_img != $vuukle->settings_defaults['excited_url']) : ?>
    fourthImg: '<?php echo esc_attr($fourth_img); ?>',
<?php endif; ?>
<?php if ($fourth_name != $vuukle->settings_defaults['excited_text']) : ?>
    fourthName: '<?php echo esc_attr($fourth_name); ?>',
<?php endif; ?>
<?php if ($fifth_img != $vuukle->settings_defaults['angry_url']) : ?>
    fifthImg: '<?php echo esc_attr($fifth_img); ?>',
<?php endif; ?>
<?php if ($fifth_name != $vuukle->settings_defaults['angry_text']) : ?>
    fifthName: '<?php echo esc_attr($fifth_name); ?>',
<?php endif; ?>
<?php if ($sixth_img != $vuukle->settings_defaults['sad_url']) : ?>
    sixthImg: '<?php echo esc_attr($sixth_img); ?>',
<?php endif; ?>
<?php if ($sixth_name != $vuukle->settings_defaults['sad_text']) : ?>
    sixthName: '<?php echo esc_attr($sixth_name); ?>',
<?php endif; ?>
<?php if ($emote_enabled1 !== '1' || $emote_enabled2 !== '2' || $emote_enabled3 !== '3' || $emote_enabled4 !== '4' ||          $emote_enabled5 !== '5')  : ?>  																								disable: [<?php echo esc_attr(implode(',', $emote_disabled)); ?>],
<?php endif; ?>
<?php if ($emotes_translite) : ?>
    customText: <?php echo esc_html($emotes_translite); ?>,
                                            <?php endif; ?>  
                }, <?php endif; ?>
             powerbar: {
          <?php if ($powerbar_enable != true) : ?>
              enabled: <?php echo esc_attr($powerbar_enable); ?>,
          <?php endif; ?>
          defaultEmote: 1,
          <?php if (!empty($items_powerbar)) { ?>
              items: [
                  <?php foreach ($items_powerbar as $item) : ?> '<?php echo esc_attr($item); ?>',
                  <?php endforeach; ?>
              ],
          <?php } else { ?>
              items: ['facebook'],
          <?php }; ?>
          <?php if ($twitter_handle) :  ?>
              customUrls: {
                  twitter: `http://twitter.com/share?text=<?php echo urlencode($post_title_name); ?>&url=<?php echo esc_attr($post_post_url); ?>&via=<?php echo esc_attr($twitter_handle_name); ?>`,
              },
          <?php endif; ?>
          <?php if ($powerbar_translite) : ?>
              customText: <?php echo esc_html($powerbar_translite); ?>,
         								 <?php endif; ?>
    },
            };
    (function() {
        var d = document,
            s = d.createElement('script');
        s.async = true;
        s.src = 'https://cdn.vuukle.com/platform.js';
        s.setAttribute('data-cfasync', 'false');
        (d.head || d.body).appendChild(s);
    })();
</script>