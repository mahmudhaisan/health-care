<form method="post" class="create-test-order-from-dashboard" action="" enctype="multipart/form-data">
    <label for="patients-test">Select A Test</label>
    <select id="patients-test" name="patients-test">

        <option value="Vitamin D" item-id="173">
            Vitamin D</option>
        <option value="Cmp" item-id="167">
            Cmp</option>
        <option value="BMP" item-id="165">
            BMP</option>

    </select>

    <label for="select-pickup-date">Select Pickup Date</label>
    <input type="date" name="pickup-date" class="date-pickup" required="">
    <button type="submit" name="submit"> Order A Test</button>



    <div class="test-order-success">

    </div>

</form>
