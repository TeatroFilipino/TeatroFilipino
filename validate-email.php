<?php

$mysqli = require __DIR__ . "/connection.php";

$sql = sprintf("SELECT * FROM user
                WHERE username = '%s'",
                $mysqli->real_escape_string($_GET["username"]));
                
$result = $mysqli->query($sql);

$is_available = $result->num_rows === 0;

header("Content-Type: application/json");

echo json_encode(["available" => $is_available]);