<!-- ADD A LEASES -->

<?php
// to display the navbar in the webpage
include('navbar.html');
// include connection to the database
include('connection.php');
include('query_functions.php');

// Receiving data from add_lease_form.php
$parcel_no = $_REQUEST['existing_parcel_no'];
$unit_no = $_REQUEST['existing_unit_no'];
$start_of_lease = $_REQUEST['start_of_lease'];
$end_of_lease = $_REQUEST['end_of_lease'];
$total_occupants = trim($_REQUEST['total_occupants']);

// if existing tenat id is not set, then new tenant is being added, data included in the form will be added to persons table
if(empty($_REQUEST['existing_tenant_id'])){
    $tenant_id = $_REQUEST['new_tenant_id'];
    $tenant_name = trim($_REQUEST['tenant_name']);
    $tenant_adrs = trim($_REQUEST['tenant_address']);
    $tenant_gnum = trim($_REQUEST['tenant_general_num']);
    $tenant_emgnum = trim($_REQUEST['tenant_emergency_num']);
    $tenant_email = trim($_REQUEST['tenant_email']);

    // adding tenant to persons table using add_person function from query_functions.php
    $adding_tenant = add_person($tenant_id, $tenant_name, $tenant_adrs, $tenant_gnum, $tenant_emgnum, $tenant_email);
    if(!$adding_tenant){
        echo '<script>alert("Error: '. mysqli_error($conn) .'");</script>';
    }
} else { 
    // if existing tenant id is set, then existing tenant id is recorded into the lease_info table
    $tenant_id = $_POST['existing_tenant_id'];
}

// Insert the lease information into the lease_info table
$adding_lease = add_lease($parcel_no, $unit_no, $tenant_id, $start_of_lease, $end_of_lease, $total_occupants);

if ($adding_lease) {
    echo '<script>
            alert("Lease added successfully.");
            window.location.replace("leases.php");
          </script>';
} else {
    $error = mysqli_error($conn);
    echo '<script>
            alert("Error: ' . $error . '");
            window.location.replace("leases.php");
          </script>';
}
?>
