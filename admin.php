<?php
require 'db.php';
// very basic admin auth: ensure logged-in user with email admin@example.com
$user = $_SESSION['user'] ?? null;
if(!$user || $user['role'] !== 'admin'){
    echo "Admin only";
    exit;
}

// stats
$total = $pdo->query("SELECT COUNT(*) FROM sleep_assessments")->fetchColumn();
$avg = $pdo->query("SELECT AVG(sleep_score) FROM sleep_results")->fetchColumn();

$recent = $pdo->query("
  SELECT a.created_at, r.sleep_score, a.user_id
  FROM sleep_assessments a
  LEFT JOIN sleep_results r ON a.user_id = r.user_id
  ORDER BY a.created_at DESC
  LIMIT 10
")->fetchAll();

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
  </head>
<body>
  <div class="container">
    <div class="content-row">
      <div class="admin-sidebar">
        <h3>Admin</h3>
        <a href="index.php">Dashboard</a><br>
        <a href="questions.php">Manage Questions</a><br>
        <a href="../index.php">Site</a>
      </div>
      <div style="flex:1">
        <h2>Admin Dashboard</h2>
        <div class="card-row">
          <div class="info-card">
            <strong>Total Assessments</strong><div class="small"><?=$total?></div>
          </div>
          <div class="info-card">
            <strong>Average Score</strong><div class="small"><?=round($avg,1)?></div>
          </div>
        </div>

        <h3 style="margin-top:18px">Recent Assessments</h3>
        <table class="table">
          <thead><tr><th>Date</th><th>User</th><th>Score</th></tr></thead>
          <tbody>
            <?php foreach($recent as $r): ?>
              <tr>
                <td><?=$r['created_at']?></td>
                <td><?php
                  if($r['user_id']){
                    $u = $pdo->prepare("SELECT email FROM users WHERE id=?");
                    $u->execute([$r['user_id']]);
                    $nm = $u->fetchColumn();
                    echo htmlspecialchars($nm);
                  } else echo 'Guest';
                ?></td>
                <td><?= $r['sleep_score'] ?></td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</body></html>
