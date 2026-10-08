<?php
require_once __DIR__ . '/../includes/auth.php'; // Guard ditaruh di awal
session_start();
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = $_POST['id'] ?? null;
    $no_anggota = trim($_POST['no_anggota'] ?? '');
    $nama       = trim($_POST['nama'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $no_hp      = trim($_POST['no_hp'] ?? '');

    if (!$id) {
        header('Location: list.php');
        exit;
    }

    if (empty($no_anggota) || empty($nama)) {
        $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'No. Anggota dan Nama wajib diisi.'];
        header('Location: edit.php?id=' . urlencode($id));
        exit;
    }

    try {
        $stmt = $pdo->prepare(
            "UPDATE anggota 
             SET no_anggota = :no_anggota, nama = :nama, alamat = :alamat, no_hp = :no_hp 
             WHERE id = :id"
        );

        $stmt->execute([
            'id'         => $id,
            'no_anggota' => $no_anggota,
            'nama'       => $nama,
            'alamat'     => empty($alamat) ? null : $alamat,
            'no_hp'      => empty($no_hp) ? null : $no_hp
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data anggota berhasil diperbarui.'];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        if ($e->getCode() === '23505') {
            $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'No. Anggota sudah digunakan, pakai nomor lain.'];
            header('Location: edit.php?id=' . urlencode($id));
            exit;
        }

        die("Gagal memperbarui data: " . $e->getMessage());
    }
} else {
    header('Location: list.php');
    exit;
}