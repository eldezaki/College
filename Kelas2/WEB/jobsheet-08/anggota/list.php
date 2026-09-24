<?php
session_start();
$page_title = "Daftar Anggota";
require __DIR__ . '/../includes/koneksi.php';

$daftarAnggota = $pdo->query("SELECT * FROM anggota ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Daftar Anggota</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= $_SESSION['flash']['type']; ?>">
            <?= htmlspecialchars($_SESSION['flash']['pesan']); ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <p><a href="tambah.php" class="btn">+ Tambah Anggota</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>No. Anggota</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. HP</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($daftarAnggota)): ?>
                <?php foreach ($daftarAnggota as $anggota): ?>
                    <tr>
                        <td><?= htmlspecialchars($anggota['id']); ?></td>
                        <td><?= htmlspecialchars($anggota['no_anggota']); ?></td>
                        <td><?= htmlspecialchars($anggota['nama']); ?></td>
                        <td><?= htmlspecialchars($anggota['alamat'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($anggota['no_hp'] ?? '-'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Belum ada data anggota.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>