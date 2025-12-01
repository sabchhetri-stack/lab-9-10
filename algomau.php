<?php
// Minimal local page that attempts to embed Algoma's site in an iframe.
// This page is intended to be loaded into the main overlay iframe so the browser URL stays on your site.
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Algoma University (embedded)</title>
  <style>
    html,body{height:100%;margin:0}
    #remote{border:0;width:100%;height:100%}
    .fallback{padding:1rem;font-family:Arial,Helvetica,sans-serif}
  </style>
</head>
<body>
  <iframe id="remote" src="https://algomau.ca"></iframe>
  <div id="fallback" class="fallback" style="display:none;">
    <h3>Unable to embed Algoma University site</h3>
    <p>The website prevented embedding in this page. You can open it in the same tab by clicking below:</p>
    <p><a id="fallback-link" href="https://algomau.ca" target="_self">Open Algoma University</a></p>
  </div>

  <script>
    (function(){
      var iframe = document.getElementById('remote');
      var fallback = document.getElementById('fallback');
      var loaded = false;

      // If embedding is blocked by X-Frame-Options/CSP, accessing the iframe's document will throw.
      // We'll wait a short time after load and then test access.
      iframe.addEventListener('load', function(){
        try {
          var doc = iframe.contentDocument || iframe.contentWindow.document;
          // If we can read doc.title or similar, embedding succeeded.
          var title = doc && doc.title;
          loaded = true;
        } catch (err) {
          // Cross-origin access thrown -> probably blocked
          loaded = false;
        }
        setTimeout(function(){
          if (!loaded) {
            iframe.style.display = 'none';
            fallback.style.display = 'block';
          }
        }, 300);
      });
    })();
  </script>
</body>
</html>
<?php include "includes/header.php"; ?>
<div style="width: 100%; height: 90vh; overflow: hidden;">
    <iframe
        src="https://www.algomau.ca"
        style="border: none; width: 100%; height: 100%;">

    </iframe>
</div>

   

<?php require_once "includes/footer.php"; ?>
