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

add_action(
    'admin_menu',
    function () {
        add_options_page('Export comments', 'Export comments', 'manage_options', 'export-comments-xml', 'export_comments_plugin_page');
    }
);


add_action(
    'admin_head',
    function () {
        echo '<style>.wp-submenu a[href*="export-comments-xml"]{display:none!important}</style>';
    }
);

add_action(
    'wp_ajax_export_comments_plugin_page',
    function () {
        if (!isset($_GET['_wpnonce']) && wp_verify_nonce(sanitize_key($_GET['_wpnonce']))) { // Input var okay
            return true;
        }

        $amount_comments = $_GET['amount_comments']; // phpcs:ignore WordPress.VIP
        $offset = $_GET['offset']; // phpcs:ignore WordPress.VIP

        if (!is_dir(plugin_dir_path(__FILE__) . 'files')) {
            wp_mkdir_p(plugin_dir_path(__FILE__) . 'files');
        } else if ($offset == 0) {
            cleanDir(plugin_dir_path(__FILE__) . 'files');
        }



        $limit = $amount_comments;
        $offse2 = $offset * $limit;
        global $wpdb;
        $table    = $wpdb->prefix . 'comments';
        $query    = "SELECT * FROM $table LIMIT $offse2, $limit";
        $comments = $wpdb->get_results($query, OBJECT_K); // phpcs:ignore WordPress

        if (empty($comments)) {
            if ($offset == 0) {
                echo json_encode(array('result' => '-1', 'link' => '', 'message' => 'Comments not found in database.'));
                exit;
            }
            $time   = gmdate('Y-m-d');
            $file_name = get_bloginfo('name') . '-commment-export-' . $time . '.zip';
            $file_path_zip = plugin_dir_path(__FILE__) . 'files/' . $file_name;
            $zip      = new ZipArchive();
            $zip_name = $file_path_zip;
            if (true !== $zip->open($zip_name, ZIPARCHIVE::CREATE)) {
                echo json_encode(array('result' => '-1', 'link' => '', 'message' => 'Sorry ZIP creation failed at this time'));
                exit;
            } else {
                $file_path_zip = plugin_dir_path(__FILE__) . 'files/';
                for ($i = 0; $i < $offset; $i++) {
                    $zip->addFile(plugin_dir_path(__FILE__) . 'files/' . $i . '_comments.xml',  $i . '_comments.xml');
                }
                $zip->close();
            }

            $linkToDownload = plugins_url() . '/free-comments-for-wordpress-vuukle/includes/files/' . $file_name; // WPCS: XSS ok

            echo json_encode(array('result' => '0', 'link' => $linkToDownload));
            exit;
        } else {
            $xml = '<?xml version="1.0" encoding="UTF-8" ?>
            <rss version="2.0"
            xmlns:excerpt="http://wordpress.org/export/1.2/excerpt/"
            xmlns:content="http://purl.org/rss/1.0/modules/content/"
            xmlns:wfw="http://wellformedweb.org/CommentAPI/"
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:wp="http://wordpress.org/export/1.2/">
            <channel>
            <wp:wxr_version>1.2</wp:wxr_version>';
            foreach ($comments as $comment) {
                $author_post_id   = get_post($comment->comment_post_ID);
                $author_post_id   = $author_post_id->post_author;
                $author_post_name = get_author_name($author_post_id);
                $categories       = get_the_category($comment->comment_post_ID);
                $string_caegorty  = '';
                if (!empty($categories)) {
                    foreach ($categories as $category) {
                        $string_caegorty .= '<category domain="post_tag" nicename="' . $category->name . '"><![CDATA[' . $category->name . ']]></category>';
                    }
                }
                $date_comment = gmdate('Y-m-d', strtotime($comment->comment_date)) . 'T' . gmdate('H:i:s', strtotime($comment->comment_date));

                $xml .= '<item>
                    <dc:creator><![CDATA[' . $author_post_name . ']]></dc:creator>
                    <wp:post_type><![CDATA[post]]></wp:post_type>
                    <wp:comment_status><![CDATA[open]]></wp:comment_status>
                    <wp:comment_date><![CDATA[' . $date_comment . ']]></wp:comment_date>
                    ' . $string_caegorty . '
                    <link><![CDATA[' . get_permalink($comment->comment_post_ID) . ']]></link>
                    <title><![CDATA[' . get_the_title($comment->comment_post_ID) . ']]></title>
                    <wp:post_id><![CDATA[' . $comment->comment_post_ID . ']]></wp:post_id>
                    <wp:comment>
                    <wp:comment_date><![CDATA[' . $date_comment . ']]></wp:comment_date>
                    <wp:comment_id><![CDATA[' . $comment->comment_ID . ']]></wp:comment_id>
                    <wp:comment_author><![CDATA[' . $comment->comment_author . ']]></wp:comment_author>
                    <wp:comment_content><![CDATA[' . $comment->comment_content . ']]></wp:comment_content>
                    <wp:comment_approved><![CDATA[' . $comment->comment_approved . ']]></wp:comment_approved>
					<wp:comment_parent><![CDATA[' . $comment->comment_parent . ']]></wp:comment_parent>
                    </wp:comment>
                    </item>';
            }  

            $xml .= '</channel>
            </rss>';


            $file_path_xml = plugin_dir_path(__FILE__) . 'files/' . $offset . '_comments.xml';
            file_put_contents($file_path_xml, $xml); // phpcs:ignore WordPress.VIP.FileSystemWritesDisallow, WordPress.WP.AlternativeFunctions

            $offset++;
            echo json_encode(array('result' => $offset));
        }

        exit;
    }
);

/*add_action( 'wp_ajax_export_comments_plugin_page', array($this,'export_comments_plugin_page') );
add_action( 'wp_ajax_nopriv_export_comments_plugin_page',  array($this,'export_comments_plugin_page') );*/

if (!function_exists("cleanDir")) {
    /**
     * This function is cleanid dir
     *
     * @param string $dir parametr
     *
     * @since  1.0.0
     * @return void
     */
    function cleanDir($dir)
    {
        $files = glob($dir . '/*');
        if (count($files) > 0) {
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file); // phpcs:ignore WordPress.VIP.FileSystemWritesDisallow, WordPress.WP.AlternativeFunctions
                }
            }
        }
    }
}
