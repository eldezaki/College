# Security Checklist & Audit Results — SIMPUS-Mini

| # | Kerentanan | Ditemukan di | Sebelum Audit | Sesudah Audit (Perbaikan) |
|---|---|---|---|---|
| 1 | **SQL Injection** | `buku/*`, `anggota/*`, `auth/*` | Menggunakan Prepared Statement | **Aman.** Semua query menggunakan `$pdo->prepare()` dan binding parameter. Diuji bypass `' OR '1'='1` -> gagal. |
| 2 | **XSS (Cross-Site Scripting)** | `list.php`, `edit.php`, `header.php` | Output dicetak mentah via `echo` | Output string dibungkus fungsi `e()` (`htmlspecialchars` dengan `ENT_QUOTES`). Diuji input `<script>alert(1)</script>` -> tampil teks aman. |
| 3 | **CSRF** | Semua form `POST` & file pemroses | Form POST dapat dipicu dari domain luar | Menambahkan `csrf_field()` & verifikasi `csrf_verify()` menggunakan `hash_equals()`. Permintaan tanpa token valid ditolak HTTP 403. |
| 4 | **Validasi & Sanitasi Input** | `proses_*.php`, `edit.php` | Sudah ada validasi dasar | Ditambahkan *type casting* eksplisit `(int)` pada ID dan variabel numerik. |
| 5 | **Session Fixation** | `auth/proses_login.php` | ID Sesi tidak berganti saat login | Menambahkan `session_regenerate_id(true)` saat login berhasil untuk memperbarui ID sesi. |

---

### Catatan Urutan Guard
Di seluruh skrip pemroses backend, `includes/auth.php` dipanggil lebih dulu daripada `includes/csrf.php`. Hal ini memastikan pengunjung yang belum terautentikasi langsung di-redirect sebelum pengecekan CSRF diproses.