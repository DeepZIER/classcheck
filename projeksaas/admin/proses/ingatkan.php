<?php
include "../../config/db.php";

$nomor_id = $_POST['nomor_id'];
$barang = $_POST['nama_barang'];

$pesan = "Segera kembalikan barang \"$barang\" karena waktu pinjam telah habis.";

mysqli_query($conn, "INSERT INTO notifikasi (nomor_id, pesan) VALUES ('$nomor_id', '$pesan')");

header("Location: ../dashboard.php?ingatkan=1");
exit;
