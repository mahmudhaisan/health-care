<?php

namespace Health\Care\Frontend;

/**
 * Class Myaccount
 *
 */
class Myaccount
{

    /**
     * Frontend constructor.
     */
    public function __construct()
    {

        if (is_user_logged_in()) {

            $user = wp_get_current_user();
            $user_role = $user->roles[0];

            // print_r($user_role);

            add_filter('user_registration_account_menu_items', array($this, 'ur_custom_menu_items'), 10, 1);
            add_action('init', array($this, 'user_registration_add_new_my_account_endpoint'));
            add_action('user_registration_account_health-care-orders_endpoint', array($this, 'user_registration_orders_endpoint_content'));
            add_action('user_registration_account_create-new-order_endpoint', array($this, 'user_registration_create_new_order_endpoint_content'));
            add_action('wp_loaded', [$this, 'my_custom_flush_rewrite_rules']);
        }
    }

    /**
     * Add custom menu links
     *
     * @param [type] $items
     * @return void
     */
    public function ur_custom_menu_items($items)
    {

        $items = array_slice($items, 0, 1, true)
         + array('health-care-orders' => 'Orders')
         + array_slice($items, 1, null, true);

        $items = array_slice($items, 0, 1, true)
         + array('create-new-order' => 'Create New Order')
         + array_slice($items, 1, null, true);

        return $items;
    }

    /**
     * Myaccount add new my account endpoint
     *
     * @return void
     */
    public function user_registration_add_new_my_account_endpoint()
    {
        add_rewrite_endpoint('health-care-orders', EP_PAGES);
        add_rewrite_endpoint('create-new-order', EP_PAGES);

    }

    /**
     * User registration orders endpont content
     *
     * @return void
     */
    public function user_registration_orders_endpoint_content()
    {

        $user_id = get_current_user_id();
        $order_meta_key = 'patients-order';

        $users_order_list = get_user_meta($user_id, $order_meta_key);

        require HLC_PLUGIN_PATH . '/includes/Frontend/views/patients.php';
    }

    /**
     * User registration create new order endpoint content
     *
     * @return void
     */
    public function user_registration_create_new_order_endpoint_content()
    {

        $term = 'gardens-of-cuyahoga-falls';
        $tests_query = get_posts(
            array(
                'post_type' => 'post',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $term,
                    ),
                ),
            ));

        require HLC_PLUGIN_PATH . '/includes/Frontend/views/create-order.php';
    }

    /**
     * Flushing Rewrite Rules
     *
     * @return void
     */
    public function my_custom_flush_rewrite_rules()
    {
        flush_rewrite_rules();
    }
}