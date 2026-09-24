<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_anggota = trim($_POST['no_anggota'] ?? '');
    $nama       = trim($_POST['nama'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $no_hp      = trim($_POST['no_hp'] ?? '');

    if (!empty($no_anggota) && !empty($nama)) {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO anggota (no_anggota, nama, alamat, no_hp) 
                 VALUES (:no_anggota, :nama, :alamat, :no_hp) 
                 RETURNING id"
            );

            $stmt->execute([
                'no_anggota' => $no_anggota,
                'nama'       => $nama,
                'alamat'     => $alamat,
                'no_hp'      => $no_hp,
            ]);

            $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];
            header('Location: list.php');
            exit;
        } catch (PDOException $e) {
            $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'Gagal menyimpan: No. Anggota sudah digunakan!'];
            header('Location: tambah.php');
            exit;
        }
    }
}

header('Location: list.php');
exit;