<?php
session_start();
include 'service/database.php';
$error = '';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['admin'] = $username;
        header("Location: katalog.php");
        exit();
    } else {$error = "NIM atau password salah!";}}?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Museum Mpu Purwa</title>
    <style>
        body { background-color: #121414; color: #f2ebdd; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background-color: #1f3339; padding: 30px; border-radius: 8px; border: 1px solid #c5a24a; width: 320px; }
        h2 { color: #c5a24a; margin-bottom: 20px; text-align: center; font-family: Georgia, serif; }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #c5a24a; border: none; font-weight: bold; cursor: pointer; border-radius: 4px; margin-top: 10px; }
        button:hover { background-color: #e2be62; }
        .error { color: #ff6b6b; font-size: 13px; text-align: center; margin-bottom: 10px; }
        .link-reg { text-align: center; margin-top: 15px; font-size: 13px; }
        .link-reg a { color: #c5a24a; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Login Admin</h2>
    <?php if ($error): ?><p class="error"><?= $error; ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Masukkan NIM" required>
        <input type="password" name="password" placeholder="Masukkan Password NIM" required>
        <button type="submit" name="login">Masuk</button>
    </form>
</div>
</body>
</html>