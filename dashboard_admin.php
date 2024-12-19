<?php
session_start(); // Mulai session

// Cek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    header('Location: signin.php'); // Arahkan ke halaman login
    exit();
}

include 'connectdb.php'; // Mengimpor file koneksi

// Ambil jumlah total tempat bersejarah
$result = $conn->query("SELECT COUNT(*) as total FROM konten");
$totalTempatBersejarah = $result->fetch_assoc()['total'];

// Ambil jumlah total pengguna
$result = $conn->query("SELECT COUNT(*) as total FROM users");
$totalPengunjung = $result->fetch_assoc()['total'];

$conn->close(); // Tutup koneksi setelah semua selesai
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Narekko Mangkasarakku</title>
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
            justify-content: space-around;
            padding: 20px;
        }
        .box {
            background-color: #7A6759;
            padding: 20px;
            border-radius: 10px;
            width: 45%;
        }
        .box h2 {
            margin-top: 0;
        }
        .box ul {
            list-style: none;
            padding: 0;
        }
        .box ul li {
            margin: 10px 0;
        }
        .box ul li i {
            margin-right: 10px;
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
        <a href="manajemenkonten.php">Manajemen Konten</a>
        <a href="halamanpengguna.php">Pengguna</a>
        <a href="pengaturanadmin.php">Pengaturan</a>
    </div>
    <div class="content">
        <div class="box">
            <h2>Total Tempat Bersejarah Saat Ini: <?php echo $totalTempatBersejarah; ?></h2>
            <ul>
                <!-- Anda bisa menampilkan detail tempat bersejarah di sini jika diinginkan -->
            </ul>
        </div>
        <div class="box">
            <h2>Total Pengunjung Saat Ini: <?php echo $totalPengunjung; ?></h2>
            <ul>
                <!-- Anda bisa menampilkan detail pengunjung di sini jika diinginkan -->
            </ul>
        </div>
    </div>
</body>
</html>