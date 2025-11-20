<?php
session_start();

// kalau sudah login, langsung ke dashboard
if (isset($_SESSION['username'])) {
  header("Location: dashboard.php");
  exit;
}

// proses form login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

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
<head>
<title>Login</title>
<style>
body { font-family: Arial; background: #f2f2f2; padding: 30px; }
form { background: white; padding: 20px; width: 300px; border-radius: 8px; }
input { width: 100%; padding: 8px; margin: 6px 0; }
button { padding: 10px; margin-top: 10px; width: 48%; }
h2 { color: #333; }
</style>
</head>
<body>

<h2>Form Login</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post">
  Username:
  <input type="text" name="username" required>

  Password:
  <input type="password" name="password" required>

  <button type="submit">Login</button>
  <button type="reset">Batal</button>
</form>

</body>
</html>
