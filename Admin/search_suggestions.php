<?php
// Include your database connection and query_functions.php
include('../connection.php');
include('query_functions.php');

if (isset($_POST['searchInput'])) {
    $searchInput = mysqli_real_escape_string($conn, $_POST['searchInput']);

    // Modify the query to match your database schema
    $query = "SELECT DISTINCT site_Name FROM site WHERE site_Name LIKE '%$searchInput%' LIMIT 5";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $suggestions = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $suggestions[] = $row['site_Name'];
        }
        echo json_encode($suggestions);
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

$conn->close();
?>
