<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$nama = $_SESSION['nama'];

$totalBarang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM barang"))['total'];
$totalPeminjaman = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman WHERE status IN ('dipinjam', 'dikembalikan')"))['total'];
$barangDipinjam = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman WHERE status = 'dipinjam'"))['total'];
$barangMenunggu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM peminjaman WHERE status = 'menunggu'"))['total'];

// Ambil daftar barang yang sedang dipinjam
$countdownItems = mysqli_query($conn, "
  SELECT p.*, b.nama_barang, b.gambar, u.nama 
  FROM peminjaman p 
  JOIN barang b ON p.id_barang = b.id 
  JOIN users u ON p.nomor_id = u.nomor_id 
  WHERE p.status = 'dipinjam'
");


?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin - Dashboard</title>
  <link rel="stylesheet" href="style/dashboard.css">
  <link rel="stylesheet" href="style/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
  <div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
      <h2>SIJA - Admin</h2>
      <ul>
        <li><a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="persetujuan.php"><i class="fas fa-box-open"></i> Persetujuan</a></li>
        <li><a href="barang.php"><i class="fas fa-warehouse"></i> Kelola Barang</a></li>
        <li><a href="riwayat.php"><i class="fas fa-history"></i> Riwayat</a></li>
        <li><a href="akun.php"><i class="fas fa-users"></i> Kelola Akun</a></li>
        <li><a href=""  id="logoutBtn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </aside>

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

    <!-- Main Content -->
    <main class="admin-main">
      <header class="admin-header">
        <h1>Halo, <?= $nama ?></h1>
        <p>Anda login sebagai <strong>Admin</strong>.</p>
      </header>

    
        <section class="admin-dashboard">
  <h2>Ringkasan</h2>
  <div class="cards">
    <div class="card summary-card">
      <i class="fas fa-boxes icon"></i>
      <div>
        <h3><?= $totalBarang ?></h3>
        <p>Total Barang</p>
      </div>
    </div>
    <div class="card summary-card">
      <i class="fas fa-file-alt icon"></i>
      <div>
        <h3><?= $totalPeminjaman ?></h3>
        <p>Total Peminjam</p>
      </div>
    </div>
    <div class="card summary-card">
      <i class="fas fa-arrow-up icon"></i>
      <div>
        <h3><?= $barangDipinjam ?></h3>
        <p>Barang Dipinjam</p>
      </div>
    </div>
    <div class="card summary-card">
      <i class="fas fa-hourglass-half icon"></i>
      <div>
        <h3><?= $barangMenunggu ?></h3>
        <p>Menunggu Persetujuan</p>
      </div>
    </div>
  </div>
  <p>Silakan gunakan menu di samping untuk mengelola data peminjaman dan barang.</p>
</section>


<!-- countdown -->
       <section style="margin-top: 40px;">
  <h2 style="margin-bottom: 15px;">⏳ Barang Sedang Dipinjam</h2>
  <div class="card-container-countdown">
    <?php while ($row = mysqli_fetch_assoc($countdownItems)): ?>
      <div class="countdown-card">
        <img src="../uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>">
        <div class="countdown-card-content">
          <h3><?= $row['nama_barang'] ?></h3>
          <p><strong>Peminjam:</strong> <?= $row['nama'] ?></p>
          <p><strong>Jumlah:</strong> <?= $row['jumlah'] ?></p>
        
        <p><strong>Sisa Waktu:</strong> 
          <span class="countdown" data-id="<?= $row['id'] ?>" data-time="<?= date('Y-m-d\TH:i:s', strtotime($row['tanggal_kembali'])) ?>"></span>
        </p>

          <div class="action-buttons" id="action-<?= $row['id'] ?>" style="display: none;">
      <form action="proses/ingatkan.php" method="POST" style="display:inline;">
        <input type="hidden" name="nomor_id" value="<?= $row['nomor_id'] ?>">
        <input type="hidden" name="nama_barang" value="<?= $row['nama_barang'] ?>">
        <button class="btn-approve" type="submit">Ingatkan</button>
      </form>
      <form action="proses/selesai.php" method="POST" style="display:inline;">
        <input type="hidden" name="id_peminjaman" value="<?= $row['id'] ?>">
        <input type="hidden" name="id_barang" value="<?= $row['id_barang'] ?>">
        <input type="hidden" name="jumlah" value="<?= $row['jumlah'] ?>">
        <button class="btn-reject" type="submit">Selesai</button>
      </form>
    </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</section>


    </main>
  </div>
    <script src="../script/logout.js"></script>
    <script src="script/dashboard.js"></script>
</body>
</html>
