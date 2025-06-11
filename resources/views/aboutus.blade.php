@extends('layouts.layout')

@section('title')
About Us
@endsection

@section('css')
<style>
    /* ================================================== */
    /* CSS BARU YANG LEBIH SPESIFIK DAN ANTI-BENTROK */
    /* ================================================== */

    .about-us-container {
        background-color: #f8f9fa;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    /* 1. HERO SECTION (Bagian atas dengan peta) */
    .about-us-container .about-hero {
        position: relative;
        /* Wajib ada untuk positioning absolut */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 5%;
        min-height: 60vh;
        overflow: hidden;
        /* Mencegah peta keluar dari kontainer */
        /* background-image Dihapus, digantikan oleh div peta */
    }

    /* PENAMBAHAN CSS UNTUK PETA */
    #map-about {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        filter: grayscale(100%);
        z-index: 0;
        /* Posisikan paling belakang */
    }

    /* Badge "About Us" yang bulat di kiri */
    .about-us-container .about-badge {
        background-color: #a73636;
        color: white;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
        margin-right: -100px;
        z-index: 2;
        /* Di atas peta */
        border: 5px solid white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .about-us-container .about-badge h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: bold;
    }

    /* Kotak konten di sebelah kanan badge */
    .about-us-container .about-content-box {
        background-color: white;
        padding: 40px 40px 40px 140px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        max-width: 700px;
        z-index: 1;
        /* Di atas peta */
    }

    .about-us-container .about-content-box .subtitle {
        font-weight: bold;
        color: #777;
    }

    .about-us-container .about-content-box h2 {
        font-size: 2.2rem;
        font-weight: bold;
        color: #a73636;
        margin-top: 5px;
        margin-bottom: 1rem;
    }

    .about-us-container .about-content-box .social-icons a {
        color: #a73636;
        font-size: 1.5rem;
        margin-right: 15px;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .about-us-container .about-content-box .social-icons a:hover {
        color: #c0392b;
    }

    /* CSS Lainnya (tetap sama) */
    .about-us-container .about-page-section {
        padding: 80px 10%;
        text-align: center;
    }

    .about-us-container .about-page-section.bg-light {
        background-color: #fdfdfd;
    }

    .about-us-container .about-page-section h2 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .about-us-container .about-page-section p,
    .about-us-container .about-page-section li {
        font-size: 1.1rem;
        color: #555;
        line-height: 1.7;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .about-us-container .reviews-section ol {
        list-style: none;
        padding-left: 0;
        counter-reset: review-counter;
        margin-top: 40px;
    }

    .about-us-container .reviews-section li {
        counter-increment: review-counter;
        margin-bottom: 25px;
        text-align: left;
        position: relative;
        padding-left: 50px;
    }

    .about-us-container .reviews-section li::before {
        content: counter(review-counter);
        position: absolute;
        left: 0;
        top: 5px;
        font-size: 1.5rem;
        font-weight: bold;
        color: #a73636;
        background-color: #f0e4e4;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .about-us-container .merchant-cards-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
        margin-top: 40px;
    }

    .about-us-container .merchant-card {
        background-color: #a73636;
        color: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        width: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .about-us-container .merchant-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }

    .about-us-container .merchant-card img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid white;
        margin-bottom: 15px;
        object-fit: cover;
    }

    .about-us-container .merchant-card h3 {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .about-us-container .merchant-card p {
        font-size: 0.9rem;
        color: #f1f1f1;
        flex-grow: 1;
    }

    .about-us-container .merchant-card .btn-details {
        background-color: white;
        color: #a73636;
        padding: 10px 25px;
        border-radius: 20px;
        text-decoration: none;
        font-weight: bold;
        margin-top: 20px;
        transition: all 0.3s ease;
    }

    .about-us-container .merchant-card .btn-details:hover {
        background-color: #eee;
        transform: scale(1.05);
    }
</style>
@endsection


@section('isi')
<div class="about-us-container">

    {{-- 1. HERO SECTION --}}
    <section class="about-hero">
        {{-- PENAMBAHAN DIV UNTUK PETA --}}
        <div id="map-about"></div>

        <div class="about-badge">
            <h2>ABOUT US</h2>
        </div>
        <div class="about-content-box">
            <p class="subtitle">Our Motto</p>
            <h2>APA SIH JELAJAH KULINER ITU??</h2>
            <p>
                Jelajah Kuliner menawarkan pengalaman unik yang menghubungkan Anda langsung dengan pedagang kaki lima (PKL) di seluruh Indonesia. Kami memahami bahwa PKL adalah bagian penting dari budaya kuliner kita, dan kami ingin memastikan mereka mendapatkan dukungan yang layak. Dengan Jelajah Kuliner, Anda dapat
            </p>
            <div class="social-icons">
                <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" title="Twitter"><i class="bi bi-twitter"></i></a>
            </div>
        </div>
    </section>

    {{-- Bagian lain dari halaman tetap sama --}}
    <section class="about-page-section why-us-section">
        <h2>KENAPA HARUS JELAJAH KULINER DARI PLATFORM LAIN?</h2>
        <p>Jelajah Kuliner menawarkan pengalaman unik yang menghubungkan Anda langsung dengan pedagang kaki lima (PKL) di seluruh Indonesia. Kami memahami bahwa PKL adalah bagian penting dari budaya kuliner kita, dan kami ingin memastikan mereka mendapatkan dukungan yang layak. Dengan Jelajah Kuliner, Anda dapat</p>
    </section>
    <section class="about-page-section reviews-section bg-light">
        <h2>REVIEW PEMBELI</h2>
        <ol>
            <li><strong>Memuaskan:</strong> Puas</li>
            <li><strong>Mas Yudis:</strong> Enak</li>
            <li><strong>Yunita tapi cowok:</strong> Unik</li>
        </ol>
    </section>
    <section class="about-page-section merchants-section">
        <h2>OUR DEVELOPER TEAMS</h2>
        <div class="merchant-cards-container">
            <div class="merchant-card">
                <img src="assets/Zidan.png" alt="Merchant 1">
                <h3>Zidan Irfan Zaky</h3>
                <p>Aku Mencoba tetapi Takut Di Coba.</p>
                <a href="#" class="btn-details">Details</a>
            </div>
            <div class="merchant-card">
                <img src="assets/Dika.jpeg" alt="Merchant 2">
                <h3>Radinka Putra Rahadian</h3>
                <p>Spontan, Uhuy.</p>
                <a href="#" class="btn-details">Details</a>
            </div>
            <div class="merchant-card">
                <img src="assets/Evi.jpg" alt="Merchant 3">
                <h3>Evi Fitriya</h3>
                <p>Visual Studio Code ungu Itu Bencana.</p>
                <a href="#" class="btn-details">Details</a>
            </div>
            <div class="merchant-card">
                <img src="assets/Farhan.jpeg" alt="Merchant 3">
                <h3>Farhan Nugraha S. P.</h3>
                <p>Hah?</p>
                <a href="#" class="btn-details">Details</a>
            </div>
            <div class="merchant-card">
                <img src="assets/Awan.jpeg" alt="Merchant 3">
                <h3>Awan Dhani W</h3>
                <p>Terbantai Dengan Tugas.</p>
                <a href="#" class="btn-details">Details</a>
            </div>
            <div class="merchant-card">
                <img src="assets/Eka.jpeg" alt="Merchant 3">
                <h3>Rahmat Eka Saputra</h3>
                <p>Ya Allah.</p>
                <a href="#" class="btn-details">Details</a>
            </div>
        </div>
    </section>

</div>
@endsection


@section('js')
{{-- ======================================================= --}}
{{-- PENAMBAHAN JAVASCRIPT UNTUK MEMBUAT PETA --}}
{{-- ======================================================= --}}
<script>
    // Inisialisasi peta pada div dengan id 'map-about'
    // Opsi ditambahkan untuk membuat peta terasa seperti background
    var map = L.map('map-about', {
        zoomControl: false,
        dragging: false,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false,
        tap: false,
        touchZoom: false,
    }).setView([-6.9175, 107.6191], 12); // Pusat di Bandung, bisa diganti

    // Tambahkan layer peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>
@endsection