<!DOCTYPE html>
<html lang="en">
<head>
    <title>404 Not Found</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('/assets/PROFILE.jpg');
            background-size: cover;
            font-family: 'Arial', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 450px;
            height: 450px;
            padding: 20px;
            border: 2px solid #B83B5E;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            background-color: #9c242c;
            text-align: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card h1 {
            font-size: 5rem;
            margin: 0;
        }

        .card p {
            font-size: 1.2rem;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .card a {
            text-decoration: none;
            color: #fff;
            background-color: #B83B5E;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #c94f70;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>404</h1>
        <p>Halaman yang kamu cari tidak ditemukan.</p>
        <a href="/">Kembali ke Beranda</a>
    </div>
</body>
</html>
