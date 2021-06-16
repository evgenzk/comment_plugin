<?php

/**
 * Fired during plugin activation
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/includes
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 * @since      1.0.0
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/includes
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 * @since      1.0.0
 */
class Free_Comments_For_Wordpress_Vuukle_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public static function activate()
    {

        add_option('Activated_Vuukle_Plugin', '1');
        if (!get_option('Activated_Vuukle_Plugin_Date')) {
            add_option('Activated_Vuukle_Plugin_Date', gmdate('Y-m-d H:i:s'));
        }
    }
}
