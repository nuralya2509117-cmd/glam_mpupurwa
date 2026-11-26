<?php
session_start();
include 'service/database.php';
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = mysqli_prepare($koneksi, "DELETE FROM koleksi_artefak WHERE id_koleksi = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
header("Location: katalog.php");
exit();
?>