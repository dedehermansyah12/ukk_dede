<?php
// Mulai session jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "../../config.php";

// Periksa apakah parameter id_peminjaman sudah ada
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: Transaksipeminjaman.php");
    exit;
}

$id= $_GET["id"];

// Perbarui status peminjaman menjadi "Sudah dikonfirmasi"
$query = "UPDATE peminjaman SET status = '3' WHERE id = $id";
if (mysqli_query($connection, $query)) {
    // Redirect kembali ke halaman petugas
    echo "<script>alert('Buku Berhasil Dikembalikan'); window.location.href='historyBuku.php';</script>";
    exit;
} else {
    echo "Error updating record: " . mysqli_error($connection);
}
?>