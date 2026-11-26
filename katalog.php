<?php
session_start();
include 'service/database.php';
$keyword = isset($_GET['search']) ? $_GET['search'] : '';
$like = "%" . $keyword . "%";
$stmt = mysqli_prepare($koneksi, "SELECT k.id_koleksi, k.nomor_inventaris, k.judul_koleksi, k.ukuran, k.deskripsi, k.gambar, c.nama_kategori_koleksi
    FROM koleksi_artefak AS k
    JOIN kategori_koleksi AS c ON k.id_kategori_koleksi = c.id_kategori_koleksi
    WHERE k.judul_koleksi LIKE ? OR k.deskripsi LIKE ? OR c.nama_kategori_koleksi LIKE ?
    ORDER BY k.id_koleksi ASC");
mysqli_stmt_bind_param($stmt, "sss", $like, $like, $like);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Koleksi - Museum Mpu Purwa</title>
    <style>
        * { margin: 0;
            padding: 0;
            box-sizing: border-box;}
        body {font-family: Georgia, serif;
              background-color: #121414;
              color: #f2ebdd;}
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
            color: #f2ebdd;}
        .logo p {
            font-size: 11px;
            letter-spacing: 2px;
            color: #c5a24a;}
        nav {
            display: flex;
            gap: 25px;
            align-items: center;}
        nav a {
            text-decoration: none;
            color: #f2ebdd;
            font-family: Arial, sans-serif;
            font-size: 15px;
            transition: color 0.3s ease;}
        nav a:hover, nav a.active {
            color: #c5a24a;}
        .container {
            padding: 60px 8%;
            min-height: 80vh;}
        .judul-section {
            text-align: center;
            margin-bottom: 30px;}
        .judul-section h2 {
            font-size: 38px;
            color: #f2ebdd;
            margin-bottom: 8px;}
        .judul-section p {
            font-family: Arial, sans-serif;
            color: #c5a24a;
            font-size: 14px;}
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            gap: 15px;
            flex-wrap: wrap;}
        .search-box {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 450px;}
        .search-box input {
            flex: 1;
            padding: 10px 16px;
            border-radius: 6px;
            border: 1px solid #c5a24a;
            background: #1f3339;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 14px;
            outline: none;}
        .search-box button {
            padding: 10px 20px;
            background: #c5a24a;
            color: #121414;
            border: none;
            font-weight: bold;
            cursor: pointer;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            transition: background 0.3s;}
        .search-box button:hover {
            background: #e2be62;}
        .btn-add {
            background: #28a745;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s;}
        .btn-add:hover {
            background: #218838;}
        .koleksi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 20px;}
        .card {
            background-color: #1f3339;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #2d4750;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, border-color 0.3s ease;}
        .card:hover {
            transform: translateY(-5px);
            border-color: #c5a24a;}
        .card-img {
            width: 100%;
            height: 260px;
            background-color: #18282d;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;}
        .card-img img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;}
        .card-body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;}
        .card-body h3 {
            font-size: 20px;
            color: #f2ebdd;
            margin-bottom: 8px;}
        .card-body .dims {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #c5a24a;
            margin-bottom: 12px;}
        .card-body .desc {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #c5beb0;
            margin-bottom: 20px;
            line-height: 1.5;}
        .action-btn {
            margin-top: auto;
            display: flex;
            gap: 8px;}
        .btn-edit, .btn-delete {
            flex: 1;
            text-align: center;
            padding: 8px;
            text-decoration: none;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-weight: bold;
            border-radius: 6px;
            transition: opacity 0.3s;}
        .btn-edit { background-color: #ffc107; color: #121414; }
        .btn-delete { background-color: #dc3545; color: #ffffff; }
        .btn-edit:hover, .btn-delete:hover { opacity: 0.85; }
        .tabel-section {
            margin-top: 50px;}
        .tabel-section h3 {
            font-size: 26px;
            color: #f2ebdd;
            margin-bottom: 6px;}
        .tabel-section .ket {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #c5a24a;
            margin-bottom: 18px;}
        .tabel-wrap {
            overflow-x: auto;}
        .tabel-koleksi {
            width: 100%;
            border-collapse: collapse;
            background-color: #1f3339;
            border: 1px solid #2d4750;
            font-family: Arial, sans-serif;
            font-size: 14px;}
        .tabel-koleksi th, .tabel-koleksi td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #2d4750;}
        .tabel-koleksi th {
            color: #c5a24a;
            background-color: #18282d;}
        .tabel-koleksi td {
            color: #c5beb0;}
        .tabel-koleksi td a {
            color: #f2ebdd;
            text-decoration: none;}
        .tabel-koleksi td a:hover {
            color: #c5a24a;}
        .tabel-koleksi tr:last-child td {
            border-bottom: none;}
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
    </style>
</head>
<body>

<?php $halaman_aktif = 'katalog'; include 'layout/header.php'; ?>

<main class="container">
    <div class="judul-section">
        <h2>Katalog Koleksi Museum</h2>
        <p>Daftar Artefak Peninggalan Sejarah Museum Mpu Purwa</p>
    </div>
    <div class="toolbar">
        <form class="search-box" method="GET">
            <input type="text" name="search" placeholder="Cari artefak (contoh: Ganesya, Teratai)..." value="<?= htmlspecialchars($keyword); ?>">
            <button type="submit">Cari 🔍</button>
        </form>
        <?php if (isset($_SESSION['admin'])): ?>
            <a href="tambah_koleksi.php" class="btn-add">+ Tambah Artefak Baru</a>
        <?php endif; ?>
    </div>
        <div class="koleksi-grid">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <a href="detail.php?id=<?= (int) $row['id_koleksi']; ?>" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card-img">
                            <img src="<?= htmlspecialchars($row['gambar'] ?? ''); ?>" alt="<?= htmlspecialchars($row['judul_koleksi']); ?>">
                        </div>
                        <div class="card-body">
                            <h3><?= htmlspecialchars($row['judul_koleksi']); ?></h3>
                            <p class="dims">Ukuran: <?= htmlspecialchars($row['ukuran'] ?? '-'); ?> (Kategori: <?= htmlspecialchars($row['nama_kategori_koleksi']); ?>)</p>
                            <p class="desc"><?= htmlspecialchars(mb_strimwidth($row['deskripsi'] ?? '', 0, 120, '...')); ?></p>
                        </div>
                    </a>

                    <?php if (isset($_SESSION['admin'])): ?>
                        <div class="action-btn" style="padding: 0 20px 20px;">
                            <a href="update.php?id=<?= (int) $row['id_koleksi']; ?>" class="btn-edit">Edit (Update)</a>
                            <a href="remove.php?id=<?= (int) $row['id_koleksi']; ?>" class="btn-delete" onclick="return confirm('Yakin hapus data ini?')">Hapus (Remove)</a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; grid-column: 1/-1; padding: 40px; color: #c5beb0;">Koleksi tidak ditemukan.</p>
        <?php endif; ?>
    </div>

    <?php if (mysqli_num_rows($result) > 0): ?>
    <section class="tabel-section">
        <h3>Tabel Data Koleksi</h3>
        <p class="ket">Nomor inventaris, judul, dan kategori koleksi, dibaca langsung dari tabel koleksi_artefak.</p>
        <div class="tabel-wrap">
            <table class="tabel-koleksi">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Inventaris</th>
                        <th>Judul Koleksi</th>
                        <th>Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php mysqli_data_seek($result, 0); $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nomor_inventaris']); ?></td>
                            <td><a href="detail.php?id=<?= (int) $row['id_koleksi']; ?>"><?= htmlspecialchars($row['judul_koleksi']); ?></a></td>
                            <td><?= htmlspecialchars($row['nama_kategori_koleksi']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php include 'layout/footer.php'; ?>

</body>
</html>