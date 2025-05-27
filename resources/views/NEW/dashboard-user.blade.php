@extends('NEW.EVI.base-page')

@section('css')
<link rel="stylesheet" href="{{ app()->environment('local')? asset('css/dashboard-user.css') :
    secure_asset('css/dashboard-user.css') }}">
<style>
    #map {
        height: calc(100vh - 90px - 20px + 3px);
    }
</style>

@endsection

@section('AddOn')
<div class="bg-success d-flex flex-column justify-content-between width-full-xs position-fixed z-3" style="width: 350px; height: 85.4vh; right:0;">
    <div class="container d-flex justify-content-between align-items-center" style="height: 30px; font-size: 12px; background-color: #2B1010 !important; color: white;">
        <div class="d-flex flex-row gap-2 justify-content-start align-items-center">
            <p class="p-clear fw-bolder">PENTOL MAMANG ALI</p>
            <p class="p-clear">|</p>
            <div class="d-flex flex-row gap-1 ">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
            </div>
        </div>
        <button type="button" class="bg-transparent border-0 noOutline">
            <!-- <i class="bi bi-x-circle first-cl"></i> -->
            <p class="text-decoration-underline p-clear" style="color:rgba(255, 255, 255, 0.56);">close</p>
        </button>
    </div>

    <div class="container d-flex flex-row gap-2 align-items-center justify-content-between" style="height: 100px; background-color: #6D2323;">
        <img class=" circle-preview" src="/assets/contoh.jpg" alt="" style="height: 80%; width: fit-content;">
        <div class="h-75" style="width: 1px; background-color:rgba(255, 255, 255, 0.36);"></div>
        <p class="p-clear h-auto" style="color:rgba(253, 253, 253, 0.87);font-size: 10px;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam, repellat quis odio sapiente quia quam vel, dolor nihil nam maiores rerum esse ex tempora porro magnam tenetur distinctio, adipisci dolore!</p>
    </div>
    <div class="bg-white" style="height: calc(100% - 30px - 100px);">
        <div class="container d-flex flex-row gap-0 py-3 align-items-center justify-content-center h-auto" style="">
            <div class=" d-flex flex-row gap-0 align-items-center justify-content-center">
                <button class="active rounded-start-5 px-3 border-start-0" style="font-size: 12px;">Produk</button>
                <button class="nonactive rounded-end-5 px-3 border-end-0" style="font-size: 12px;">Ulasan</button>
            </div>
        </div>
        <div style="height:calc(100% - 30px - 30px);">
            <div class="container bg-black" style="height: 30px;">
                <p class="p-clear">Produk</p>
            </div>
            <div class="container produks bg-danger d-flex flex-column gap-4" style="height: 300px;">
                @for($i=0;$i<=5;$i++)
                    <div class="produk align-items-center d-flex flex-row">
                        <img class=" circle-preview" src="/assets/contoh.jpg" alt="" style="height: 75%; width: fit-content;">

                        <div>
                            <p>PENTOL GILA</p>
                            <hr>
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <p>stok: 17</p>
                                <p>terjual: 50</p>
                            </div>
                            <div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam quam eligendi, quo officia illum dignissimos, qui, accusantium perferendis saepe consequatur sint molestias doloribus voluptates obcaecati temporibus. Itaque nesciunt sunt dolores!</p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div style="height: 30px;">
            <button>Beri Ulasan</button>
            <button>Pesan Sekarang</button>
        </div>
    </div>
</div>

@endsection

@section('isi')

<div class="h-100 position-relative z-n1" style="height: calc(100vh - 90px - 20px); min-height: fit-content;">
    <div id="map"></div>
</div>


@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
<!-- Load Leaflet from CDN -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet-vector@4.2.3/dist/esri-leaflet-vector.js"></script>

<!-- Load Esri Leaflet Geocoder from CDN -->
<link rel="stylesheet"
    href="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.css">
<script src="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.js"></script>

<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
<script>
    var map = L.map('map').setView([-7.2575, 112.7521], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 5,
        maxZoom: 22,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
</script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin="">
</script>
@endsection