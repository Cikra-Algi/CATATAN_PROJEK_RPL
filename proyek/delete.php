<?php
session_start();
include '../config/database.php';

// Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Ambil dan bersihkan ID
$id = mysqli_real_escape_string($conn, $_GET['id']);
$uid = $_SESSION['user_id'];

// Eksekusi hapus
$query = "DELETE FROM proyek WHERE id = '$id' AND user_id = '$uid'";
mysqli_query($conn, $query);

// Cek apakah data benar-benar terhapus
if(mysqli_affected_rows($conn) > 0) {
    header("Location: index.php?msg=Berhasil");
    exit; // Wajib ada
} else {
    // Jika tidak ada baris yang terhapus, kemungkinan ID salah atau milik orang lain
    die("Akses ditolak atau data tidak ditemukan.");
}
?>