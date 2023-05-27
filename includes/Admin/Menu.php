<?php

namespace Health\Care\Admin;

/**
 * Class Menu
 * @package Appointment \Booking\Admin
 */
class Menu
{

    /**
     * Menu constructor.
     */
    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Admin Menu Callback
     *
     * @return void
     */
    public function admin_menu()
    {

        $admin_role = get_role('administrator');
        $nurse_role = get_role('nurse');

        if (!empty($nurse_role)) {
            $nurse_role->add_cap('custom-plugin-page');
        }
        // print_r(get_role('nurse'));
        $admin_role->add_cap('custom-plugin-page');

        $capability = ('custom-plugin-page');
        $slug = 'health-care-options';
        $settings_slug = 'health-care-setting';
        $list_slug = 'health-care-list';

        add_menu_page(
            __('Add New Order', 'health-care'),
            __('New Order', 'health-care'),
            $capability,
            $slug,
            [$this, 'menu_page_template'],
            'dashicons-yes'
        );

        add_submenu_page(
            $slug,
            'Lists',
            'Health Care Lists',
            $capability,
            $list_slug,
            [$this, 'health_care_test_lists']

        );

    }

    /**
     * Main Menu Callback
     *
     * @return void
     */
    public function menu_page_template()
    {
        $data_array = array(

            'gardens-of-cuyahoga-falls' => array(
                'BMP', 'CMP', 'CMP', 'Vitamin D', 'Vitamin B', 'PT/ INR', 'TSH Hepatic Panel', 'Urinalysis and CX', 'Covid-19', 'Flu A', 'Flu B	RSV',
            ),
            'the-Woods-on-french-creek	' => array(
                'Basic Metabolic Panel', 'Comp Metabolic Panel', 'Electrolyte Panel', 'Hepatic Panel', 'Iron Deficiency Panel', 'Lipid Panel', 'Renal Function Panel', 'Urinalysis and CX', 'Albumin', 'Alkaline Phospatase', 'ALT', 'AST',
            ),

        );

        $user_location = 'gardens-of-cuyahoga-falls';

        foreach ($data_array as $location_based_test) {

            if ($location_based_test == $user_location) {
                $location_data_arr = $location_based_test;
            } else {
                $location_data_arr = $location_based_test;
            }
        }

        include HLC_PLUGIN_PATH . 'includes/Admin/views/dashboard-create-order.php';
    }

    /**
     * Healthcare Settings Submenu Callback
     *
     * @return void
     */
    public function health_care_settings()
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

        require HLC_PLUGIN_PATH . '/views/user-settings.php';
    }

    public function health_care_test_lists()
    {

        $patients_list_view = new Patients_Views();
        $patients_list_view->plugin_page();
    }

}
