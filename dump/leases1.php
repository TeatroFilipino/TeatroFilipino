<!-- LEASES DASHBOARD -->

<?php
    // to display the navbar in the webpage
    include('navbar.html');
    // include connection to the database
    include('connection.php'); 
    // including the functions for querying the database
    include('query_functions.php');
    include('alerts.php');

    // check if "expired" parameter is set in the URL
    $expired = isset($_GET['expired']) ? $_GET['expired'] : '';
    // query for retrieving records
    $query = "SELECT ParcelNo, UnitNo, TenantID, StartOfLease, EndOfLease, TotalOccupants FROM lease_info";
    // if "expired" is set to "exclude", modify the query to exclude expired leases
    if ($expired == 'exclude') {
        $query .= " WHERE EndOfLease > CURDATE()";
    }
    // executing query
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- .css file links -->
    <title>Leases</title>
    <link rel="stylesheet" type="text/css" href="leases.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<div id="body">
<div id="title_container"><p id="title">Leases</p></div>
<div id="actions_container">
    <h1 id="actions_title">Actions</h1>

<!-- ADD LEASE BUTTON -->
    <button id="add_button" onclick="document.location='add_lease_form.php'"><i class="material-icons">add</i> Add Lease</button>

<?php
    // Determine the URL for the "Exclude Expired Leases" button based on the current state
    $excludeURL = ($expired == 'exclude') ? 'leases.php' : 'leases.php?expired=exclude';
?>
<span> 
<!-- EXCLUDE EXPIRED LEASES BUTTON -->
    <button id="exclude_lease_button" onclick="document.location='<?php echo $excludeURL; ?>'"><?php echo ($expired == 'exclude') ? 'View All Leases' : 'Exclude Expired Lease'; ?></button>
</span>
</div>
<div id="table_container">
<table>
    <tr>
        <th>Parcel Number</th>
        <th>Unit Number</th>
        <th>Tenant ID</th>
        <th>Start of Lease</th>
        <th>End of Lease</th>
        <th>Total Occupants</th>
        <th>Delete a Lease</th> <!-- Add Delete column for delete button -->
    </tr>  
<?php
    // loops to display records (fetched as arrays with mysqli_fetch_assoc) into a table
    if ($result && mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td><?php echo $record['ParcelNo']; ?></td>
            <td><?php echo $record['UnitNo']; ?></td>
            <td><?php echo $record['TenantID']; ?></td>
            <td><?php echo $record['StartOfLease']; ?></td>
            <td><?php echo $record['EndOfLease']; ?></td>
            <td><?php echo $record['TotalOccupants']; ?></td>
            <td>
                <!-- BUTTON FOR DELETION -->
                <a href="#" onclick="deleteLease('<?php echo $record['ParcelNo']; ?>', '<?php echo $record['UnitNo']; ?>')">Delete</a>
            </td>
        </tr>
                
<?php
    }
} else {
    echo "<tr><td colspan='7'>No records found</td></tr>";
}

$conn->close();
?>
</table>
    
<script>
    function deleteLease(parcelNo, unitNo) {
        if (confirm("Are you sure you want to delete this lease?")) {
            window.location.href = "delete_leases.php?parcelNo=" + parcelNo + "&unitNo=" + unitNo;
        }
    }
</script>
    
</body>
</html>
