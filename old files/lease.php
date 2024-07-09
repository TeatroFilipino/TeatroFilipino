<?php 
    include('connection.php');
    include ('navbar.html');
    include('query_functions.php');

    $all_lease = fetch_all('lease_info');
    $active_leases = exclude_expired_lease();
?>

<!-- move inline styles attribute to external css file -->
<!DOCTYPE html>
<html>
<head>
    <title>Leases</title>
    <link rel="stylesheet" type="text/css" href="leases.css">
    <script src="helperFunctions.js"></script>
</head>
<body>
    <div id="lease_header" style="padding-left: 40px;">
        <h2>LEASES</h2>
    </div>
    <div id="search-bar">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search...">
            <input type="submit" value="Search">
        </form>
    </div>
    
    <!-- id changed -->
    <div id="actions_header"> 
        <h2>Action</h2>
    </div>

    <div class="action_button"style="height: 70px;">
        <button id="add-lease-button" onclick="document.location='add_lease_form.php'">Add a Lease</button>
        <button onclick="include_expired()" id="include_button" hidden>Include Expired Lease</button>
        <button onclick="exclude_expired()" id="exclude_button"></button>
        <button id="delete-lease-button" onclick="document.location='delete.js'">Delete a Lease</button>
    </div>
    
    <table border="1" cellspacing="0" cellpadding="10" id="all_leases">
        <tr>
            <th>Parcel Number</th>
            <th>Unit Number</th>
            <th>Tenant ID</th>
            <th>Start of Lease</th>
            <th>End of Lease</th>
            <th>Total Occupants</th>
        </tr>
        <?php
            if (mysqli_num_rows($all_lease) > 0) {
                while ($record = mysqli_fetch_assoc($all_lease)) {
            ?>
            <tr>
                <td><?php echo $record['ParcelNo']; ?></td>
                <td><?php echo $record['UnitNo']; ?></td>
                <td><?php echo $record['TenantID']; ?></td>
                <td><?php echo $record['StartOfLease']; ?></td>
                <td><?php echo $record['EndOfLease']; ?></td>
                <td><?php echo $record['TotalOccupants']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
        ?>
    </table>

    <!-- if exclude button is clicked, the ff table will be displayed -->
    <table border="1" cellspacing="0" cellpadding="10" id="expired_lease_excluded" hidden>
        <tr>
            <th>Parcel Number</th>
            <th>Unit Number</th>
            <th>Tenant ID</th>
            <th>Start of Lease</th>
            <th>End of Lease</th>
            <th>Total Occupants</th>
        </tr>
        <?php
            while ($lease = mysqli_fetch_assoc($active_leases)) {
        ?>
                <tr>
                    <td><?php echo $lease['ParcelNo']; ?></td>
                    <td><?php echo $lease['UnitNo']; ?></td>
                    <td><?php echo $lease['TenantID']; ?></td>
                    <td><?php echo $lease['StartOfLease']; ?></td>
                    <td><?php echo $lease['EndOfLease']; ?></td>
                    <td><?php echo $lease['TotalOccupants']; ?></td>
                </tr>
    <?php
            }
        ?>
    </table>
</body>
</html>
