<?php
include "../../config/db.php";

$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$nomor_id = mysqli_real_escape_string($conn, $_POST['nomor_id']);
$password = $_POST['password']; // password disimpan apa adanya
$role = $_POST['role'];
$kelas     = isset($_POST['kelas']) ? mysqli_real_escape_string($conn, $_POST['kelas']) : null;

// Cek apakah nomor_id sudah ada
$cek = mysqli_query($conn, "SELECT * FROM users WHERE nomor_id = '$nomor_id'");
if (mysqli_num_rows($cek) > 0) {
    header("Location: ../akun.php?error=duplikat");
    exit;
}

$query = "INSERT INTO users (nama, nomor_id, kelas, password, role) VALUES ('$nama', '$nomor_id', '$kelas', '$password', '$role')";
$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: ../akun.php?success=1");
} else {
    header("Location: ../akun.php?error=1");
}
