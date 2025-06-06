

<?php
session_start();
include "../config/db.php";

// Cek role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'siswa') {
    header("Location: ../login.php");
    exit;
}

// Ambil daftar barang dari database
$query = mysqli_query($conn, "SELECT * FROM barang");

// Ambil data peminjaman aktif oleh user
$nomor_id = $_SESSION['nomor_id'];
$peminjamanAktif = [];

$peminjamanQuery = mysqli_query($conn, "SELECT id_barang, status, tanggal_kembali FROM peminjaman WHERE nomor_id = '$nomor_id' AND status IN ('menunggu', 'dipinjam')");
while ($rowP = mysqli_fetch_assoc($peminjamanQuery)) {
    $peminjamanAktif[$rowP['id_barang']] = $rowP;
}

// Cek peminjaman yang sudah melewati waktu pengembalian
$now = date("Y-m-d H:i:s");

$peminjamanHabis = mysqli_query($conn, "
  SELECT id, id_barang, jumlah 
  FROM peminjaman 
  WHERE status = 'dipinjam' AND tanggal_kembali < '$now'
");

while ($row = mysqli_fetch_assoc($peminjamanHabis)) {
    $id_peminjaman = $row['id'];
    $id_barang = $row['id_barang'];
    $jumlah = $row['jumlah'];

    // Kembalikan stok
    mysqli_query($conn, "UPDATE barang SET stok = stok + $jumlah WHERE id = '$id_barang'");

    // Update status peminjaman
    mysqli_query($conn, "UPDATE peminjaman SET status = 'selesai' WHERE id = '$id_peminjaman'");
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ajukan Peminjaman</title>
  <link rel="stylesheet" href="style/dashboard.css">
  <link rel="stylesheet" href="style/ajukan.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

    <!-- Modal logout -->
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
        <li><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="ajukan.php" class="active"><i class="fas fa-box-open"></i> Ajukan Peminjaman</a></li>
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

    <!-- Notifikasi sukses -->
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success">
        ✅ Pengajuan berhasil! Silakan cek di halaman <a href="status.php">Status Peminjaman</a>.
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['error']) && $_GET['error'] === 'stok_limit'): ?>
  <div class="alert alert-danger" id="alertStok">
    ⚠️ Jumlah barang yang dipinjam melebihi stok yang tersedia!
  </div>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] === 'waktu'): ?>
  <div class="alert alert-danger" id="alertWaktu">
    ❌ Waktu peminjaman tidak valid. Harap pilih waktu yang benar!
  </div>
<?php endif; ?>

    <!-- Main Content -->
  <main class="main-content">
  <h1>Ajukan Peminjaman</h1>
  <p>Pilih barang yang ingin dipinjam dan isi detail peminjaman.</p>

  <div class="card-container">
    <?php while($row = mysqli_fetch_assoc($query)): ?>
      <div class="barang-card">
        <img src="../uploads/<?= $row['gambar'] ?>" alt="<?= $row['nama_barang'] ?>">
        <h3><?= $row['nama_barang'] ?></h3>
        <p><strong>Stok:</strong> <?= $row['stok'] ?></p>
        <p><strong>Kondisi:</strong> <?= $row['kondisi'] ?></p>
        <p><strong>Lokasi:</strong> <?= $row['lokasi'] ?></p>

        <?php if ($row['stok'] > 0): ?>
          <button class="toggle-form-btn" data-id="<?= $row['id'] ?>">Pinjam</button>
         
        <?php else: ?>
          <p class="countdown">Stok Habis</p>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </div>
  <!-- Modal Form Peminjaman -->
<div id="formModal" class="modal hidden">
  <div class="modal-content">
    <span class="close-btn" onclick="closeFormModal()">&times;</span>
    <h3>Form Peminjaman</h3>
    <form id="modalForm" action="proses/proses_ajukan.php" method="POST">
      <input type="hidden" name="id_barang" id="modal_id_barang">
      <input type="number" name="jumlah" min="1" max="<?= $row['stok'] ?>" placeholder="Jumlah" required>
      <input type="time" name="jam_mulai" required>
      <input type="time" name="jam_selesai" required>
      <input type="text" name="alasan" placeholder="Alasan" required>
      <button type="submit">Ajukan</button>
    </form>
  </div>
</div>
</main>
  </div>

<!-- Script Logout -->
<script src="../script/logout.js"></script>

<script src="script/bar.js"></script>

<!-- Alert success auto fade -->
<script>
  const alertBox = document.querySelector('.alert-success');
  if (alertBox) {
    setTimeout(() => {
      alertBox.classList.add('fade-out');
    }, 3000);
    setTimeout(() => {
      alertBox.style.display = 'none';
      const url = new URL(window.location);
      url.searchParams.delete('success');
      window.history.replaceState({}, document.title, url);
    }, 3500);
  }
</script>



<script>
  // Buka Modal
  document.querySelectorAll('.toggle-form-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.dataset.id;
      document.getElementById('modal_id_barang').value = id;
      document.getElementById('formModal').classList.remove('hidden');
    });
  });

  // Tutup Modal
  function closeFormModal() {
    document.getElementById('formModal').classList.add('hidden');
  }

  // Tutup jika klik di luar modal-content
  window.onclick = function(event) {
    const modal = document.getElementById('formModal');
    if (event.target === modal) {
      closeFormModal();
    }
  }


  Countdown
  function startCountdown() {
    const countdowns = document.querySelectorAll('.countdown');
    countdowns.forEach(cd => {
      const endTime = new Date(cd.dataset.time).getTime();
      const interval = setInterval(() => {
        const now = new Date().getTime();
        const distance = endTime - now;
        if (distance <= 0) {
          cd.innerText = "Tersedia";
          clearInterval(interval);
        } else {
          const h = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const m = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          const s = Math.floor((distance % (1000 * 60)) / 1000);
          cd.innerText = `Tersedia dalam ${h}j ${m}m ${s}d`;
        }
      }, 1000);
    });
  }
  startCountdown();
// </script>

 <script>
  const stokAlert = document.getElementById('alertStok');
  if (stokAlert) {
    setTimeout(() => {
      stokAlert.classList.add('fade-out');
    }, 3000);

    setTimeout(() => {
      stokAlert.style.display = 'none';
      const url = new URL(window.location);
      url.searchParams.delete('error');
      window.history.replaceState({}, document.title, url);
    }, 3500);
  }
</script>

<script>
  const alertWaktu = document.getElementById('alertWaktu');
  if (alertWaktu) {
    setTimeout(() => {
      alertWaktu.classList.add('fade-out');
    }, 3000);
    setTimeout(() => {
      alertWaktu.remove();
      const url = new URL(window.location);
      url.searchParams.delete('error');
      window.history.replaceState({}, document.title, url);
    }, 3500);
  }
</script>


</body>
</html>
