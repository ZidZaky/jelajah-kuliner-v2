@extends('NEW.EVI.base-page')

@section('title')
Tambah Produk || JELAJAHKULINER
@endsection

@section('css')
<link rel="stylesheet" href="{{ app()->environment('local') ? asset('css/base.css') : secure_asset('css/base.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
    #map {
        height: calc(100vh - 90px - 20px + 3px);
        filter: grayscale(100%);

    }

    .btn-close {
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 1;
    }
</style>
@endsection


@section('AddOn')
<!-- Modal -->
<div class="modal fade show d-block modal-custom" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 p-4 shadow" style="background-color: #f9f9f9;">
            <button type="button" class="btn-close" onclick="window.location='{{ url()->previous() }}'"></button>
            <div class="text-center mb-3">
                <h4 class="fw-bold">Tambah Produk</h4>
                <hr>
            </div>
            <form method="POST" action="/produk" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control rounded-pill border-2" id="namaProduk" name="namaProduk"
                        placeholder="Nama produk" required>
                </div>

                <div class="d-flex justify-content-center gap-2 mb-3">
                    <div class="btn-group rounded-pill border border-danger overflow-hidden" role="group">
                        <input type="radio" class="btn-check" name="jenisProduk" id="makanan" value="Makanan" autocomplete="off" checked>
                        <label class="btn btn-outline-danger px-4" for="makanan">Makanan</label>

                        <input type="radio" class="btn-check" name="jenisProduk" id="minuman" value="Minuman" autocomplete="off">
                        <label class="btn btn-outline-danger px-4" for="minuman">Minuman</label>
                    </div>
                </div>

                <div class="mb-3">
                    <textarea class="form-control rounded-4 border-2" name="desc" rows="3" placeholder="Deskripsi produk" required></textarea>
                </div>

                <div class="d-flex gap-2 mb-3">
                    <input type="number" class="form-control rounded-pill border-2 text-center" name="harga"
                        placeholder="Harga Produk" required>
                    <input type="number" class="form-control rounded-pill border-2 text-center" name="stok"
                        placeholder="Stok Awal" required>
                </div>

                <div class="mb-3 d-flex gap-2 align-items-center">
                    <input type="file" class="form-control rounded-pill border-2" name="fotoProduk" required>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">Tambah</button>
                </div>
                <input type="text" name="idPKL" id="idPKL" value="{{ session('pkl')['id'] }}" readonly hidden>
                <input type="text" name="idAccount" id="idAccount" value="{{ session('pkl')['id'] }}" readonly hidden>
            </form>
        </div>
    </div>
</div>
@endsection

@section('isi')
<div id="map"></div>
@endsection

@section('js')
<!-- Map scripts -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet-vector@4.2.3/dist/esri-leaflet-vector.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js"></script>

<script>
    var map = L.map('map').setView([-7.2575, 112.7521], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 5,
        maxZoom: 22,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
</script>
@endsection