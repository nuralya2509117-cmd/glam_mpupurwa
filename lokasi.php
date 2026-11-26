<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi - Museum Mpu Purwa</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Georgia, serif; background-color: #121414; color: #f2ebdd; }
        header { background-color: #1f3339; display: flex; justify-content: space-between; align-items: center; padding: 18px 8%; position: sticky; top: 0; z-index: 10; border-bottom: 1px solid #c5a24a; }
        .logo h1 { font-size: 25px; color: #f2ebdd; }
        .logo p { font-size: 11px; letter-spacing: 2px; color: #c5a24a; }
        nav { display: flex; gap: 35px; align-items: center; }
        nav a { text-decoration: none; color: #f2ebdd; font-family: Arial, sans-serif; font-size: 15px; transition: color 0.3s ease; }
        nav a:hover, nav a.active { color: #c5a24a; }
        
        .container { padding: 50px 8%; text-align: center; }
        .judul-section { margin-bottom: 30px; }
        .judul-section h2 { font-size: 36px; margin-bottom: 8px; }
        .judul-section p { font-family: Arial, sans-serif; color: #c5a24a; }
        
        .map-wrapper { width: 100%; height: 400px; border-radius: 12px; overflow: hidden; border: 2px solid #c5a24a; margin-bottom: 30px; }
        .btn-back { display: inline-block; background-color: #c5a24a; color: #121414; padding: 12px 26px; text-decoration: none; font-family: Arial, sans-serif; font-weight: bold; border-radius: 6px; transition: background 0.3s; }
        .btn-back:hover { background-color: #e2be62; }

        footer { background-color: #121414; color: #f2ebdd; padding: 35px 8% 50px; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #c5a24a; margin-top: 40px; }
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
    </nav>
</header>

<main class="container">
    <div class="judul-section">
        <h2>Lokasi Museum Mpu Purwa</h2>
        <p>Jl. Soekarno Hatta No.210, Mojolangu, Kec. Lowokwaru, Kota Malang</p>
    </div>

    <div class="map-wrapper">
        <iframe 
        src="https://maps.google.com/maps?q=Museum%20Mpu%20Purwa%20Malang&t=&z=16&ie=UTF8&iwloc=&output=embed" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy">
        </iframe>
    </div>

    <a href="index.php" class="btn-back">← Kembali ke Beranda</a>
</main>

<footer>
    <div>
        <h3>Museum Mpu Purwa</h3>
        <p>Warisan sejarah dan budaya Malang</p>
    </div>
    <p>&copy; 250911722743 Nur Alya Kaila Qoi Sara</p>
</footer>

</body>
</html>