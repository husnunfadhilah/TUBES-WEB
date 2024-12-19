<?php
session_start();
include 'connectdb.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa kredensial pengguna
    $sql = "SELECT id, password FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Memeriksa password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, simpan user ID di sesi
            $_SESSION['user_id'] = $user['id'];
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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
            border: none;
            border-radius: 30px;
            background-color: #7A6759;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            position: relative;
        }
        .container button::before,
        .container button::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 30px;
        }
        .container button::before {
            border: 2px solid white;
            z-index: 1;
        }
        .container button::after {
            top: 4px;
            left: 4px;
            right: 4px;
            bottom: 4px;
            z-index: 0;
        }
        .container .social-icons {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        .container .social-icons i {
            margin: 0 10px;
            font-size: 24px;
            cursor: pointer;
        }
        .container .signin-link {
            margin-top: 20px;
        }
        .container .signin-link a {
            color: #1e90ff;
            text-decoration: none;
        }
        .container .signin-link a:hover {
            text-decoration: underline;
        }
        .remember-me {
            display: flex;
            align-items: center;
            margin: 10px 0;
        }
        .remember-me input {
            width: 15px; /* Ukuran kotak ceklis */
            height: 15px; /* Tinggi kotak ceklis */
            margin-right: 5px; /* Jarak antara kotak ceklis dan label */
        }
        .forgot-password {
            color: red;
            margin-left: 42px; /* Jarak kecil antara "Remember Me" dan "Forgot Password?" */
            text-decoration: none;
        }
        .message {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>SIGN IN</h1>
    <form method="post" action="ceklogin.php"> <!-- Arahkan ke ceklogin.php -->
        <input type="text" placeholder="Username" name="username" id="username" required>
        <input type="password" placeholder="Password" name="password" id="password" required>
        <div class="remember-me">
            <input type="checkbox" name="remember_me" id="remember_me">
            <label for="remember_me">Remember Me</label>
            <a class="forgot-password" href="#">Forgot Password?</a>
        </div>
        <button type="submit">SIGN IN</button> <!-- Tombol untuk login -->
    </form>
    <p>or with</p>
    <div class="social-icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-twitter"></i>
    </div>
    <div class="signin-link">
        <p>Don’t Have an account? <a href="signup.php">Sign Up</a></p>
    </div>
    
    <?php
    // PHP code for handling form submission can be added here
    ?>
</div>

</body>
</html>