<?php
session_start();
include "../config/db.php";

// Cek role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Ambil seluruh riwayat peminjaman (tanpa filter status)
$query = mysqli_query($conn, "
  SELECT p.*, b.nama_barang 
  FROM peminjaman p 
  JOIN barang b ON p.id_barang = b.id 
  ORDER BY p.tanggal_pinjam DESC
");
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Peminjaman</title>
  <link rel="stylesheet" href="style/riwayat.css">
  <link rel="stylesheet" href="style/admin.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="admin-wrapper">
  <!-- Sidebar -->
  <aside class="admin-sidebar">
    <h2>SIJA - Admin</h2>
    <ul>
      <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="persetujuan.php"><i class="fas fa-box-open"></i> Persetujuan</a></li>
      <li><a href="barang.php"><i class="fas fa-warehouse"></i> Kelola Barang</a></li>
      <li><a href="riwayat.php" class="active"><i class="fas fa-history"></i> Riwayat</a></li>
        <li><a href="akun.php"><i class="fas fa-users"></i> Kelola Akun</a></li>
      <li><a href="../proses/logout.php" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
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

  <!-- Konten -->
  <main class="admin-main">
    <h1>Riwayat Peminjaman</h1>
    <table class="table-barang">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Barang</th>
          <th>Jumlah</th>
          <th>Alasan</th>
          <th>Tgl Pinjam</th>
          <th>Tgl Kembali</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($query)): ?>
          <tr>
            <td><?= $row['nama'] ?></td>
            <td><?= $row['kelas'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td><?= $row['alasan'] ?></td>
            <td><?= date('d-m-Y H:i', strtotime($row['tanggal_pinjam'])) ?></td>
            <td><?= date('d-m-Y H:i', strtotime($row['tanggal_kembali'])) ?></td>
            <td><?php
    $status = $row['status'];
    $class = match($status) {
      'menunggu'   => 'badge orange',
      'dipinjam'   => 'badge blue',
      'ditolak'    => 'badge red',
      'dikembalikan' => 'badge green',
      default      => 'badge'
    };
  ?>
  <span class="<?= $class ?>"><?= ucfirst($status) ?></span>
</td>


          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>
</div>

<script src="../script/logout.js"></script>
</body>
</html>
