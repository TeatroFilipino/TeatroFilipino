<?php
// include the connection to the db
include('connection.php');

// to display the navbar in the webpage
include('navbar.html');

// identifier for which property to display, got from the view hyperlink
$id = $_REQUEST['id'];

// query to retrieve the record
$query = "SELECT * FROM unit_info WHERE ParcelNo='" . $id . "'";
$result = mysqli_query($conn, $query);

// fetching each record as an associative array
$record = mysqli_fetch_assoc($result);

// retrieves description by the id (if available)
$unit_type = '';
if (isset($record['UnitTypeID'])) {
    $unit_type_id = $record['UnitTypeID'];
    $query_unit_type = "SELECT UnitDesc FROM unit_types WHERE UnitTypeID = '" . $unit_type_id . "'";
    $result_unit_type = mysqli_query($conn, $query_unit_type);
    $unit_type_data = mysqli_fetch_assoc($result_unit_type);
    $unit_type = $unit_type_data['UnitDesc'];
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
?>
<!-- html which displays data fetched from the db -->
<!DOCTYPE html>
<html>
<head>
    <title>Unit Details</title>
    <script src='delete.js'></script>
</head>
<body>
    <!-- displays retrieved info (if available) -->
    <h4>Unit Type ID</h4>
    <h1><?php echo $record['UnitTypeID']; ?></h1>

    <!-- button for deletion confirmation -->
    <button onclick="confirm_delete()">Delete Unit</button>
</body>
</html>