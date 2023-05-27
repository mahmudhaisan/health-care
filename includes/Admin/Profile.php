<?php

namespace Health\Care\Admin;

/**
 * Class UserProfileField
 *
 */
class Profile
{

    /**
     * User profile field construct
     */
    public function __construct()
    {
        add_action('show_user_profile', array($this, 'hlc_profile_fields'));
        add_action('edit_user_profile', array($this, 'hlc_profile_fields'));

        add_action('personal_options_update', array($this, 'rudr_save_profile_fields'));
        add_action('edit_user_profile_update', array($this, 'rudr_save_profile_fields'));

    }

    /**
     * HLC Profile Fields
     *
     * @return void
     */
    public function hlc_profile_fields($user)
    {

        $user_id = $user->ID;

        $get_user_location = get_user_meta($user_id, 'user_location_val')[0];

        require HLC_PLUGIN_PATH . '/includes/Admin/views/user-profile-fields.php';
    }

    public function rudr_save_profile_fields($user_id)
    {

        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'update-user_' . $user_id)) {
            return;
        }

        if (!current_user_can('edit_user', $user_id)) {
            return;
        }

        $user_location = $_POST['user_location_val']; // Storing Selected Value In Variable
        update_user_meta($user_id, 'user_location_val', sanitize_text_field($user_location));

    }

}