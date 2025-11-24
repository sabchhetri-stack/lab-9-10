<?php
session_start();
require_once "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $fname = trim($_POST['fname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $province = trim($_POST['province'] ?? '');
    $postal = trim($_POST['postal'] ?? '');

    if ($password !== $confirm) {
        die("Passwords do not match.");
    }

    if ($fname === '' || $lname === '' || $username === '' || $email === '' || $password === '') {
        die("Please fill in all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Please provide a valid email address.");
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

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

    if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['username'] = $username;

        header("Location: welcome.php");
        exit;
    } else {
        echo "Database Error: " . $stmt->error;
    }

} else {
    header('Location: signupform.php');
    exit;
}
?>
