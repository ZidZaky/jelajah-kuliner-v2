<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <link rel="stylesheet" href="{{ auto_asset('css/base.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    @yield('css')

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<!-- {/* MODIFIED HERE */} -->
<body class="first-bg d-flex flex-column min-vh-100"> 
    <nav class="navbar w-full d-flex justify-content-center align-items-center" style="height: 80px; max-height:fit-content;">
        <div class="second-bg d-flex justify-content-between flex-row px-2 px-md-5 rounded-3 h-auto" style="padding: 10px 2px; width: 98%;">
            <div class="containerLeftNavbar d-flex flex-row justify-content-sm-between">
                <a href="/base" class="logo h-auto" style="width: 150px;">
                    <img src="{{ auto_asset('assets/logoJelajahKuliner.svg') }}" alt="Logo"
                        class="w-100">
                </a>
                <div class="container-fluid w-75 h-25">
                    <div class="input-group">
                        <input type="text" class="form-control noOutline" aria-label="Text input with segmented dropdown button">
                        <button type="button" class="btn btn-sm primary-bg-cl noOutline">
                            <i class="bi bi-search text-light"></i>
                        </button>
                    </div>
                </div>
                <div class="dropdown d-flex d-md-none">
                    <button class="btn btn-prm hover-red-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="closePopup()">
                        <i class="bi bi-list"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item cl-white hover-red-dark" href="#" style="background-color: #a73636;">Login</a></li>
                        <li><a class="dropdown-item btn-prm hover-red-dark" href="#">Register</a></li>
                        <li><a class="dropdown-item" href="#">User Guide</a></li>
                    </ul>
                </div>
            </div>
            <div class=" d-none d-md-flex gap-3">
                <a href="/baseLogin" class="btn border border-danger hover-red-dark" style="border: 2px solid #991b1b !important; color: #991b1b;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#991b1b'">
                    Login</a>
<<<<<<< HEAD
                <a href="/baseRegist"><button class="btn btn-prm hover-red-dark rounded-3">Register</button></a>

                <!-- udh login -->
                <!-- <div class="w-auto h-100 d-flex flex-row gap-2 align-items-center justify-content-center">
                    <p class="fs-6 p-0 m-0">Hello, Maryam</p>
                    <button class="btn h-100 rounded-5 p-1 m-0 w-auto border-line-red d-flex flex-row  gap-3 justify-content-center align-items-center">
                        <img src="{{ auto_asset('assets/farhan.jpg') }}" alt="" class="circle-preview">
                        <i class="bi bi-caret-down-fill primary-color px-2 m-0"></i>
                    </button>
                </div> -->
=======
                <button class="btn btn-prm hover-red-dark rounded-3">Register</button>
>>>>>>> 89a22838925d7d5252f99a00082f4c70f0818367
            </div>
        </div>
    </nav>

    


    <div class="position-relative z-3 d-flex flex-column flex-wrap" style="max-height: calc(100vh - 90px - 30px); min-height:0px; max-width:100%; min-width: 0px;">
        <!-- <div class="position-absolute offcanvas offcanvas-start h-100" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel"
        style="max-height: calc(100vh - 90px - 30px); height: calc(100vh - 90px - 30px);">

        </div> -->




        @yield('AddOn')
    </div>

    <div class="isi position-relative z-2" style="/* height: calc(100vh - 90px - 20px); */ width:100%;">
        @yield('isi')
    </div>

    <footer class="mt-auto d-flex justify-content-end position-relative z-3 justify-content-md-between align-items-center grey-bg w-100 px-4" style="bottom:0; height: 30px;">
    
        <div class="d-none d-md-flex justify-content-center align-items-center">
            <p class="show-font">Jelajah Kuliner - Aplikasi Pelacakan Pedagang Kaki Lima Berbasis Web</p>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-row gap-3">
            <a href="" class="d-flex justify-content-center align-items-center flex-row gap-3">
                <p class="show-font">User Guide</p>
                <p class="tiny-font">User Guide</p>
            </a>
            <a href="" class="d-flex justify-content-center align-items-center flex-row gap-3">
                <p class="show-font">Help</p>
                <p class="tiny-font">Help</p>
            </a>
            <a href="" class="d-flex justify-content-center align-items-center flex-row gap-3">
                <p class="show-font">Contact Us</p>
                <p class="tiny-font">Contact Us</p>
            </a>
        </div>
    </footer>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>

@yield('js')

</html>
