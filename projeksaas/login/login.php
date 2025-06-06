<?php 
include "../config/db.php";
?>

<?php
$showError = isset($_GET['error']) && $_GET['error'] == 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - Ruang Alat</title>
  <link rel="stylesheet" href="../assets/style/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>

 
 <div class="container">
   <div class="sidebar">
     <h1>Login</h1>
     <a href="../index.php" class="back-btn"><i class="fas fa-arrow-circle-left fa-3x"></i></a>
     <p>SIJA SMKN 26</p>
    </div>
    

<?php if (isset($_GET['error'])): ?>
  <div id="loginAlert" class="alert hidden">Nomor ID atau Kata Sandi salah!</div>
<?php endif; ?>

<?php if (isset($_GET['logout'])): ?>
  <div id="logoutAlert" class="alert success hidden">Kamu berhasil logout.</div>
<?php endif; ?>

    <div class="login-box">
   
    <h2>Sebelum Masukk!</h2>
    <p>Tunjukkan bahwa kamu <strong>THE REAL SIJA!!</strong></p>

    <form id="loginForm" action="../proses/login-proses.php" method="POST">
      <div class="input-group">
        <input type="text" name="nomor_id" id="nomor_id" required>
        <label for="nomor_id">Nomor ID</label>
      </div>
      <div class="input-group">
        <input type="password" name="password" id="password" required>
        <label for="password">Kata Sandi</label>
      </div>

      <button type="submit" id="submitBtn">
        <span class="btn-text">Masuk</span>
        <span class="spinner"></span>
      </button>
    </form>
  </div>

  <!-- Hiasan lingkaran -->
  <div class="circle circle1"></div>
  <div class="circle circle2"></div>
  <div class="circle circle3"></div>
  <div class="circle circle4"></div>
</div>

<script>
 
  const urlParams = new URLSearchParams(window.location.search);
  const loginAlert = document.getElementById('loginAlert');
  const logoutAlert = document.getElementById('logoutAlert');

  function showAlert(alertBox) {
    if (!alertBox) return;

    alertBox.classList.remove('hidden');
    alertBox.classList.add('show');

    // Hilang otomatis setelah 3 detik
    setTimeout(() => {
      alertBox.classList.remove('show');
      alertBox.style.opacity = '0';
      alertBox.style.transform = 'translateY(-10px)';

      // Hapus dari tampilan setelah transisi
      setTimeout(() => {
        alertBox.classList.add('hidden');

        // Bersihkan URL
        const newUrl = window.location.origin + window.location.pathname;
        window.history.replaceState({}, document.title, newUrl);
      }, 500);
    }, 3000);
  }

  if (urlParams.has('error')) {
    showAlert(loginAlert);
  }

  if (urlParams.has('logout')) {
    showAlert(logoutAlert);
  }

</script>
</body>
</html>
