<?php
require 'db.php';
$user = $_SESSION['user'] ?? null;
if(!$user){
  header('Location: login.php');
  exit;
}
$stmt = $pdo->prepare("SELECT * FROM sleep_assessments WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user['id']]);
$rows = $stmt->fetchAll();
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>History</title>
    <link rel="stylesheet" href="style.css">
  </head>
<body>
  <div class="container">
    <a href="index.php" class="small">← Home</a>
    <h2>Your Sleep Assessments</h2>
    <table class="table">
      <thead><tr><th>Date</th><th>Score</th><th>Time to sleep (min)</th><th>Wakeups</th><th>View</th></tr></thead>
      <tbody>
      <?php foreach($rows as $r): ?>
        <tr>
          <td><?=htmlspecialchars($r['created_at'])?></td>
          <td><?= htmlspecialchars($r['overall_score'] ?? 'N/A') ?></td>
          <td><?=htmlspecialchars($r['time_to_sleep'])?></td>
          <td><?=htmlspecialchars($r['interruptions'])?></td>
          <td><a href="results.php?id=<?=$r['id']?>" class="small">View</a></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body></html>
