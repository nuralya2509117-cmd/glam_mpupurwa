<?php
session_start();
include 'service/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $tanggal  = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $minat    = isset($_POST['minat']) ? implode(", ", $_POST['minat']) : '-';
    $tujuan   = mysqli_real_escape_string($koneksi, $_POST['tujuan']);
    $pesan_sukses = "Pendaftaran pengunjung berhasil dikirim!";}?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kunjungan - Museum Mpu Purwa</title>
    <style>
        * {margin: 0; padding: 0; box-sizing: border-box;}
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
        .kunjungan-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 60px;}
        .kunjungan-card {
            background-color: #1f3339;
            border-radius: 14px;
            padding: 30px;
            border: 1px solid #2d4750;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.35);
            text-align: center;
            transition: transform 0.3s ease, border-color 0.3s ease;}
        .kunjungan-card:hover {
            transform: translateY(-6px);
            border-color: #c5a24a;}
        .kunjungan-card h3 {
            color: #c5a24a;
            margin-bottom: 15px;
            font-size: 22px;}
        .kunjungan-card p {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #c5beb0;}
        .form-container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #1f3339;
            padding: 40px;
            border-radius: 14px;
            border: 1px solid #2d4750;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
            font-family: Arial, sans-serif;}
        .form-container h3 {
            font-family: Georgia, serif;
            font-size: 28px;
            color: #f2ebdd;
            margin-bottom: 8px;
            text-align: center;}
        .form-container p.subtitle {
            color: #c5a24a;
            font-size: 14px;
            text-align: center;
            margin-bottom: 30px;}
        .form-group {margin-bottom: 22px;}
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #f2ebdd;
            font-size: 14px;}
        .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: #121414;
            border: 1.5px solid #2d4750;
            border-radius: 6px;
            color: #f2ebdd;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;}
        .form-control:focus:valid {
            border-color: #2ecc71 !important;
            box-shadow: 0 0 6px rgba(46, 204, 113, 0.4);}
        .form-control:focus:invalid {
            border-color: #e74c3c !important;
            box-shadow: 0 0 6px rgba(231, 76, 60, 0.4);}
        .radio-group, .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 6px;}
        .radio-item, .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #c5beb0;
            cursor: pointer;}
        .radio-item input, .checkbox-item input {
            accent-color: #c5a24a;
            width: 16px;
            height: 16px;
            cursor: pointer;}
        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: #c5a24a;
            color: #121414;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;}
        .btn-submit:hover {background-color: #e2be62;}
        .alert-success {
            background-color: rgba(46, 204, 113, 0.2);
            border: 1px solid #2ecc71;
            color: #2ecc71;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;}
        footer {
            background-color: #121414;
            color: #f2ebdd;
            padding: 35px 8% 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #c5a24a;}
        footer h3 {
            font-size: 22px;
            color: #f2ebdd;}
        footer p {
            font-family: Arial, sans-serif;
            font-size: 13px;
            margin-top: 8px;
            color: #c5a24a;}
        @media(max-width: 900px) {
            nav {display: none;}
            .kunjungan-grid {grid-template-columns: 1fr;}}
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
        <h2>Informasi Pengunjung</h2>
        <p>Informasi mengenai jadwal, lokasi, dan pendaftaran kunjungan Museum Mpu Purwa</p>
    </div>
    <div class="kunjungan-grid">
        <div class="kunjungan-card">
            <h3> Jadwal Operasional</h3>
            <p>
                SENIN-KAMIS 08.00-16.00 WIB
                <br>
                JUMAT 08.30-15.00 WIB
                <br><br>
                SABTU, MINGGU, HARI LIBUR NASIONAL
                DAN CUTI BERSAMA (TUTUP)
            </p>
        </div>
        <div class="kunjungan-card">
            <h3>⌖ Lokasi</h3>
            <p>
                Jl. Soekarno Hatta,
                Mojolangu, Lowokwaru,
                Kota Malang.
            </p>
        </div>
        <div class="kunjungan-card">
            <h3>ⓘ Informasi</h3>
            <p>
                Informasi mengenai museum
                dan layanan pendaftaran kunjungan.
            </p>
        </div>
    </div>
    <div class="form-container">
        <h3>Formulir Pendaftaran Pengunjung</h3>
        <p class="subtitle">Lengkapi data diri Anda di bawah ini untuk pendaftaran layanan kunjungan.</p>
        <?php if (isset($pesan_sukses)): ?>
            <div class="alert-success"><?= $pesan_sukses; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap *</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Nur Alya Kaila" required>
            </div>
            <div class="form-group">
                <label for="email">Alamat Email *</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Rencana Tanggal Kunjungan *</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Kategori Pengunjung *</label>
                <div class="radio-group">
                    <label class="radio-item">
                        <input type="radio" name="kategori" value="Pelajar / Mahasiswa" required checked> Pelajar / Mahasiswa
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="kategori" value="Umum" required> Umum / Masyarakat
                    </label>
                    <label class="radio-item">
                        <input type="radio" name="kategori" value="Peneliti" required> Peneliti / Akademisi
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label>Minat Kategori Koleksi (Boleh pilih lebih dari satu)</label>
                <div class="checkbox-group">
                    <label class="checkbox-item">
                        <input type="checkbox" name="minat[]" value="Arca"> Arca & Patung
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="minat[]" value="Prasasti"> Prasasti & Inskripsi
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="minat[]" value="Ornamen"> Ornamen Candi
                    </label>
                    <label class="checkbox-item">
                        <input type="checkbox" name="minat[]" value="Megalitik"> Kerajinan Megalitik
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="tujuan">Tujuan Kunjungan Utama *</label>
                <select id="tujuan" name="tujuan" class="form-control" required>
                    <option value="">-- Pilih Tujuan Kunjungan --</option>
                    <option value="Wisata Edukasi">Wisata Edukasi & Rekreasi</option>
                    <option value="Tugas Sekolah/Kuliah">Tugas Sekolah / Perkuliahan</option>
                    <option value="Penelitian Ilmiah">Penelitian Ilmiah / Riset</option>
                    <option value="Dokumentasi Budaya">Liputan Media / Dokumentasi Budaya</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Kirim Pendaftaran Pengunjung</button>
        </form>
    </div>
</main>
<footer>
    <div>
        <h3>Museum Mpu Purwa</h3>
        <p>Warisan sejarah dan budaya Malang</p>
    </div>
    <p>
        &copy; 250911722743<br>
        Nur Alya Kaila Qoi Sara
    </p>
</footer>
</body>
</html>