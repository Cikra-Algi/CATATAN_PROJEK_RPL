<?php
session_start();
include '../config/database.php';

// Proteksi: Pastikan user login dan menekan tombol update
if (!isset($_SESSION['user_id']) || !isset($_POST['update'])) {
    header("Location: index.php");
    exit;
}

// Ambil dan bersihkan data
$id    = mysqli_real_escape_string($conn, $_POST['id']);
$uid   = $_SESSION['user_id'];
$nama  = mysqli_real_escape_string($conn, $_POST['nama_proyek']);
$jenis = mysqli_real_escape_string($conn, $_POST['jenis_proyek']);
$tekno = mysqli_real_escape_string($conn, $_POST['teknologi']);
$desk  = mysqli_real_escape_string($conn, $_POST['deskripsi']);
$stat  = mysqli_real_escape_string($conn, $_POST['status_proyek']);
$tgl   = mysqli_real_escape_string($conn, $_POST['tanggal_mulai']);

// Query Update yang aman
$sql = "UPDATE proyek SET 
        nama_proyek = '$nama', 
        jenis_proyek = '$jenis', 
        teknologi = '$tekno', 
        deskripsi = '$desk', 
        status_proyek = '$stat', 
        tanggal_mulai = '$tgl' 
        WHERE id = '$id' AND user_id = '$uid'";

if (mysqli_query($conn, $sql)) {
    // Berhasil update
    header("Location: index.php?msg=Berhasil Update");
} else {
    // Jika gagal, tampilkan pesan error (untuk debugging)
    echo "Update gagal: " . mysqli_error($conn);
}
?>