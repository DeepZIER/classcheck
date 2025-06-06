<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$barang = mysqli_query($conn, "SELECT * FROM barang");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Barang</title>
  <link rel="stylesheet" href="style/admin.css">
  <link rel="stylesheet" href="style/barang.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
<div class="admin-wrapper">
  <!-- Sidebar -->
  <aside class="admin-sidebar">
    <h2>SIJA - Admin</h2>
    <ul>
      <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
      <li><a href="persetujuan.php"><i class="fas fa-box-open"></i> Persetujuan</a></li>
      <li><a href="barang.php" class="active"><i class="fas fa-warehouse"></i> Kelola Barang</a></li>
      <li><a href="riwayat.php"><i class="fas fa-history"></i> Riwayat</a></li>
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

  <main class="admin-main">
    <h1>Kelola Barang</h1>

    <button id="openModalBtn" class="btn-primary">+ Tambah Barang</button>

    <!-- Modal Tambah -->
    <div id="modalTambah" class="modal hidden">
      <div class="modal-content">
        <span class="close-modal" id="closeModalBtn">&times;</span>
        <form action="proses/tambah_barang.php" method="POST" enctype="multipart/form-data" class="form-barang">
          <h2>Tambah Barang</h2>
          <input type="text" name="nama_barang" placeholder="Nama Barang" required>
          <input type="number" name="stok" placeholder="Stok" required>
          <input type="text" name="kondisi" placeholder="Kondisi" required>
          <input type="text" name="lokasi" placeholder="Lokasi" required>
          <input type="file" name="gambar" accept="image/*" required>
          <button type="submit">Tambah</button>
        </form>
      </div>
    </div>

    <!-- Card Barang -->
    <div class="card-container">
      <?php while ($row = mysqli_fetch_assoc($barang)): ?>
      <div class="card">
  <img src="../uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>">
  <h3><i class="fas fa-cube"></i> <?= $row['nama_barang'] ?></h3>
  <p><i class="fas fa-boxes"></i> Stok: <?= $row['stok'] ?></p>
  <p><i class="fas fa-check-circle"></i> Kondisi: <?= $row['kondisi'] ?></p>
  <p><i class="fas fa-map-marker-alt"></i> Lokasi: <?= $row['lokasi'] ?></p>

  <div class="card-actions">
    <a href="proses/edit_barang.php?id=<?= $row['id'] ?>" class="edit-btn"><i class="fas fa-edit"></i> Edit</a>
    <a href="proses/hapus_barang.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Hapus barang ini?')">
      <i class="fas fa-trash"></i> Hapus
    </a>
  </div>
</div>

      <?php endwhile; ?>
    </div>
  </main>
</div>

<script>
  const modal = document.getElementById('modalTambah');
  const openBtn = document.getElementById('openModalBtn');
  const closeBtn = document.getElementById('closeModalBtn');

  openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
  closeBtn.addEventListener('click', () => modal.classList.add('hidden'));

  window.addEventListener('click', (e) => {
    if (e.target === modal) modal.classList.add('hidden');
  });
</script>

<script src="../script/logout.js"></script>
</body>
</html>
