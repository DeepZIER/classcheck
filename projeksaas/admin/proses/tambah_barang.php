<?php
include "../../config/db.php";

$nama = $_POST['nama_barang'];
$stok = $_POST['stok'];
$kondisi = $_POST['kondisi'];
$lokasi = $_POST['lokasi'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

$ext = pathinfo($gambar, PATHINFO_EXTENSION);
$namaFileBaru = uniqid() . '.' . $ext;

$folder = "../../uploads/";
move_uploaded_file($tmp, $folder . $namaFileBaru);

mysqli_query($conn, "INSERT INTO barang (nama_barang, stok, kondisi, lokasi, gambar) 
VALUES ('$nama', '$stok', '$kondisi', '$lokasi', '$namaFileBaru')");

header("Location: ../barang.php");
