<?php
include 'connectdb.php'; // Mengimpor file koneksi

// Ambil data pengguna dari sesi
session_start();
$currentUsername = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; // Ganti dengan data dari database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Admin</title>
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
            background-image: url('<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'default-profile.png'; ?>');
            background-size: cover;
            background-position: center;
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
            justify-content: center;
            padding: 20px;
            flex-direction: column;
            align-items: center;
        }
        .box {
            background-color: #7A6759;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px; /* Batas lebar maksimum */
        }
        .box h2 {
            margin-top: 0;
        }
        .form-group {
            margin: 10px 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 15px;
            background-color: #5A4B42;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #7A6759;
        }
        .logout-button {
            background-color: #d9534f; /* Merah untuk tombol keluar */
        }
        .logout-button:hover {
            background-color: #c9302c;
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
        <a href="dashboard_admin.php">Dashboard</a>
        <a href="manajemenkonten.php">Manajemen Konten</a>
        <a href="halamanpengguna.php">Pengguna</a>
        <a class="active" href="#">Pengaturan</a>
    </div>
    <div class="content">
        <div class="box">
            <h2>Pengaturan Admin</h2>
            <p>Username Saat Ini: <strong><?php echo $currentUsername; ?></strong></p>
            <form action="updateprofiladmin.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="username">Username Baru:</label>
                    <input type="text" id="username" name="username" value="<?php echo $currentUsername; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password Baru:</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit">Simpan Perubahan</button>
            </form>
            <form action="landingpage.php" method="POST" style="margin-top: 20px;">
                <button type="submit" class="logout-button">Keluar</button>
            </form>
        </div>
    </div>
</body>
</html>