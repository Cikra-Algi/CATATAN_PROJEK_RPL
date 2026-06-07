<?php
session_start();
include 'config/database.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit;
}

$uid = $_SESSION['user_id'];

// Statistik
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM proyek WHERE user_id = '$uid'"))['t'];
$perencanaan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM proyek WHERE user_id = '$uid' AND status_proyek='Perencanaan'"))['t'];
$proses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM proyek WHERE user_id = '$uid' AND status_proyek='Proses'"))['t'];
$selesai = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM proyek WHERE user_id = '$uid' AND status_proyek='Selesai'"))['t'];

$terbaru = mysqli_query($conn, "SELECT * FROM proyek WHERE user_id = '$uid' ORDER BY id DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Catatan Proyek</title>
</head>
<body class="container mt-4">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="/CATATAN_PROYEK_RPL/assets/css/style.css">
</head>

<body>
    <script src="/CATATAN_PROYEK_RPL/assets/js/script.js"></script>
</body>

    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <hr>

    <div class="row">
        <div class="col-md-3"><div class="card bg-primary text-white p-3">Total: <?php echo $total; ?></div></div>
        <div class="col-md-3"><div class="card bg-warning text-white p-3">Perencanaan: <?php echo $perencanaan; ?></div></div>
        <div class="col-md-3"><div class="card bg-info text-white p-3">Proses: <?php echo $proses; ?></div></div>
        <div class="col-md-3"><div class="card bg-success text-white p-3">Selesai: <?php echo $selesai; ?></div></div>
    </div>

    <h3 class="mt-4">5 Proyek Terakhir</h3>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr><th>Nama Proyek</th><th>Status</th><th>Tanggal</th></tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($terbaru)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nama_proyek']); ?></td>
                <td><?php echo $row['status_proyek']; ?></td>
                <td><?php echo $row['tanggal_mulai']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="proyek/index.php" class="btn btn-primary">Kelola Semua Proyek</a>
    <a href="auth/logout.php" class="btn btn-danger">Logout</a>

</body>
</html>