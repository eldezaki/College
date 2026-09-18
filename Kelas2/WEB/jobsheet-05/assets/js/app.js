/* ============================================================
   1. Hamburger Menu (JS-driven, replaces checkbox hack)
   ============================================================ */
function initNavToggle() {
    const toggleBtn = document.getElementById("nav-toggle-btn");
    const nav = document.querySelector("header nav");

    if (!toggleBtn || !nav) return;

    toggleBtn.addEventListener("click", function () {
        nav.classList.toggle("nav-open");
    });
}

/* ============================================================
   2. Confirm Delete (DOM removal)
   ============================================================ */
function initHapusConfirm() {
    document.querySelectorAll(".btn-hapus").forEach(function (btn) {
        btn.addEventListener("click", function () {
            const row = btn.closest("tr");
            const name = row ? row.querySelector("td")?.textContent.trim() : "data ini";
            const yakin = confirm('Yakin ingin menghapus "' + name + '"?');

            if (yakin && row) {
                row.remove();
            }
        });
    });
}

/* ============================================================
   3. Real-Time Table Filter
   ============================================================ */
function initTableFilter() {
    const input = document.getElementById("search-input");
    const table = document.querySelector(".table-responsive table");

    if (!input || !table) return;

    input.addEventListener("keyup", function () {
        const keyword = input.value.toLowerCase();
        const rows = table.querySelectorAll("tbody tr");

        rows.forEach(function (row) {
            const teks = row.textContent.toLowerCase();
            row.style.display = teks.includes(keyword) ? "" : "none";
        });
    });
}

/* ============================================================
   4. Form Validation Helpers & Main Handler
   ============================================================ */
function displayError(input, message) {
    hapusError(input);
    const span = document.createElement("span");
    span.className = "error";
    span.textContent = message;
    input.insertAdjacentElement("afterend", span);
}

function hapusError(input) {
    const next = input.nextElementSibling;
    if (next && next.classList.contains("error")) {
        next.remove();
    }
}

function initValidasiForm() {
    const form = document.getElementById("form-tambah");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        let valid = true;

        // Validasi Judul / Nama
        const judul = form.querySelector("[name='judul'], [name='nama']");
        if (judul && judul.value.trim() === "") {
            displayError(judul, "Kolom ini wajib diisi.");
            valid = false;
        } else if (judul) {
            hapusError(judul);
        }

        // Validasi Pengarang / No Anggota
        const pengarang = form.querySelector("[name='pengarang'], [name='no_anggota']");
        if (pengarang && pengarang.value.trim() === "") {
            displayError(pengarang, "Kolom ini wajib diisi.");
            valid = false;
        } else if (pengarang) {
            hapusError(pengarang);
        }

        // Validasi Tahun Terbit (Khusus Buku)
        const tahun = form.querySelector("[name='tahun']");
        if (tahun) {
            const valTahun = parseInt(tahun.value, 10);
            if (isNaN(valTahun) || valTahun < 1900 || valTahun > 2026) {
                displayError(tahun, "Tahun harus antara 1900-2026.");
                valid = false;
            } else {
                hapusError(tahun);
            }
        }

        // Validasi Stok (Khusus Buku)
        const stok = form.querySelector("[name='stok']");
        if (stok) {
            const valStok = parseInt(stok.value, 10);
            if (isNaN(valStok) || valStok < 0) {
                displayError(stok, "Stok tidak boleh bernilai negatif.");
                valid = false;
            } else {
                hapusError(stok);
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
}

/* ============================================================
   DOM Ready Entry Point
   ============================================================ */
document.addEventListener("DOMContentLoaded", function () {
    initNavToggle();
    initHapusConfirm();
    initTableFilter();
    initValidasiForm();
});