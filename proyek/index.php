<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
include '../config/database.php';
$uid = $_SESSION['user_id'];
$query = "SELECT * FROM proyek WHERE user_id = '$uid' ORDER BY id DESC";
$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Proyek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/CATATAN_PROYEK_RPL/assets/css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="../dashboard.php" class="btn btn-secondary">« Kembali</a>
                <a href="../laporan/proyek_print.php" class="btn btn-info text-white" target="_blank">Cetak Laporan</a>
            </div>
            <a href="create.php" class="btn btn-primary">+ Tambah Proyek</a>
        </div>

        <h2 class="mb-4">Daftar Proyek Anda</h2>
        
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nama Proyek</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['nama_proyek']); ?></td>
                    <td>
                        <span class="badge bg-success"><?php echo htmlspecialchars($row['status_proyek']); ?></span>
                    </td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="/CATATAN_PROYEK_RPL/assets/js/script.js"></script>
</body>
</html>