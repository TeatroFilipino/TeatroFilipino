<?php
    // include the connection to the db
    include('connection.php');
    include('query_functions.php');

    include('navbar.html');

    // identifier for which unit to display, obtained from the URL parameter
    $parcel_no = $_REQUEST['parcelno'];
    $unit_no = $_REQUEST['unitno'];

    // query to retrieve the record
    $unit_details = fetch_cols("*","unit_info","ParcelNo = $parcel_no AND UnitNo = $unit_no");
    $unit = mysqli_fetch_assoc($unit_details);
    $prop_address = fetch_by_id("PropAddress","property_info","ParcelNo",$parcel_no);
    $unit_type = fetch_by_id("UnitDesc","unit_types","UnitTypeID",$unit['UnitTypeID']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unit Details - <?php echo $parcel_no;?></title>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="unit_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div id="title_container">
       <a href="units.php" id="title">
        Units<i class="material-icons">keyboard_double_arrow_right</i>
        </a>
        <span id='parcel_no'><em><?php echo $parcel_no; ?></span></em>
    </div>
    <hr>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>
        <button id="delete_button" type="button" onclick="confirm_delete(<?php echo $unit_no; ?>)">
          <i class="material-icons">delete</i> Delete
        </button>
    </div>
    <div id='details_container'>
        <div id='col1'>
        <!-- HTML to display the fetched data -->
        <h4>Parcel Number</h4>
        <h1>
        <a href="property_details.php?id=<?php echo $parcel_no; ?>"><?php echo $parcel_no; ?></a>
        </h1>

        <h4>Property Address</h4>
        <h1><?php echo $prop_address['PropAddress']; ?></h1>

        <h4>Unit Number</h4>
        <h1><?php echo $unit_no; ?></h1>
    </div>
    <div id='col2'>
    <h4>Unit Description</h4>
    <h1><?php echo $unit['UnitTypeID']," - ",$unit_type['UnitDesc']; ?></h1>
    </div>
    <!-- Placeholder for updating records -->
    <!-- <button onclick="document.location='update_unit.php?id=<?php echo urlencode($unit_no); ?>'">Update Unit</button> -->
</body>
</html>
