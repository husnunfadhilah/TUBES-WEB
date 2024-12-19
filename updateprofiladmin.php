<?php
session_start();
include 'connectdb.php'; // Mengimpor file koneksi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir
    $currentUsername = $_SESSION['username']; // Ambil username saat ini dari sesi
    $newUsername = $_POST['username'];
    $password = $_POST['password'];

    // Siapkan query untuk memperbarui data pengguna
    if (!empty($password)) {
        // Jika password diisi, buat query untuk memperbarui username dan password
        $sql = "UPDATE users SET username=?, password=? WHERE username=?";
        $stmt = $conn->prepare($sql);
        $hashedPassword = $password; // Simpan password dalam bentuk plaintext
        // Menggunakan 3 parameter: newUsername, password, currentUsername
        $stmt->bind_param("sss", $newUsername, $hashedPassword, $currentUsername);
    } else {
        // Jika password tidak diisi, hanya perbarui username
        $sql = "UPDATE users SET username=? WHERE username=?";
        $stmt = $conn->prepare($sql);
        // Menggunakan 2 parameter: newUsername, currentUsername
        $stmt->bind_param("ss", $newUsername, $currentUsername);
    }

    // Eksekusi query
    if ($stmt->execute()) {
        // Simpan perubahan di sesi
        $_SESSION['username'] = $newUsername; // Update username di sesi
        
        // Redirect ke halaman pengaturan
        header('Location: pengaturanadmin.php');
        exit();
    } else {
        echo "Terjadi kesalahan saat memperbarui profil: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close(); // Tutup koneksi
?>