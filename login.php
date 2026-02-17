<?php
require 'db.php';


$err = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    $user = null;

    // Check admin table first
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email=?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch();

    if($admin && $pass === $admin['password']){
        $user = [
            'id'    => $admin['admin_id'],
            'name'  => $admin['username'],
            'email' => $admin['email'],
            'role'  => $admin['role']
        ];
    } else {
        // Check users table
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $usr = $stmt->fetch();

        if($usr && $pass === $usr['password']){
            $user = [
                'id'    => $usr['id'],
                'name'  => $usr['username'],
                'email' => $usr['email'],
                'role'  => $usr['role']
            ];
        }
    }

    if($user){
        $_SESSION['user'] = $user;

        if($user['role'] === 'admin'){
            header("Location: admin.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        $err = "Invalid login details!";
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
  <div class="login-card">
    <h2>Login</h2>

    <?php if($err): ?>
      <div class="small" style="color:#ff8a8a;text-align:center;margin-bottom:10px;">
        <?= $err ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <div class="form-group">
        <input class="input" type="email" name="email" placeholder="Email" required>
      </div>

      <div class="form-group">
        <input class="input" type="password" name="password" placeholder="Password" required>
      </div>

      <button class="btn" type="submit">Login</button>
    </form>

    <p>
      Don't have an account? <a href="register.php">Register</a>
    </p>
  </div>
</div>

</body>
</html>
