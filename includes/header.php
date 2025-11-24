<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($title)) $title = "My Site";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- Favicon -->
    <link rel="icon" href="img/algomau.png" type="image/png">

    <!-- Fix navbar-toggler-icon visibility -->
    <style>
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 255, 0.9%29' stroke-width='2' stroke-linecap='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
         html, body {
        height: 100%;
    }

    main {
        min-height: calc(100vh - 140px); /* pushes footer to bottom */
    }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-secondary mb-5">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="index.php">Algoma University</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-info" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-info" href="labsolutions.php">Lab Solutions</a></li>
            </ul>

            <!-- Right side buttons -->
            <?php if (isset($_SESSION["user_id"])): ?>
                <span class="text-white me-2 fw-bold">
                    Hello, <?= htmlspecialchars($_SESSION["username"]) ?>
                </span>
                <a href="logout.php" class="btn btn-info btn-sm">Logout</a>
            <?php else: ?>
                <a href="signupform.php" class="btn btn-info btn-sm me-2">Sign Up</a>
                <a href="loginform.php" class="btn btn-info btn-sm">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="container-fluid">
