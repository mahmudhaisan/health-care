<h2>Your Orders</h2>


<table>
    <tr>
        <th>Test Name</th>
        <th>Pickup Date</th>
        <th>Status</th>
    </tr>

    <?php
foreach ($users_order_list as $single_order_item) {

    $order_item_array = ($single_order_item);

    $test_name = $order_item_array[0];
    $date_pickup = $order_item_array[1];
    $order_status = $order_item_array[2];

    if ($order_status == 'completed' && $order_item_array[3] != null) {
        $pdf_prescription = HLC_PLUGIN_URL_CUSTOM_UPLOAD . $order_item_array[3];
        $order_pdf = "<a href='$pdf_prescription'> View Prescrption </a>";
    } else {
        $order_pdf = false;
    }

    ?>




    <tr>
        <td><?php echo $test_name; ?></td>
        <td><?php echo $date_pickup; ?></td>
        <td><?php echo $order_status . $order_pdf; ?></td>
    </tr>

    <?php }
?>

</table>