<?php

namespace Health\Care\Admin;

/**
 * Class Menu
 * @package Appointment \Booking\Admin
 */

class Patients_Views
{

    public function plugin_page()
    {

        /**
         * Plugin page handler
         *
         * @return void
         */
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $umeta_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {

            case 'edit':
                $patients_meta = hlc_get_patients_order_meta($umeta_id);
                $template = __DIR__ . '/views/patient-edit.php';
                break;

            default:
                $template = __DIR__ . '/views/patient-lists.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Handle the form
     *
     * @return void
     */
    public function form_handler()
    {
        if (!isset($_POST['update_status'])) {
            return;
        }

        $umeta_id = isset($_POST['umeta_id']) ? intval($_POST['umeta_id']) : 0;
        $test_name = isset($_POST['test_name']) ? sanitize_text_field($_POST['test_name']) : '';
        $date_pickup = isset($_POST['date_pickup']) ? sanitize_text_field($_POST['date_pickup']) : '';
        $order_status_select = isset($_POST['order-status-select']) ? sanitize_textarea_field($_POST['order-status-select']) : '';

        $uploadOk = 1;

        $target_dir = WP_PLUGIN_DIR . '/health-care/uploads/';

        $target_file_val = str_replace(' ', '-', $_FILES['pdf_file_upload']['name']);
        $target_file = $target_dir . basename($target_file_val);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $pdf_temp = ($_FILES["pdf_file_upload"]["tmp_name"]);

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($file_type != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($pdf_temp, $target_file)) {
                echo "The file " . basename($target_file) . " has been
                    uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $order_meta_value = array(
            $test_name,
            $date_pickup,
            $order_status_select,
            $target_file_val,
        );

        print_r($target_file_val);

        $args = [
            'meta_value' => serialize($order_meta_value),

        ];

        if ($umeta_id) {
            $args['umeta_id'] = $umeta_id;
        }

        $insert_id = hlc_insert_order_meta($args);

        if ($umeta_id && $uploadOk == 1) {
            $redirected_to = admin_url('admin.php?page=health-care-list&action=edit&address-updated=true&file_type=pdf&fil&id=' . $umeta_id);
        } else {
            $redirected_to = admin_url('admin.php?page=health-care-list&inserted=true');
        }

        wp_redirect($redirected_to);

        // print_r('hello');
        exit;
    }

}