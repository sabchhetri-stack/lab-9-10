<?php
$title = "Lab Solutions";
require_once "includes/header.php";

if (!isset($_SESSION['user_id'])) {
    die("You must log in to see this page.");
}
?>

<h2>Lab Solutions</h2>
<p>Welcome to the member-only area.</p>

<?php require_once "includes/footer.php"; ?>
