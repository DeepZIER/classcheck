<?php
include "../../config/db.php";

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama_barang'];
  $stok = $_POST['stok'];
  $kondisi = $_POST['kondisi'];
  $lokasi = $_POST['lokasi'];

  // Jika gambar baru diupload
  if (!empty($_FILES['gambar']['name'])) {
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $ext = pathinfo($gambar, PATHINFO_EXTENSION);
    $namaFileBaru = uniqid() . '.' . $ext;

    move_uploaded_file($tmp, "../../uploads/" . $namaFileBaru);

    // Update semua termasuk gambar
    $query = "UPDATE barang SET 
      nama_barang='$nama', 
      stok='$stok', 
      kondisi='$kondisi', 
      lokasi='$lokasi',
      gambar='$namaFileBaru'
      WHERE id=$id";

  } else {
    // Update tanpa gambar
    $query = "UPDATE barang SET 
      nama_barang='$nama', 
      stok='$stok', 
      kondisi='$kondisi', 
      lokasi='$lokasi'
      WHERE id=$id";
  }

  $result = mysqli_query($conn, $query);

  if ($result) {
    header("Location: ../barang.php?update=success");
  } else {
    echo "Gagal update data: " . mysqli_error($conn);
  }
} else {
  echo "ID barang tidak ditemukan.";
}
