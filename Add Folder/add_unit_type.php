<?php
include('connection.php');
include('navbar.html');
include('query_functions.php');

$id = trim($_REQUEST['unit_type']);
$desc = trim($_REQUEST['unit_desc']);

$adding_unit_type = add_unit_type($id, $desc);

if($adding_unit_type){
    echo '<script>
            alert("Unit type added successfully.");
            window.location.replace("unit_types.php");
        </script>';
}
else{
    echo '<script>
            alert("Error: '. mysqli_error($conn) .'");
            window.location.replace("unit_types.php");
        </script>';
}
?>