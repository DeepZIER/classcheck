
<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'siswa') {
    header("Location: ../login.php");
    exit;
}

include "../config/db.php";
?>

<?php
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'siswa') {
    header("Location: ../login.php");
    exit;
}

$nomor_id = $_SESSION['nomor_id'];
$dipinjamQuery = mysqli_query($conn, "
    SELECT p.*, b.nama_barang, b.gambar 
    FROM peminjaman p 
    JOIN barang b ON p.id_barang = b.id 
    WHERE p.nomor_id = '$nomor_id' AND p.status = 'dipinjam'
");
?>



<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Siswa</title>
  <link rel="stylesheet" href="style/dashboard.css"/>
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
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>SIJA</h2>
      <ul>
        <li><a href="#" class="active"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="ajukan.php"><i class="fas fa-box-open"></i> Ajukan Peminjaman</a></li>
        <li><a href="status.php"><i class="fas fa-clock"></i> Status Peminjaman</a></li>
        <li><a href="riwayat.php"><i class="fas fa-history"></i> Riwayat</a></li>
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

    <!-- Main content -->
    <main class="main-content">
      <header>
        <div class="top-bar">
          <span class="role-icon">🎓</span>
          <span class="user-name"><?= $_SESSION['nama']; ?></span>
        </div>
      </header>

      <section class="dashboard">
        <h1>Halo, Selamat datang!</h1>
        <p>Silakan ajukan peminjaman barang melalui menu di samping.</p>
      </section>

     <h2>Barang yang sedang dipinjam</h2>
<div class="card-container">
  <?php while ($row = mysqli_fetch_assoc($dipinjamQuery)): ?>
    <div class="card">
      <img src="../uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>" style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px;">
      <h3><?= $row['nama_barang'] ?></h3>
      <p><strong>Jumlah:</strong> <?= $row['jumlah'] ?></p>
      <p><strong>Batas Pengembalian:</strong></p>
      <span class="countdown" data-time="<?= date('Y-m-d\TH:i:s', strtotime($row['tanggal_kembali'])) ?>"></span>
    </div>
  <?php endwhile; ?>
</div>


    </main>
  </div>
  
  <script src="../script/logout.js"></script>
  <script src="script/bar.js"></script>

  <script>
function startCountdown() {
  const countdowns = document.querySelectorAll('.countdown');
  countdowns.forEach(cd => {
    const endTime = new Date(cd.dataset.time).getTime();
    if (!endTime || isNaN(endTime)) {
      cd.innerText = "Waktu tidak valid";
      return;
    }

    const interval = setInterval(() => {
      const now = new Date().getTime();
      const distance = endTime - now;

      if (distance <= 0) {
        cd.innerText = "Sudah jatuh tempo!";
        clearInterval(interval);
      } else {
        const h = Math.floor((distance / (1000 * 60 * 60)) % 24);
        const m = Math.floor((distance / (1000 * 60)) % 60);
        const s = Math.floor((distance / 1000) % 60);
        cd.innerText = `${h}j ${m}m ${s}d`;
      }
    }, 1000);
  });
}
startCountdown();
</script>

</body>
</html>
