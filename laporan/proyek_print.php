<?php
session_start();
include '../config/database.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}

$uid = $_SESSION['user_id'];
$query = "SELECT * FROM proyek WHERE user_id = '$uid' ORDER BY tanggal_mulai ASC";
$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Proyek - <?php echo $_SESSION['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: white !important; padding: 20px; }
        @media print {
            .btn-print { display: none !important; }
            .table-dark { background-color: #333 !important; color: white !important; }
        }
    </style>
</head>
<body>

    <h2 class="text-center mb-4">Laporan Daftar Proyek</h2>
    <p>Nama User: <b><?php echo $_SESSION['name']; ?></b></p>
    
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Proyek</th>
                <th>Jenis</th>
                <th>Teknologi</th>
                <th>Status</th>
                <th>Tanggal Mulai</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama_proyek']); ?></td>
                <td><?php echo htmlspecialchars($row['jenis_proyek']); ?></td>
                <td><?php echo htmlspecialchars($row['teknologi']); ?></td>
                <td><?php echo $row['status_proyek']; ?></td>
                <td><?php echo $row['tanggal_mulai']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="btn-print mt-3">
        <button class="btn btn-primary" onclick="window.print()">Cetak Laporan</button>
        <a href="../proyek/index.php" class="btn btn-secondary">Kembali</a>
    </div>

    <script>
        // Opsional: hapus baris di bawah jika tidak ingin otomatis print
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>