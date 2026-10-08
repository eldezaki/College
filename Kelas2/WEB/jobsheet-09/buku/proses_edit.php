<?php
session_start();
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = $_POST['id'] ?? null;
    $judul     = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun     = (int) ($_POST['tahun'] ?? 0);
    $isbn      = trim($_POST['isbn'] ?? '');
    $stok      = (int) ($_POST['stok'] ?? 0);
    $kategori  = trim($_POST['kategori'] ?? '');

    if (!$id) {
        header('Location: list.php');
        exit;
    }

    if (empty($judul) || empty($pengarang) || $tahun <= 0) {
        $_SESSION['flash'] = ['type' => 'danger', 'pesan' => 'Mohon isi semua field wajib dengan benar.'];
        header('Location: edit.php?id=' . urlencode($id));
        exit;
    }

    $stmt = $pdo->prepare(
        "UPDATE buku 
         SET judul = :judul, pengarang = :pengarang, tahun = :tahun, isbn = :isbn, stok = :stok, kategori = :kategori 
         WHERE id = :id"
    );

    $stmt->execute([
        'id'        => $id,
        'judul'     => $judul,
        'pengarang' => $pengarang,
        'tahun'     => $tahun,
        'isbn'      => empty($isbn) ? null : $isbn,
        'stok'      => $stok,
        'kategori'  => empty($kategori) ? null : $kategori
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data buku berhasil diperbarui.'];
    header('Location: list.php');
    exit;
} else {
    header('Location: list.php');
    exit;
}