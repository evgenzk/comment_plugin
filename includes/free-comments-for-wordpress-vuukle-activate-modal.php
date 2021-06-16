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
?>
<div class="modal-vuukle" id="modal-activate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-header" style="border:none!important">
            <a href="#" class="btn-close" id="btn-close-desable" aria-hidden="true">×</a>
        </div>
        <div class="modal-body">
            <center><img src="<?php echo VUUKLE_ADMIN_URL ?>/images/logo.png" style="width: 100px;"></center>
            <p><strong>Vuukle is installed on your site and your admin email used is <a href="mailto:<?php echo esc_attr(get_option('admin_email')); ?>"><?php echo esc_attr(get_option('admin_email')); ?></a></strong></p>
            <p><strong>To see Vuukle Live instantly on your website please delete any plugin cache or super cache etc.</strong></p>
            <p><strong>For any questions please email us on <a href="mailto:support@vuukle.com">support@vuukle.com</a></strong></p>
            <h2>Please select the widgets</h2>
            <form id="vuukle-enable-function" action="<?php echo esc_attr(admin_url('admin-post.php')); ?>" method="POST">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input form-check-input-vuukle checkbox1" type="checkbox" name="share" checked="checked" value="1">
                        Powerbar (sharing tool)
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input form-check-input-vuukle checkbox2" type="checkbox" name="emote" checked="checked" value="1">
                        Emote widget
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input form-check-input-vuukle checkbox3" type="checkbox" name="enabled_comments" checked="checked" value="1">
                        Commenting widget
                    </label>
                </div>
                <input type="hidden" name="action" id="action-field" value="vuukleEnableFunction">
                <?php wp_nonce_field(); ?>
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="button button-primary" id="vuukle-activate-button">Activate</button>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.location = '#modal-activate';
        document.querySelector('#vuukle-activate-button').addEventListener("click", function(event) {
            document.querySelector('#vuukle-enable-function').submit();
        });

        document.querySelector('.form-check-input-vuukle').addEventListener('change', function() {
            document.querySelector('#vuukle-activate-button').removeAttribute('disabled');
            if (!document.querySelector('.checkbox1').checked && !document.querySelector('.checkbox2').checked && !document.querySelector('.checkbox3').checked) {
                document.querySelector('#vuukle-activate-button').attrgetAttribute('disabled', true);
            }
            if(document.querySelector('#export_button3')){
            if (document.querySelector('.checkbox3').checked) {
                document.querySelector('#export_button3').style.visibility = "visible";
            } else {
                document.querySelector('#export_button3').style.visibility = "hidden";
            }}
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector('#export_button3')?.addEventListener("click", function(event) {
            function loadXMLDoc() {
                var cache = false;
                var url = "/wp-admin/admin-ajax.php";
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET", url, cache);
                xmlhttp.send({
                    "action": "export_comments_plugin_page",
                    "export_xml": 2,
                    "_wpnonce": "<?php echo esc_attr(wp_create_nonce('export_xml2')); ?>"
                });
                if (xmlhttp.readyState == XMLHttpRequest.DONE) { // XMLHttpRequest.DONE == 4
                    if (xmlhttp.status == 200) {
                        var result = JSON.parse(xmlhttp.response);
                    }
                }
            }
        });
    });
</script>