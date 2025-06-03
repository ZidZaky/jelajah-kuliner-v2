@extends('NEW.EVI.base-page')

@section('css')
{{-- Tambahkan CSS khusus untuk halaman ini jika diperlukan --}}
<style>
    .user-guide-banner {
        background-color: #8C1C1C; /* Warna merah tua seperti di gambar, sesuaikan jika perlu */
        color: white;
    }

    .user-guide-section-title {
        color: #333; /* Warna teks judul bagian, sesuaikan jika perlu */
        font-weight: bold;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    .placeholder-box {
        background-color: #E9ECEF; /* Warna abu-abu muda untuk placeholder */
        border: 1px solid #DEE2E6;
        height: 400px; /* Sesuaikan tinggi placeholder */
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #6C757D;
        font-size: 1.2rem;
        border-radius: 0.25rem;
    }

    /* Pastikan logo dan menu navigasi utama terlihat jelas */
    /* Jika .first-bg dari body Anda gelap, banner mungkin perlu kontras */
    body.first-bg {
        /* background-color: #f8f9fa; /* Contoh jika ingin background body lebih terang */
    }
</style>
@endsection

@section('AddOn')
{{-- Bagian AddOn bisa dikosongkan jika tidak ada popup atau sidebar khusus untuk halaman ini --}}
@endsection

@section('isi')
<div class="container-fluid user-guide-banner py-4">
    <div class="container">
        <h1 class="text-center display-4">USER GUIDE</h1>
    </div>
</div>

<div class="container mt-4 mb-5">
    {{-- User Guide PKL --}}
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="text-center user-guide-section-title">USERGUIDE PKL</h2>
        </div>
        <div class="col-md-10 col-lg-8">
            <div class="placeholder-box">
                <p>Konten Userguide untuk PKL akan ditampilkan di sini.<br>(Misalnya: Video tutorial, langkah-langkah, atau carousel gambar)</p>
            </div>
        </div>
    </div>

    {{-- User Guide Pembeli --}}
    <div class="row justify-content-center mt-5">
        <div class="col-12">
            <h2 class="text-center user-guide-section-title">USERGUIDE PEMBELI</h2>
        </div>
        <div class="col-md-10 col-lg-8">
            <div class="placeholder-box">
                <p>Konten Userguide untuk Pembeli akan ditampilkan di sini.<br>(Misalnya: Video tutorial, langkah-langkah, atau carousel gambar)</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- Tambahkan JavaScript khusus untuk halaman ini jika diperlukan --}}
<script>
    // Contoh: jika ada interaksi khusus pada halaman user guide
    // console.log("Halaman User Guide dimuat.");

    // Karena halaman ini tidak memiliki popup seperti contoh Anda,
    // fungsi closePopup() dan setViewPopupPKL() dari contoh sebelumnya
    // tidak secara langsung digunakan di sini kecuali Anda menambahkannya
    // kembali untuk fungsionalitas lain.
    function closePopup(){
        // Implementasi jika ada popup di halaman ini
        // Contoh: document.getElementById('myUserGuidePopup').style.display = 'none';
        console.log('closePopup dipanggil, tapi tidak ada popup default di halaman ini.');
    }
</script>
@endsection