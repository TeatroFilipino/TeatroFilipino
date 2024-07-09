<?php
    // include the connection to the db
    include('connection.php');
    include('query_functions.php');

    include('navbar.html');
    include('delete_functions.php');

    // identifier for which unit to display, obtained from the URL parameter
    $parcel_no = $_GET['parcel_no'];
    $unit_no = $_GET['unit_no'];

    // query to retrieve the record
    $all_records = all_units();
    $more_details = more_unit_details();

    if (mysqli_num_rows($all_records) > 0) {
        while($record = mysqli_fetch_assoc($all_records)) { 
            if ($record['ParcelNo'] == $parcel_no && $record['UnitNo'] == $unit_no) {
                $unit_details = $record;
            }
        }
    }

    if (mysqli_num_rows($more_details) > 0) {
        while($record = mysqli_fetch_assoc($more_details)) { 
            if ($record['ParcelNo'] == $parcel_no && $record['UnitNo'] == $unit_no) {
                $more_unit_details = $record;
            }
        }
    }

    if(isset($_GET['delete'])){
        delete_unit($parcel_no,$unit_no);
    }
    ?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $parcel_no, " - ", $unit_no?></title>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="unit_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div id="title_container">
        <a href="units.php" id="title">
            Units<i class="material-icons">keyboard_double_arrow_right</i>
        </a>
        <span id='key'><?php echo $parcel_no ?><em><?php echo " Unit ", $unit_no?></em></span>
    </div>
    <hr>
    <div id=body>
        <div id="actions_container">
            <h1 id="actions_title">Actions</h1>
            <!-- button for deletion -->
            <a href="javascript:confirm_delete_unit('<?php echo $parcel_no?>','<?php echo $unit_no?>')">
                <button id="delete_button">
                    <i class="material-icons">delete</i> Delete
                </button>
            </a>
            <button id="lease_history" onclick="document.location='leases.php?parcelno=<?php echo $parcel_no ?>&unitno=<?php echo $unit_no ?>'">
                <i class="material-icons">view_list</i><p>View Lease History</p>
            </button>
            <button id="active_lease" onclick="document.location='leases.php?parcelno=<?php echo $parcel_no ?>&unitno=<?php echo $unit_no ?>&active=true'">
                <i class="material-icons">wysiwyg</i><p>View Active Lease</p>
            </button>
        </div>
        <!-- HTML to display the fetched data -->
        <div id='details_container'>
            <div id='col1'>
            <h4>Parcel Number</h4>
            <h1>
            <a href="property_details.php?id=<?php echo $parcel_no; ?>"><?php echo $parcel_no; ?></a>
            </h1>

            <h4>Property Address</h4>
            <h1><?php echo $unit_details['PropAddress']; ?></h1>

            <h4>Unit Number</h4>
            <h1><?php echo $unit_no; ?></h1>
        </div>
            <div id='col2'>
                <h4>Unit Description</h4>
                <h1><?php echo $more_unit_details['Unit Description']; ?></h1>
            </div>
            <span id='unit_icon'><img src='images/unit.png'></img></span>
        </div>
    </div>
    </body>
</html>