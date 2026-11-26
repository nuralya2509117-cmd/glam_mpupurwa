<?php
// Modul koneksi basis data terpusat (Tier Database).
// Dipanggil dari halaman lain dengan: include 'service/database.php';
$host     = "localhost";
$user     = "root";
$password = "";
$db       = "db_glam_mpupurwa";

try {
    $koneksi = mysqli_connect($host, $user, $password, $db);
} catch (mysqli_sql_exception $e) {
    $koneksi = false;
}

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");
