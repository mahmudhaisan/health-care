<h1>dashboard</h1>
<form name="" method="post" class="create-health-test-order-form" action="" enctype="multipart/form-data">

    <h2>Select A Test</h2>
    <select id="select-patients-test" name="patients-test">

        <?php

foreach ($location_data_arr as $test_item => $test_value) {

    ?>
        <option value="<?php echo $test_value; ?>" item-id="<?php echo $test_item; ?>">
            <?php echo $test_value; ?></option>
        <?php }?>

    </select>

    <label for="select-pickup-date">Select Pickup Date</label>
    <input type="date" name="pickup-date" class="date-pickup" required>
    <button type="submit" name="submit"> Order A Test</button>


    <div class="test-order-success">

    </div>

</form>