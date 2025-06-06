<?php
include "../../config/db.php";

$id = $_GET['id'];

// Ambil data peminjaman
$data = mysqli_query($conn, "SELECT id_barang, jumlah FROM peminjaman WHERE id = '$id'");
$peminjaman = mysqli_fetch_assoc($data);

$id_barang = $peminjaman['id_barang'];
$jumlah = $peminjaman['jumlah'];

// Kurangi stok barang
mysqli_query($conn, "UPDATE barang SET stok = stok - $jumlah WHERE id = '$id_barang'");

// Update status peminjaman
mysqli_query($conn, "UPDATE peminjaman SET status = 'dipinjam' WHERE id = '$id'");

header("Location: ../peminjaman.php?success=disetujui");
?>
