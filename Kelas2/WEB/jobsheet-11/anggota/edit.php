<?php
require_once __DIR__ . '/../includes/auth.php';
session_start();
$page_title = "Edit Anggota";
require_once __DIR__ . '/../includes/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => $id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {
    header('Location: list.php');
    exit;
}

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Edit Anggota</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?>">
            <?= htmlspecialchars($_SESSION['flash']['pesan']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form id="form-tambah" method="post" action="proses_edit.php" style="max-width: 400px;">
        <?= csrf_field(); ?>
        <input type="hidden" name="id" value="<?= (int) $anggota['id'] ?>">

        <p>
            <label for="no_anggota">No. Anggota *</label>
            <input type="text" id="no_anggota" name="no_anggota" value="<?= e($anggota['no_anggota']) ?>" required>
        </p>

        <p>
            <label for="nama">Nama Lengkap *</label>
            <input type="text" id="nama" name="nama" value="<?= e($anggota['nama']) ?>" required>
        </p>

        <p>
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" style="height: 80px;"><?= e($anggota['alamat'] ?? '') ?></textarea>
        </p>

        <p>
            <label for="no_hp">No. HP</label>
            <input type="text" id="no_hp" name="no_hp" value="<?= e($anggota['no_hp'] ?? '') ?>">
        </p>

        <button type="submit">Simpan Perubahan</button>
        <a href="list.php">Batal</a>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>