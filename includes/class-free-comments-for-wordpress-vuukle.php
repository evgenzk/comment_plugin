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

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @category   PHP
 * @package    Free_Comments_For_Wordpress_Vuukle
 * @subpackage Free_Comments_For_Wordpress_Vuukle/includes
 * @author     Vuukle <info@vuukle.com>
 * @license    http://www.gnu.org/licenses/gpl-2.0.txt GPL-2.0+
 * @link       https://vuukle.com
 * @since      1.0.0
 */
class Free_Comments_For_Wordpress_Vuukle
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    Free_Comments_For_Wordpress_Vuukle_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since  1.0.0
     * @access protected
     * @var    string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if (defined('FREE_COMMENTS_FOR_WORDPRESS_VUUKLE_VERSION')) {
            $this->version = FREE_COMMENTS_FOR_WORDPRESS_VUUKLE_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'free-comments-for-wordpress-vuukle';

        $this->_loadDependencies();
        $this->_setLocale();
        $this->_defineAdminHooks();
        $this->_definePublicHooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Free_Comments_For_Wordpress_Vuukle_Loader. Orchestrates the hooks of the plugin.
     * - Free_Comments_For_Wordpress_Vuukle_i18n. Defines internationalization functionality.
     * - Free_Comments_For_Wordpress_Vuukle_Admin. Defines all hooks for the admin area.
     * - Free_Comments_For_Wordpress_Vuukle_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     *
     * @return void
     */
    private function _loadDependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-free-comments-for-wordpress-vuukle-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-free-comments-for-wordpress-vuukle-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-free-comments-for-wordpress-vuukle-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        include_once plugin_dir_path(dirname(__FILE__)) . 'public/class-free-comments-for-wordpress-vuukle-public.php';

        $this->loader = new Free_Comments_For_Wordpress_Vuukle_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Free_Comments_For_Wordpress_Vuukle_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since  1.0.0
     * @access private
     *
     * @return void
     */
    private function _setLocale()
    {

        $plugin_i18n = new Free_Comments_For_Wordpress_Vuukle_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     *
     * @return void
     */
    private function _defineAdminHooks()
    {

        $plugin_admin = new Free_Comments_For_Wordpress_Vuukle_Admin($this->getPluginName(), $this->getVersion());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueueStyles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueueScripts');
        $this->loader->add_action('admin_menu', $plugin_admin, 'adminMenu');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'myColorPicker');
        $this->loader->add_action('admin_post_vuukleEnableFunction', $plugin_admin, 'vuukleEnableFunction');
        $this->loader->add_action('admin_post_vuukleDeactivateFunction', $plugin_admin, 'vuukleDeactivateFunction');
        $this->loader->add_action('admin_post_vuukleDisablePlugin', $plugin_admin, 'vuukleDisablePlugin');
        $this->loader->add_action('admin_footer', $plugin_admin, 'activationModal');
        $this->loader->add_action('admin_footer', $plugin_admin, 'deactivationModal');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'settingsJs');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_admin, 'jkLoadDashicons');
        $this->loader->add_action('wp_ajax_hideVuukleAdminNotice', $plugin_admin, 'hideVuukleAdminNotice');
        $this->loader->add_action('wp_ajax_nopriv_hideVuukleAdminNotice', $plugin_admin, 'hideVuukleAdminNotice');
        $this->loader->add_action('wp_ajax_quickRegister', $plugin_admin, 'quickRegister');
        $this->loader->add_action('wp_ajax_nopriv_quickRegister', $plugin_admin, 'quickRegister');
        $this->loader->add_filter('script_loader_src', $plugin_admin, 'vuukleRemoveVerCssJs', 9999);
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since  1.0.0
     * @access private
     *
     * @return void
     */
    private function _definePublicHooks()
    {

        $plugin_public = new Free_Comments_For_Wordpress_Vuukle_Public($this->getPluginName(), $this->getVersion());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueueStyles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueueScripts');
        $this->loader->add_action('wp_ajax_saveCommentToDb', $plugin_public, 'saveCommentToDb');
        $this->loader->add_action('wp_ajax_nopriv_saveCommentToDb', $plugin_public, 'saveCommentToDb');
        $this->loader->add_action('init', $plugin_public, 'generateShortcode');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'frontScripts');
        $this->loader->add_action('widgets_init', $plugin_public, 'registerRecentCommentsWidget');
        $this->loader->add_action('wp_head', $plugin_public, 'addDns');
        $this->loader->add_filter('script_loader_tag', $plugin_public, 'defer_parsing_of_js', 10);
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since  1.0.0
     * @return string    The name of the plugin.
     */
    public function getPluginName()
    {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since  1.0.0
     * @return Free_Comments_For_Wordpress_Vuukle_Loader    Orchestrates the hooks of the plugin.
     */
    public function getLoader()
    {
        return $this->loader;
    }
    /**
     * Retrieve the version number of the plugin.
     *
     * @since  1.0.0
     * @return string    The version number of the plugin.
     */
    public function getVersion()
    {
        return $this->version;
    }
}
