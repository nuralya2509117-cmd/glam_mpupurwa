<?php
session_start();
include 'service/database.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = mysqli_prepare($koneksi, "SELECT k.id_koleksi, k.nomor_inventaris, k.judul_koleksi, k.bahan, k.ukuran, k.asal, k.deskripsi, k.gambar, c.nama_kategori_koleksi
    FROM koleksi_artefak AS k
    JOIN kategori_koleksi AS c ON k.id_kategori_koleksi = c.id_kategori_koleksi
    WHERE k.id_koleksi = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$item = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$item) { header("Location: katalog.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Koleksi - Museum Mpu Purwa</title>
    <style>
        * {margin: 0;padding: 0;box-sizing: border-box;}
        body {font-family: Georgia, serif;
              background-color: #121414;
              color: #f2ebdd; }
        header {background-color: #1f3339;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 18px 8%;
                position: sticky;
                top: 0;
                z-index: 10;
                border-bottom: 1px solid #c5a24a;}
        .logo h1 {font-size: 25px; color: #f2ebdd;}
        .logo p {font-size: 11px;
                 letter-spacing: 2px;
                 color: #c5a24a;}
        nav {display: flex; gap: 25px; align-items: center; }
        nav a {text-decoration: none;
               color: #f2ebdd;
               font-family: Arial, sans-serif;
               font-size: 15px;
               transition: color 0.3s ease;}
        nav a:hover {color: #c5a24a;}
        .detail-container {padding: 50px 8% 70px; min-height: 650px;}
        .back {display: inline-block;
               text-decoration: none;
               color: #c5a24a;
               font-family: Arial, sans-serif;
               font-size: 14px;
               margin-bottom: 30px;
               transition: color 0.3s;}
        .back:hover {color: #f2ebdd;}
        .detail-content {display: grid;
                         grid-template-columns: 45% 55%;
                         gap: 50px;
                         align-items: flex-start;}
        .detail-image {background-color: #1f3339;
                       border-radius: 14px;
                       padding: 25px;
                       box-shadow: 0 5px 18px rgba(0, 0, 0, 0.35);
                       border: 1px solid #2d4750;
                       text-align: center;}
        .detail-image img {width: 100%;
                           max-width: 400px;
                           height: 430px;
                           object-fit: contain;
                           display: block;
                           margin: auto;}
        .detail-info {max-width: 550px;}
        .detail-info h2 {font-size: 42px;color: #f2ebdd;margin-bottom: 10px;}
        .kategori {font-family: Arial, sans-serif;
                   letter-spacing: 2px;
                   font-size: 13px;
                   color: #c5a24a;
                   margin-bottom: 20px;
                   font-weight: bold;}
        .deskripsi {font-family: Arial, sans-serif;
                    color: #c5beb0;
                    font-size: 15px;
                    line-height: 1.7;
                    margin-bottom: 25px;
                    white-space: pre-line;}
        .metadata {width: 100%;
                   border-collapse: collapse;
                   background-color: #1f3339;
                   border-radius: 10px;
                   overflow: hidden;
                   margin-bottom: 25px;
                   font-family: Arial, sans-serif;
                   border: 1px solid #2d4750;}
        .metadata th,
        .metadata td {padding: 13px 15px;
                      text-align: left;
                      border-bottom: 1px solid #2d4750;
                      font-size: 14px;}
        .metadata th {width: 35%;
                      color: #c5a24a;}
        .metadata td {color: #c5beb0;}
        .metadata tr:last-child th,
        .metadata tr:last-child td {border-bottom: none;}
        .back-button {display: inline-block;
                      background-color: #c5a24a;
                      color: #121414;
                      font-weight: bold;
                      padding: 13px 22px;
                      text-decoration: none;
                      border-radius: 7px;
                      font-family: Arial, sans-serif;
                      font-size: 14px;
                      transition: background-color 0.3s;}
        .back-button:hover {background-color: #e2be62;}
        footer {background-color: #121414;
                color: #f2ebdd;
                padding: 35px 8% 50px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-top: 1px solid #c5a24a;}
        footer h3 {font-size: 22px;
                   color: #f2ebdd;}
        footer p {font-family: Arial, sans-serif;
                  font-size: 13px;
                  margin-top: 8px;
                  color: #c5a24a;}
        @media(max-width: 900px) {
            nav { display: none; }
            .detail-content {
                grid-template-columns: 1fr;
                gap: 35px;}
            .detail-info { max-width: 100%; }
            .detail-info h2 { font-size: 34px; }
            .detail-image img { height: 350px; }}
    </style>
</head>
<body>
<?php $halaman_aktif = 'katalog'; include 'layout/header.php'; ?>
<main>
    <section class="detail-container">
        <a href="katalog.php" class="back">← Kembali ke Katalog</a>
        <div class="detail-content">
            <div class="detail-image">
                <img id="img-koleksi" src="<?= htmlspecialchars($item['gambar'] ?? ''); ?>" alt="<?= htmlspecialchars($item['judul_koleksi']); ?>">
            </div>
            <div class="detail-info">
                <h2 id="nama-benda"><?= htmlspecialchars($item['judul_koleksi']); ?></h2>
                <p class="kategori" id="no-inv">NO. INVENTARIS: <?= htmlspecialchars($item['nomor_inventaris']); ?></p>
                <table class="metadata">
                    <tr>
                        <th>Bahan</th>
                        <td id="bahan"><?= htmlspecialchars($item['bahan'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Ukuran</th>
                        <td id="ukuran"><?= htmlspecialchars($item['ukuran'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Asal</th>
                        <td id="asal"><?= htmlspecialchars($item['asal'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td><?= htmlspecialchars($item['nama_kategori_koleksi']); ?></td>
                    </tr>
                </table>
                <p class="deskripsi" id="deskripsi"><?= htmlspecialchars($item['deskripsi'] ?? ''); ?></p>
                <a href="katalog.php" class="back-button">← Kembali ke Katalog</a>
            </div>
        </div>
    </section>
</main>
<?php include 'layout/footer.php'; ?>
</body>
</html>