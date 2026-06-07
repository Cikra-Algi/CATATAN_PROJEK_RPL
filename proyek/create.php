<?php
session_start();
// Proteksi: Hanya user yang login yang bisa akses
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Proyek Baru</title>

</head>
<body class="container mt-5">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="/CATATAN_PROYEK_RPL/assets/css/style.css">
</head>

<body>
    <script src="/CATATAN_PROYEK_RPL/assets/js/script.js"></script>
</body>

    <h2>Tambah Proyek Baru</h2>
    <hr>
    
    <form action="store.php" method="POST">
        <div class="mb-3">
            <label>Nama Proyek</label>
            <input type="text" name="nama_proyek" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label>Jenis Proyek</label>
            <select name="jenis_proyek" class="form-control" required>
                <option value="Web">Web</option>
                <option value="Mobile">Mobile</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Teknologi</label>
            <input type="text" name="teknologi" class="form-control" placeholder="Contoh: PHP, Laravel, Flutter" required>
        </div>
        
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>
        
        <div class="mb-3">
            <label>Status Proyek</label>
            <select name="status_proyek" class="form-control" required>
                <option value="Perencanaan">Perencanaan</option>
                <option value="Proses">Proses</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>
        
        <button type="submit" name="save" class="btn btn-primary">Simpan Proyek</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>