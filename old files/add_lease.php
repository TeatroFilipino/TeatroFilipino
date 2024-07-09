<!-- ADD A LEASES -->

<?php
// to display the navbar in the webpage
include('navbar.html');
// include connection to the database
include('connection.php');
include('alerts.php');

// Receiving data from add_lease_form.php
$parcel_no = $_POST['existing_parcel_no'];
$unit_no = $_POST['existing_unit_no'];
$start_of_lease = trim($_POST['start_of_lease']);
$end_of_lease = trim($_POST['end_of_lease']);
$total_occupants = trim($_POST['total_occupants']);

// if existing tenat id is not set, then new tenant is being added, data included in the form will be added to persons table
if(empty($_REQUEST['existing_tenant_id'])){
    $new_tenant_id = $_REQUEST['new_tenant_id'];
    $tenant_name = trim($_REQUEST['tenant_name']);
    $tenant_adrs = trim($_REQUEST['tenant_address']);
    $tenant_gnum = trim($_REQUEST['tenant_general_num']);
    $tenant_emgnum = trim($_REQUEST['tenant_emergency_num']);
    $tenant_email = trim($_REQUEST['tenant_email']);

    // adding tenant to persons table using add_person function from query_functions.php
    $adding_tenant = add_person($new_tenant_id, $tenant_name, $tenant_adrs, $tenant_gnum, $tenant_emgnum, $tenant_email);
    if(!$adding_tenant){
        echo '<script>alert("Error: '. mysqli_error($conn) .'");</script>';
    }
} else { 
    // if existing tenant id is set, then existing tenant id is recorded into the lease_info table
    $tenant_id = $_POST['existing_tenant_id'];
}

/*
// Debugging statements
echo "Parcel No: " . $parcel_no . "<br>";
echo "Unit No: " . $unit_no . "<br>";
echo "Tenant ID: " . $tenant_id . "<br>";

// Check if tenant exists in persons table
$query = "SELECT COUNT(*) as count FROM persons WHERE ID = $tenant_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$tenant_exists = $row['count'] > 0;

if (!$tenant_exists) {
    $error = "Tenant does not exist.";
}

if (isset($error)) {
    echo '<script>
            alert("Error: ' . $error . '");
            window.location.replace("leases.php");
          </script>';
  exit;
} */

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

// Function to insert a new tenant into the persons table
function add_person($tenant_name, $tenant_address, $tenant_general_num, $tenant_emergency_num, $tenant_email) {
    global $conn;
    $query = "INSERT INTO persons (Name, Address, GeneralNum, EmergencyNum, Email) 
              VALUES ('$tenant_name', '$tenant_address', '$tenant_general_num', '$tenant_emergency_num', '$tenant_email')";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Function to insert a new lease into the lease_info table
function add_lease($parcel_no, $unit_no, $tenant_id, $start_of_lease, $end_of_lease, $total_occupants) {
    global $conn;
    $query = "INSERT INTO lease_info (ParcelNo, UnitNo, TenantID, StartOfLease, EndOfLease, TotalOccupants) 
              VALUES ('$parcel_no', '$unit_no', '$tenant_id', '$start_of_lease', '$end_of_lease', '$total_occupants')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $error = mysqli_error($conn);
        echo "SQL Error: " . $error;
        exit;
    }
    return $result;
}
?>
