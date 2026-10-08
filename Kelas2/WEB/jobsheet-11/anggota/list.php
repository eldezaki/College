<?php
require_once __DIR__ . '/../includes/auth.php';
session_start();
$page_title = "Daftar Anggota";
require_once __DIR__ . '/../includes/koneksi.php';

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE nama ILIKE :kw OR no_anggota ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM anggota WHERE nama ILIKE :kw OR no_anggota ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM anggota ORDER BY id DESC LIMIT :limit OFFSET :offset");
}

$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$daftarAnggota = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPages = max(1, (int) ceil($totalRows / $perPage));

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Daftar Anggota</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?>">
            <?= htmlspecialchars($_SESSION['flash']['pesan']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <p><a href="tambah.php" class="btn">+ Tambah Anggota</a></p>

    <div class="search-box">
        <form method="get" action="list.php">
            <span>
                <label for="search-input">Cari Nama/No. Anggota</label><br>
                <input type="text" id="search-input" name="q" value="<?= e($keyword) ?>" placeholder="Ketik nama atau nomor...">
            </span>
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="table-responsive">
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>No. Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($daftarAnggota)): ?>
                    <?php foreach ($daftarAnggota as $anggota): ?>
                        <tr>
                            <td><?= (int) $anggota['id'] ?></td>
                            <td><?= e($anggota['no_anggota']) ?></td>
                            <td><?= e($anggota['nama']) ?></td>
                            <td><?= e($anggota['alamat'] ?? '-') ?></td>
                            <td><?= e($anggota['no_hp'] ?? '-') ?></td>
                            <td>
                                <a href="edit.php?id=<?= (int) $anggota['id'] ?>" class="btn-edit">Edit</a>
                                <form class="form-hapus" method="post" action="hapus.php">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?= (int) $anggota['id'] ?>">
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Belum ada data anggota.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <nav class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="list.php?page=<?= $i ?><?= $keyword !== '' ? '&q=' . urlencode($keyword) : '' ?>" class="<?= $i === $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </nav>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>