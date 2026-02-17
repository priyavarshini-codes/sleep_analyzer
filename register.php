<?php
require 'db.php';

$err = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role     = $_POST['role'] ?? '';

    if($username === '' || $email === '' || $password === '' || $role === ''){
        $err = "All fields are required!";
    } else {
        try {
            if($role === 'admin'){
                // check admin email
                $check = $pdo->prepare("SELECT COUNT(*) FROM admin WHERE email=?");
                $check->execute([$email]);

                if($check->fetchColumn() > 0){
                    $err = "Admin email already exists!";
                } else {
                    $stmt = $pdo->prepare(
                        "INSERT INTO admin (username, email, role, password, created_at)
                         VALUES (?, ?, ?, ?, NOW())"
                    );
                    $stmt->execute([$username, $email, $role, $password]);
                    header("Location: login.php");
                    exit;
                }
            } else { // user
                // check user email
                $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email=?");
                $check->execute([$email]);

                if($check->fetchColumn() > 0){
                    $err = "User email already exists!";
                } else {
                    $stmt = $pdo->prepare(
                        "INSERT INTO users (username, email, role, password, created_at)
                         VALUES (?, ?, ?, ?, NOW())"
                    );
                    $stmt->execute([$username, $email, $role, $password]);
                    header("Location: login.php");
                    exit;
                }
            }
        } catch (PDOException $e){
            $err = "Database error: " . $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
  <div class="login-card">
    <h2>Register</h2>

    <?php if($err): ?>
      <div class="small" style="color:#ff8a8a;text-align:center;margin-bottom:10px;">
        <?= $err ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <input class="input" type="text" name="username" placeholder="Username" required>
      </div>

      <div class="form-group">
        <input class="input" type="email" name="email" placeholder="Email" required>
      </div>

      <div class="form-group">
        <input class="input" type="password" name="password" placeholder="Password" required>
      </div>

      <div class="form-group">
        <select class="input" name="role" required>
          <option value="">Select Role</option>
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <button class="btn" type="submit">Register</button>
    </form>

    <p>
      Already have an account? <a href="login.php">Login</a>
    </p>
  </div>
</div>

</body>
</html>
