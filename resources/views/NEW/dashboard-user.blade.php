@extends('NEW.EVI.base-page')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/dashboard-user.css') }}">
<style>
    #map {
        height: calc(100vh - 90px - 20px + 3px);
    }
</style>

@endsection

@section('AddOn')
<div class="containerPopup bg-success d-flex flex-column justify-content-between width-full-xs position-fixed z-3" style="width: 350px; height: 80vh; right:0;">
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
        <button type="button" onclick="closePopup()" class="closebutton bg-transparent border-0 noOutline">
            <!-- <i class="bi bi-x-circle first-cl"></i> -->
            <p class="text-decoration-underline p-clear" style="color:rgba(255, 255, 255, 0.56);">close</p>
        </button>
    </div>

    <div class="container d-flex flex-row gap-2 align-items-center justify-content-between" style="height: 100px; max-height: 100px; background-color: #6D2323;">
        <img class="circle-preview" src="/assets/contoh.jpg" alt="" style="height: 80%; width: fit-content;">
        <div class="h-75" style="width: 1px; background-color:rgba(255, 255, 255, 0.36);"></div>
        <p class="p-clear h-auto" style="color:rgba(253, 253, 253, 0.87);font-size: 10px;">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam, repellat quis odio sapiente quia quam vel, dolor nihil nam maiores rerum esse ex tempora porro magnam tenetur distinctio, adipisci dolore!</p>
    </div>
    <div class="bg-white d-flex flex-column justify-content-between" style="height: calc(100% - 30px - 100px); max-height: calc(100% - 30px - 100px);">
        <div class="container d-flex flex-row gap-0 py-3 align-items-center justify-content-center h-auto" style="">
            <div class="button1 d-flex flex-row gap-0 align-items-center justify-content-center">
                <button class="active rounded-start-5 px-3 border-start-0" style="font-size: 12px;" onclick="setViewPopupPKL('Produk')">Produk</button>
                <button class="nonactive rounded-end-5 px-3 border-end-0" style="font-size: 12px;" onclick="setViewPopupPKL('Ulasan')">Ulasan</button>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-between" style="height: calc(100% - 30px - 30px - 50px);">
            <div class="container d-flex flex-column gap-0" style="height: 30px;">
                <p class="p-clear">Produk</p>
                <hr class="m-0 " style=" height: 2px; border: 1px  solid  #6D2323; background-color: #6D2323;">
            </div>
            <div class="container mt-2 area products produks d-flex flex-column gap-2" style="height: calc(100% - 30px);">

                <!-- Kalau belum ada produk -->
                <!-- <div class="w-100 h-100 d-flex justify-content-center align-items-center ">
                    <p class="p-clear" style="font-size: 12px;">Belum ada Produk yang terdaftar</p>
                </div> -->
                <!-- Kalau udh ada produk -->
                @for($i=0;$i<=20;$i++)
                    <div class="produk align-items-center position-relative d-flex flex-row justify-content-end align-items-end" style="height:110px; min-height: 110px;">
                    <img class="circle-preview position-absolute z-1 shadow" src="{{auto_asset('assets/contoh.jpg')}}" alt="" style="height: 75%; width: fit-content; left: 0;">
                    <div class="position-absolute z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:87%; height:95%; max-height: 95%; min-height: 95%;  ">
                        <div class="contisi d-flex flex-column first-cl justify-content-end align-items-end w-50">
                            <p class="fw-bolder" style="font-size: 10px;">PENTOL GILA</p>
                            <hr class="w-100">
                            <div class="d-flex flex-row w-100 justify-content-between align-items-center" style="font-size: 10px;">
                                <p class="p-clear">stok: 17</p>
                                <p class="p-clear">terjual: 50</p>
                            </div>
                        </div>
                        <div class="textDexscription scroll-bg-dark pe-1 text-justify first-cl" style="width: 85%; flex:1; overflow: auto;">
                            <p class="text-justify" style="text-indent: 12px; font-size: 9px; text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, aliquam deleniti? Aliquam fugiat similique, vitae consequuntur fugit doloremque perferendis quis quasi? Incidunt, quam! Laboriosam aut placeat esse consequuntur! Ea, velit?</p>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            <div class="container mt-2  area ulasans d-none d-flex flex-column gap-2" style="height: calc(100% - 30px);">
                <!-- kalau belum ada ulasan -->
                <!-- <div class="w-100 h-100 d-flex justify-content-center align-items-center ">
                    <p class="p-clear" style="font-size: 12px;">Belum ada Ulasan</p>
                </div> -->
                <!-- kalau udh ada ulasan -->
                @for($i=0;$i<=20;$i++)
                    <div class="produk ulasan align-items-center border-left-top border-right-bottom py-2 px-3 gap-2 position-relative d-flex flex-column justify-content-start align-items-center" style="height:100px; min-height: 100px; background-color: #D8D8D8;">
                        <div class="d-flex justify-content-between align-items-center w-100 h-auto">
                            <div class="d-flex flex-row gap-1" style="font-size: 8px;">
                                <i class="p-clear bi bi-star-fill cl-prim-dark"></i>
                                <i class="p-clear bi bi-star-fill cl-prim-dark"></i>
                                <i class="p-clear bi bi-star-fill cl-prim-dark"></i>
                                <i class="p-clear bi bi-star-fill cl-grey-fade"></i>
                                <i class=" p-clear bi bi-star-fill cl-grey-fade"></i>
                            </div>

                            <p class="p-clear cl-prim-dark fw-bolder" style="font-size: 13px;">A**ri L**fa</p>
                        </div>

                        <div class="w-100" style="flex:1; overflow: auto;">
                            <p style="font-size: 10px; text-indent: 12px; text-align: justify;">hygfds</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
        <div class="button2 d-flex flex-row gap-3 justify-content-center align-items-center" style="height: 50px;">
            <button class="nonactive rounded-5 px-3" onclick="hrefTo('/')" style="font-size: 12px; width: 40%; height: 30px;">Beri ulasan</button>
            <button class="active rounded-5 px-3 " onclick="hrefTo('/')" style="font-size: 12px; width: 40%; height: 30px;">Pesan Sekarang</button>
            <!-- <button class="login active rounded-5 px-3 " onclick="hrefTo('/')" style="font-size: 12px; max-width: fit-content; height: 30px;">Silahkan Login Terlebih Dahulu</button> -->
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
<script>
    function setViewPopupPKL(wht) {
        button1 = document.querySelector('.button1').querySelectorAll('button')
        button2 = document.querySelector('.button2').querySelectorAll('button')
        loginbbutton = document.querySelector('.button2 .login')
        console.log(loginbbutton)
        // console.log(button2)
        container = document.querySelectorAll('.container.area')
        // console.log(container)
        // console.log(button1)
        button1.forEach(e => {
            if (wht == e.innerHTML) {
                e.classList.replace('nonactive', 'active');
            } else {
                e.classList.replace('active', 'nonactive');

            }
        })

        if (wht == 'Produk') {
            if (loginbbutton == null) {
                button2[1].classList.replace('nonactive', 'active')
                button2[0].classList.replace('active', 'nonactive')
            }
            container[1].classList.replace('d-flex', 'd-none')
            container[0].classList.replace('d-none', 'd-flex')
        } else {
            container[0].classList.replace('d-flex', 'd-none')
            container[1].classList.replace('d-none', 'd-flex')
            if (loginbbutton == null) {

                button2[0].classList.replace('nonactive', 'active')
                button2[1].classList.replace('active', 'nonactive')
            }
        }
    }

    function hrefTo(link) {
        window.location.href = link;
    }

    function closePopup(){
        popup = document.querySelectorAll('.containerPopup')
        popup.forEach(e=>{
            e.classList.replace('d-flex', 'd-none')
        })
    }
</script>
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