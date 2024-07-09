<?php

if (empty($_POST["username"])) {
    die("Username is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$mysqli = require __DIR__ . "/../connection.php";

// Check if the connection was successful
if (!$mysqli) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO admin (username, email, password_hash)
        VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (!$stmt) {
    die("Statement initialization failed: " . $mysqli->error);
}

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $stmt->error);
}

$stmt->bind_param("sss",
    $_POST["username"],
    $_POST["email"],
    $password_hash);

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

if ($stmt->execute()) {
    header("Location: signup-success.html");
    exit;
} else {
    if ($mysqli->errno === 1062) {
        die("Email already taken");
    } else {
        die("Execution error: " . $stmt->error);
    }
}
