<?php
session_start();
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Tambah Anggota Baru</h2>

    <form action="proses_tambah.php" method="POST">
        <div class="form-group">
            <label for="no_anggota">No. Anggota *</label>
            <input type="text" id="no_anggota" name="no_anggota" required>
        </div>

        <div class="form-group">
            <label for="nama">Nama Lengkap *</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat">
        </div>

        <div class="form-group">
            <label for="no_hp">No. HP</label>
            <input type="text" id="no_hp" name="no_hp">
        </div>

        <button type="submit" class="btn">Simpan</button>
        <a href="list.php" class="btn btn-secondary">Batal</a>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>