<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        .container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            margin-left: 1px;
        }
        .container button {
            width: 80%;
            padding: 15px;
            margin: 20px 0;
            border: 2px solid white; /* Border putih lapis pertama */
            border-radius: 30px;
            background-color: #7A6759;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }
        
        .message {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>SIGN UP</h1>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Create Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">SIGN UP</button>
    </form>
    <div class="signin-link">
        <p>Have already account? <a href="signin.php">Sign In</a></p>
    </div>
    
    <?php
    // Cek apakah form disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require 'connectdb.php'; // Mengimpor koneksi database

        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validasi password
        if ($password !== $confirm_password) {
            echo "<p class='message'>Password tidak cocok!</p>";
        } else {
            // Menyimpan data ke database tanpa enkripsi
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            if ($stmt->execute([$username, $password])) {
                echo "<p class='message'>Pendaftaran berhasil! Silahkan Sign in</p>";
            } else {
                echo "<p class='message'>Terjadi kesalahan saat mendaftar. Silakan coba lagi.</p>";
            }
        }
    }
    ?>
</div>

</body>
</html>