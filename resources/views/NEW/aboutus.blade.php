@extends('NEW.EVI.base-page')

@section('css')
{{-- Tambahkan CSS khusus untuk halaman ini jika diperlukan --}}
<head>
    <title>Tentang Kami - Jelajah Kuliner</title>
    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
    }

    body {
    background-color: #f4f4f4;
    color: #333;
    }

    .navbar {
    background: white;
    padding: 10px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 3px solid #eee;
    }

    .logo {
    display: flex;
    align-items: center;
    }

    .logo img {
    width: 200px;
    margin-right: 10px;
    }

    .profile-wrapper {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 20px;
    background-color: #fff;
    }

    .greeting {
    font-size: 28px;
    color: #941b1b;
    font-weight: bold;
    margin-right: 20px;
    }

    .profile-dropdown {
    display: flex;
    align-items: center;
    border: 2px solid #941b1b;
    border-radius: 50px;
    padding: 5px 10px;
    }

    .profile-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 8px;
    }

    .arrow {
    font-size: 24px;
    color: #941b1b;
    }

    .hero {
    background: linear-gradient(rgba(161, 0, 0, 0.8), rgba(161, 0, 0, 0.8)), url('assets/map.png') center/cover no-repeat;
    padding: 60px 30px;
    display: flex;
    align-items: center;
    color: white;
    }

    .about-circle {
    background: linear-gradient(to bottom, #a10000, #600000);
    width: 200px;
    height: 200px;
    border-radius: 100px;
    text-align: center;
    line-height: 200px;
    font-weight: bold;
    font-size: 18px;
    margin-right: 40px;
    box-shadow: 3px 3px 8px #bbb;
    }

    .about-content h2 {
    margin-bottom: 15px;
    }

    .social-icons {
    margin-top: 10px;
    }

    .section {
    padding: 40px 60px;
    }

    .section h3 {
    color: #a10000;
    margin-bottom: 10px;
    }

    .merchants {
    background-color: #fff;
    padding: 40px 60px;
    text-align: center;
    }

    .merchant-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    }

    .card {
    width: 300px;
    background: linear-gradient(to bottom, #b71919, #5e1b1b);
    padding: 30px 20px;
    border-radius: 15px;
    color: white;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s ease;
    }

    .card:hover {
    transform: translateY(-5px);
    }

    .card img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 20px;
    }

    .card h3 {
    margin-bottom: 10px;
    font-size: 20px;
    }

    .card p {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
    }

    .btn-placeholder {
    width: 120px;
    height: 40px;
    background-color: white;
    border-radius: 10px;
    margin: 0 auto;
    }

    .footer {
    background-color: #a10000;
    color: white;
    padding: 30px 60px;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    }

    .footer h5 {
    margin-bottom: 10px;
    }

    .footer p {
    font-size: 14px;
    line-height: 1.6;
    }
    </style>
</head>
<body>

@endsection

@section('AddOn')

@endsection

@section('isi')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jelajah Kuliner</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <img src="assets/newLogo_JELAJAHKULINER.png" alt="Logo">
    </div>
    <div class="profile-wrapper">
    <span class="greeting">Hello, <b>Cantik</b></span>
    <div class="profile-dropdown">
    <img src="assets/profile-icon.png" alt="Profile" class="profile-img">
    <span class="arrow">&#x25BC;</span> <!-- tanda panah bawah -->
  </div>
</div>
  </header>

  <section class="hero">
    <div class="about-circle">ABOUT US</div>
    <div class="about-content">
      <small>Our Mission</small>
      <h2>APA SIH JELAJAH KULINER ITU??</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <div class="social-icons">
        <img src="https://cdn-icons-png.flaticon.com/512/1384/1384063.png" alt="IG" width="24">
        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="FB" width="24">
      </div>
    </div>
  </section>

  <section class="section">
    <h3>KENAPA HARUS JELAJAH KULINER DARI PLATFORM LAIN?</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit... (potong untuk ringkas)</p>
  </section>

  <section class="section">
    <h3>REVIEW PEMBELI</h3>
    <ol>
      <li><strong>Mamook keren:</strong> Lorem ipsum dolor sit amet...</li>
      <li><strong>Mas Yudis:</strong> Lorem ipsum dolor sit amet...</li>
      <li><strong>Vania top!</strong> Lorem ipsum dolor sit amet...</li>
    </ol>
  </section>

  <section class="merchants">
    <h3>OUR MERCHANT</h3>
    <div class="merchant-list">
      <div class="card">
        <img src="assets/profile-icon.png"" alt="">
        <h4>Jajang arjuna</h4>
        <p>Lorem ipsum dolor sit amet...</p>
      </div>
      <div class="card">
        <img src="assets/profile-icon.png" alt="">
        <h4>Uhay harora</h4>
        <p>Lorem ipsum dolor sit amet...</p>
      </div>
      <div class="card">
        <img src="assets/profile-icon.png" alt="">
        <h4>Mas yoga teh celup</h4>
        <p>Lorem ipsum dolor sit amet...</p>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div>
      <h5>Our Service</h5>
      <p>Review<br>Maps<br>Merchant<br>Rute Jelajah<br>Rekomendasi</p>
    </div>
    <div>
      <h5>Information</h5>
      <p>Apakah aman?<br>Kenapa harus kami?<br>Info lainnya<br>Syarat dan ketentuan</p>
    </div>
    <div>
      <h5>Our Company</h5>
      <p>About Us<br>Contact<br>Teamwork</p>
    </div>
  </footer>
</body>
@endsection

@section('js')

@endsection