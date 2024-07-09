<?php 
    include('connection.php');
    include ('navbar.html');
    include('query_functions.php');
    include('delete_functions.php');

    $all_records = all_lease();
    $active_records = active_lease();

    // if the delete button is clicked, 
    // parameters are set thru the url with values of the primary key to delete specific record
    if(isset($_GET['delete'])){
        $parcel_no = $_GET['parcel_no'];
        $unit_no = $_GET['unit_no'];
        $start_of_lease = $_GET['lease_start'];
        // parameters are passed to delete_functions.php
        delete_lease($parcel_no, $unit_no, $start_of_lease);
    }
?>

<!-- move inline styles attribute to external css file -->
<!DOCTYPE html>
<html>
<head>
    <title>Leases</title>
    <link rel="stylesheet" type="text/css" href="leases.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols-Rounded"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="helperFunctions.js"></script>
</head>
<body>
    <div id="title_container">
        <p id="title">Leases</p>
    </div>
    <div id=body>
        <div id="actions_container">
            <h1 id="actions_title">Action</h1>
            <button id="add_lease_button" onclick="document.location='add_lease_form.php'"><i class="material-icons">add</i> Add a Lease</button>
            <button onclick="include_expired()" id="include_button" hidden>
                <i class="material-icons">visibility</i><p>Include Expired Lease</p>
            </button>
            <button onclick="exclude_expired()" id="exclude_button">
                <i class="material-icons">visibility_off</i><p>Exclude Expired Lease</p>
            </button>
        </div>
        
        <div id="table_container">
        <table id="all_leases">
            <tr>
                <th>Parcel Number</th>
                <th>Unit Number</th>
                <th>Tenant</th>
                <th>Start of Lease</th>
                <th>End of Lease</th>
                <th>Total Occupants</th>
                <th>Delete</th>
            </tr>
            <?php
                if (mysqli_num_rows($all_records) > 0) {
                    while ($lease = mysqli_fetch_assoc($all_records)) {
                ?>
                <tr>
                    <td><?php echo $lease['ParcelNo']; ?></td>
                    <td><?php echo $lease['UnitNo']; ?></td>
                    <td><?php echo $lease['Tenant']; ?></td>
                    <td><?php echo $lease['StartOfLease']; ?></td>
                    <td><?php echo $lease['EndOfLease']; ?></td>
                    <td><?php echo $lease['TotalOccupants']; ?></td>
                    <td>
                    <a href="javascript:confirm_delete_lease('<?php echo $lease['ParcelNo']?>', '<?php echo $lease['UnitNo']?>', '<?php echo $lease['StartOfLease']?>')" id="delete-lease-button">
                    <button id="delete_button">Delete</button>
                    </a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
            ?>
        </table>

        <!-- if exclude button is clicked, the ff table will be displayed -->
        <table id="active_lease_only" hidden>
            <tr>
                <th>Parcel Number</th>
                <th>Unit Number</th>
                <th>Tenant</th>
                <th>Start of Lease</th>
                <th>End of Lease</th>
                <th>Total Occupants</th>
                <th>Delete</th>
            </tr>
            <?php
                while ($lease = mysqli_fetch_assoc($active_records)) {
            ?>
                    <tr>
                        <td><?php echo $lease['ParcelNo']; ?></td>
                        <td><?php echo $lease['UnitNo']; ?></td>
                        <td><?php echo $lease['Tenant']; ?></td>
                        <td><?php echo $lease['StartOfLease']; ?></td>
                        <td><?php echo $lease['EndOfLease']; ?></td>
                        <td><?php echo $lease['TotalOccupants']; ?></td>
                        <td>
                        <a href="javascript:confirm_delete_lease('<?php echo $lease['ParcelNo']?>', '<?php echo $lease['UnitNo']?>', '<?php echo $lease['StartOfLease']?>')" id="delete-lease-button">
                        <button id="delete_button">Delete</button>
                        </a>
                        </td>
                    </tr>
        <?php
                }
            ?>
        </table>

        <?php
        if(isset($_GET['parcelno'])){
            $parcel_no = $_GET['parcelno'];
            $active_lease = find_active_lease($parcel_no); ?>
            <script type="text/javascript">
                document.getElementById("all_leases").hidden = true;
                document.getElementById("active_lease_only").hidden = true;
                document.getElementById('exclude_button').style.display = "none";
                document.getElementById('include_button').style.display = "none";
            </script>

            <table id="property_active_lease">
            <tr>
                <th>Parcel Number</th>
                <th>Unit Number</th>
                <th>Tenant</th>
                <th>Start of Lease</th>
                <th>End of Lease</th>
                <th>Total Occupants</th>
                <th>Delete</th>
            </tr>
            <?php
                while ($lease = mysqli_fetch_assoc($active_lease)) {
            ?>
                    <tr>
                        <td><?php echo $lease['ParcelNo']; ?></td>
                        <td><?php echo $lease['UnitNo']; ?></td>
                        <td><?php echo $lease['Tenant']; ?></td>
                        <td><?php echo $lease['StartOfLease']; ?></td>
                        <td><?php echo $lease['EndOfLease']; ?></td>
                        <td><?php echo $lease['TotalOccupants']; ?></td>
                        <td>
                        <a href="javascript:confirm_delete_lease('<?php echo $lease['ParcelNo']?>', '<?php echo $lease['UnitNo']?>', '<?php echo $lease['StartOfLease']?>')" id="delete-lease-button">
                        <button id="delete_button">Delete</button>
                        </a>
                        </td>
                    </tr>
        <?php
                }
            }
        ?>
        </table>
        
        <?php
        if(isset($_GET['parcelno']) && isset($_GET['unitno'])){
            $parcel_no = $_GET['parcelno'];
            $unit_no = $_GET['unitno'];
            $lease_history = find_unit_lease($parcel_no, $unit_no); ?>
            <script type="text/javascript">
                document.getElementById("all_leases").hidden = true;
                document.getElementById("active_lease_only").hidden = true;
                document.getElementById("property_active_lease").hidden = true;
                document.getElementById('exclude_button').style.display = "none";
                document.getElementById('include_button').style.display = "none";
            </script>

            <table id="unit_lease">
            <tr>
                <th>Parcel Number</th>
                <th>Unit Number</th>
                <th>Tenant</th>
                <th>Start of Lease</th>
                <th>End of Lease</th>
                <th>Total Occupants</th>
                <th>Delete</th>
            </tr>
            <?php
            if (mysqli_num_rows($lease_history) > 0) {
                while ($lease = mysqli_fetch_assoc($lease_history)) {
            ?>
                    <tr>
                        <td><?php echo $lease['ParcelNo']; ?></td>
                        <td><?php echo $lease['UnitNo']; ?></td>
                        <td><?php echo $lease['Tenant']; ?></td>
                        <td><?php echo $lease['StartOfLease']; ?></td>
                        <td><?php echo $lease['EndOfLease']; ?></td>
                        <td><?php echo $lease['TotalOccupants']; ?></td>
                        <td>
                        <a href="javascript:confirm_delete_lease('<?php echo $lease['ParcelNo']?>', '<?php echo $lease['UnitNo']?>', '<?php echo $lease['StartOfLease']?>')" id="delete-lease-button">
                        <button id="delete_button">Delete</button>
                        </a>
                        </td>
                    </tr>
        <?php
                }
            }
            else{
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
        }
        ?>
        </table>

        <?php
        if(isset($_GET['parcelno']) && isset($_GET['unitno']) && isset($_GET['active'])){
            $parcel_no = $_GET['parcelno'];
            $unit_no = $_GET['unitno'];
            $unit_active_lease = find_active_unit_lease($parcel_no, $unit_no); ?>
            <script type="text/javascript">
                document.getElementById("all_leases").hidden = true;
                document.getElementById("active_lease_only").hidden = true;
                document.getElementById("property_active_lease").hidden = true;
                document.getElementById("unit_lease").hidden = true;
                document.getElementById('exclude_button').style.display = "none";
                document.getElementById('include_button').style.display = "none";
            </script>

            <table id="unit_active_lease">
            <tr>
                <th>Parcel Number</th>
                <th>Unit Number</th>
                <th>Tenant</th>
                <th>Start of Lease</th>
                <th>End of Lease</th>
                <th>Total Occupants</th>
                <th>Delete</th>
            </tr>
            <?php
            if (mysqli_num_rows($unit_active_lease) > 0) {
                while ($lease = mysqli_fetch_assoc($unit_active_lease)) {
            ?>
                    <tr>
                        <td><?php echo $lease['ParcelNo']; ?></td>
                        <td><?php echo $lease['UnitNo']; ?></td>
                        <td><?php echo $lease['Tenant']; ?></td>
                        <td><?php echo $lease['StartOfLease']; ?></td>
                        <td><?php echo $lease['EndOfLease']; ?></td>
                        <td><?php echo $lease['TotalOccupants']; ?></td>
                        <td>
                        <a href="javascript:confirm_delete_lease('<?php echo $lease['ParcelNo']?>', '<?php echo $lease['UnitNo']?>', '<?php echo $lease['StartOfLease']?>')" id="delete-lease-button">
                        <button id="delete_button">Delete</button>
                        </a>
                        </td>
                    </tr>
        <?php
                }
            }
            else{
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
        }
        ?>
        </table>
    </div>
</body>
</html>
