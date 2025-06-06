<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Akun</title>
    <link rel="icon" type="" href="favicon.ico">
  <link rel="stylesheet" href="style/akun.css">
  <link rel="stylesheet" href="style/admin.css">
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
      <li><a href="barang.php"><i class="fas fa-warehouse"></i> Kelola Barang</a></li>
      <li><a href="riwayat.php"><i class="fas fa-history"></i> Riwayat</a></li>
      <li><a href="akun.php" class="active"><i class="fas fa-users"></i> Kelola Akun</a></li>
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

 <?php if (isset($_SESSION['notif_hapus'])): ?>
  <div class="alert alert-success" id="alertHapus">
    ✅ <?= $_SESSION['notif_hapus'] ?>
  </div>
  <?php unset($_SESSION['notif_hapus']); ?>
<?php endif; ?>




  <main class="admin-main">
    <h1>Daftar Akun</h1>

   <!-- Tombol -->
<button id="openUserModal" class="btn-tambah">Tambah User</button>

<!-- Modal -->
<div id="userModal" class="modal hidden">
  <div class="modal-content">
    <h3>Tambah Akun Baru</h3>
    <form action="proses/tambah_user.php" method="POST" class="form-barang">
      <input type="text" name="nama" placeholder="Nama Lengkap" required>
      <input type="text" name="nomor_id" placeholder="Nomor ID" required>
      <input type="password" name="password" placeholder="Kata Sandi" required>
      <select name="kelas" required>
        <option value="">-- Pilih kelas --</option>
        <option value="X SIJA 1">X SIJA 1</option>
        <option value="X SIJA 2">X SIJA 2</option>
        <option value="XI SIJA 1">XI SIJA 1</option>
        <option value="XI SIJA 2">XI SIJA 2</option>
        <option value="XII SIJA 1">XII SIJA 1</option>
        <option value="XII SIJA 2">XII SIJA 2</option>
      </select>
      <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="siswa">Siswa</option>
      </select>
      <div class="modal-buttons">
        <button type="button" id="closeUserModal" class="btn cancel">Batal</button>
        <button type="submit" class="btn submit">Simpan</button>
      </div>
    </form>
  </div>
</div>


    <table class="table-barang">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Nomor ID</th>
          <th>Kelas</th>
          <th>Password</th>
          <th>Role</th>
          <th>Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php while($u = mysqli_fetch_assoc($users)): ?>
        <tr>
          <td><?= $u['nama'] ?></td>
          <td><?= $u['nomor_id'] ?></td>
          <td><?= $u['kelas'] ?></td>
          <td><?= $u['password'] ?></td>
          <td><?= ucfirst($u['role']) ?></td>
        <td>
  <a href="proses/hapus_akun.php?id=<?= $u['id'] ?>" 
     class="btn-reject" 
     onclick="return confirm('Yakin ingin menghapus akun ini?')">
     Hapus
  </a>
</td>

        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>
</div>

<script>
  const modal = document.getElementById("userModal");
  const openBtn = document.getElementById("openUserModal");
  const closeBtn = document.getElementById("closeUserModal");

  openBtn.addEventListener("click", () => {
    modal.classList.remove("hidden");
  });

  closeBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
  });
</script>

<script>
  const alertBox = document.getElementById('alertHapus');
  if (alertBox) {
    setTimeout(() => {
      alertBox.classList.add('fade-out');
    }, 3000);

    setTimeout(() => {
      alertBox.remove();
    }, 3500);
  }
</script>


<script src="../script/logout.js"></script>
</body>
</html>
