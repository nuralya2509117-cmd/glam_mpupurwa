<?php
// Komponen header (logo dan navigasi), dipakai ulang di banyak halaman.
// Pemakaian: $halaman_aktif = 'katalog'; include 'layout/header.php';
// Halaman pemanggil harus sudah menjalankan session_start().
$halaman_aktif = $halaman_aktif ?? '';
?>
<header>
    <div class="logo">
        <h1>MUSEUM MPU PURWA</h1>
        <p>WARISAN MASA LALU</p>
    </div>
    <nav>
        <a href="index.php" class="<?= $halaman_aktif === 'beranda' ? 'active' : ''; ?>">Beranda</a>
        <a href="tentang.php" class="<?= $halaman_aktif === 'tentang' ? 'active' : ''; ?>">Tentang</a>
        <a href="katalog.php" class="<?= $halaman_aktif === 'katalog' ? 'active' : ''; ?>">Koleksi</a>
        <a href="pengunjung.php" class="<?= $halaman_aktif === 'pengunjung' ? 'active' : ''; ?>">Kunjungan</a>
        <a href="lokasi.php" class="<?= $halaman_aktif === 'lokasi' ? 'active' : ''; ?>">Lokasi 📍</a>
        <?php if (isset($_SESSION['admin'])): ?>
            <a href="logout.php" style="color: #ff6b6b; font-weight: bold;">Logout (<?= htmlspecialchars($_SESSION['admin']); ?>)</a>
        <?php else: ?>
            <a href="login.php" style="color: #c5a24a; font-weight: bold;">Login Admin</a>
        <?php endif; ?>
    </nav>
</header>
