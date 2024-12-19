<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Narekko Mangkasarakku</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Montserrat:wght@500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #1D202A; /* Biru */
            color: #fff;
        }
        .header {
            position: relative;
            text-align: center;
            color: white;
        }
        .header img {
            width: 100%;
            
            max-height: 400px; /* Atur tinggi maksimum gambar header */
        }
        .header .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .header .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 80px; /* Ukuran logo */
            border-radius: 50%; /* Membuat sudut bulat */
        }
        .header h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            text-decoration: underline; /* Garis di bawah */
        }
        .header p {
            margin: 0;
            font-size: 1.5em;
            font-weight: 500;
            font-family: 'Montserrat', sans-serif;
            text-decoration: none; /* Tanpa garis bawah */
        }
        .header .sign-in {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #1D202A;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 1em;
            font-family: 'Lato', sans-serif; /* Menggunakan font Lato Bold */
            font-weight: 700;
        }
        .content {
            display: flex;
            justify-content: space-around;
            padding: 20px;
            flex-wrap: wrap;
        }
        .content .card {
            background-color: #1D202A;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px;
            width: 300px;
            text-align: center;
            text-decoration: underline;
        }
        .content .card img {
            width: 100%;
            height: 350px;
        }
        .content .card p {
            margin: 10px 0;
            font-size: 1em;
        }
    </style>
</head>
<body>
    <div class="header">
        <img class="logo" alt="Logo" src="LOGO.jpg" /> <!-- Ganti dengan URL logo yang sesuai -->
        <img alt="Historical building in Makassar" src="https://i.pinimg.com/736x/16/28/8c/16288cc9fe1170cdfe6bbdbc874b84b9.jpg"/>
        <div class="overlay">
            <h1>NAREKKO MANGKASARAKKU</h1>
            <p>Tempat Bersejarah Kota Makassar</p>
            <button class="sign-in" onclick="location.href='signin.php'">SIGN IN</button>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <img alt="Benteng Fort Rotterdam" src="https://i.pinimg.com/736x/02/70/f0/0270f0f4d662d1e52bbc657f2958748c.jpg"/>
            <p>BENTENG FORT ROTTERDAM</p>
        </div>
        <div class="card">
            <img alt="Monumen Mandala" src="https://i.pinimg.com/736x/de/34/e4/de34e441bef428a3d4588a8e030483ab.jpg"/>
            <p>MONUMEN MANDALA</p>
        </div>
        <div class="card">
            <img alt="Pelabuhan Paotere" src="https://i.pinimg.com/736x/e2/80/51/e28051135c1fbe98a3500cebbb1aa3e0.jpg"/>
            <p>PELABUHAN PAOTERE</p>
        </div>
    </div>
</body>
</html>