<?php
include "../../config/db.php";

$id_peminjaman = $_POST['id_peminjaman'];
$id_barang = $_POST['id_barang'];
$jumlah = $_POST['jumlah'];


mysqli_query($conn, "UPDATE barang SET stok = stok + $jumlah WHERE id = '$id_barang'");
// Update status jadi dikembalikan
mysqli_query($conn, "UPDATE peminjaman SET status = 'dikembalikan' WHERE id = '$id_peminjaman'");

header("Location: ../dashboard.php?selesai=1");
exit;
