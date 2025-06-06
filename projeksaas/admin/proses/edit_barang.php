<?php
session_start();
include "../../config/db.php";
$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT * FROM barang WHERE id = $id");
$barang = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Barang</title>
  <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
<div class="admin-wrapper">
  <aside class="admin-sidebar">
    <h2>SIJA - Admin</h2>
    <ul>
      <li><a href="../dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="../peminjaman.php"><i class="fas fa-box-open"></i> Data Peminjaman</a></li>
      <li><a href="../barang.php" class="active"><i  class="fas fa-warehouse"></i> Kelola Barang</a></li>
      <li><a href="../riwayat.php"><i class="fas fa-history"></i> Riwayat</a></li>
      <li><a href="../profil.php"><i class="fas fa-user"></i> Profil</a></li>
      <li><a href="../proses/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </aside>
  <main class="admin-main">
    <h1>Edit Barang</h1>
    <form action="update_barang.php" method="POST" enctype="multipart/form-data" class="form-barang">
      <input type="hidden" name="id" value="<?= $barang['id'] ?>">
      <input type="text" name="nama_barang" value="<?= $barang['nama_barang'] ?>" required>
      <input type="number" name="stok" value="<?= $barang['stok'] ?>" required>
      <input type="text" name="kondisi" value="<?= $barang['kondisi'] ?>" required>
      <input type="text" name="lokasi" value="<?= $barang['lokasi'] ?>" required>
      <label>Ganti Gambar (kosongkan jika tidak ingin diubah)</label>
      <input type="file" name="gambar">
      <button type="submit">Update</button>
    </form>
  </main>
</div>
</body>
</html>
