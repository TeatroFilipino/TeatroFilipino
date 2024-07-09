<?php
include('connection.php');
include('navbar.html');
include('query_functions.php');

$parcel_no = $_REQUEST['existing_parcel_no'];
$unit_no = trim($_REQUEST['unit_no']);
$unit_type = $_REQUEST['unit_type'];

$adding_unit = add_unit($parcel_no,$unit_no,$unit_type);

if($adding_unit){
    echo '<script>
            alert("Unit added successfully.");
            window.location.replace("units.php");
        </script>';
}
else {
    echo '<script>
            alert("Error: '.mysqli_error($conn).'");
            window.location.replace("units.php");
        </script>';
}
?>