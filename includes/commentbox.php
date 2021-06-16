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
$check_amp = false;
$v_app_key = '';
if (isset($vuukle->settings)) {
    $vuukle->settings['emote_position'] = 1;
    $check_amp = isset($vuukle->settings['embed_emotes_amp']) && $vuukle->settings['embed_emotes_amp'] == 'on' ? true : false;
    $v_app_key = isset($vuukle->settings['AppId']) && $vuukle->settings['AppId'] != '' ? $vuukle->settings['AppId'] : '';
}
?>
<div id="sharing"></div>
<?php if (isset($vuukle->settings['emote_position']) && '2' === $vuukle->settings['emote_position']) : ?>
    <div id="vuukle-emote" class="emotesBoxDiv"></div>
<?php endif ?>

<div id="respond"></div>
<div id="vuukle-comments" class="commentBoxDiv"></div>

<?php
global $post;
if (function_exists('amp_is_request')) {
    if (amp_is_request()) {
        if ($check_amp) {
            $src_url = "https://cdn.vuukle.com/amp.html?";
            $post_image = "";
            if (has_post_thumbnail($post->ID)) {
                $thumb_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                $post_image = isset($thumb_image[0]) ? $thumb_image[0] : '';
            }
            $post_tags_array = get_the_tags();
            $post_tags = array();
            if ($post_tags_array) {
                foreach ($post_tags_array as $taged) {
                    $post_tags[] = $taged->name;
                }
                $post_tags = implode(',', $post_tags);
            } else {
                $post_tags = '';
            }
            $src_url_query = array(
                "url"    => wp_get_canonical_url($post->ID),
                "host"   => "prowrestling.com",
                "id"     => $post->ID,
                "apiKey" => $v_app_key,
                "img"    => $post_image,
                "title"  => urlencode($post->post_title),
                "tags"   => urlencode($post_tags),
            );
            $src_url_query = http_build_query($src_url_query);
            $src_url .= $src_url_query;

            echo '<amp-iframe width="740" 
                        height="350" 
                        style="clear:both"
                        layout="responsive" 
                        sandbox="allow-scripts allow-same-origin allow-modals allow-popups allow-forms allow-top-navigation" 
                        resizable frameborder="0" 
                        src=' . $src_url . '>
                        <div overflow tabindex="0" role="button" aria-label="Show comments" style="display: block;text-align: center;background: #1f87e5;color: #fff;border-radius: 4px;">Show comments</div>
                    </amp-iframe>';
        }
    }
} elseif (function_exists('is_amp_endpoint')) {
    if (is_amp_endpoint()) {
        if ($check_amp) {
            $src_url = "https://cdn.vuukle.com/amp.html?";
            $post_image = "";
            if (has_post_thumbnail($post->ID)) {
                $thumb_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
                $post_image = isset($thumb_image[0]) ? $thumb_image[0] : '';
            }
            $post_tags_array = get_the_tags();
            $post_tags = array();
            if ($post_tags_array) {
                foreach ($post_tags_array as $taged) {
                    $post_tags[] = $taged->name;
                }
                $post_tags = implode(',', $post_tags);
            } else {
                $post_tags = '';
            }
            $src_url_query = array(
                "url"    => wp_get_canonical_url($post->ID),
                "host"   => "prowrestling.com",
                "id"     => $post->ID,
                "apiKey" => $v_app_key,
                "img"    => $post_image,
                "title"  => urlencode($post->post_title),
                "tags"   => urlencode($post_tags),
            );
            $src_url_query = http_build_query($src_url_query);
            $src_url .= $src_url_query;

            echo '<amp-iframe width="740" 
                        height="350" 
                        style="clear:both"
                        layout="responsive" 
                        sandbox="allow-scripts allow-same-origin allow-modals allow-popups allow-forms allow-top-navigation" 
                        resizable frameborder="0" 
                        src=' . $src_url . '>
                        <div overflow tabindex="0" role="button" aria-label="Show comments" style="display: block;text-align: center;background: #1f87e5;color: #fff;border-radius: 4px;">Show comments</div>
                    </amp-iframe>';
        }
    }
}
?>



<?php if (!empty($vuukle->settings['div_id']) && '4' === $vuukle->settings['embed_comments']) : ?>
    <script data-cfasync="false">
var str = document.getElementById("<?php echo esc_attr($vuukle->settings['div_id']); ?>");
        if (str === null) {
            console.warn("Vuukle comments post request was not completed because the divClassID for Vuukle Widgets is invalid. Please check your configuration.");
        } else {
        document.addEventListener("DOMContentLoaded", function(event) {
            var commentBoxDiv = document.getElementById("vuukle-comments");
            var commentBoxDivAfter = document.getElementById("<?php echo esc_attr($vuukle->settings['div_id']); ?>");
            var cloneCommentBoxDiv = commentBoxDiv.cloneNode(true);
            commentBoxDiv.parentNode.removeChild(commentBoxDiv);
            commentBoxDivAfter.parentNode.insertBefore(cloneCommentBoxDiv, commentBoxDivAfter.nextSibling);
        });
		}
    </script>
    <style>
        #vuukle-comments {
            position: relative !important;
        }
    </style>
<?php endif; ?>

<?php if (!empty($vuukle->settings['div_class']) && '3' === $vuukle->settings['embed_comments']) : ?>
    <script data-cfasync="false">
var str = document.getElementsByClassName("<?php echo esc_attr($vuukle->settings['div_class']); ?>");
        if (str === null) {
            console.warn("Vuukle comments post request was not completed because the divClass for Vuukle Widgets is invalid. Please check your configuration.");
        } else {
        document.addEventListener("DOMContentLoaded", function(event) {
            var commentBoxDiv2 = document.getElementById("vuukle-comments");
            var commentBoxDivAfter2 = document.getElementsByClassName("<?php echo esc_attr($vuukle->settings['div_class']); ?>")[0];
            var cloneCommentBoxDiv2 = commentBoxDiv2.cloneNode(true);
            commentBoxDiv2.parentNode.removeChild(commentBoxDiv2);
            commentBoxDivAfter2.parentNode.insertBefore(cloneCommentBoxDiv2, commentBoxDivAfter2.nextSibling);
        });
		}
    </script>
    <style>
        #vuukle-comments {
            position: relative !important;
        }
    </style>
<?php endif; ?>


<?php if (!empty($vuukle->settings['div_id_emotes']) && '2' === $vuukle->settings['embed_emotes']) : ?>
    <script data-cfasync="false">
 var str = document.getElementById("<?php echo esc_attr($vuukle->settings['div_id_emotes']); ?>");
        if (str === null) {
            console.warn("Vuukle emotes post request was not completed because the divClassID for Vuukle Widgets is invalid. Please check your configuration.");
        } else {
        document.addEventListener("DOMContentLoaded", function(event) {
            var emoteBoxDiv = document.getElementById("vuukle-emote");
            var emoteBoxDivAfter = document.getElementById("<?php echo esc_attr($vuukle->settings['div_id_emotes']); ?>");
            var cloneEmoteBoxDiv = emoteBoxDiv.cloneNode(true);
            emoteBoxDiv.parentNode.removeChild(emoteBoxDiv);
            emoteBoxDivAfter.parentNode.insertBefore(cloneEmoteBoxDiv, emoteBoxDivAfter.nextSibling);
        });
		}
    </script>
    <style>
        #vuukle-emote {
            position: relative !important;
        }
    </style>
<?php endif; ?>


<?php if (!empty($vuukle->settings['div_class_emotes']) && '1' === $vuukle->settings['embed_emotes']) : ?>
    <script data-cfasync="false">
 var str = document.getElementsByClassName("<?php echo esc_attr($vuukle->settings['div_class_emotes']); ?>");
        if (str === null) {
            console.warn("Vuukle emotes post request was not completed because the divClass for Vuukle Widgets is invalid. Please check your configuration.");
        } else {
        document.addEventListener("DOMContentLoaded", function(event) {
            var emoteBoxDiv2 = document.getElementById("vuukle-emote");
            var emoteBoxDivAfter2 = document.getElementsByClassName("<?php echo esc_attr($vuukle->settings['div_class_emotes']); ?>")[0];
            var cloneEmoteBoxDiv2 = emoteBoxDiv2.cloneNode(true);
            emoteBoxDiv2.parentNode.removeChild(emoteBoxDiv2);
            emoteBoxDivAfter2.parentNode.insertBefore(cloneEmoteBoxDiv2, emoteBoxDivAfter2.nextSibling);
        });
		}
    </script>
    <style>
        #vuukle-emote {
            position: relative !important;
        }
    </style>
<?php endif; ?>

<?php if (!empty($vuukle->settings['div_id_newsfeed']) && '2' === $vuukle->settings['embed_newsfeed']) : ?>
    <script data-cfasync="false">
 var str = document.getElementById("<?php echo esc_attr($vuukle->settings['div_id_newsfeed']); ?>");
        if (str === null) {
            console.warn("Vuukle newsfeed post request was not completed because the divClassID for Vuukle Widgets is invalid. Please check your configuration.");
        } else {
        document.addEventListener("DOMContentLoaded", function(event) {
            var newsfeedBoxDiv = document.getElementById("vuukle-newsfeed");
            var newsfeedBoxDivAfter = document.getElementById("<?php echo esc_attr($vuukle->settings['div_id_newsfeed']); ?>");
            var cloneNewsfeedBoxDiv = newsfeedBoxDiv.cloneNode(true);
            newsfeedBoxDiv.parentNode.removeChild(newsfeedBoxDiv);
            newsfeedBoxDivAfter.parentNode.insertBefore(cloneNewsfeedBoxDiv, newsfeedBoxDivAfter.nextSibling);
        });
		}
    </script>
    <style>
        #vuukle-newsfeed {
            position: relative !important;
        }
    </style>
<?php endif; ?>

<?php if (!empty($vuukle->settings['div_class_newsfeed']) && '1' === $vuukle->settings['embed_newsfeed']) : ?>
    <script data-cfasync="false">
  var str = document.getElementsByClassName("<?php echo esc_attr($vuukle->settings['div_class_newsfeed']); ?>");
        if (str === null) {
            console.warn("Vuukle newsfeed post request was not completed because the divClass for Vuukle Widgets is invalid. Please check your configuration.");
        } else {
        document.addEventListener("DOMContentLoaded", function(event) {
            var newsfeedBoxDiv2 = document.getElementById("vuukle-newsfeed");
            var newsfeedBoxDivAfter_for2 = document.getElementsByClassName("<?php echo esc_attr($vuukle->settings['div_class_newsfeed']); ?>")[0];
            var cloneNewsfeedBoxDiv2 = newsfeedBoxDiv2.cloneNode(true);
            newsfeedBoxDiv2.parentNode.removeChild(newsfeedBoxDiv2);
            newsfeedBoxDivAfter_for2.parentNode.insertBefore(cloneNewsfeedBoxDiv2, newsfeedBoxDivAfter_for2.nextSibling);
        });
		}
    </script>

<?php endif; ?>


<?php if (!empty($vuukle->settings['div_id_powerbar']) && '2' === $vuukle->settings['embed_powerbar']) : ?>
    <script data-cfasync="false">
        var str = document.getElementById("<?php echo esc_attr($vuukle->settings['div_id_powerbar']); ?>");
        if (str === null) {
            console.warn("Vuukle widgets post request was not completed because the divClassID for Vuukle Widgets is invalid. Please check your configuration.");
        } else {
            document.addEventListener("DOMContentLoaded", function(event) {
                var powerbarBoxDiv = document.getElementById("vuukle-powerbar");
                var powerbarBoxDivAfter_for = document.getElementById("<?php echo esc_attr($vuukle->settings['div_id_powerbar']); ?>");
                var clonePowerbarBoxDiv = powerbarBoxDiv.cloneNode(true);
                powerbarBoxDiv.parentNode.removeChild(powerbarBoxDiv);
                powerbarBoxDivAfter_for.parentNode.insertBefore(clonePowerbarBoxDiv, powerbarBoxDivAfter_for.nextSibling);

            });
        }
    </script>
<?php endif; ?>

<?php if (!empty($vuukle->settings['div_class_powerbar']) && '1' === $vuukle->settings['embed_powerbar']) : ?>
    <script data-cfasync="false">
        var str = document.getElementsByClassName("<?php echo esc_attr($vuukle->settings['div_class_powerbar']); ?>");
        if (str.length === 0) {
            console.warn("Vuukle widgets post request was not completed because the divClass for Vuukle Widgets is invalid. Please check your configuration.");
        } else {
            document.addEventListener("DOMContentLoaded", function(event) {
                var powerbarBoxDiv2 = document.getElementById("vuukle-powerbar");
                var powerbarBoxDivAfter_for2 = document.getElementsByClassName("<?php echo esc_attr($vuukle->settings['div_class_powerbar']); ?>")[0];
                var clonePowerbarBoxDiv2 = powerbarBoxDiv2.cloneNode(true);
                powerbarBoxDiv2.parentNode.removeChild(powerbarBoxDiv2);
                powerbarBoxDivAfter_for2.parentNode.insertBefore(clonePowerbarBoxDiv2, powerbarBoxDivAfter_for2.nextSibling);

            });
        }
    </script>
<?php endif; ?>