<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = trim($_POST['nama'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nama === '' || $username === '' || strlen($password) < 6) {
        $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'Mohon isi semua field dengan benar (password minimal 6 karakter).'];
        header('Location: register.php');
        exit;
    }

    // Pengecekan username duplikat
    $cek = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $cek->execute(['username' => $username]);
    if ($cek->fetch()) {
        $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'Username sudah digunakan.'];
        header('Location: register.php');
        exit;
    }

    // Insert user baru dengan Hashing Password
    $stmt = $pdo->prepare(
        "INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'petugas')"
    );
    $stmt->execute([
        'nama'     => $nama,
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Registrasi berhasil! Silakan login.'];
    header('Location: login.php');
    exit;
} else {
    header('Location: register.php');
    exit;
}