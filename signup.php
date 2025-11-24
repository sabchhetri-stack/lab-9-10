<?php
session_start();
require_once "includes/db.php";

// Get form data (MUST match signupform.php)
$fname      = $_POST['fname'];
$lname      = $_POST['lname'];
$username   = $_POST['username'];
$email      = $_POST['email'];
$password   = $_POST['password'];
$confirm    = $_POST['confirm_password'];
$address    = $_POST['address'];
$city       = $_POST['city'];
$province   = $_POST['province'];
$postal     = $_POST['postal'];

// Check password match
if ($password !== $confirm) {
    die("Passwords do not match.");
}

// Hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Correct SQL for YOUR TABLE STRUCTURE
$sql = "INSERT INTO users 
        (first_name, last_name, username, email, password, address, city, province, postal_code)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param(
    "sssssssss",
    $fname,
    $lname,
    $username,
    $email,
    $hashed,
    $address,
    $city,
    $province,
    $postal
);

// Execute
if ($stmt->execute()) {

    // Start session for logged-in user
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['username'] = $username;

    header("Location: welcome.php");
    exit;

} else {
    echo "Database Error: " . $stmt->error;
}
?>
