<?php
session_start();
include '../config/database.php';

// Proteksi akses langsung
if (!isset($_POST['save'])) {
    header("Location: index.php");
    exit;
}

// Proteksi sesi
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Mengambil dan membersihkan input
$user_id = $_SESSION['user_id'];
$nama    = mysqli_real_escape_string($conn, $_POST['nama_proyek']);
$jenis   = mysqli_real_escape_string($conn, $_POST['jenis_proyek']);
$teknol  = mysqli_real_escape_string($conn, $_POST['teknologi']);
$desk    = mysqli_real_escape_string($conn, $_POST['deskripsi']);
$status  = mysqli_real_escape_string($conn, $_POST['status_proyek']);
$tgl     = mysqli_real_escape_string($conn, $_POST['tanggal_mulai']);

// Query menggunakan variabel yang sudah aman
$query = "INSERT INTO proyek (user_id, nama_proyek, jenis_proyek, teknologi, deskripsi, status_proyek, tanggal_mulai) 
          VALUES ('$user_id', '$nama', '$jenis', '$teknol', '$desk', '$status', '$tgl')";

if (mysqli_query($conn, $query)) {
    header("Location: index.php?status=success");
} else {
    echo "Gagal menyimpan: " . mysqli_error($conn);
}
?>