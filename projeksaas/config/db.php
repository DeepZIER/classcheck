<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "peminjaman_jurusan";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if ($conn->connect_error) {

    die("Koneksi gagal: " . $conn->connect_error);
}

?> 