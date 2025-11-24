<?php
session_start();
require_once 'includes/db.php';

if (!isset($_POST['email'], $_POST['password'])) {
    die("Please fill in all fields.");
}

$email = trim($_POST['email']);
$password = $_POST['password'];

$stmt = $mysqli->prepare("SELECT id, username, password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Invalid Email or Password.";
    exit;
}

$user = $result->fetch_assoc();
if (!password_verify($password, $user['password'])) {
    echo "Invalid Email or Password.";
    exit;
}
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
header("Location: labsolutions.php");
exit;
?>
