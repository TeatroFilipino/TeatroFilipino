<!-- ADD A LEASES FORM-->

<?php
    // include connection to the database
    include('connection.php');
    // to display the navbar in the webpage
    include('navbar.html');
    // including the functions for querying the database
    include('query_functions.php');
    include('alerts.php');

    // fetching records using functions in query_functions.php 
    $all_lease_info = fetch_all("lease_info");
    $all_parcel_no = fetch("ParcelNo","property_info");
    $all_persons = fetch_all("persons");

    // repeating above step to fetch records again, this is done to avoid error in retrieving records for selecting manager
    $all_persons_ = fetch_all("persons");

    // counting current number of records in persons table to generate new id
    $latest_id = count_records();
    $new_id = (int)$latest_id['last_id'] + 1;

    if(isset($_GET['existing_parcel_no'])){
        $parcel_no = $_GET['existing_parcel_no'];
    }
?>

<!DOCTYPE html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="add_lease_form.css">
    <title>Add a Lease Record</title>
</head>
    <script src='helperFunctions.js'></script>

<body>
<!-- Form to collect data for a new lease record -->
<div id=title_container>
    <p id=title>Add Lease Record</p>
</div>
<div id=form_container>
<form action="add_lease.php" method="post" autocomplete="off">

<div id=col1>
    <span>
        <label for="ParcelNo">Parcel Number: </label>
        <label for="UnitNo">Unit Number: </label>
        <label for="start_of_lease">Start of Lease:</label>
        <label for="end_of_lease">End of Lease:</label>
        <label for="total_occupants">Total Occupants:</label>
    </span>

    <span>
        <!-- Field for parcel number -->
        <select name="existing_parcel_no" id="existing_parcel_no" onchange="getUnits()"required>
        <!-- default option, hints no selection -->
        <option value="<?php echo isset($parcel_no) ? $parcel_no : '' ?>" selected hidden><?php echo isset($parcel_no) ? $parcel_no : 'Select' ?></option>
            <!-- fetching parcel numbers to be set as options, value and text displayed is the parcel number -->
            <?php
            while($parcel = mysqli_fetch_array($all_parcel_no, MYSQLI_ASSOC)):
            ?>
            <option value="<?php echo $parcel['ParcelNo']; ?>">
                <?php echo $parcel['ParcelNo']; ?>
            </option>
            <?php
            endwhile;
            ?>
        </select>

        <!-- Field for unit number -->
        <select name="existing_unit_no" id="existing_unit_no" required>
        <!-- default option, hints no selection -->
        <option value="" selected disabled hidden></option>
            <!-- fetching parcel numbers to be set as options, value and text displayed is the parcel number -->
            <?php
            $all_unit_no = fetch_by_id_result("UnitNo","unit_info","ParcelNo",$parcel_no);
            while($unit_no = mysqli_fetch_array($all_unit_no, MYSQLI_ASSOC)):
            ?>
            <option value="<?php echo $unit_no['UnitNo']; ?>">
                <?php echo $unit_no['UnitNo']; ?>
            </option>
            <?php
            endwhile;
            ?>
        </select>

        <!-- Field for start of lease -->
        <input type="date" name="start_of_lease" id="start_of_lease" onchange=set_limit() required>
        <!-- Field for end of lease -->
        <input type="date" name="end_of_lease" id="end_of_lease" required>
        <script>
            function set_limit(){
                var start_of_lease = document.getElementById('start_of_lease').value;
                document.getElementById('end_of_lease').setAttribute("min",start_of_lease);
            }
        </script>
        <!-- Field for total occupants -->
        <input type="text" name="total_occupants" id="total_occupants" required minlength="1" maxlength="2" min="1" onchange="this.value = Math.floor(Math.max(this.value,1))">
</div>

<div id=col2>
    <!-- Radio buttons to select if tenant is existing or new -->
    <div id=tenant_radio_buttons>
    <span>
        <label for="Tenant">Tenant:</label>
    </span>
    <span>
        <input type="radio" name="if_existing_tenant" id="existing_tenant" value="existing" style="margin-left: 150px;" required>Existing
        <input type="radio" name="if_existing_tenant" id="new_tenant" value="new">New
        </span>
    </div>
    <hr>
 
    <!-- Div to display if existing tenant is selected, a dropdown to select an ID -->
    <div id="select_tenant">
        <span>
            <label>Tenant ID</label>
        </span>
        <span>
            <select name="existing_tenant_id" id="existing_tenant_id" required>
                <!-- default option, hints no selection -->
                <option value="" selected disabled hidden>Select</option>
                <!-- fetching ID to be set as options, value and text displayed is the ID -->
                <?php
                while($person = mysqli_fetch_array($all_persons,MYSQLI_ASSOC)):
                ?>
                <option value="<?php echo $person['ID']; ?>">
                    <?php echo $person['ID']; ?>
                </option>
                <?php
                endwhile;
                ?>
            </select>
        </span>
    </div>

    <!-- Div to display if new tenant is selected, containing a form to be submitted to the persons table-->
    <div id="add_new_tenant">
    <span>
            <label for="TenantID">Tenant ID: </label>
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
            <input type="number" name="new_tenant_id" id="new_tenant_id" value="" readonly required>
            <input type="text" name="tenant_name" id="tenant_name" required maxlength="30">
            <input type="text" name="tenant_address" id="tenant_address" required maxlength="80">
            <input type="text" name="tenant_general_num" id="tenant_general_num" required minlength="6" maxlength="15" pattern="^[0-9\-]+$">
            <input type="text" name="tenant_emergency_num" id="tenant_emergency_num" maxlength="15" pattern="^[0-9\-]*$">
            <input type="text" name="tenant_email" id="tenant_email" maxlength="50" pattern="[^@\s]+@[^@\s]+\.[^@\s]+">
    </span>
    </div>
        <!-- Submit button -->
        <input type="submit" name="submit" value="Submit"></input>
        <!-- calling the jscripts for executing actions -->
        <!-- depending on whether tenant exists or needs a new record -->
        <script src='isTenantExisting.js'></script>
    </div>
</form>
</div>
<script>
        $(document).ready(function () {
            //change selectboxes to selectize mode to be searchable
            $("select").select2();
        });
</script>
</body>
</html>
