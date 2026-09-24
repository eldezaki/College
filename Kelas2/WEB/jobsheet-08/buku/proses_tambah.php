<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun     = (int) ($_POST['tahun'] ?? 0);
    $isbn      = trim($_POST['isbn'] ?? '');
    $stok       = (int) ($_POST['stok'] ?? 0);
    $kategori  = trim($_POST['kategori'] ?? '');

    if (!empty($judul) && !empty($pengarang) && $tahun > 0) {
        $stmt = $pdo->prepare(
            "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) 
             VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori) 
             RETURNING id"
        );

        $stmt->execute([
            'judul'     => $judul,
            'pengarang' => $pengarang,
            'tahun'     => $tahun,
            'isbn'      => $isbn,
            'stok'      => $stok,
            'kategori'  => $kategori,
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan.'];
        header('Location: list.php');
        exit;
    }
}

header('Location: list.php');
exit;