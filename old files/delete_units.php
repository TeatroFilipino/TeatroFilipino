<!-- DELETE A UNIT -->

<?php
// include connection to the database
include('connection.php');
include('alerts.php');

if(isset($_GET['parcelNo']) && isset($_GET['unit_info'])) {
    $parcelNo = $_GET['parcelNo'];
    $unit_info = $_GET['unit_info'];

    // SQL query to delete the lease record
    $query = "DELETE FROM unit_info, property_info WHERE ParcelNo = '$parcelNo' AND unit_info = '$unitNo' LIMIT 1"; //ensure that only one lease record is deleted at a time

    // Execute the query
    $result = mysqli_query($conn, $query);

    if($result) {
        // Units deleted successfully
        echo '<script>
                alert("Units deleted successfully.");
                window.location.replace("units.php");
            </script>';
    } else {
        // Error occurred while deleting the lease
        echo '<script>
                alert("Error: ' . mysqli_error($conn) . '");
                window.location.replace("units.php");
            </script>';
    }
} else {
    // Required parameters are missing
    echo '<script>
            alert("Invalid request.");
            window.location.replace("units.php");
        </script>';
}

$conn->close();
?>
