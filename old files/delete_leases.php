<!-- DELETE A LEASES -->

<?php
// include connection to the database
include('connection.php');
include('alerts.php');

if(isset($_GET['parcelNo']) && isset($_GET['unitNo'])) {
    $parcelNo = $_GET['parcelNo'];
    $unitNo = $_GET['unitNo'];

    // SQL query to delete the lease record
    $query = "DELETE FROM lease_info WHERE ParcelNo = '$parcelNo' AND UnitNo = '$unitNo' LIMIT 1"; //ensure that only one lease record is deleted at a time

    // Execute the query
    $result = mysqli_query($conn, $query);

    if($result) {
        // Lease deleted successfully
        echo '<script>
                alert("Lease deleted successfully.");
                window.location.replace("leases.php");
            </script>';
    } else {
        // Error occurred while deleting the lease
        echo '<script>
                alert("Error: ' . mysqli_error($conn) . '");
                window.location.replace("leases.php");
            </script>';
    }
} else {
    // Required parameters are missing
    echo '<script>
            alert("Invalid request.");
            window.location.replace("leases.php");
        </script>';
}

$conn->close();
?>
