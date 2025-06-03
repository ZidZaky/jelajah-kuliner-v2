@extends('NEW.EVI.base-page')

@section('css')
<style>
    .error-page-wrapper {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 20px;
    }
    .error-title {
        color: #8C1C1C; /* Warna merah tua */
        font-weight: bold;
        margin-bottom: 1rem;
        font-size: 2.8rem; /* Ukuran font judul */
    }
    .error-message {
        color: #333; /* Warna teks pesan */
        font-size: 1.1rem;
        max-width: 600px;
        line-height: 1.6;
    }
</style>
@endsection

@section('AddOn')
<!-- {{-- Kosongkan --}} -->
@endsection

@section('isi')
<div class="error-page-wrapper">
    <div>
        <h1 class="error-title">Halaman Tidak Ditemukan!</h1>
        <p class="error-message">
            Maaf, halaman yang Anda cari tidak ditemukan. Mungkin halaman tersebut telah dihapus, dipindahkan, atau URL yang Anda masukkan tidak tepat.
        </p>
        <!-- {{-- Opsional: Tambahkan tombol kembali ke beranda --}}
        {{-- <a href="{{ url('/') }}" class="btn btn-danger mt-4" style="background-color: #8C1C1C; border-color: #731717;">Kembali ke Beranda</a> --}} -->
    </div>
</div>
@endsection

@section('js')
<!-- {{-- Tidak ada JavaScript khusus untuk halaman ini --}} -->
@endsection