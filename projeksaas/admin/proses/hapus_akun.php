<?php
session_start();
include "../../config/db.php";

if (!isset($_GET['id'])) {
    header("Location: ../akun.php");
    exit;
}

$id = $_GET['id'];

// Hapus akun dari database
mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");

// Set session notifikasi
$_SESSION['notif_hapus'] = "Akun berhasil dihapus.";

header("Location: ../akun.php");
exit;
