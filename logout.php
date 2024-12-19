<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1D202A;
            color: #ffffff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            width: 300px;
        }
        .container h1 {
            margin-bottom: 20px;
            font-family: 'Lato', sans-serif;
            font-weight: bold;
            font-size: 40px;
        }
        .container p {
            margin: 20px 0;
            font-size: 18px;
        }
        .container a {
            color: #1e90ff;
            text-decoration: none;
            font-weight: bold;
        }
        .container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Anda Telah Keluar</h1>
    <p>Silahkan <a href="signin.php">sign in</a> kembali.</p>
</div>

</body>
</html>