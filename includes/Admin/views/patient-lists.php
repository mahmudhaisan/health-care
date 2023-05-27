<h1>Patients Data</h1>

<a href="<?php echo admin_url('admin.php?page=health-care-options'); ?>" class="button action">Add New Order</a>
<form method="post" class="create-test-order-from-dashboard" action="" enctype="multipart/form-data">

    <?php

$table = new Health\Care\Admin\Listclass;
$table->prepare_items();
$table->display();

?>


</form>