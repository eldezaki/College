<?php
require_once __DIR__ . '/../includes/auth.php';
session_start();
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Tambah Buku Baru</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?>">
            <?= htmlspecialchars($_SESSION['flash']['pesan']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form id="form-tambah" action="proses_tambah.php" method="POST" style="max-width: 400px;">
        <?= csrf_field(); ?>
        <p>
            <label for="judul">Judul Buku *</label>
            <input type="text" id="judul" name="judul" required>
        </p>

        <p>
            <label for="pengarang">Pengarang *</label>
            <input type="text" id="pengarang" name="pengarang" required>
        </p>

        <p>
            <label for="tahun">Tahun Terbit *</label>
            <input type="number" id="tahun" name="tahun" required>
        </p>

        <p>
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn">
        </p>

        <p>
            <label for="stok">Stok *</label>
            <input type="number" id="stok" name="stok" value="0" required>
        </p>

        <p>
            <label for="kategori">Kategori</label>
            <input type="text" id="kategori" name="kategori">
        </p>

        <button type="submit">Simpan ke Database</button>
        <a href="list.php">Batal</a>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>