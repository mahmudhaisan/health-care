<!-- <h3>Additional Information</h3> -->


<table class="form-table">
    <tr>
        <th><label for="city">Location</label></th>
        <td>
            <select name="user_location_val" id="user_location">
                <option value=""> Select User Location</option>

                <option value="gardens-of-cuyahoga-falls"
                    <?php if ($get_user_location == "gardens-of-cuyahoga-falls") {echo "selected";}?>>Gardens of
                    Cuyahoga
                    Falls
                </option>
                <option value="the-woods-on-french-creek"
                    <?php if ($get_user_location == "the-woods-on-french-creek") {echo "selected";}?>>The Woods on
                    French Creek </option>
            </select>
        </td>
    </tr>
</table>