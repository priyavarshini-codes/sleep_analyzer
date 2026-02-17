<?php
session_start();
require 'db.php';
$user = $_SESSION['user'] ?? null;
if(!$user || $user['role'] !== 'admin'){
   echo "Admin only."; 
   exit; 
  }

// create
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['qtext'])){
  $stmt = $pdo->prepare("INSERT INTO questions (question_text,input_type,options) VALUES (?,?,?)");
  $stmt->execute([$_POST['qtext'],$_POST['itype'],$_POST['opts']]);
  header('Location: questions.php'); exit;
}

// fetch
$questions = $pdo->query("SELECT * FROM questions ORDER BY id ASC")->fetchAll();
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Manage Questions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <a href="index.php" class="small">← Dashboard</a>
    <h2>Manage Questions</h2>
    <form method="post" style="margin-bottom:15px">
      <input class="input" name="qtext" placeholder="Question text" required>
      <select class="input" name="itype">
        <option value="time">time</option>
        <option value="number">number</option>
        <option value="rating">rating</option>
        <option value="yesno">yes/no</option>
      </select>
      <input class="input" name="opts" placeholder="options (comma separated)" >
      <button class="btn">Add</button>
    </form>

    <table class="table">
      <thead><tr><th>ID</th><th>Question</th><th>Type</th></tr></thead>
      <tbody>
      <?php foreach($questions as $q): ?>
        <tr><td><?=$q['id']?></td><td><?=htmlspecialchars($q['question_text'])?></td><td><?=$q['input_type']?></td></tr>
      <?php endforeach;?>
      </tbody>
    </table>
  </div>
</body></html>
