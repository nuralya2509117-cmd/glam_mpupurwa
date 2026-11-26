<?php
session_start();
include 'service/database.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
$message = '';
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($koneksi, "SELECT username FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $cek = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($cek) > 0) {
        $message = "NIM/Username sudah terdaftar!";
    } else {
        $stmt = mysqli_prepare($koneksi, "INSERT INTO users (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        if (mysqli_stmt_execute($stmt)) {
            $message = "Pendaftaran berhasil! <a href='login.php' style='color:#c5a24a;'>Klik di sini untuk Login</a>";
            } else {$message = "Gagal mendaftar!";}}}?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Admin - Museum Mpu Purwa</title>
    <style>
        body { background-color: #121414; color: #f2ebdd; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background-color: #1f3339; padding: 30px; border-radius: 8px; border: 1px solid #c5a24a; width: 320px; }
        h2 { color: #c5a24a; margin-bottom: 20px; text-align: center; font-family: Georgia, serif; }
        input { width: 100%; padding: 10px; margin: 10px 0; border-radius: 4px; border: 1px solid #ccc; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; font-weight: bold; cursor: pointer; border-radius: 4px; margin-top: 10px; }
        button:hover { background-color: #218838; }
        .msg { color: #c5a24a; font-size: 13px; text-align: center; margin-bottom: 10px; }
        .link-login { text-align: center; margin-top: 15px; font-size: 13px; }
        .link-login a { color: #c5a24a; text-decoration: none; }
    </style>
</head>
<body>

<div class="card">
    <h2>Daftar Admin Baru</h2>
    <?php if ($message): ?><p class="msg"><?= $message; ?></p><?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Masukkan NIM (Username)" required>
        <input type="password" name="password" placeholder="Masukkan Password NIM" required>
        <button type="submit" name="register">Daftar Sekarang</button>
    </form>
    <div class="link-login">
        Sudah punya akun? <a href="login.php">Login di sini</a>
    </div>
</div>

</body>
</html>