@extends('layouts.layout')

@section('css')
{{-- Tambahkan CSS khusus untuk halaman ini jika diperlukan --}}
<!-- <head>
    <title>Tentang Kami - Jelajah Kuliner</title> -->
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            color: #333;
        }
        header {
            background-color: #8B0000;
            padding: 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-weight: bold;
            font-size: 24px;
        }
        .nickname {
            font-size: 16px;
        }
        section {
            padding: 40px 60px;
        }
        .about-section {
            background-color: #c0392b;
            color: white;
            padding: 60px;
            text-align: left;
            position: relative;
        }
        .about-section h2 {
            font-size: 24px;
        }
        .review-section, .merchant-section {
            background-color: white;
            margin-top: 20px;
            padding: 40px;
            border-radius: 8px;
        }
        .merchant-cards {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        .card {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 30%;
        }
        .card img {
            width: 80px;
            border-radius: 50%;
        }
        footer {
            background-color: #8B0000;
            color: white;
            padding: 40px 60px;
            display: flex;
            justify-content: space-between;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        .btn-kembali-home {
            background-color: #8B0000;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-kembali-home:hover {
            background-color: #a52a2a;
        }

    </style>
<!-- </head>
<body> -->

@endsection

@section('AddOn')

@endsection

@section('isi')
<header>
    <div class="logo">🍜 Jelajah Kuliner</div>
    <div class="nickname">Hello, Ganteng</div>
</header>

<section class="about-section">
    <h2>APA SIH JELAJAH KULINER ITU??</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
</section>

<section>
    <h2>KENAPA HARUS JELAJAH KULINER DARI PLATFORM LAIN?</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</p>
</section>

<section class="review-section">
    <h2>REVIEW PEMBELI</h2>
    <ol>
        <li><strong>Memuaskan</strong> - Lorem ipsum dolor sit amet, consectetur adipiscing elit...</li>
        <li><strong>Mas Yudis</strong> - Lorem ipsum dolor sit amet, consectetur adipiscing elit...</li>
        <li><strong>Yunita top</strong> - Lorem ipsum dolor sit amet, consectetur adipiscing elit...</li>
    </ol>
</section>

<section class="merchant-section">
    <h2>OUR MERCHANT</h2>
    <div class="merchant-cards">
        <div class="card">
            <img src="https://via.placeholder.com/80" alt="merchant 1">
            <h3>Jajang arjuna</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
        </div>
        <div class="card">
            <img src="https://via.placeholder.com/80" alt="merchant 2">
            <h3>Ubay haroro</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
        </div>
        <div class="card">
            <img src="" alt="merchant 3">
            <h3>Mas yoga teh celup</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
        </div>
    </div>
</section>

<footer>
    <div>
        <h3>Our Service</h3>
        <ul>
            <li>Review</li>
            <li>Mapview</li>
            <li>Rekomendasi</li>
            <li>Merchant</li>
            <li>Menu List</li>
        </ul>
    </div>
    <div>
        <h3>Information</h3>
        <ul>
            <li>Apa sih Jelajah Kuliner?</li>
            <li>Kenapa harus Jelajah?</li>
            <li>Review Pembeli</li>
            <li>Info Merchant Terbaik</li>
        </ul>
    </div>
    <div>
        <h3>Our Company</h3>
        <ul>
            <li>About</li>
            <li>Contact</li>
            <li>News/Artikel</li>
            <li>FAQ</li>
        </ul>
    </div>
</footer>

</body>
@endsection

@section('js')

@endsection