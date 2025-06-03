@extends('NEW.EVI.base-page')

@section('css')
<style>
    .error-page-wrapper {
        /* Wrapper ini akan mengisi tinggi dari parentnya (div @yield('isi')) */
        height: 100%;
        display: flex; /* Menggunakan flexbox untuk centering konten */
        flex-direction: column;
        justify-content: center; /* Centering vertikal */
        align-items: center;    /* Centering horizontal */
        text-align: center;
        padding: 20px; /* Padding agar konten tidak menempel ke tepi */
    }
    .error-title {
        color: #8C1C1C; /* Warna merah tua (sesuaikan jika perlu) */
        font-weight: bold;
        margin-bottom: 1rem; /* Sedikit jarak bawah dari judul */
        font-size: 2.8rem; /* Ukuran font judul, sesuaikan dengan gambar */
    }
    .error-message {
        color: #333; /* Warna teks pesan (lebih gelap dari abu-abu muda) */
        font-size: 1.1rem; /* Ukuran font pesan */
        max-width: 600px; /* Batas lebar pesan agar mudah dibaca */
        line-height: 1.6;
    }
</style>
@endsection

@section('AddOn')
@endsection

@section('isi')
<div class="error-page-wrapper">
    <div>
        <h1 class="error-title">Access Ditolak!</h1>
        <p class="error-message">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator atau gunakan akun dengan peran yang sesuai untuk mendapatkan akses.
        </p>
        
        <!-- <a href="{{ url('/') }}" class="btn btn-danger mt-4" style="background-color: #8C1C1C; border-color: #731717;">Kembali ke Beranda</a> -->
    </div>
</div>
@endsection

@section('js')
@endsection