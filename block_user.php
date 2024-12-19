<?php
session_start();
include 'connectdb.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $username = $_POST['username'];

    // Hapus pengguna dari database berdasarkan username
    $sql = "DELETE FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        echo "Pengguna dengan username '$username' berhasil diblokir.";
    } else {
        echo "Terjadi kesalahan saat memblokir pengguna: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
header('Location: halamanpengguna.php'); // Kembali ke halaman pengguna setelah proses
exit();
?>