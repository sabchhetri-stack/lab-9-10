<?php
$mysqli = new mysqli("localhost", "root", "", "customers");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
