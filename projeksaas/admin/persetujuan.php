<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil data peminjaman yang masih menunggu persetujuan
$query = mysqli_query($conn, "
  SELECT p.*, b.nama_barang, b.gambar, u.nama 
  FROM peminjaman p 
  JOIN barang b ON p.id_barang = b.id 
  JOIN users u ON p.nomor_id = u.nomor_id 
  WHERE p.status = 'menunggu' 
  ORDER BY p.tanggal_pinjam DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Persetujuan Peminjaman</title>
  <link rel="stylesheet" href="style/admin.css">
  <link rel="stylesheet" href="style/persetujuan.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
 
</head>
<body>
<div class="admin-wrapper">
  <!-- Sidebar -->
  <aside class="admin-sidebar">
    <h2>SIJA - Admin</h2>
    <ul>
      <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="persetujuan.php" class="active"><i class="fas fa-box-open"></i> Persetujuan</a></li>
      <li><a href="barang.php"><i class="fas fa-warehouse"></i> Kelola Barang</a></li>
      <li><a href="riwayat.php"><i class="fas fa-history"></i> Riwayat</a></li>
      <li><a href="akun.php"><i class="fas fa-users"></i> Kelola Akun</a></li>
      <li><a href="" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </aside>

 <div id="logoutModal" class="modal hidden">
            <div class="modal-content">
          <p>Yakin ingin logout?</p>
        <div class="modal-buttons">
            <button id="cancelLogout" class="btn cancel">Batal</button>
          <a href="../proses/logout.php" class="btn logout-confirm">Logout</a>
        </div>
      </div>
    </div>

  <!-- Main Content -->
  <main class="admin-main">
    <h1>Persetujuan Peminjaman</h1>

    <div class="card-container">
      <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="card">
          <img src="../uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>">
          <h3><?= $row['nama_barang'] ?></h3>
          <p><strong>Nama:</strong> <?= $row['nama'] ?></p>
          <p><strong>Jumlah:</strong> <?= $row['jumlah'] ?></p>
          <p><strong>Alasan:</strong> <?= $row['alasan'] ?></p>
          <p><strong>Waktu:</strong><br><?= date('d M Y H:i', strtotime($row['tanggal_pinjam'])) ?> - <?= date('H:i', strtotime($row['tanggal_kembali'])) ?></p>
          <form action="proses/konfirmasi.php" method="POST">
            <input type="hidden" name="id_peminjaman" value="<?= $row['id'] ?>">
            <input type="hidden" name="id_barang" value="<?= $row['id_barang'] ?>">
            <input type="hidden" name="jumlah" value="<?= $row['jumlah'] ?>">
            <button class="btn-approve" name="aksi" value="setujui" type="submit">Setujui</button>
            <button class="btn-reject" name="aksi" value="tolak" type="submit">Tolak</button>
          </form>
        </div>
      <?php endwhile; ?>
    </div>
  </main>
</div>

  <script src="../script/logout.js"></script>
</body>
</html>
