<?php
session_start();
$page_title = "Daftar Buku";
require __DIR__ . '/../includes/koneksi.php';

$daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Daftar Buku</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= $_SESSION['flash']['type']; ?>">
            <?= htmlspecialchars($_SESSION['flash']['pesan']); ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <p><a href="tambah.php" class="btn">+ Tambah Buku</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Tahun</th>
                <th>ISBN</th>
                <th>Stok</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($daftarBuku)): ?>
                <?php foreach ($daftarBuku as $buku): ?>
                    <tr>
                        <td><?= htmlspecialchars($buku['id']); ?></td>
                        <td><?= htmlspecialchars($buku['judul']); ?></td>
                        <td><?= htmlspecialchars($buku['pengarang']); ?></td>
                        <td><?= htmlspecialchars($buku['tahun']); ?></td>
                        <td><?= htmlspecialchars($buku['isbn'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($buku['stok']); ?></td>
                        <td><?= htmlspecialchars($buku['kategori'] ?? '-'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Belum ada data buku.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>