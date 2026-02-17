<?php
require 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = $_SESSION['user'] ?? null;
$user_id = $user['id'] ?? null;

if (!$user_id) {
    die("User not logged in.");
}

// Get latest assessment for user
$stmt = $pdo->prepare("
SELECT *
FROM sleep_assessments
WHERE user_id = ?
ORDER BY created_at DESC
LIMIT 1
");
$stmt->execute([$user_id]);

$ass = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$ass) {
    die("Result not found.");
}

// Score calculation
$overall_score = ($ass['sleep_quality'] * 20)
               - ($ass['interruptions'] * 5)
               - ($ass['stress_level'] * 5);

$overall_score = max(0, min(100, $overall_score));
?>
<!doctype html>
<html>
<head>
  <title>Results</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h2>Sleep Assessment Result</h2>

  <h3><?= $overall_score ?> / 100</h3>

  <p>Sleep Quality: <?= $ass['sleep_quality'] ?>/5</p>
  <p>Interruptions: <?= $ass['interruptions'] ?></p>
  <p>Stress Level: <?= $ass['stress_level'] ?></p>
  <p>Taken on: <?= $ass['created_at'] ?></p>

  <a href="history.php">View History</a>
</div>
</body>
</html>
