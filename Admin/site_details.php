<?php
// include the connection to the db
include('../connection.php');
include('query_functions.php');
include('delete_functions.php');

// to display the navbar in the webpage
include('navbar.html');

// identifier for which site to display, got from the view hyperlink
$id = $_REQUEST['id'];

// retrieves details of the site
$site_details = fetch_by_id(array(
    'col' => 'site_Code, site_Name, site_Address, site_Class, site_Category, site_Proximity, site_Desc, S_itinerary_Code',
    'table' => 'site', // table name
    'id_col' => 'site_Code', // column name
    'id' => $id
));

/*
// retrieves details of lease the site is in
$lease_details = fetch_by_id_result("ParcelNo, UnitNo, StartOfLease, EndOfLease","lease_info","TenantID",$id);

// retrieves properties owned by the site
$all_owner = all_owner();
$props_owned = array();
if (mysqli_num_rows($all_owner) > 0) {
    while ($owner = mysqli_fetch_assoc($all_owner)) {
        if ($owner['ID'] == $id) {
            array_push($props_owned, $owner['ParcelNo']);
        }
    }
}

// retrieves properties managed by the site
$all_manager = all_manager();
$props_managed = array();
if (mysqli_num_rows($all_manager) > 0) {
    while ($manager = mysqli_fetch_assoc($all_manager)) {
        if ($manager['ID'] == $id) {
            array_push($props_managed, $manager['ParcelNo']);
        }
    }
}

// retrieves number of properties owned by the site
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

$owned_per_prop_type = count_per_prop_type($id); */

if(isset($_GET['delete'])){
    delete_site($id);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $id, " - ", $site_details['site_Name']; ?></title>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="admin_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src='delete.js'></script>
</head>
<body>
    <div id="title_container">
        <a href="site.php" id="title">
            Sites<i class="material-icons">keyboard_double_arrow_right</i>
        </a>
        <span id='site_id' style='font-size: 30px;'><em><?php echo $id; ?></em>,&nbsp;</span> <span id='site_Name' style='font-size: 30px;'><em><?php echo $site_details['site_Name']; ?></em></span>
    </div>
    <hr>
    <div id=body>
    <div id="actions_container">
        <h1 id="actions_title">Actions</h1>
        <!-- button for deletion -->
            <a href="javascript:confirm_delete_site('<?php echo $id?>')">

                <button id="delete_button">
                    <i class="material-icons">delete</i>Delete
                </button>
            </a>

    </div>
    <div id='details_container'>
        <div id='row1' class="parcel-no-spacing">
            <!-- details of --- site -->
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

            <!-- details of --- site -->
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

<script>
    function confirm_delete_site(id) {
        var confirmDelete = confirm("Are you sure you want to delete this site?");
        if (confirmDelete) {
            window.location.href = 'site_details.php?id=' + id + '&delete=true';
        }
    }
</script>