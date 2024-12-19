<?php
session_start(); // Memulai sesi

// Cek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    header('Location: signin.php'); // Arahkan ke halaman login
    exit();
}

// Kode untuk dashboard_user.php di sini

// Cek apakah waktu terakhir aktif ada dalam sesi
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
    // Jika lebih dari 5 menit, hapus sesi dan redirect ke signin.php
    session_unset(); // Menghapus semua variabel sesi
    session_destroy(); // Menghancurkan sesi
    header("Location: signin.php");
    exit();
}

// Update waktu terakhir aktif
$_SESSION['LAST_ACTIVITY'] = time();

include 'connectdb.php'; // Mengimpor file koneksi

// Ambil jumlah total tempat bersejarah
$result = $conn->query("SELECT COUNT(*) as total FROM konten");
$totalTempatBersejarah = $result->fetch_assoc()['total'];

// Ambil semua tempat bersejarah
$resultTempat = $conn->query("SELECT * FROM konten");
$daftarTempat = [];
while ($row = $resultTempat->fetch_assoc()) {
    $daftarTempat[] = $row;
}

$conn->close(); // Tutup koneksi setelah semua selesai
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Narekko Mangkasarakku - Dashboard User</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1D202A;
            color: #ffffff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #1D202A;
        }
        .header img {
            height: 40px;
            background-color: transparent; /* Pastikan gambar mendukung transparansi */
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
        }
        .header .profile {
            width: 40px;
            height: 40px;
            background-color: #ffffff;
            border-radius: 50%;
        }
        .nav {
            display: flex;
            justify-content: space-around;
            background-color: #1D202A;
            padding: 10px 0;
        }
        .nav a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
        }
        .nav a.active {
            background-color: #7A6759;
            border-radius: 5px;
        }
        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }
        .card {
            background-color: #7A6759;
            border-radius: 10px;
            width: 30%;
            margin: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 100%; /* Membuat gambar responsif */
            height: auto; /* Mempertahankan rasio aspek */
            border-radius: 5px; /* Menambahkan sudut bulat pada gambar */
        }
        .card h3 {
            margin-top: 10px;
        }
        .card p {
            font-size: 14px;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="header">
        <img alt="Logo" src="LOGOO.png"/>
        <h1>NAREKKO MANGKASARAKKU</h1>
        <div class="profile"></div>
    </div>
    <div class="nav">
        <a class="active" href="#">Dashboard</a>
        <a href="pengaturanuser.php">Pengaturan</a>
    </div>
    <div class="content">
        <?php foreach ($daftarTempat as $tempat): ?>
        <div class="card">
            <?php 
                $gambarUrl = "uploads/" . htmlspecialchars($tempat['gambar']); 
                echo "<!-- Gambar URL: $gambarUrl -->"; // Menampilkan URL gambar sebagai komentar HTML
            ?>
            <img src="<?php echo $gambarUrl; ?>" alt="<?php echo htmlspecialchars($tempat['nama_tempat']); ?>">
            <h3><?php echo htmlspecialchars($tempat['nama_tempat']); ?></h3>
            <p><?php echo htmlspecialchars($tempat['keterangan']); ?></p>
            <p><strong>Lokasi:</strong> <?php echo htmlspecialchars($tempat['lokasi']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>