<?php
session_start();
$page_title = "Edit Buku";
require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Edit Buku</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?>">
            <?= htmlspecialchars($_SESSION['flash']['pesan']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form id="form-tambah" method="post" action="proses_edit.php" style="max-width: 400px;">
        <input type="hidden" name="id" value="<?= htmlspecialchars($buku['id']) ?>">

        <p>
            <label for="judul">Judul Buku *</label>
            <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($buku['judul']) ?>" required>
        </p>

        <p>
            <label for="pengarang">Pengarang *</label>
            <input type="text" id="pengarang" name="pengarang" value="<?= htmlspecialchars($buku['pengarang']) ?>" required>
        </p>

        <p>
            <label for="tahun">Tahun Terbit *</label>
            <input type="number" id="tahun" name="tahun" value="<?= htmlspecialchars($buku['tahun']) ?>" required>
        </p>

        <p>
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" value="<?= htmlspecialchars($buku['isbn'] ?? '') ?>">
        </p>

        <p>
            <label for="stok">Stok *</label>
            <input type="number" id="stok" name="stok" value="<?= htmlspecialchars($buku['stok']) ?>" required>
        </p>

        <p>
            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach (['fiksi' => 'Fiksi', 'non-fiksi' => 'Non-Fiksi', 'referensi' => 'Referensi'] as $value => $label): ?>
                    <option value="<?= $value ?>" <?= $buku['kategori'] === $value ? 'selected' : '' ?>>
                        <?= $label ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <button type="submit">Simpan Perubahan</button>
        <a href="list.php">Batal</a>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>