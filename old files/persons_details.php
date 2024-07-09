<?php
// include the connection to the db
include('connection.php');

// to display the navbar in the webpage
include('navbar.html');

// identifier for which property to display, got from the view hyperlink
$id = $_REQUEST['id'];

// query to retrieve the record
$query = "SELECT * FROM persons WHERE ID='" . $id . "'";
$result = mysqli_query($conn, $query);

// fetching each record as an associative array
$record = mysqli_fetch_assoc($result);


// retrieves property type by the id (if available)
$prop_type = '';
if (isset($record['ParcelNo'])) {
    $parcel_no = $record['ParcelNo'];
    $query_prop_type = "SELECT PropType FROM property_info JOIN property_types ON property_info.PropTypeID = property_types.PropTypeID WHERE property_info.ParcelNo = '" . $parcel_no . "'";
    $result_prop_type = mysqli_query($conn, $query_prop_type);
    $prop_type_data = mysqli_fetch_assoc($result_prop_type);
    $prop_type = $prop_type_data['PropType'];
}

// retrieves property type by the id (if available)
$prop_type = '';
if (isset($record['ParcelNo'])) {
    $parcel_no = $record['ParcelNo'];
    $query_prop_type = "SELECT PropType FROM property_info JOIN property_types ON property_info.PropTypeID = property_types.PropTypeID WHERE property_info.ParcelNo = '" . $parcel_no . "'";
    $result_prop_type = mysqli_query($conn, $query_prop_type);
    $prop_type_data = mysqli_fetch_assoc($result_prop_type);
    $prop_type = $prop_type_data['PropType'];
}


// retrieves description by the id (if available)
$unit_type = '';
if (isset($record['UnitTypeID'])) {
    $unit_type_id = $record['UnitTypeID'];
    $query_unit_type = "SELECT UnitTypeID FROM unit_types WHERE UnitTypeID = '" . $unit_type_id . "'";
    $result_unit_type = mysqli_query($conn, $query_unit_type);
    $unit_type_data = mysqli_fetch_assoc($result_unit_type);
    $unit_type = $unit_type_data['UnitTypeID'];
}
?>

<!-- html which displays data fetched from the db -->
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $id; ?></title>
    <script src='delete.js'></script>
</head>
<body>
    <?php if (!empty($prop_type_id)) { ?>
        <h4>Properties</h4>
        <h1><?php echo $prop_type_id; ?></h1>
    <?php } ?>

    <!-- displays retrieved info (if available) -->
    <?php if (!empty($unit_type)) { ?>
        <h4>Units Occupied</h4>
        <h1><?php echo $unit_type; ?></h1>
    <?php } ?>

    <?php if (!empty($prop_type)) { ?>
        <h4>Owned by</h4>
        <h1><?php echo $prop_type; ?></h1>
    <?php } ?>

    <?php if (!empty($unit_number)) { ?>
        <h4>Managed by</h4>
        <h1><?php echo $unit_number; ?></h1>
    <?php } ?>
    
    <!-- button for deletion confirmation -->
    <button onclick="confirm_delete()">Delete Unit</button>
</body>
</html
