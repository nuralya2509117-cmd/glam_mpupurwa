<?php
session_start();
include 'service/database.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = mysqli_prepare($koneksi, "SELECT id_koleksi, nomor_inventaris, judul_koleksi, id_kategori_koleksi, bahan, ukuran, asal, deskripsi, gambar FROM koleksi_artefak WHERE id_koleksi = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$data) { header("Location: katalog.php"); exit(); }
$galat = "";
$daftar_kategori = mysqli_query($koneksi, "SELECT id_kategori_koleksi, nama_kategori_koleksi FROM kategori_koleksi ORDER BY nama_kategori_koleksi ASC");
if (isset($_POST['update'])) {
    $nomor     = trim($_POST['nomor_inventaris']);
    $nama      = trim($_POST['nama']);
    $id_kat    = (int) $_POST['id_kategori_koleksi'];
    $bahan     = trim($_POST['bahan']);
    $ukuran    = trim($_POST['ukuran']);
    $asal      = trim($_POST['asal']);
    $deskripsi = trim($_POST['deskripsi']);
    $gambar    = trim($_POST['gambar']);
    $stmt = mysqli_prepare($koneksi, "UPDATE koleksi_artefak SET nomor_inventaris = ?, judul_koleksi = ?, id_kategori_koleksi = ?, bahan = ?, ukuran = ?, asal = ?, deskripsi = ?, gambar = ? WHERE id_koleksi = ?");
    mysqli_stmt_bind_param($stmt, "ssisssssi", $nomor, $nama, $id_kat, $bahan, $ukuran, $asal, $deskripsi, $gambar, $id);
    try {
        mysqli_stmt_execute($stmt);
        header("Location: katalog.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        $galat = ($e->getCode() == 1062) ? "Nomor inventaris sudah dipakai koleksi lain." : "Data gagal disimpan. Periksa kembali isian formulir.";
        $data = array_merge($data, ['nomor_inventaris' => $nomor, 'judul_koleksi' => $nama, 'id_kategori_koleksi' => $id_kat, 'bahan' => $bahan, 'ukuran' => $ukuran, 'asal' => $asal, 'deskripsi' => $deskripsi, 'gambar' => $gambar]);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Artefak</title>
    <style>
        body { background-color: #121414; color: #f2ebdd; font-family: Arial; padding: 40px; }
        .form-box { max-width: 400px; margin: auto; background: #1f3339; padding: 25px; border-radius: 8px; border: 1px solid #c5a24a; }
        input, select, textarea { width: 100%; padding: 8px; margin: 8px 0; border-radius: 4px; box-sizing: border-box; }
        button { background: #ffc107; color: black; padding: 10px; border: none; font-weight: bold; cursor: pointer; width: 100%; margin-top: 10px; }
    </style>
</head>
<body>
<div class="form-box">
    <h2 style="color:#c5a24a; margin-bottom:15px;">Edit Artefak</h2>
    <form method="POST">
        <?php if ($galat !== ""): ?><p style="color:#ff6b6b;"><?= htmlspecialchars($galat); ?></p><?php endif; ?>
        <input type="text" name="nomor_inventaris" value="<?= htmlspecialchars($data['nomor_inventaris']); ?>" maxlength="30" required>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['judul_koleksi']); ?>" maxlength="150" required>
        <select name="id_kategori_koleksi" required>
            <?php while ($kat = mysqli_fetch_assoc($daftar_kategori)): ?>
                <option value="<?= (int) $kat['id_kategori_koleksi']; ?>" <?= ((int) $kat['id_kategori_koleksi'] === (int) $data['id_kategori_koleksi']) ? 'selected' : ''; ?>><?= htmlspecialchars($kat['nama_kategori_koleksi']); ?></option>
            <?php endwhile; ?>
        </select>
        <input type="text" name="bahan" value="<?= htmlspecialchars($data['bahan'] ?? ''); ?>" placeholder="Bahan">
        <input type="text" name="ukuran" value="<?= htmlspecialchars($data['ukuran'] ?? ''); ?>" required>
        <input type="text" name="asal" value="<?= htmlspecialchars($data['asal'] ?? ''); ?>" placeholder="Asal artefak">
        <textarea name="deskripsi" required><?= htmlspecialchars($data['deskripsi'] ?? ''); ?></textarea>
        <input type="text" name="gambar" value="<?= htmlspecialchars($data['gambar'] ?? ''); ?>" required>
        <button type="submit" name="update">Update Data</button>
    </form>
</div>
</body>
</html>