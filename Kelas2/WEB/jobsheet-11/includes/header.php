<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';

$_jobsheetRoot = dirname(__DIR__);
$_scriptDir    = dirname($_SERVER['SCRIPT_FILENAME']);
$_rel          = ltrim(str_replace('\\', '/', substr($_scriptDir, strlen($_jobsheetRoot))), '/');
$base          = $_rel === '' ? '' : str_repeat('../', substr_count($_rel, '/') + 1);

$sudahLogin    = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-Mini<?= isset($page_title) ? ' | ' . e($page_title) : ''; ?></title>
    <link rel="stylesheet" href="<?= $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
        <nav>
            <ul>
                <li><a href="<?= $base; ?>index.php">Beranda</a></li>
                <li><a href="<?= $base; ?>buku/list.php">Daftar Buku</a></li>
                <?php if ($sudahLogin): ?>
                    <li><a href="<?= $base; ?>buku/tambah.php">Tambah Buku</a></li>
                    <li><a href="<?= $base; ?>anggota/list.php">Daftar Anggota</a></li>
                    <li><a href="<?= $base; ?>anggota/tambah.php">Tambah Anggota</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-status">
            <?php if ($sudahLogin): ?>
                <span>Halo, <?= e($_SESSION['nama']); ?></span>
                <a href="<?= $base; ?>auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="<?= $base; ?>auth/login.php">Login</a>
            <?php endif; ?>
        </div>
    </header>
    <main>