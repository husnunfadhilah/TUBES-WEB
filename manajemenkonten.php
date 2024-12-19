<?php include 'konten.php'; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Narekko Mangkasarakku - Manajemen Konten</title>
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
            justify-content: space-around;
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
        .action-buttons {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        .action-buttons button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50; /* Warna hijau untuk tombol tambah */
            color: white;
        }
        .edit-button {
            background-color: #FFA500; /* Warna oranye untuk tombol edit */
        }
        .delete-button {
            background-color: #F44336; /* Warna merah untuk tombol hapus */
        }
        .form-container {
            display: none; /* Sembunyikan form awalnya */
            background-color: #7A6759;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            width: 100%;
        }
        .form-container input[type="text"], .form-container input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        .form-container button {
            background-color: #4CAF50; /* Warna hijau untuk tombol simpan */
        }
    </style>
    <script>
        let currentEditId = null;

        function toggleForm() {
            const formContainer = document.getElementById("form-container");
            formContainer.style.display = formContainer.style.display === "none" ? "block" : "none";
        }

        function editContent(id, gambar, namaTempat, lokasi, keterangan) {
            currentEditId = id;
            document.getElementById("image").value = ''; // Reset gambar
            document.getElementById("namaTempat").value = namaTempat;
            document.getElementById("lokasi").value = lokasi;
            document.getElementById("keterangan").value = keterangan;
            document.getElementById("form-container").style.display = "block";
            document.getElementById("form-container").setAttribute('data-existing-image', gambar);
        }

        function saveContent() {
            const formData = new FormData(document.getElementById("form"));
            formData.append('action', currentEditId ? 'edit' : 'add');
            if (currentEditId) {
                formData.append('id', currentEditId);
            }

            fetch('konten.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Menampilkan pesan dari server
                loadTable(); // Memuat ulang tabel
                document.getElementById("form").reset(); // Mengosongkan form
                currentEditId = null; // Reset ID
            })
            .catch(error => console.error('Error:', error));
        }

        function deleteContent(id) {
            if (confirm('Anda yakin ingin menghapus konten ini?')) {
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', id);

                fetch('konten.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data); // Menampilkan pesan dari server
                    loadTable(); // Memuat ulang tabel
                })
                .catch(error => console.error('Error:', error));
            }
        }

        function loadTable() {
            fetch('konten.php?fetch=true')
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector('tbody');
                tbody.innerHTML = ''; // Kosongkan tbody

                data.forEach((item, index) => {
                    const row = `<tr>
                        <td>${index + 1}</td>
                        <td><img src="uploads/${item.gambar}" alt="Gambar" width="200" /></td>
                        <td>${item.nama_tempat}</td>
                        <td>${item.lokasi}</td>
                        <td>${item.keterangan}</td>
                        <td>
                            <button class="edit-button" onclick="editContent(${item.id}, '${item.gambar}', '${item.nama_tempat}', '${item.lokasi}', '${item.keterangan}');">Edit</button>
                            <button class="delete-button" onclick="deleteContent(${item.id});">Hapus</button>
                        </td>
                    </tr>`;
                    tbody.innerHTML += row; // Tambahkan baris baru
                });
            })
            .catch(error => console.error('Error:', error));
        }

        // Muat tabel ketika halaman dimuat
        window.onload = loadTable;
    </script>
</head>
<body>
    <div class="header">
        <img alt="Logo" src="LOGOO.png"/>
        <h1>NAREKKO MANGKASARAKKU</h1>
        <div class="profile"></div>
    </div>
    <div class="nav">
    <a href="dashboard_admin.php">Dashboard</a>
    <a class="active" href="#">Manajemen Konten</a>
    <a href="halamanpengguna.php">Pengguna</a> <!-- Pastikan tautan ini mengarah ke halamanpengguna.php -->
    <a href="pengaturanadmin.php">Pengaturan</a>
    </div>
    <div class="content">
        <div class="action-buttons">
            <button onclick="toggleForm();">Tambah Konten</button>
        </div>
        <div id="form-container" class="form-container">
            <form id="form" onsubmit="event.preventDefault(); saveContent();" enctype="multipart/form-data">
                <input type="file" id="image" name="image" accept="image/*">
                <input type="text" id="namaTempat" name="namaTempat" placeholder="Nama Tempat" required>
                <input type="text" id="lokasi" name="lokasi" placeholder="Lokasi" required>
                <input type="text" id="keterangan" name="keterangan" placeholder="Keterangan" required>
                <button type="submit">Simpan</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>GAMBAR</th>
                        <th>NAMA TEMPAT</th>
                        <th>LOKASI</th>
                        <th>KETERANGAN</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($konten) && !empty($konten)): ?>
                        <?php foreach ($konten as $index => $item): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><img src="uploads/<?php echo htmlspecialchars($item['gambar']); ?>" alt="Gambar" width="230px" /></td>
                            <td><?php echo $item['nama_tempat']; ?></td>
                            <td><?php echo $item['lokasi']; ?></td>
                            <td><?php echo $item['keterangan']; ?></td>
                            <td>
                                <button class="edit-button" onclick="editContent(<?php echo $item['id']; ?>, '<?php echo $item['gambar']; ?>', '<?php echo $item['nama_tempat']; ?>', '<?php echo $item['lokasi']; ?>', '<?php echo $item['keterangan']; ?>');">Edit</button>
                                <button class="delete-button" onclick="deleteContent(<?php echo $item['id']; ?>);">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Tidak ada konten yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>