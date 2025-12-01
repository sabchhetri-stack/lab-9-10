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

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

  
    <link rel="icon" href="img/algomau.png" type="image/png">

   
    <style>
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 255, 0.9%29' stroke-width='2' stroke-linecap='round' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
         html, body {
        height: 100%;
    }

    main {
        min-height: calc(100vh - 140px); 
    }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-secondary mb-5">
    <div class="container-fluid">
        <a id="algoma-link" class="navbar-brand text-white" href="https://algomau.ca" data-external="https://algomau.ca">Algoma University</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link text-info" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link text-info" href="labsolutions.php">Lab Solutions</a></li>
            </ul>

            
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

<!-- External site iframe container (hidden by default). Click the Algoma University link to load the site here. -->
<div id="external-frame-container" style="display:none; position:fixed; inset:0; z-index:1050; background:#fff;">
    <div style="height:48px; background:#343a40; display:flex; align-items:center; padding:0 1rem;">
        <button id="external-frame-close" class="btn btn-sm btn-light">Close</button>
        <span id="external-frame-title" class="text-white ms-3">Loading...</span>
    </div>
    <iframe id="external-frame" src="about:blank" style="border:0; width:100%; height:calc(100% - 48px);"></iframe>
</div>

<main class="container-fluid">

<script>
    (function(){
        var link = document.getElementById('algoma-link');
        var container = document.getElementById('external-frame-container');
        var iframe = document.getElementById('external-frame');
        var closeBtn = document.getElementById('external-frame-close');
        var title = document.getElementById('external-frame-title');

        if (!link) return;

        function openExternal(e){
            var url = link.getAttribute('data-external') || link.href;
            // Try to load in iframe first
            try {
                iframe.src = url;
                title.textContent = url;
                container.style.display = 'block';
                // Prevent default navigation
                e && e.preventDefault();
            } catch (err) {
                // Fallback: navigate in same window
                window.location.href = url;
            }
        }

        link.addEventListener('click', function(e){
            // If user holds ctrl/meta, allow default (open in new tab)
            if (e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;
            openExternal(e);
        });

        closeBtn.addEventListener('click', function(){
            iframe.src = 'about:blank';
            container.style.display = 'none';
        });

        // If iframe fails to load due to X-Frame-Options, detect and fallback after a short timeout
        iframe.addEventListener('load', function(){
            // A simple heuristic: if iframe's location cannot be read or contentWindow.document.body is empty, we can't reliably detect cross-origin denial.
            // We'll attempt to access a simple property; if it throws, we assume cross-origin and embedding may be blocked.
            try {
                // Accessing href will throw for cross-origin, but some browsers allow it; so use a timeout fallback
                var doc = iframe.contentDocument || iframe.contentWindow.document;
                // If we get here, embedding succeeded (same-origin) — nothing else to do.
            } catch (err) {
                // Likely blocked by X-Frame-Options or CSP. Fallback to navigating in same window.
                var url = link.getAttribute('data-external') || link.href;
                container.style.display = 'none';
                window.location.href = url;
            }
        });
    })();
</script>
