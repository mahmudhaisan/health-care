<?php

namespace Health\Care;

/**
 * Class Assets
 *
 * @package Health\Care
 */
class Ajax
{

    /**
     * Assets constructor.
     */
    public function __construct()
    {
        add_action('wp_ajax_create_new_order', [$this, 'create_new_order']);
    }

    public function create_new_order()
    {

        $selected_test = $_POST['selected_test'];
        $date_pickup = $_POST['date_pickup'];
        $order_status = 'processing';
        $pdf_file = '';
        $user_id = get_current_user_id();

        $user_order_meta = array($selected_test, $date_pickup, $order_status, $pdf_file);

        add_user_meta($user_id, 'patients-order', $user_order_meta);

        wp_die();
    }

}
