<?php
// include the connection to the db
include('connection.php');
include('query_functions.php');
include('delete_functions.php');

// to display the navbar in the webpage
include('navbar.html');

// identifier for which property to display, got from the view hyperlink
$id = $_REQUEST['id'];

// query to retrieve the record
$all_records = all_property();
$more_details = more_property_details();
$ave_duration = ave_lease_duration();
$total_occupants = sum_total_occupants();
$active_lease = count_active_lease();
$count_per_unit_type = unit_type_per_property($id);
$units = view_units($id);

if (mysqli_num_rows($all_records) > 0) {
    while($record = mysqli_fetch_assoc($all_records)) { 
        if ($record['ParcelNo'] == $id) {
            $prop_details = $record;
        }
    }
}

if (mysqli_num_rows($more_details) > 0) {
    while($record = mysqli_fetch_assoc($more_details)) { 
        if ($record['ParcelNo'] == $id) {
            $more_prop_details = $record;
        }
    }
}

if (mysqli_num_rows($ave_duration) > 0) {
    while($record = mysqli_fetch_assoc($ave_duration)) {
        if ($record['ParcelNo'] == $id) {
            $ave_lease_duration = $record;
        }
    }
}

if (mysqli_num_rows($total_occupants) > 0) {
    while($record = mysqli_fetch_assoc($total_occupants)) {
        if ($record['ParcelNo'] == $id) {
            $sum_total_occupants = $record;
        }
    }
}

if (mysqli_num_rows($active_lease) > 0) {
    while($record = mysqli_fetch_assoc($active_lease)) {
        if ($record['ParcelNo'] == $id) {
            $count_active_lease = $record;
        }
    }
}

if(isset($_GET['delete'])){
    delete_property($id);
}

?>

<!-- html which displays data fetched from the db -->
<!DOCTYPE html>
<html>
<head>
    <title>Parcel <?php echo $id; ?></title>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="property_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <div id="title_container">
        <a href="properties.php" id="title">
            Properties<i class="material-icons">keyboard_double_arrow_right</i>
        </a>
        <span id='parcel_no'><em><?php echo $id; ?></span></em>
    </div>
    <hr>
    <div id=body>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>
        <!-- button for deletion -->
        <a href="javascript:confirm_delete_property(<?php echo $id?>)">
            <button id="delete_button">
                <i class="material-icons">delete</i>Delete
            </button>
        </a>
        <button id="view_units" onclick="document.location='units.php?parcelno=<?php echo $id ?>'">
            <i class="material-icons">view_list</i><p>View Units</p>
        </button>
    </div>
    <div id='details_container'>
        <div id='col1'>
            <h3>Parcel Number</h3>
            <p><?php echo $id; ?></p>
            <h3>Property Address</h3>
            <p><?php echo $prop_details['PropAddress']; ?></p>
            <h3>Property Type</h3>
            <p><?php echo $more_prop_details['PropType']; ?></p>
            <h3>Number of Units</h3>
            <p><?php echo $more_prop_details['NoOfUnits']; ?></p>
                <table width=30%>
                <?php
                    if (mysqli_num_rows($count_per_unit_type) > 0) {
                        while($type = mysqli_fetch_assoc($count_per_unit_type)) { ?>
                        <tr>
                            <td><em><?php echo $type['UnitTypeID']; ?></em></td>
                            <td><?php echo $type['Count']; ?> </td>
                        <tr>
                        <?php
                        }
                    }
                    else { ?>
                        <tr>
                            <td colspan="8">No records of units found</td>
                        </tr>
                <?php
                    } ?>
                </table>
        </div>
        <div id='col2'>
            <h3>Owner</h3>
            <p><?php echo $prop_details['Owner']; ?></p>
            <h3>Manager</h3>
            <p><?php echo $more_prop_details['Manager']; ?></p>
        </div>
        <span id='prop_icon'><img src='images/property-icon.png'></img></span>
    </div>
    </div>
    <div id=more_info>
        <h3>More Information</h3>
        <span id=labels>
            <?php if(!empty($ave_lease_duration['Average Lease Duration'])){ ?>
                <em><h4>Average Lease Duration</h4></em>
                <em><h4>Total Occupants</h4></em>
                <em><h4>Active Leases</h4></em>
            <?php } ?>
        </span>
        <span id=values>
            <?php 
            if(!empty($ave_lease_duration['Average Lease Duration'])){ ?>
                <h4> <?php echo $ave_lease_duration['Average Lease Duration']; ?> </h4>
                <h4> <?php echo $sum_total_occupants['Total Occupants']; ?> </h4>
                <?php 
                    if(!empty($count_active_lease['Active Leases'])){ ?>
                <h4> <a href='leases.php?parcelno=<?php echo $id ?>'> View <?php echo $count_active_lease['Active Leases']; ?> lease/s </a></h4>
            <?php } 
                else { ?>
                    <h4> <?php echo 'No active leases'; ?> </h4>
            <?php }    
            }
            else { ?>
                <h4> <?php echo 'No leases found'; ?> </h4>
            <?php
            } ?>
        </span>
    </div>
</body>
</html>