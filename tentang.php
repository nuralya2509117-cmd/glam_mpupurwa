<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - Museum Mpu Purwa</title>
    <style>
        * {margin: 0;padding: 0;box-sizing: border-box;}
        html, body {height: 100%;}
        body {
            font-family: Georgia, serif;
            background-color: #121414;
            color: #f2ebdd;
            display: flex;
            flex-direction: column;
            min-height: 100vh;}
        main {
            flex: 1;
            display: flex;
            flex-direction: column;}
        header {
            background-color: #1f3339;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 8%;
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 1px solid #c5a24a;}
        .logo h1 {
            font-size: 25px;
            color: #f2ebdd;
            letter-spacing: 1px;}
        .logo p {
            font-size: 11px;
            letter-spacing: 2px;
            color: #c5a24a;}
        nav {
            display: flex;
            gap: 35px;
            align-items: center;}
        nav a {
            text-decoration: none;
            color: #f2ebdd;
            font-family: Arial, sans-serif;
            font-size: 15px;
            transition: color 0.3s ease;}
        nav a:hover {color: #c5a24a;}
        .halaman {padding: 50px 8% 70px;}
        .judul-section {
            text-align: center;
            margin-bottom: 45px;}
        .judul-section h2 {
            font-size: 45px;
            margin-bottom: 10px;
            color: #f2ebdd;}
        .judul-section p {
            font-family: Arial, sans-serif;
            color: #c5a24a;}
        .tentang-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;}
        .tentang-card {
            background-color: #1f3339;
            border-radius: 14px;
            padding: 30px;
            border: 1px solid #2d4750;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.35);
            text-align: center;
            transition: transform 0.3s ease, border-color 0.3s ease;}
        .tentang-card:hover {
            transform: translateY(-6px);
            border-color: #c5a24a;}
        .tentang-card h3 {
            color: #c5a24a;
            margin-bottom: 15px;
            font-size: 22px;}
        .tentang-card p {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #c5beb0;}
        footer {
            background-color: #121414;
            color: #f2ebdd;
            padding: 35px 8% 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #c5a24a;}
        footer h3 {font-size: 22px;color: #f2ebdd;}
        footer p {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin-top: 8px;
            color: #c5a24a;}
        @media(max-width: 900px){
            nav {display: none;}
            .tentang-grid {grid-template-columns: 1fr;}}
    </style>
</head>
<body>
<header>
    <div class="logo">
        <h1>MUSEUM MPU PURWA</h1>
        <p>WARISAN MASA LALU</p>
    </div>
    <nav>
    <a href="index.php">Beranda</a>
    <a href="tentang.php">Tentang</a>
    <a href="katalog.php">Koleksi</a>
    <a href="pengunjung.php">Kunjungan</a>
    <a href="lokasi.php">Lokasi 📍</a>
    <?php if (isset($_SESSION['admin'])): ?>
        <a href="logout.php" style="color: #ff6b6b; font-weight: bold;">Logout (<?= $_SESSION['admin']; ?>)</a>
    <?php else: ?>
        <a href="login.php" style="color: #c5a24a; font-weight: bold;">Login Admin</a>
    <?php endif; ?>
</nav>
</header>
<main class="halaman">
    <div class="judul-section">
        <h2>Tentang Museum</h2>
        <p>
            Mengenal sejarah, misi, dan nilai Museum Mpu Purwa
        </p>
    </div>
    <div class="tentang-grid">
        <div class="tentang-card">
            <h3>◍ Sejarah</h3>
            <p>
                Museum Mpu Purwa didirikan untuk
                mengabadikan jejak budaya dan sejarah
                yang tumbuh di kawasan Malang.
            </p>
        </div>
        <div class="tentang-card">
            <h3>✦ Misi</h3>
            <p>
                Mengembangkan edukasi sejarah,
                melestarikan warisan budaya, serta
                memperkenalkan koleksi berharga
                kepada masyarakat.
            </p>
        </div>
        <div class="tentang-card">
            <h3>☼ Nilai</h3>
            <p>
                Menjaga dan menyampaikan warisan
                masa lalu agar tetap hidup dalam
                pemahaman dan semangat generasi
                masa kini.
            </p>
        </div>
    </div>
</main>
<footer>
    <div>
        <h3>Museum Mpu Purwa</h3>
        <p>
            Warisan sejarah dan budaya Malang
        </p>
    </div>
    <p>
        &copy; 250911722743
        Nur Alya Kaila Qoi Sara
    </p>
</footer>
</body>
</html>