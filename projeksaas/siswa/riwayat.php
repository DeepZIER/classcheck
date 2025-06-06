<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'siswa') {
    header("Location: ../login.php");
    exit;
}

$nomor_id = $_SESSION['nomor_id'];
$query = mysqli_query($conn, "
  SELECT p.*, b.nama_barang 
  FROM peminjaman p 
  JOIN barang b ON p.id_barang = b.id 
  WHERE p.nomor_id = '$nomor_id' 
    AND status IN ('dipinjam', 'ditolak', 'dikembalikan')
  ORDER BY p.tanggal_pinjam DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Peminjaman</title>
  <link rel="stylesheet" href="style/dashboard.css">
  <link rel="stylesheet" href="style/riwayat.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <!-- logout -->
<div id="logoutModal" class="modal hidden">
<div class="modal-content">
 <p>Yakin ingin logout?</p>
 <div class="modal-buttons">
   <button id="cancelLogout" class="btn cancel">Batal</button>
   <a href="../proses/logout.php" class="btn logout-confirm">Logout</a>
 </div>
</div>
</div>
<div class="wrapper">
   <aside class="sidebar">
      <h2>SIJA</h2>
      <ul>
        <li><a href="dashboard.php" ><i class="fas fa-home"></i> Home</a></li>
        <li><a href="ajukan.php"><i class="fas fa-box-open"></i> Ajukan Peminjaman</a></li>
        <li><a href="status.php"><i class="fas fa-clock"></i> Status Peminjaman</a></li>
        <li><a href="riwayat.php" class="active"><i class="fas fa-history"></i> Riwayat</a></li>
        <li><a href="../proses/logout.php" id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>  
      </ul>
    </aside>

    <!-- Navbar mobile -->
<div class="navbar-mobile">
  <button id="toggleSidebar"><i class="fas fa-bars"></i></button>
  <span class="navbar-user"><?= $_SESSION['nama']; ?></span>
</div>


    <!-- ingatkan -->
<?php
$notif = mysqli_query($conn, "SELECT * FROM notifikasi WHERE nomor_id = '$nomor_id' AND status = 'baru'");
?>

<?php while ($n = mysqli_fetch_assoc($notif)): ?>
  <div class="alert alert-danger">
    <?= $n['pesan'] ?>
  </div>
<?php endwhile; ?>

<!-- Ubah semua status jadi 'dibaca' setelah ditampilkan -->
<?php mysqli_query($conn, "UPDATE notifikasi SET status = 'dibaca' WHERE nomor_id = '$nomor_id'"); ?>

  <main class="main-content">
    <header>
      <div class="top-bar">
        <span class="role-icon">🎓</span>
        <span class="user-name"><?= $_SESSION['nama']; ?></span>
      </div>
    </header>
    <h1>Riwayat Peminjaman</h1>

    <table class="table-barang">
      <thead>
        <tr>
          <th>Barang</th>
          <th>Jumlah</th>
          <th>Status</th>
          <th>Waktu Pinjam</th>
          <th>Waktu Kembali</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = mysqli_fetch_assoc($query)): ?>
          <tr>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['jumlah'] ?></td>
            <td><span class="badge status-<?= $row['status'] ?>"><?= ucfirst($row['status']) ?></span></td>
            <td><?= date('d M Y H:i', strtotime($row['tanggal_pinjam'])) ?></td>
            <td><?= date('d M Y H:i', strtotime($row['tanggal_kembali'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>
</div>

<!-- Script Logout -->
<script src="../script/logout.js"></script>
<script src="script/bar.js"></script>
</body>
</html>
