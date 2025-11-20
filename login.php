<?php
session_start();

// kalau sudah login, langsung ke dashboard
if (isset($_SESSION['username'])) {
  header("Location: dashboard.php");
  exit;
}

// proses form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // login sederhana: username admin, password 123
  if ($username === 'admin' && $password === '123') {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'Dosen';
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Username atau password salah!";
  }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
  <h2>Form Login</h2>
  <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="post">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
    <button type="reset">Batal</button>
  </form>
</body>
</html>