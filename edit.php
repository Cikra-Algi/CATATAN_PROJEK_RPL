<?php
session_start();
include '../config/database.php';

// 1. Keamanan: Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// 2. Ambil ID dari URL dan filter keamanan
$id = mysqli_real_escape_string($conn, $_GET['id']);
$uid = $_SESSION['user_id'];

// 3. Query untuk memastikan data milik user yang sedang login
$query = "SELECT * FROM proyek WHERE id = '$id' AND user_id = '$uid'";
$res = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($res);

// 4. Jika data tidak ditemukan, tampilkan pesan error
if (!$data) {
    die("Data tidak ditemukan atau Anda tidak memiliki akses!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="/CATATAN_PROYEK_RPL/assets/css/style.css">
</head>

<body>
    <script src="/CATATAN_PROYEK_RPL/assets/js/script.js"></script>
</body>
    <h2>Edit Proyek</h2>
    <hr>
    
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <div class="mb-3">
            <label>Nama Proyek</label>
            <input type="text" name="nama_proyek" class="form-control" value="<?php echo htmlspecialchars($data['nama_proyek']); ?>" required>
        </div>
        
        <div class="mb-3">
            <label>Jenis Proyek</label>
            <select name="jenis_proyek" class="form-control">
                <option value="Web" <?php if($data['jenis_proyek'] == 'Web') echo 'selected'; ?>>Web</option>
                <option value="Mobile" <?php if($data['jenis_proyek'] == 'Mobile') echo 'selected'; ?>>Mobile</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Teknologi</label>
            <input type="text" name="teknologi" class="form-control" value="<?php echo htmlspecialchars($data['teknologi']); ?>">
        </div>
        
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
        </div>
        
        <div class="mb-3">
            <label>Status Proyek</label>
            <select name="status_proyek" class="form-control">
                <option value="Perencanaan" <?php if($data['status_proyek'] == 'Perencanaan') echo 'selected'; ?>>Perencanaan</option>
                <option value="Proses" <?php if($data['status_proyek'] == 'Proses') echo 'selected'; ?>>Proses</option>
                <option value="Selesai" <?php if($data['status_proyek'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="<?php echo $data['tanggal_mulai']; ?>" required>
        </div>
        
        <button type="submit" name="update" class="btn btn-success">Update Proyek</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>