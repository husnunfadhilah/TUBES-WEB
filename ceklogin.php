<?php
session_start();
require 'connectdb.php'; // Mengimpor koneksi database

// Mengambil dan membersihkan input
$username = trim($_POST['username']);
$password = $_POST['password'];

// Mencari pengguna di tabel admin
$stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if ($admin) {
    // Verifikasi password tanpa hashing
    if ($admin['password'] === $password) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;

        // Set cookie untuk username
        setcookie('remember_me', $username, time() + 600, "/"); // Cookie berlaku selama 10 menit

        header('Location: dashboard_admin.php'); // Arahkan ke dashboard admin
        exit();
    } else {
        $error_message = "Password yang dimasukkan salah.";
    }
} else {
    // Jika tidak ditemukan di tabel admin, cek di tabel users
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verifikasi password tanpa hashing
        if ($user['password'] === $password) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $username;

            // Set cookie untuk username
            setcookie('remember_me', $username, time() + 600, "/"); // Cookie berlaku selama 10 menit

            header('Location: dashboard_user.php'); // Arahkan ke dashboard users
            exit();
        } else {
            $error_message = "Password yang dimasukkan salah.";
        }
    } else {
        $error_message = "Username tidak terdaftar.";
    }
}