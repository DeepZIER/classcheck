<?php
session_start();
session_destroy(); // Menghapus semua session

// Arahkan ke halaman login
header("Location: ../login/login.php");
header("Location: ../login/login.php?logout=1");
exit;

?>