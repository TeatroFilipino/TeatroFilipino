<?php
// include the connection to the db
include('connection.php');
include('query_functions.php');

// to display the navbar in the webpage
include('navbar.html');

// identifier for which person to display, got from the view hyperlink
$id = $_REQUEST['id'];

// query to retrieve the record per person
$person_details = fetch_by_id("*","persons","ID",$id);

// retrieves details of lease the person is in
$lease_details = fetch_by_id_result("ParcelNo, UnitNo, StartOfLease, EndOfLease","lease_info","TenantID",$id);

// retrieves properties owned by the person
$props_owned = fetch_by_id_result("ParcelNo","property_info","OwnerID",$id);

// retrieves properties managed by the person
$props_managed = fetch_by_id_result("ParcelNo","property_info","ManagerID",$id);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $id, " - ", $person_details['Name']; ?></title>
    <script src="helperFunctions.js"></script>
    <link rel="stylesheet" type="text/css" href="person_details.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        .parcel-no-spacing p {
            margin: 0 0 1.0em;
        }
    </style>
    <script src='delete.js'></script>
</head>
<body>
    <div id="title_container">
        <a href="persons.php" id="title">
            Persons<i class="material-icons">keyboard_double_arrow_right</i>
        </a>
        <span id='person_id'><em><?php echo $id; ?></em></span> <span id='Name'><em><?php echo $person_details['Name']; ?></em></span>
    </div>
    <hr>
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
        <div id='col1' class="parcel-no-spacing">
            <!-- details of lease properties owned by the person -->
            <?php 
            if (mysqli_num_rows($props_owned) > 0) { ?>
                <h3>Owner of</h3>
                <?php
                while ($property = mysqli_fetch_assoc($props_owned)) {
                    ?>
                    <p>
                        <a href="property_details.php?id=<?php echo $property['ParcelNo']; ?>">
                            <?php echo $property['ParcelNo']; ?>
                        </a>
                    </p>
                <?php 
                }
            }
            ?>

            <!-- details of lease properties managed by the person -->
            <?php
            if (mysqli_num_rows($props_managed) > 0) { ?>
                <h3>Manager at</h3>
                <?php
                while ($property = mysqli_fetch_assoc($props_managed)) {
                    ?>
                    <p>
                        <a href="property_details.php?id=<?php echo $property['ParcelNo']; ?>">
                            <?php echo $property['ParcelNo']; ?>
                        </a>
                    </p>
                <?php 
                }
            }
            ?>

            <!-- details of lease the person is in -->
            <?php 
            if (mysqli_num_rows($lease_details) > 0) { ?>
                <h3>Tenant at</h3>
                <?php
                while ($lease = mysqli_fetch_assoc($lease_details)) {
                    ?>
                    <p>
                        <a href="property_details.php?id=<?php echo $lease['ParcelNo']; ?>">
                            <?php echo $lease['ParcelNo']; ?> Unit <?php echo $lease['UnitNo']; ?>
                        </a>
                        since <?php echo $lease['StartOfLease']; ?> until <?php echo $lease['EndOfLease']; ?>
                    </p>
                <?php
                }
            }
            ?>
            <br>
            <br>
            <h3>ID</h3>
            <p><?php echo $id; ?></p>
            <h3>Name</h3>
            <p><?php echo $person_details['Name']; ?></p>
            <h3>Address</h3>
            <p><?php echo $person_details['Address']; ?></p>
        </div>
        <div id='col2'>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h3>General Number</h3>
            <p><?php echo $person_details['GeneralNum']; ?></p>
            <h3>Emergency Number</h3>
            <p><?php echo $person_details['EmergencyNum']; ?></p>
        </div>
        <span id='person_icon'><img src='images/person-icon.png'></span>
    </div>
</body>
</html>
