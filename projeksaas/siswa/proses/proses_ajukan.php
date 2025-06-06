<?php
session_start();
include "../../config/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'siswa') {
    header("Location: ../../login.php");
    exit;
}

// Ambil data dari form
$id_barang   = $_POST['id_barang'];
$alasan      = mysqli_real_escape_string($conn, $_POST['alasan']);
$jumlah      = (int)$_POST['jumlah'];
$jam_mulai   = $_POST['jam_mulai'];  // format: HH:MM
$jam_selesai = $_POST['jam_selesai']; // format: HH:MM
$nomor_id    = $_SESSION['nomor_id'];

// Ambil nama dan kelas siswa
$getUser = mysqli_query($conn, "SELECT nama, kelas FROM users WHERE nomor_id = '$nomor_id'");
$dataUser = mysqli_fetch_assoc($getUser);
$nama  = $dataUser['nama'];
$kelas = $dataUser['kelas'];

// Gabungkan tanggal hari ini dengan jam inputan
$tanggal_hari_ini = date("Y-m-d");
$tanggal_pinjam   = $tanggal_hari_ini . " " . $jam_mulai . ":00";
$tanggal_kembali  = $tanggal_hari_ini . " " . $jam_selesai . ":00";

// Hitung durasi dalam detik
$start         = strtotime($tanggal_pinjam);
$end           = strtotime($tanggal_kembali);
$durasi_detik  = $end - $start;

// 🔒 Cek stok barang terlebih dahulu
$cekBarang   = mysqli_query($conn, "SELECT stok FROM barang WHERE id = '$id_barang'");
$stokData    = mysqli_fetch_assoc($cekBarang);
$stokTersedia = $stokData['stok'];

if ($jumlah > $stokTersedia) {
    header("Location: ../ajukan.php?error=stok_limit");
    exit;
}

// Cek validasi waktu
if ($durasi_detik <= 0) {
    header("Location: ../ajukan.php?error=waktu");
    exit;
}

// ✅ Simpan ke tabel peminjaman
$query = "INSERT INTO peminjaman 
(nomor_id, nama, kelas, id_barang, alasan, jumlah, status, tanggal_pinjam, tanggal_kembali)
VALUES 
('$nomor_id', '$nama', '$kelas', '$id_barang', '$alasan', $jumlah, 'menunggu', '$tanggal_pinjam', '$tanggal_kembali')";

$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: ../ajukan.php?success=1");
} else {
    header("Location: ../ajukan.php?error=1");
}
?>
