<?php
$servername = "localhost";
$username = "root";
$password = "shitir0seia";
$db = "interactive_intramuros"; // place database name here

// creating the connection
$con = new mysql_connect($servername, $username, $password, $db);

// check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
echo "Connected successfully!\n\n";

return $con;
?>
