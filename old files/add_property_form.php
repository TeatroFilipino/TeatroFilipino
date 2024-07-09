<?php
    include('connection.php');
    include('query_functions.php');
    include('navbar.html');

    // fetching records using functions in query_functions.php 
    $all_prop_types = fetch_all("property_types");
    $all_persons = fetch_all("persons");
    // repeating above step to fetch records again, this is done to avoid error in retrieving records for selecting manager
    $all_persons_ = fetch_all("persons");

    // counting current number of records in persons table to generate new id
    $latest_id = count_records("persons");
    $new_id = (int)$latest_id['Count']+1;
?>

<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="add_property_form.css">
    <title>Add Property Record</title>
</head>
<body>
<!-- Form to collect data for a new property record -->
<div id=title_container>
    <p id=title>Add Property Record</p>
</div>
<div id=form_container>
<form action="add_property.php" method="post" autocomplete="off">
    <div id=col1>
        <!-- Field for parcel number -->
        <span>
            <label for="parcel_no">Parcel Number:</label>
            <label for="prop_address">Property Address:</label>
            <label for="no_of_units">Number of Units:</label>
            <label for="prop_type">Property Type:</label>
        </span>

        <span>
            <input type="text" name="parcel_no" id="parcel_no" required minlength="12" maxlength="12" pattern="^[0-9]+$">
            <input type="text" name="prop_address" id="prop_address" required minlength="5" maxlength="80">
            <input type="text" name="no_of_units" id="no_of_units" required maxlength="3" pattern="^[0-9]+$">
            <select name="prop_type" id="prop_type" required>
                <!-- default option, hints no selection -->
                <option value="" selected disabled hidden>Select</option>
                <!-- fetching each prop type to be set as options, value is id but text displayed is the desc -->
                <?php 
                    while($proptype = mysqli_fetch_array($all_prop_types,MYSQLI_ASSOC)):;
                ?> 
                    <option value = "<?php echo $proptype['PropTypeID'];?>">
                        <?php echo $proptype['PropType']; ?>
                    </option>
                <?php
                    endwhile;
                ?>
            </select>
        </span>
    </div>

    <div id=col2>
    <!-- Radio buttons to select if manager is existing or new -->
        <div id=owner_radio_buttons>
            <span>
                <label for="Owner">Owner</label>
            </span>
            <span>
                <input type="radio" name="if_existing_ownr" id="existing_owner" required>Existing
                <input type="radio" name="if_existing_ownr" id="new_owner">New
            </span>
        </div>
        <hr>

        <!-- Div to display if existing owner is selected, a dropdown to select an ID -->
        <div id="select_owner">
            <span>
                <label>Owner ID</label>
            </span>
            <span>
                <select name="existing_owner_id" id="existing_owner_id" required>
                    <!-- default option, hints no selection -->
                    <option value="" selected disabled hidden>Select</option>
                    <!-- fetching ID to be set as options, value and text displayed is the ID -->
                    <?php
                        while($person = mysqli_fetch_array($all_persons,MYSQLI_ASSOC)):;
                    ?>
                            <option value = "<?php echo $person['ID'];?>">
                                <?php echo $person['ID']; ?>
                            </option>
                    <?php
                        endwhile;
                    ?>
                </select>
            </span>
        </div>

        <!-- Div to display if new owner is selected, containing a form to be submitted to the persons table-->
        <div id="add_new_owner">
            <span>
                <label for="OwnerID">Owner ID: </label>
                <label for="Name">Name: </label>
                <label for="Address">Address: </label>
                <label for="GeneralNum">General Number: </label>
                <label for="EmergencyNum">Emergency Number: </label>
                <label for="Email">Email: </label>
            </span>

            <span>
                <script type="text/javascript">
                    var new_id = <?php echo json_encode($new_id); ?>;
                </script>
                <input type="number" name="new_owner_id" id="new_owner_id" value="" readonly required>
                <input type="text" name="ownr_name" id="ownr_name" required maxlength="30">
                <input type="text" name="ownr_address" id="ownr_address" required maxlength="80">
                <input type="text" name="ownr_general_num" id="ownr_general_num" required minlength="6" maxlength="15" pattern="^[0-9\-]+$">
                <input type="text" name="ownr_emergency_num" id="ownr_emergency_num" maxlength="15" pattern="^[0-9\-]*$">
                <input type="text" name="ownr_email" id="ownr_email" maxlength="50" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
            </span>
        </div>

        <!-- Radio buttons to select if manager is existing or new -->
        <div id=manager_radio_buttons>
            <span>
                <label for="Manager">Manager</label>
            </span>
            <span>
                <input type="radio" name="if_existing_mgr" id="existing_manager" required>Existing
                <input type="radio" name="if_existing_mgr" id="new_manager">New
            </span>
        </div>
        <hr>

        <!-- Div to display if existing manager is selected, a dropdown to select an ID -->
        <div id="select_manager">
            <span>
                <label> Manager ID</label>
            </span>
            <span>
            <select name="existing_mgr_id" id="existing_mgr_id" required>
                <!-- default option, hints no selection -->
                <option value="" selected disabled hidden>Select</option>
                <!-- fetching ID to be set as options, value and text displayed is the ID -->
                <?php
                    while($person = mysqli_fetch_array($all_persons_,MYSQLI_ASSOC)):;
                ?>
                        <option value = "<?php echo $person['ID'];?>">
                        <?php echo $person['ID']; ?>
                        </option>
                <?php
                    endwhile;
                ?>
            </select>
            <span>
        </div>

        <!-- Div to display if new manager is selected, containing a form to be submitted to the persons table-->
        <div id="add_new_manager">
            <span>
                <label for="ManagerID">Manager ID: </label>
                <label for="Name">Name: </label>
                <label for="Address">Address: </label>
                <label for="GeneralNum">General Number: </label>
                <label for="EmergencyNum">Emergency Number: </label>
                <label for="Email">Email: </label>
            </span>

            <span>
                <input type="text" name="new_manager_id" id="new_manager_id" value="" readonly required>
                <input type="text" name="mgr_name" id="mgr_name" required maxlength="30">
                <input type="text" name="mgr_address" id="mgr_address" required maxlength="80">
                <input type="text" name="mgr_general_num" id="mgr_general_num" required minlength="6" maxlength="15" pattern="^[0-9\-]+$">
                <input type="text" name="mgr_emergency_num" id="mgr_emergency_num" maxlength="15" pattern="^^[0-9\-]*$">
                <input type="text" name="mgr_email" id="mgr_email" minlength="8" maxlength="50" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
            </span>
        </div>
        <script src='isOwnerExisting.js'></script>
        <script src='isManagerExisting.js'></script>
            
        <!-- Submit button -->
        <input type="submit" name="submit" value="Submit"></input>
    </div>
</form>
</div>

</body>
</html>