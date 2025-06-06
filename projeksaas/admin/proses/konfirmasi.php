<?php
session_start();
include "../../config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
}

$id = $_POST['id_peminjaman'];
$aksi = $_POST['aksi'];

if ($aksi === "setujui") {
    mysqli_query($conn, "UPDATE peminjaman SET status = 'dipinjam' WHERE id = '$id'");
    // Kurangi stok
    $jumlah = $_POST['jumlah'];
    $id_barang = $_POST['id_barang'];
    mysqli_query($conn, "UPDATE barang SET stok = stok - $jumlah WHERE id = '$id_barang'");
} elseif ($aksi === "tolak") {
    mysqli_query($conn, "UPDATE peminjaman SET status = 'ditolak' WHERE id = '$id'");
}

header("Location: ../persetujuan.php");
exit;
?>



