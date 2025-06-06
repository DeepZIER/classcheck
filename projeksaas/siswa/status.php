<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'siswa') {
    header("Location: ../login.php");
    exit;
}

$nomor_id = $_SESSION['nomor_id'];
$query = mysqli_query($conn, "
  SELECT p.*, b.nama_barang, b.gambar 
  FROM peminjaman p 
  JOIN barang b ON p.id_barang = b.id 
  WHERE p.nomor_id = '$nomor_id' 
  ORDER BY p.tanggal_pinjam DESC
");

// Cek otomatis untuk peminjaman yang sudah selesai
$cek_kembali = mysqli_query($conn, "SELECT * FROM peminjaman WHERE status = 'dipinjam' AND tanggal_kembali < NOW()");
while ($row = mysqli_fetch_assoc($cek_kembali)) {
    $jumlah = $row['jumlah'];
    $id_barang = $row['id_barang'];
    $id_peminjaman = $row['id'];

    mysqli_query($conn, "UPDATE peminjaman SET status = 'dikembalikan' WHERE id = '$id_peminjaman'");
    mysqli_query($conn, "UPDATE barang SET stok = stok + $jumlah WHERE id = '$id_barang'");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Status Peminjaman</title>
  <link rel="stylesheet" href="style/dashboard.css">
  <link rel="stylesheet" href="style/status.css">
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
        <li><a href="status.php" class="active"><i class="fas fa-clock"></i> Status Peminjaman</a></li>
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

  <main class="main-content">
    <div class="top-bar">
      <span class="role-icon">🎓</span>
      <span class="user-name"><?= $_SESSION['nama']; ?></span>
    </div>
    <h1>Status Peminjaman</h1>

    <!-- Filter Tombol -->
    <div class="status-filter">
      <button class="filter-btn active" data-status="menunggu">Menunggu</button>
      <button class="filter-btn" data-status="dipinjam">Dipinjam</button>
      <button class="filter-btn" data-status="ditolak">Ditolak</button>
    </div>

    <!-- Kartu Peminjaman -->
    <div class="cards-container">
      <?php while ($row = mysqli_fetch_assoc($query)): ?>
        <div class="card status-<?= $row['status'] ?>">
          <img src="../uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>">
          <div class="card-info">
            <h3><?= $row['nama_barang'] ?></h3>
            <p><strong>Jumlah:</strong> <?= $row['jumlah'] ?></p>
            <p><strong>Status:</strong> <?= ucfirst($row['status']) ?></p>
            <p><strong>Pinjam:</strong> <?= date('d M Y H:i', strtotime($row['tanggal_pinjam'])) ?></p>
            <p><strong>Kembali:</strong> <?= date('d M Y H:i', strtotime($row['tanggal_kembali'])) ?></p>
            <?php if ($row['status'] === 'dipinjam'): ?>
              <p class="countdown" data-time="<?= date('Y-m-d\TH:i:s', strtotime($row['tanggal_kembali'])) ?>"></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </main>
</div>


<!-- Script Logout -->
<script src="../script/logout.js"></script>
<script src="script/bar.js"></script>

<script>
// Filter tampilan berdasarkan status
const filterBtns = document.querySelectorAll(".filter-btn");
const cards = document.querySelectorAll(".card");

filterBtns.forEach(btn => {
  btn.addEventListener("click", () => {
    filterBtns.forEach(b => b.classList.remove("active"));
    btn.classList.add("active");
    const status = btn.dataset.status;
    cards.forEach(card => {
      if (card.classList.contains(`status-${status}`)) {
        card.style.display = "flex";
      } else {
        card.style.display = "none";
      }
    });
  });
});

// Countdown
document.querySelectorAll('.countdown').forEach(cd => {
  const time = new Date(cd.dataset.time).getTime();
  const interval = setInterval(() => {
    const now = new Date().getTime();
    const diff = time - now;
    if (diff <= 0) {
      cd.textContent = "Waktu Habis";
      clearInterval(interval);
    } else {
      const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
      const m = Math.floor((diff / (1000 * 60)) % 60);
      const s = Math.floor((diff / 1000) % 60);
      cd.textContent = `${h}j ${m}m ${s}d`;
    }
  }, 1000);
});
</script>


</body>
</html>
