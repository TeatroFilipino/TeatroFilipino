<?php
include('connection.php');
include('navbar.html');
include('query_functions.php');
include('alerts.php');

// receiving data from add_property_form.php
$parcel_no = trim($_REQUEST['parcel_no']);
$prop_address = trim($_REQUEST['prop_address']);
$no_of_units = trim($_REQUEST['no_of_units']);
$prop_type = trim($_REQUEST['prop_type']);

// if existing owner id is not set, then new owner is being added, data included in the form will be added to persons table
if(empty($_REQUEST['existing_owner_id'])){
    $owner_id = $_REQUEST['new_owner_id'];
    $owner_name = trim($_REQUEST['ownr_name']);
    $owner_adrs = trim($_REQUEST['ownr_address']);
    $owner_gnum = trim($_REQUEST['ownr_general_num']);
    $owner_emgnum = trim($_REQUEST['ownr_emergency_num']);
    $owner_email = trim($_REQUEST['ownr_email']);

    // adding owner to persons table using add_person function from query_functions.php
    $adding_owner = add_person($owner_id, $owner_name, $owner_adrs, $owner_gnum, $owner_emgnum, $owner_email);
    if(!$adding_owner){
        echo '<script>alert("Error: '. mysqli_error($conn) .'");</script>';
    }
}
// if existing owner id is set, then existing owner id is recorded into the property_info table
else{ 
    $owner_id = $_REQUEST['existing_owner_id'];
}

// if existing manager id is not set, then new manager is being added, data included in the form will be added to persons table
if(empty($_REQUEST['existing_mgr_id'])){
    $manager_id = $_REQUEST['new_manager_id'];
    $manager_name = trim($_REQUEST['mgr_name']);
    $manager_adrs = trim($_REQUEST['mgr_address']);
    $manager_gnum = trim($_REQUEST['mgr_general_num']);
    $manager_emgnum = trim($_REQUEST['mgr_emergency_num']);
    $manager_email = trim($_REQUEST['mgr_email']);

    // adding manager to persons table using add_person function from query_functions.php
    $adding_manager = add_person($manager_id, $manager_name, $manager_adrs, $manager_gnum, $manager_emgnum, $manager_email);
    if(!$adding_manager){
        echo '<script>alert("Error: '. mysqli_error($conn) .'");</script>';
    }
}
// if existing manager id is set, then existing manager id is recorded into the property_info table
else{
    $manager_id = $_REQUEST['existing_mgr_id'];
}

// adding property to property_info table using add_property function from query_functions.php
$adding_property = add_property($parcel_no, $prop_address, $no_of_units, $prop_type, $owner_id, $manager_id);

// if property is added successfully, redirect to properties.php
if($adding_property){
    echo '<script>
            alert("Property added successfully.");
            window.location.replace("properties.php");
        </script>';
}
else {
    echo '<script>
        alert("Error: '. mysqli_error($conn) . '");
        window.location.replace("properties.php");
        </script>';
}
?>