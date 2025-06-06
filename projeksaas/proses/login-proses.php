
<?php
session_start();
require_once '../config/db.php';

// Ambil input dari form
$nomor_id = $_POST['nomor_id'];
$password = $_POST['password'];

// Cari data user berdasarkan nomor_id
$query = $conn->prepare("SELECT * FROM users WHERE nomor_id = ?");
$query->bind_param("s", $nomor_id);
$query->execute();
$result = $query->get_result();

// Jika user ditemukan
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Jika password disimpan tanpa hash (langsung teks biasa)
    if ($password === $user['password']) {
        // Simpan data ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nomor_id'] = $user['nomor_id']; // Penting untuk digunakan di fitur lain
        $_SESSION['role'] = $user['role'];
        $_SESSION['nama'] = $user['nama'];

        // Jika kamu menambahkan kolom kelas di tabel users, kamu juga bisa:
        // $_SESSION['kelas'] = $user['kelas'];

        // Redirect ke halaman sesuai role
        if ($user['role'] === 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../siswa/dashboard.php");
        }
        exit;
    }
}

// Jika gagal login
header("Location: ../login/login.php?error=1");
exit;
