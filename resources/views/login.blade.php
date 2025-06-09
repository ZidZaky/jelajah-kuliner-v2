@extends('layouts.layout')


@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/dashboard-user.css') }}">
<style>
    #map {
        height: calc(100vh - 90px - 20px + 3px);
        filter: grayscale(100%);
    }
</style>

@endsection

@section('AddOn')

<form action="/loginAccount" method="POST" id="loginForm">
    @csrf
    <div class="position-fixed" style="width: 50%; height: 100%; right: 0; background-color: white; margin-top: -15px; padding: 7% 0;">
        <div class="position-fixed d-flex flex-column align-items-center" style="width: 25%; height: 60%; right: 12.5%">
            <img src="{{ auto_asset('assets/logoJelajahKuliner.svg') }}" alt="newLogoApp"
                class="mt-4" style="width: 40%;">

            <strong>
                <h5 class="mt-1 mb-4" style="text-align: center; width: 100%;">
                    SELAMAT DATANG!
                </h5>
            </strong>

            <div class="d-flex flex-column gap-3 px-4 w-100">

                <div class="position-relative">
                    <input autocomplete="off" type="email" name="email" class="form-control rounded-5 @error('email') is-invalid @enderror" style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="position-relative">
                    <input autocomplete="off" type="password" name="password" class="form-control rounded-5 @error('password') is-invalid @enderror" style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;" placeholder="Password" id="passwordField" required>
                    <button class="btn position-absolute end-0 top-50 translate-middle-y me-2" type="button" onclick="togglePassword()">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <button type="submit" class="btn w-100 rounded-5 mt-3 hover-red-dark" style="background-color: #991b1b; height: 35px; color: white;"><strong>Sign In</strong></button>

                <div class="d-flex justify-content-center gap-1">
                    <strong>
                        <p class="mb-0" style="color: #666666;">Belum punya akun?</p>
                    </strong>
                    <strong><a href="/account/create" class="text-decoration-none" style="color: #FF0000;" onmouseover="this.style.color='#991b1b'" onmouseout="this.style.color='#FF0000'">Daftar Disini!</a></strong>
                </div>

            </div>

            <script>
                function togglePassword() {
                    const passwordField = document.getElementById('passwordField');
                    const toggleIcon = document.getElementById('toggleIcon');

                    if (passwordField.type === 'password') {
                        passwordField.type = 'text';
                        toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
                    } else {
                        passwordField.type = 'password';
                        toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
                    }
                }
            </script>
        </div>
    </div>
</form>
@endsection

@section('isi')

<div class="h-100 position-relative z-n1" style="height: calc(100vh - 90px - 20px); min-height: fit-content;">
    <div id="map"></div>
</div>


@endsection

@section('js')
<script>
    @if((session('alert')!=null))
 erorAlert('Login Gagal', '{{session('alert')}}')
@endif
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

    function closePopup() {
        popup = document.querySelectorAll('.containerPopup')
        popup.forEach(e => {
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