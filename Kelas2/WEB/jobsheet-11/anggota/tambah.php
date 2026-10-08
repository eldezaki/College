<?php
require_once __DIR__ . '/../includes/auth.php';
session_start();
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Tambah Anggota Baru</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?>">
            <?= htmlspecialchars($_SESSION['flash']['pesan']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form action="proses_tambah.php" method="POST" style="max-width: 400px;">
        <?= csrf_field(); ?>
        <div style="margin-bottom: 12px;">
            <label for="no_anggota">No. Anggota *</label><br>
            <input type="text" id="no_anggota" name="no_anggota" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 12px;">
            <label for="nama">Nama Lengkap *</label><br>
            <input type="text" id="nama" name="nama" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 12px;">
            <label for="alamat">Alamat</label><br>
            <textarea id="alamat" name="alamat" style="width: 100%; height: 80px;"></textarea>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="no_hp">No. HP</label><br>
            <input type="text" id="no_hp" name="no_hp" style="width: 100%;">
        </div>

        <button type="submit">Simpan ke Database</button>
        <a href="list.php">Batal</a>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>