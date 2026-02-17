<?php
require 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch questions
$stmt = $pdo->query("SELECT * FROM questions ORDER BY id ASC");
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$questions) {
    die("No questions found.");
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sleep Test</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <div style="max-width:800px;margin:0 auto">
    <h2>Sleep Assessment</h2>
    <div class="small">Complete the short questionnaire to get your sleep score.</div>

    <form action="submit.php" method="post">

      <?php foreach ($questions as $i => $q): ?>
        <div class="question-card">
          <label><strong>Q<?= $i+1 ?>. <?= htmlspecialchars($q['question_text']) ?></strong></label>

          <div style="margin-top:8px">
            <?php if ($i === 0): ?>
              <input class="input" type="time" name="sleep_time" required>

            <?php elseif ($i === 1): ?>
              <input class="input" type="time" name="wake_time" required>

            <?php elseif ($q['input_type'] === 'number'): ?>
              <input class="input" type="number" name="q<?= $i+1 ?>" min="0" required>

            <?php elseif ($q['input_type'] === 'rating'): ?>
              <select name="q<?= $i+1 ?>" class="input" required>
                <option value="">Select</option>
                <option value="1">1 - Poor</option>
                <option value="2">2</option>
                <option value="3">3 - Average</option>
                <option value="4">4</option>
                <option value="5">5 - Excellent</option>
              </select>

            <?php elseif ($q['input_type'] === 'yesno'): ?>
              <select name="q<?= $i+1 ?>" class="input" required>
                <option value="0">No</option>
                <option value="1">Yes</option>
              </select>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <button class="btn" type="submit">Submit Assessment</button>
    </form>
  </div>
</div>

</body>
</html>


