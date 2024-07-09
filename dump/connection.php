<?php
$servername = "localhost";
$username = "root";
$password = "hp1020";
$db = "tenant_landlord_information";

// creating the connection
$conn = new mysqli($servername, $username, $password, $db);

// check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully!\n\n";
?>