<?php

namespace Health\Care;

/**
 * Class Assets
 *
 * @package Health\Care
 */
class Assets
{

    /**
     * Assets constructor.
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'front_end_enqueue'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));
    }

    /**
     * Front css js enqueue
     */
    public function front_end_enqueue()
    {
        wp_enqueue_style('hlc-frontend', HLC_PLUGIN_URL . 'assets/css/front-end.css', false, HLC_VERSION);
        wp_enqueue_script('hlc-frontend', HLC_PLUGIN_URL . 'assets/js/frontend.js', array('jquery'), HLC_VERSION, true);

        wp_localize_script('hlc-frontend', 'data', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));

    }

    /**
     * Admin css js enqueue
     */
    public function admin_enqueue()
    {
        wp_enqueue_style('hlc-backend', HLC_PLUGIN_URL . 'assets/css/backend.css', null, HLC_VERSION);
        wp_enqueue_script('hlc-backend', HLC_PLUGIN_URL . 'assets/js/backend.js', array('jquery'), HLC_VERSION, true);

        wp_localize_script('hlc-backend', 'data', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));

    }

}
