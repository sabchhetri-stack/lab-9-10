<?php 
$title = "Sign Up";
require_once "includes/header.php";
?>

<h2 class="text-center mb-4">Sign Up</h2>

<form action="signup.php" method="POST" class="w-75 mx-auto">

    <div class="row mb-3">
        <div class="col">
            <label class="form-label">First Name</label>
            <input type="text" name="fname" class="form-control" required>
        </div>
        <div class="col">
            <label class="form-label">Last Name</label>
            <input type="text" name="lname" class="form-control" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label class="form-label">User Name</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="col">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="col">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Address</label>
        <input type="text" name="address" class="form-control" required>
    </div>

    <div class="row mb-4">
        <div class="col">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" required>
        </div>
        <div class="col">
            <label class="form-label">Province</label>
            <select name="province" class="form-select" required>
                <option value="">Choose...</option>
                <option>Ontario</option>
                <option>Quebec</option>
                <option>British Columbia</option>
                <option>Alberta</option>
            </select>
        </div>
        <div class="col">
            <label class="form-label">Postal Code</label>
            <input type="text" name="postal" class="form-control" required>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary px-4">Submit</button>
    </div>

</form>

<?php require_once "includes/footer.php"; ?>
