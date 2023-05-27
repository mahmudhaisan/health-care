<?php
/**
 * Plugin Name:       Health Care
 * Plugin URI:        https://github.com/mahmudhaisan
 * Description:       Health Care
 * Version:           1.0.0
 * Author:            JoyDevs
 * Author URI:        https://github.com/mahmudhaisan
 * License:           GPL v2 or later
 * Text Domain:       health-care
 * Domain Path:       /languages/
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

if (!class_exists('Hlc_Health_Care')) {

    /**
     * The main plugin class
     */
    final class Hlc_Health_Care
    {

        /**
         * Hlc_Health_Care constructor.
         */
        private function __construct()
        {
            $this->define_constants();

            register_activation_hook(__FILE__, array($this, 'activate'));
            add_action('plugins_loaded', array($this, 'init_plugin'));
            add_action('plugins_loaded', array($this, 'plugins_loaded_text_domain'));
            add_action('register_plugin_activation', array($this, 'activate'));
        }

        /**
         * Initializes a single instance
         */
        public static function init()
        {
            static $instance = false;

            if (!$instance) {
                $instance = new self();
            }

            return $instance;
        }

        /**
         * Plugin text domain loaded
         */
        public function plugins_loaded_text_domain()
        {
            load_plugin_textdomain('health-care', false, HLC_PLUGIN_PATH . 'languages/');
        }

        /**
         * Define plugin path and url constants
         */
        public function define_constants()
        {
            define('HLC_PLUGIN_PATH', plugin_dir_path(__FILE__));
            define('HLC_PLUGIN_URL', plugin_dir_url(__FILE__));
            define('HLC_PLUGIN_URL_CUSTOM_UPLOAD', plugin_dir_url(__FILE__) . '/uploads/');
            define('HLC_VERSION', '1.0.0');
        }

        /**
         *  Init plugin
         */
        public function init_plugin()
        {
            if (is_admin()) {
                new Health\Care\Admin();
            } else {
                new Health\Care\Frontend();
            }

            new Health\Care\Assets();
            new Health\Care\Ajax();
        }

        /***
         * Do Stuff Plugin activation
         */
        public function activate()
        {
            add_role(
                'nurse',
                __('nurse', 'testdomain'),
                array(
                    'read' => true, // true allows this capability
                    // 'edit_posts' => true,
                )
            );

        }
    }

}

/**
 * Initializes the main plugin
 *
 * @return \Hlc_Health_Care
 */
function hlc_health_care()
{
    return Hlc_Health_Care::init();
}

/**
 * Rick off the plugin
 */
hlc_health_care();
