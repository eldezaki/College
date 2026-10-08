<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Login Petugas";
include __DIR__ . '/../includes/header.php';
?>

<section style="max-width: 400px; margin: 2rem auto;">
    <h2>Login Petugas</h2>

    <?php if (isset($_SESSION['flash'])): ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?>">
            <?= htmlspecialchars($_SESSION['flash']['pesan']) ?>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <form action="proses_login.php" method="POST">
        <p>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </p>
        <p>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </p>
        <button type="submit">Login</button>
        <p style="margin-top: 1rem;">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </p>
    </form>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>