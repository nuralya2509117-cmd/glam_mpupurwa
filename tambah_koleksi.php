<?php
session_start();
include 'service/database.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
$galat = "";
$daftar_kategori = mysqli_query($koneksi, "SELECT id_kategori_koleksi, nama_kategori_koleksi FROM kategori_koleksi ORDER BY nama_kategori_koleksi ASC");
if (isset($_POST['simpan'])) {
    // Sanitasi masukan: trim() membuang spasi berlebih, (int) memaksa angka,
    // dan nilai dikirim ke MySQL lewat prepared statement (bind_param).
    $nomor     = trim($_POST['nomor_inventaris']);
    $nama      = trim($_POST['nama']);
    $id_kat    = (int) $_POST['id_kategori_koleksi'];
    $bahan     = trim($_POST['bahan']);
    $ukuran    = trim($_POST['ukuran']);
    $asal      = trim($_POST['asal']);
    $deskripsi = trim($_POST['deskripsi']);
    $gambar    = trim($_POST['gambar']);
    $stmt = mysqli_prepare($koneksi, "INSERT INTO koleksi_artefak (nomor_inventaris, judul_koleksi, id_kategori_koleksi, bahan, ukuran, asal, deskripsi, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssisssss", $nomor, $nama, $id_kat, $bahan, $ukuran, $asal, $deskripsi, $gambar);
    try {
        mysqli_stmt_execute($stmt);
        header("Location: katalog.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        $galat = ($e->getCode() == 1062) ? "Nomor inventaris sudah dipakai koleksi lain." : "Data gagal disimpan. Periksa kembali isian formulir.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artefak - Museum Mpu Purwa</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Georgia, serif;
            background-color: #121414;
            color: #f2ebdd;
            display: flex;
            flex-direction: column;
            min-height: 100vh;}
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
        .logo h1 { font-size: 25px; color: #f2ebdd; }
        .logo p { font-size: 11px; letter-spacing: 2px; color: #c5a24a; }
        nav { display: flex; gap: 25px; align-items: center; }
        nav a {
            text-decoration: none;
            color: #f2ebdd;
            font-family: Arial, sans-serif;
            font-size: 15px;
            transition: color 0.3s ease;}
        nav a:hover, nav a.active { color: #c5a24a; }
        main { flex: 1; padding: 50px 8% 70px; }
        .form-box {
            max-width: 460px;
            margin: 0 auto;
            background: #1f3339;
            padding: 25px;
            border-radius: 8px;
            border: 1px solid #c5a24a;
            font-family: Arial, sans-serif;}
        .form-box h2 { color: #c5a24a; margin-bottom: 15px; font-family: Georgia, serif; }
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 4px;
            box-sizing: border-box;}
        button {
            background: #28a745;
            color: white;
            padding: 10px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;}
        .batal {
            display: block;
            text-align: center;
            margin-top: 14px;
            color: #c5a24a;
            font-size: 13px;
            text-decoration: none;}
        .batal:hover { color: #f2ebdd; }
        footer {
            background-color: #121414;
            color: #f2ebdd;
            padding: 35px 8% 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #c5a24a;}
        footer h3 { font-size: 22px; }
        footer p { font-family: Arial, sans-serif; font-size: 13px; margin-top: 8px; color: #c5a24a; }
        @media(max-width: 900px) { nav { display: none; } }
    </style>
</head>
<body>
<?php $halaman_aktif = 'katalog'; include 'layout/header.php'; ?>
<main>
    <div class="form-box">
        <h2>Tambah Artefak</h2>
        <form method="POST">
            <?php if ($galat !== ""): ?><p style="color:#ff6b6b;"><?= htmlspecialchars($galat); ?></p><?php endif; ?>
            <input type="text" name="nomor_inventaris" placeholder="Nomor Inventaris (misal: 07/KOTA MALANG)" maxlength="30" required>
            <input type="text" name="nama" placeholder="Nama Artefak" maxlength="150" required>
            <select name="id_kategori_koleksi" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while ($kat = mysqli_fetch_assoc($daftar_kategori)): ?>
                    <option value="<?= (int) $kat['id_kategori_koleksi']; ?>"><?= htmlspecialchars($kat['nama_kategori_koleksi']); ?></option>
                <?php endwhile; ?>
            </select>
            <input type="text" name="bahan" placeholder="Bahan (misal: Batu Andesit)">
            <input type="text" name="ukuran" placeholder="Ukuran (misal: 39 x 34 cm)" required>
            <input type="text" name="asal" placeholder="Asal artefak">
            <textarea name="deskripsi" placeholder="Deskripsi Artefak" required></textarea>
            <input type="text" name="gambar" placeholder="Nama File Gambar (misal: kuncup.jpg)" required>
            <button type="submit" name="simpan">Simpan Data</button>
        </form>
        <a href="katalog.php" class="batal">&larr; Batal, kembali ke katalog</a>
    </div>
</main>
<?php include 'layout/footer.php'; ?>
</body>
</html>
