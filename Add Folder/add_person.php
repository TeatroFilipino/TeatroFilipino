<?php
include('connection.php');
include('navbar.html');
include('query_functions.php');

$id = $_REQUEST['new_id'];
$name = trim($_REQUEST['name']);
$address = trim($_REQUEST['address']);
$general_num = trim($_REQUEST['general_num']);
$emergency_num = trim($_REQUEST['emergency_num']);
$email = trim($_REQUEST['email']);

$adding_person = add_person($id, $name, $address, $general_num, $emergency_num, $email);

if($adding_person){
    echo '<script>
            alert("Person added successfully.");
            window.location.replace("persons.php");
        </script>';
}
else{
    echo '<script>
            alert("Error: '. mysqli_error($conn) .'");
            window.location.replace("persons.php");
        </script>';
}
?>