<?php

$user_id = $patients_meta->user_id;
$user_info = get_userdata($user_id);
$user_login = $user_info->user_login;
$user_order_meta = (unserialize($patients_meta->meta_value));

$test_name = $user_order_meta[0];
$pickup_date = $user_order_meta[1];
$order_status = $user_order_meta[2];
$order_pdf = $user_order_meta[3];

$order_status_arr = array(
    'processing',
    'completed',
);

?>

<div class="wrap">
    <h1><?php _e('Edit Orders', 'wedevs-academy');?></h1>

    <?php if (isset($_GET['address-updated'])) {?>
    <div class="notice notice-success">
        <p><?php _e('Address has been updated successfully!', 'wedevs-academy');?></p>
    </div>
    <?php }?>

    <form action="" method="post" enctype="multipart/form-data">
        <table class="form-table">
            <tbody>
                <tr class="row">
                    <th scope="row">
                        <label for="name"><?php _e('Patient Name', 'wedevs-academy');?></label>
                    </th>
                    <td>

                        <p><?php echo $user_login; ?></p>
                    </td>
                </tr>


                <tr class="row">
                    <th scope="row">
                        <label><?php _e('Test Name', 'wedevs-academy');?></label>
                    </th>
                    <td>
                        <p><?php echo $test_name; ?></p>


                    </td>
                </tr>



                <tr>
                    <th scope="row">
                        <label for="address"><?php _e('Pickup Date', 'wedevs-academy');?></label>
                    </th>
                    <td>
                        <input type="date" name="date_pickup" id="" value="<?php echo $pickup_date; ?>">



                    </td>
                </tr>


                <tr class="row">
                    <th scope="row">
                        <label for=""><?php _e('Status', 'wedevs-academy');?></label>
                    </th>
                    <td>


                        <?php

echo '<select name="order-status-select" id="">';
foreach ($order_status_arr as $order_status_item) {
    if ($order_status == $order_status_item) {

        echo "<option selected='selected' value='$order_status_item'>$order_status_item </option>";
    } else {
        echo "<option value='$order_status_item'>$order_status_item </option>";

    }

}
echo '</select>';

// <option value="processing" <?php echo $order_status;

?>
                        </select>

                    </td>
                </tr>


                <tr>
                    <th scope="row">
                        <label for="upload_pdf"><?php _e('upload_pdf', 'wedevs-academy');?></label>
                    </th>
                    <td>
                        <input type="file" name="pdf_file_upload" value="<?php echo $order_pdf; ?>" required>



                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="test_name" value="<?php echo esc_attr($test_name); ?>">
        <input type="hidden" name="umeta_id" value="<?php echo esc_attr($umeta_id); ?>">

        <?php submit_button(__('Update Status', 'wedevs-academy'), 'primary', 'update_status');?>
    </form>
</div>

<?