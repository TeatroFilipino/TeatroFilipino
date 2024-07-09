<?php
include('../connection.php');
include('navbar.html');
include('query_functions.php');

$dest_id = $_REQUEST['dest_id'];
$dest_destination = ($_REQUEST['dest_destination']);


$adding_destination = add_destination($dest_id, $dest_destination);

if ($adding_destination) {
    echo '<script>
            alert("Destination added successfully.");
            window.location.replace("itinerary.php");
        </script>';
} else {
    echo '<script>
            alert("Error: ' . mysqli_error($conn) . '");
            window.location.replace("itinerary.php");
        </script>';
}
?>
