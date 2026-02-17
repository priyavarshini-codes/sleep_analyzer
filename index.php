<?php
require 'db.php';

$user = $_SESSION['user'] ?? null;
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Sleep Quality Analyzer</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <div class="brand">
        <div class="logo">SQ</div>
        <div>
          <h1>Sleep Quality Analyzer</h1>
          <div class="small">Understand your sleep patterns and improve your rest.</div>
        </div>
      </div>
      <div>
        <?php if($user): ?>
          Hello, <?=htmlspecialchars($user['name'])?> |
          <a href="history.php" class="small">History</a> |
          <a href="logout.php" class="small">Logout</a>
        <?php else: ?>
          <a href="login.php" class="small">Login</a> |
          <a href="register.php" class="small">Register</a>
        <?php endif; ?>
      </div>
    </div>

    <div class="hero">
      <div class="left">
        <h2>Sleep Quality Analyzer</h2>
        <p class="small">Understand your sleep patterns and improve your rest.</p>
        <div class="cta">
          <a href="questionnaire.php" class="btn">Start Sleep Test →</a>
        </div>

        <div class="card-row">
          <div class="info-card">
            <strong>Sleep duration</strong>
            <div class="small">Track average nightly minutes</div>
          </div>
          <div class="info-card">
            <strong>Sleep efficiency</strong>
            <div class="small">How effectively you slept</div>
          </div>
          <div class="info-card">
            <strong>Stress & restfulness</strong>
            <div class="small">See what's impacting your rest</div>
          </div>
        </div>
      </div>
      <div class="right center">
        <!-- Simple moon illustration -->
        <div style="text-align:center">
          <svg width="200" height="200" viewBox="0 0 64 64">
            <circle cx="32" cy="32" r="18" fill="#fde68a"/>
            <circle cx="40" cy="24" r="18" fill="#12203a"/>
          </svg>
          <div class="small">Animated stars & moon (add JS/CSS later)</div>
        </div>
      </div>
    </div>

    
  </div>


</body>
</html>
