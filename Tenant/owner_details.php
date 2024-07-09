<?php
// include the connection to the db
include('connection.php');
include('connect.php');
include('query_functions.php');
include('delete_functions.php');

// to display the navbar in the webpage
include('navbar.html');

// identifier for which owner to display, got from the view hyperlink
$id = $_REQUEST['id'];

// retrieves details of the owner
$owner_details = fetch_by_id("owner_ID, surName, firstName, midName, contactNo, emailAdd","owners","owner_ID",$id);

// retrieves details of lease the owner is in
$lease_details = fetch_by_id_result("ParcelNo, UnitNo, StartOfLease, EndOfLease","lease_info","TenantID",$id);

// retrieves number of properties owned by the owner
$owned_property = count_owned_property();
if (mysqli_num_rows($owned_property) > 0) {
    while ($owned = mysqli_fetch_assoc($owned_property)) {
        if ($owned['OwnerID'] == $id) {
            $owned_properties = $owned['Owned Properties'];
        }
    }
}

$managed_property = count_managed_property();
if (mysqli_num_rows($managed_property) > 0) {
    while ($managed = mysqli_fetch_assoc($managed_property)) {
        if ($managed['ManagerID'] == $id) {
            $managed_properties = $managed['Managed Properties'];
        }
    }
}

$lease_count = count_lease();
if (mysqli_num_rows($lease_count) > 0) {
    while ($lease = mysqli_fetch_assoc($lease_count)) {
        if ($lease['TenantID'] == $id) {
            $count = $lease['Lease Count'];
        }
    }
}

$owned_per_prop_type = count_per_prop_type($id);

// retrieves details of lease properties owned by the owner (additional variable definition)
$props_owned = get_properties_owned_by_owner($id);

// retrieves details of lease properties managed by the owner (additional variable definition)
$props_managed = get_properties_managed_by_owner($id);

if(isset($_GET['delete'])){
    delete_person($id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $id, " - ", $owner_details['surName'], " ", $owner_details['firstName']; ?></title>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="owner_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src='delete.js'></script>
</head>
<body>
    <div id="title_container">
        <a href="owners.php" id="title">
            Owners<i class="material-icons">keyboard_double_arrow_right</i>
        </a>
        <span id='person_id'><em><?php echo $id; ?></em></span>
        <span id='Name'><em><?php echo $owner_details['surName'], " ", $owner_details['firstName']; ?></em></span>
    </div>
    <hr>
    <div id="body">
        <div id="actions_container">
            <h1 id="actions_title">Actions</h1>
            <!-- button for deletion -->
            <a href="javascript:confirm_delete_person(<?php echo $id?>)">
                <button id="delete_button">
                    <i class="material-icons">delete</i>Delete
                </button>
            </a>
        </div>
        <div id='details_container'>
            <div id='row1' class="parcel-no-spacing">
                <!-- details of lease properties owned by the owner -->
                <?php
                if (!empty($props_owned)) { ?>
                    <h3>Owner of</h3>
                    <?php
                    foreach ($props_owned as $parcel_no) {
                        ?>
                        <p>
                            <a href="property_details.php?id=<?php echo $parcel_no; ?>">
                                <?php echo $parcel_no; ?>
                            </a>
                        </p>
                    <?php 
                    }
                }
                ?>
                <!-- details of lease properties managed by the owner -->
                <?php
                if (!empty($props_managed)) { ?>
                    <h3>Manager at</h3>
                    <?php
                    foreach ($props_managed as $parcel_no) {
                        ?>
                        <p>
                            <a href="property_details.php?id=<?php echo $parcel_no; ?>">
                                <?php echo $parcel_no; ?>
                            </a>
                        </p>
                    <?php 
                    }
                }
                ?>
                <!-- details of lease the owner is in -->
                <?php 
                if (mysqli_num_rows($lease_details) > 0) { ?>
                    <h3>Tenant at</h3>
                    <?php
                    while ($lease = mysqli_fetch_assoc($lease_details)) {
                        ?>
                        <p>
                            <a href="unit_details.php?parcel_no=<?php echo $lease['ParcelNo']; ?>&unit_no=<?php echo $lease['UnitNo'];?>">
                                <?php echo "Parcel ", $lease['ParcelNo']; ?> Unit <?php echo $lease['UnitNo'];?></a>
                            since <?php echo $lease['StartOfLease']; ?> until <?php echo $lease['EndOfLease']; ?>
                        </p>
                    <?php
                    }
                }
                ?>
            </div>
            <div id='row2'>
                <div id='row2col1'>
                    <h3>ID</h3>
                    <p><?php echo $id; ?></p>
                    <h3>Name</h3>
                    <p><?php echo $owner_details['surName'], " ", $owner_details['firstName']; ?></p>
                    <h3>Contact Number</h3>
                    <p><?php echo $owner_details['contactNo']; ?></p>
                </div>
                <div id='row2col2'>
                    <h3>Email Address</h3>
                    <p><?php echo $owner_details['emailAdd']; ?></p>
                </div>
                <span id='person_icon'><img src='images/person-icon.png'></span>
            </div>
        </div>
    </div>
    <div id='more_info'>
        <h3>More Information</h3>
        <span id='labels'>
            <em><h4>Number of Properties Owned</h4></em>
            <em><h4>Number of Properties Managed</h4></em>
            <em><h4>Number of Leases</h4></em>
        </span>
        <span id='values'>
            <h4><?php if (!empty($owned_properties)){
                echo $owned_properties;
                } else {
                    echo "0";
                }  ?>
            </h4>
            <h4><?php if (!empty($managed_properties)){
                echo $managed_properties;
                } else {
                    echo "0";
                }  ?></h4>
            <h4><?php if (!empty($count)){
                echo $count;
                } else {
                    echo "0";
                }  ?></h4>
        </span>
        <span id='property_types_owned'>
            <table width='30%'>
                <tr>
                    <th>Property Types Owned</th>
                </tr>
                <?php
                    if (mysqli_num_rows($owned_per_prop_type) > 0) {
                        while($type = mysqli_fetch_assoc($owned_per_prop_type)) { ?>
                        <tr>
                            <td><em><?php echo $type['PropType']; ?></em></td>
                            <td><?php echo $type['Count']; ?> </td>
                        </tr>
                        <?php
                        }
                    }
                    else { ?>
                        <tr>
                            <td colspan="8">No record found</td>
                        </tr>
                <?php
                    } ?>
            </table>
        </span>
    </div>
</body>
</html>
