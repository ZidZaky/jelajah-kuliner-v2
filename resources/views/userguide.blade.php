@extends('layouts.layout')

@section('title')
    User Guide
@endsection

@section('css')
    {{-- CSS Khusus untuk halaman User Guide --}}
    <style>
        /* ======================================================= */
        /* PERUBAHAN CSS UNTUK PETA SEBAGAI BACKGROUND */
        /* ======================================================= */

        /* Hero Section - sekarang berfungsi sebagai kontainer */
        .userguide-hero {
            position: relative; /* Wajib ada agar elemen di dalamnya bisa diposisikan absolut */
            width: 100%;
            height: 45vh; /* Anda bisa sesuaikan tingginya */
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            overflow: hidden; /* Mencegah peta keluar dari kontainer */
        }

        /* Div Peta - sekarang diposisikan sebagai background */
        #map {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            filter: grayscale(100%); /* Efek hitam-putih dari kode Anda */
            z-index: 1; /* Posisikan paling belakang */
        }

        /* Lapisan gelap di atas PETA agar tulisan lebih mudah dibaca */
        .userguide-hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(40, 40, 40, 0.6);
            z-index: 2; /* Posisikan di atas peta */
        }

        /* Judul Utama "USER GUIDE" */
        .userguide-hero h1 {
            font-size: 4rem;
            font-weight: 700;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            position: relative;
            z-index: 3; /* Posisikan paling depan, di atas lapisan gelap */
        }

        /* ======================================================= */
        /* CSS LAINNYA (TETAP SAMA) */
        /* ======================================================= */

        .guides-content-wrapper {
            padding: 50px 2%;
            background-color: #ffffff;
        }

        .guide-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 80px;
        }

        .guide-block h2 {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: #333;
        }

        .guide-block iframe {
            border: 2px solid #ddd;
            border-radius: 8px;
            width: 80%;
            max-width: 900px;
            height: 550px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 768px) {
            .userguide-hero {
                height: 30vh;
            }
            .userguide-hero h1 {
                font-size: 2.5rem;
            }
            .guide-block h2 {
                font-size: 1.8rem;
            }
            .guide-block iframe {
                width: 95%;
                height: 400px;
            }
        }
    </style>
@endsection


@section('isi')

{{-- Bagian Header dengan Judul Utama dan Background Peta --}}
<section class="userguide-hero">
    {{-- Div ini akan diisi peta oleh JavaScript --}}
    <div id="map"></div> 
    
    {{-- Judul ini akan tampil di atas peta --}}
    <h1>USER GUIDE</h1>
</section>

{{-- Bagian Konten yang berisi semua panduan (Tetap Sama) --}}
<section class="guides-content-wrapper">
    <div class="guide-block" id="userguide-pkl">
        <h2>USERGUIDE PKL</h2>
        <iframe allowfullscreen="allowfullscreen" scrolling="no" class="fp-iframe" src="https://heyzine.com/flip-book/71c9ca6e8a.html" title="User Guide untuk PKL"></iframe>
    </div>
    <div class="guide-block" id="userguide-pembeli">
        <h2>USERGUIDE PEMBELI</h2>
        <iframe allowfullscreen="allowfullscreen" scrolling="no" class="fp-iframe" src="https://heyzine.com/flip-book/00bf2a3947.html" title="User Guide untuk Pembeli"></iframe>
    </div>
</section>

@endsection

@section('js')
{{-- ======================================================= --}}
{{-- JAVASCRIPT UNTUK MEMBUAT PETA LEAFLET --}}
{{-- ======================================================= --}}
<script>
    // Inisialisasi peta pada div dengan id 'map'
    // Opsi ditambahkan untuk membuat peta terasa seperti background (tidak bisa di-drag/zoom)
    var map = L.map('map', {
        zoomControl: false,
        dragging: false,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false,
        tap: false,
        touchZoom: false,
    }).setView([-6.9175, 107.6191], 12); // Koordinat Bandung, zoom level 12

    // Tambahkan layer peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>
@endsection