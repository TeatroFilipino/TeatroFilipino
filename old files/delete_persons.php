<!-- DELETE A LEASES -->

<?php
// include connection to the database
include('connection.php');
include('alerts.php');

if(isset($_GET['parcelNo']) && isset($_GET['unitNo'])) {
    $id = $_GET['person_id'];
    $Name = $_GET['Name'];

    // SQL query to delete the lease record
    $query = "DELETE FROM persons WHERE person_id = '$id' AND Name = '$Name' LIMIT 1"; //ensure that only one lease record is deleted at a time

    // Execute the query
    $result = mysqli_query($conn, $query);

    if($result) {
        // Person deleted successfully
        echo '<script>
                alert("Person deleted successfully.");
                window.location.replace("persons.php");
            </script>';
    } else {
        // Error occurred while deleting the lease
        echo '<script>
                alert("Error: ' . mysqli_error($conn) . '");
                window.location.replace("persons.php");
            </script>';
    }
} else {
    // Required parameters are missing
    echo '<script>
            alert("Invalid request.");
            window.location.replace("persons.php");
        </script>';
}

$conn->close();
?>
