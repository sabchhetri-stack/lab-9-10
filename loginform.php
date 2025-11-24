<?php
$title = "Login";
require_once 'includes/header.php';
?>

<h2 class="mb-4">Login</h2>

<form method="POST" action="login.php">

    <div class="mb-3">
        <label>Email Address</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-primary">Login</button>

</form>

<?php require_once 'includes/footer.php'; ?>
