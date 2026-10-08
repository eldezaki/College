<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/koneksi.php';

csrf_verify();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_anggota = trim($_POST['no_anggota'] ?? '');
    $nama       = trim($_POST['nama'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $no_hp      = trim($_POST['no_hp'] ?? '');

    if (empty($no_anggota) || empty($nama)) {
        $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'No. Anggota dan Nama wajib diisi.'];
        header('Location: tambah.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare(
            "INSERT INTO anggota (no_anggota, nama, alamat, no_hp) VALUES (:no_anggota, :nama, :alamat, :no_hp)"
        );
        $stmt->execute([
            'no_anggota' => $no_anggota,
            'nama'       => $nama,
            'alamat'     => empty($alamat) ? null : $alamat,
            'no_hp'      => empty($no_hp) ? null : $no_hp
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() === '23505') {
            $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'No. Anggota sudah digunakan.'];
            header('Location: tambah.php');
            exit;
        }
        die("Gagal menyimpan data: " . $e->getMessage());
    }
} else {
    header('Location: list.php');
    exit;
}