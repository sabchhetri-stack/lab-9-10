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
    /* Ensure navbar stays above iframe overlay */
    nav.navbar { position: relative; z-index: 1100; }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg bg-secondary mb-5">
    <div class="container-fluid">
        <a id="algoma-link" class="navbar-brand text-white" href="algomau.php" data-external="https://algomau.ca">Algoma University</a>

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


<div id="external-frame-container" style="display:none; position:fixed; left:0; right:0; bottom:0; top:0; z-index:1050; background:#fff;">
    <div id="external-frame-bar" style="height:48px; background:#343a40; display:flex; align-items:center; padding:0 1rem;">
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

        function sizeContainerBelowHeader() {
            // compute header/navbar bottom so iframe sits below it reliably
            var headerEl = document.querySelector('nav.navbar');
            var topOffset = 0;
            if (headerEl) {
                var rect = headerEl.getBoundingClientRect();
                // use rect.bottom to get the pixel position below the navbar
                topOffset = Math.ceil(rect.bottom);
            }
            // set top and height so the header remains visible
            container.style.top = topOffset + 'px';
            container.style.height = 'calc(100% - ' + topOffset + 'px)';
            // ensure the iframe fills the remaining area under the bar
            var barH = document.getElementById('external-frame-bar').getBoundingClientRect().height;
            iframe.style.height = 'calc(100% - ' + Math.ceil(barH) + 'px)';
        }

        function openExternal(e){
            var url = link.getAttribute('data-external') || link.href;
            // Try to load in iframe first
            try {
                // size container before showing to avoid covering header
                sizeContainerBelowHeader();
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

        // Recompute sizes when window resizes while container is visible
        window.addEventListener('resize', function(){
            if (container.style.display === 'block') {
                try { sizeContainerBelowHeader(); } catch(e){}
            }
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
