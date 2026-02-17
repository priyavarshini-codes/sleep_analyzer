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

// Correct field names
$sleep_time = $_POST['sleep_time'] ?? '';
$wake_time  = $_POST['wake_time'] ?? '';

$q3  = intval($_POST['q3'] ?? 0);
$q4  = intval($_POST['q4'] ?? 0);
$q5  = intval($_POST['q5'] ?? 0);
$q6  = intval($_POST['q6'] ?? 3);
$q7  = intval($_POST['q7'] ?? 0);
$q8  = intval($_POST['q8'] ?? 0);
$q9  = intval($_POST['q9'] ?? 0);
$q10 = intval($_POST['q10'] ?? 0);

if ($sleep_time === '' || $wake_time === '') {
    die("Sleep time and wake time are required.");
}

// Insert assessment
$stmt = $pdo->prepare("
INSERT INTO sleep_assessments
(user_id, sleep_time, wake_time, time_to_sleep,
 interruptions, sleep_quality, stress_level,
 dream_quality, date_taken, created_at)
VALUES (?,?,?,?,?,?,?,?,CURDATE(),NOW())
");

$stmt->execute([
  $user_id,
  $sleep_time,
  $wake_time,
  $q3,
  $q4,
  $q6,
  $q7,
  $q10
]);

$assessment_id = $pdo->lastInsertId();

// Redirect correctly
header("Location: results.php?id=" . $assessment_id);
exit;
