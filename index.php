<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Museum Mpu Purwa</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box;}
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
            border-bottom: 1px solid #c5a24a; }
        .logo h1 {
            font-size: 25px;
            color: #f2ebdd;
            letter-spacing: 1px;}
        .logo p {
            font-size: 11px;
            letter-spacing: 2px;
            color: #c5a24a; }
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
        nav a:hover {
            color: #c5a24a;  }
        .hero {
            flex: 1;
            min-height: 550px;
            background:
                linear-gradient(
                    to right,
                    rgba(18, 20, 20, 0.92),
                    rgba(31, 51, 57, 0.70),
                    rgba(31, 51, 57, 0.25)),
                url("museum-bg.jpg");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding: 60px 10%;}
        .hero-content {max-width: 650px;}
        .welcome {
            letter-spacing: 7px;
            font-size: 13px;
            color: #c5a24a;
            margin-bottom: 15px;}
        .hero h2 {
            font-size: 72px;
            line-height: 0.95;
            margin-bottom: 25px;
            color: #f2ebdd; }
        .hero-description {
            font-size: 23px;
            line-height: 1.4;
            margin-bottom: 25px;
            color: #f2ebdd; }
        .search-container {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            max-width: 500px;}
        .search-container input {
            flex: 1;
            padding: 12px 18px;
            border-radius: 5px;
            border: 1px solid #c5a24a;
            background-color: rgba(31, 51, 57, 0.85);
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 15px;
            outline: none;}
        .search-container input::placeholder {
            color: #b0b0b0;}
        .search-container button {
            background-color: #c5a24a;
            color: #121414;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease;}
        .search-container button:hover {
            background-color: #e0c36a;}
        .btn {
            display: inline-block;
            background-color: #c5a24a;
            color: #121414;
            padding: 15px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-family: Arial, sans-serif;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;}
        .btn:hover {
            background-color: #e0c36a;
            transform: translateY(-2px);}
        .keunggulan {
            margin-top: 45px;
            display: flex;
            gap: 35px;
            font-family: Arial, sans-serif; }
        .keunggulan div {
            display: flex;
            align-items: center;
            gap: 10px;}
        .keunggulan span {
            font-size: 27px;
            color: #c5a24a;}
        .keunggulan p {
            font-size: 13px;
            color: #f2ebdd;
            line-height: 1.4;}
        footer {
            background-color: #121414;
            color: #f2ebdd;
            padding: 35px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #c5a24a;}
        footer h3 {
            font-size: 22px;
            color: #f2ebdd;}
        footer p 
           {font-family: Arial, sans-serif;
            font-size: 13px;
            margin-top: 8px;
            color: #c5a24a;}
        @media(max-width: 900px) 
            {nav 
            {display: none;}
            .hero h2 
            {font-size: 55px;}
            .keunggulan 
                {flex-direction: column;
                gap: 20px;}}
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
            <a href="logout.php" style="color:#ff6b6b; font-weight:bold;">Logout (<?= $_SESSION['admin']; ?>)</a>
        <?php else: ?>
            <a href="login.php" style="color:#c5a24a; font-weight:bold;">Login Admin</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <section class="hero">
        <div class="hero-content">
            <p class="welcome">SELAMAT DATANG DI</p>
            <h2>Museum<br>Mpu Purwa</h2>
            <p class="hero-description">
                Menjelajahi jejak sejarah dan warisan budaya Malang.
            </p>
            <form class="search-container" action="katalog.php" method="GET">
                <input type="text" name="search" placeholder="Cari artefak (misal: Ganesya)..." required>
                <button type="submit">Cari 🔍</button>
            </form>
            <a href="katalog.php" class="btn">
                Lihat Koleksi →
            </a>
            <div class="keunggulan">
                <div>
                    <span>◉</span>
                    <p>Melestarikan<br>Warisan Budaya</p>
                </div>
                <div>
                    <span>♙</span>
                    <p>Mengenalkan Sejarah<br>kepada Masyarakat</p>
                </div>
                <div>
                    <span>▤</span>
                    <p>Menyediakan<br>Informasi Digital</p>
                </div>
            </div>
        </div>
    </section>
</main>
<footer>
    <div>
        <h3>Museum Mpu Purwa</h3>
        <p>Warisan sejarah dan budaya Malang</p>
    </div>
    <p>
        &copy; 250911722743 Nur Alya Kaila Qoi Sara
    </p>
</footer>
</body>
</html>