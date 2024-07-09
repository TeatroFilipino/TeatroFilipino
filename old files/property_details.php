<?php
// include the connection to the db
include('connection.php');
include('query_functions.php');

// to display the navbar in the webpage
include('navbar.html');

// identifier for which property to display, got from the view hyperlink
$id = $_REQUEST['id'];

// query to retrieve the record
$prop_details = fetch_by_id("*","property_info","ParcelNo",$id);
$prop_type = fetch_by_id("PropType","property_types","PropTypeID",$prop_details['PropTypeID']);
$owner = fetch_by_id("Name","Persons","ID",$prop_details['OwnerID']);
$manager = fetch_by_id("Name","Persons","ID",$prop_details['ManagerID']);
?>

<!-- html which displays data fetched from the db -->
<!DOCTYPE html>
<html>
<head>
    <title>Parcel <?php echo $id; ?></title>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="property_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div id="title_container">
        <a href="properties.php" id="title">
            Properties<i class="material-icons">keyboard_double_arrow_right</i>
        </a>
        <span id='parcel_no'><em><?php echo $id; ?></span></em>
    </div>
    <hr>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>
        <!-- button for deletion -->
        <a href="javascript:confirm_delete_property(<?php echo $id?>)">
            <button id="delete_button">
                <i class="material-icons">delete</i>Delete
            </button>
        </a>
    </div>
    <div id='details_container'>
        <div id='col1'>
            <h3>Parcel Number</h3>
            <p><?php echo $id; ?></p>
            <h3>Property Address</h3>
            <p><?php echo $prop_details['PropAddress']; ?></p>
            <h3>Property Type</h3>
            <p><?php echo $prop_type['PropType']; ?></p>
            <h3>Number of Units</h3>
            <p><?php echo $prop_details['NoOfUnits']; ?></p>
        </div>
        <div id='col2'>
            <h3>Owner</h3>
            <p><?php echo $owner['Name']; ?></p>
            <h3>Manager</h3>
            <p><?php echo $manager['Name']; ?></p>
        </div>
        <span id='prop_icon'><img src='images/property-icon.png'></img></span>
    </div>
</body>
</html>