<?php
// Koneksi ke database
$host = "localhost"; // Ganti dengan host database Anda
$user = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "db_tubesweb"; // Ganti dengan nama database Anda

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pengguna dari database
$result = $conn->query("SELECT * FROM users");
$users = $result->fetch_all(MYSQLI_ASSOC);

$conn->close(); // Tutup koneksi setelah semua selesai
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Narekko Mangkasarakku - Manajemen Pengguna</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1D202A;
            color: rgba(255, 252, 252, 0.94);
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
            background-color: #7A6759; /* Gaya aktif yang konsisten */
            border-radius: 5px;
        }
        .content {
            display: flex;
            justify-content: center;
            padding: 20px;
            flex-direction: column; /* Mengubah orientasi menjadi kolom */
            align-items: center;
        }
        .table-container {
            background-color: #7A6759; /* Warna latar belakang */
            padding: 10px;
            border-radius: 10px; /* Menggunakan radius yang sama dengan .box */
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgb(247, 240, 240);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #000000;
            color: black; /* Mengubah warna teks menjadi hitam */
        }
        th {
            background-color: rgb(228, 214, 214);
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
    <a href="halamanpengguna.php" class="active">Pengguna</a>
    <a href="pengaturanadmin.php">Pengaturan</a>
    </div>
    
    <div class="content">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA PENGGUNA</th>
                        <th>TANGGAL DAFTAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($users) && !empty($users)): ?>
                        <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td>
                                <?php 
                                if (isset($user['tanggal_daftar'])) {
                                    $tanggal = new DateTime($user['tanggal_daftar']);
                                    echo htmlspecialchars($tanggal->format('d-m-Y H:i:s'));
                                } else {
                                    echo 'Data tidak tersedia';
                                }
                                ?>
                            </td>
                            <td>
                                <form method="post" action="block_user.php">
                                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin memblokir akun ini?');">Blokir</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak ada pengguna yang terdaftar.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>