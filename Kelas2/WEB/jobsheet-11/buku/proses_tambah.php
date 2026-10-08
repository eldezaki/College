<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/koneksi.php';

csrf_verify();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul     = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun     = (int) ($_POST['tahun'] ?? 0);
    $isbn      = trim($_POST['isbn'] ?? '');
    $stok      = (int) ($_POST['stok'] ?? 0);
    $kategori  = trim($_POST['kategori'] ?? '');

    if (empty($judul) || empty($pengarang) || $tahun <= 0) {
        $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'Mohon isi semua field wajib dengan benar.'];
        header('Location: tambah.php');
        exit;
    }

    $stmt = $pdo->prepare(
        "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori) 
         VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)"
    );

    $stmt->execute([
        'judul'     => $judul,
        'pengarang' => $pengarang,
        'tahun'     => $tahun,
        'isbn'      => empty($isbn) ? null : $isbn,
        'stok'      => $stok,
        'kategori'  => empty($kategori) ? null : $kategori
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan.'];
    header('Location: list.php');
    exit;
} else {
    header('Location: list.php');
    exit;
}