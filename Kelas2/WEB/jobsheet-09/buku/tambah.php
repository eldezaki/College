<?php
session_start();
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Tambah Buku Baru</h2>

    <form action="proses_tambah.php" method="POST">
        <div class="form-group">
            <label for="judul">Judul Buku *</label>
            <input type="text" id="judul" name="judul" required>
        </div>

        <div class="form-group">
            <label for="pengarang">Pengarang *</label>
            <input type="text" id="pengarang" name="pengarang" required>
        </div>

        <div class="form-group">
            <label for="tahun">Tahun Terbit *</label>
            <input type="number" id="tahun" name="tahun" required>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn">
        </div>

        <div class="form-group">
            <label for="stok">Stok *</label>
            <input type="number" id="stok" name="stok" value="0" required>
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>
            <input type="text" id="kategori" name="kategori">
        </div>

        <button type="submit" class="btn">Simpan</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>