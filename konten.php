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

// Proses penyimpanan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    if ($action === 'add') {
        // Pastikan semua data ada
        if (isset($_POST['namaTempat'], $_POST['lokasi'], $_POST['keterangan']) && isset($_FILES['image'])) {
            $namaTempat = $_POST['namaTempat'];
            $lokasi = $_POST['lokasi'];
            $keterangan = $_POST['keterangan'];
            $gambar = $_FILES['image']['name'];

            // Upload gambar ke folder uploads
            $destination = 'uploads/' . $gambar;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                // Simpan data ke database
                $stmt = $conn->prepare("INSERT INTO konten (gambar, nama_tempat, lokasi, keterangan) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $gambar, $namaTempat, $lokasi, $keterangan);
                if ($stmt->execute()) {
                    echo "Konten berhasil disimpan!";
                } else {
                    echo "Gagal menyimpan konten: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Gagal mengunggah gambar.";
            }
        } else {
            echo "Semua field harus diisi.";
        }
    } elseif ($action === 'edit') {
        // Pastikan semua data ada
        if (isset($_POST['id'], $_POST['namaTempat'], $_POST['lokasi'], $_POST['keterangan'])) {
            $id = $_POST['id'];
            $namaTempat = $_POST['namaTempat'];
            $lokasi = $_POST['lokasi'];
            $keterangan = $_POST['keterangan'];

            // Cek apakah ada gambar baru yang di-upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Proses upload gambar dan simpan path-nya
                $gambar = $_FILES['image']['name'];
                $destination = 'uploads/' . $gambar;
                move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                // Update database dengan gambar baru
                $stmt = $conn->prepare("UPDATE konten SET gambar = ?, nama_tempat = ?, lokasi = ?, keterangan = ? WHERE id = ?");
                $stmt->bind_param("ssssi", $gambar, $namaTempat, $lokasi, $keterangan, $id);
            } else {
                // Jika tidak ada gambar baru, hanya update yang lain
                $stmt = $conn->prepare("UPDATE konten SET nama_tempat = ?, lokasi = ?, keterangan = ? WHERE id = ?");
                $stmt->bind_param("sssi", $namaTempat, $lokasi, $keterangan, $id);
            }

            if ($stmt->execute()) {
                echo "Konten berhasil diperbarui.";
            } else {
                echo "Gagal memperbarui konten: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Semua field harus diisi.";
        }
    } elseif ($action === 'delete') {
        // Hapus konten berdasarkan ID
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            // Pertama, ambil gambar untuk dihapus dari server
            $result = $conn->query("SELECT gambar FROM konten WHERE id = $id");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $gambar = $row['gambar'];
                // Hapus gambar dari folder uploads
                if (file_exists('uploads/' . $gambar)) {
                    unlink('uploads/' . $gambar); // Menghapus file gambar
                }
            }
            // Hapus data dari database
            $stmt = $conn->prepare("DELETE FROM konten WHERE id = ?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo "Konten berhasil dihapus.";
            } else {
                echo "Gagal menghapus konten: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "ID tidak ditemukan.";
        }
    }
}

// Ambil data dari database untuk ditampilkan jika permintaan fetch
if (isset($_GET['fetch'])) {
    $result = $conn->query("SELECT * FROM konten");
    $konten = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($konten);
    exit; // Hentikan eksekusi setelah mengembalikan JSON
}

$conn->close(); // Tutup koneksi setelah semua selesai
?>