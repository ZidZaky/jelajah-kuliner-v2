<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ auto_asset('assets/logoGerobak.svg') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <link rel="stylesheet" href="{{ auto_asset('css/base.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('css')

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>


<body class="first-bg d-flex flex-column justify-content-center min-vh-100">

    @yield('unrelative')
    <nav class="navbar w-full d-flex justify-content-center align-items-center" style="height: 80px; max-height:fit-content;">
        <div class="second-bg d-flex justify-content-between flex-row px-2 px-md-5 rounded-3 h-auto" style="padding: 10px 2px; width: 98%;">
            <div class="containerLeftNavbar d-flex flex-row justify-content-sm-between">
                <a href="/" class="logo h-auto" style="width: 150px;">
                    <img src="{{ auto_asset('assets/logoJelajahKuliner.svg') }}" alt="Logo"
                        class="w-100">
                </a>
                <div class="container-fluid w-75 h-25">
                    <div class="input-group">
                        <input type="text" id="inpSearch" oninput="MainSearch(this)" class="form-control noOutline" aria-label="Text input with segmented dropdown button" placeholder="Cari PKL atau menu...">
                        <button type="button" class="btn btn-sm primary-bg-cl noOutline" onclick="cari5()">
                            <i class="bi bi-search text-light"></i>
                        </button>
                    </div>
                </div>
                <div class="dropdown d-flex d-md-none">
                    <button class="btn btn-prm hover-red-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="closePopup()">
                        <i class="bi bi-list"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if (!Auth::check())
                        <li><a class="dropdown-item cl-white hover-red-dark" href="/login" style="background-color: #a73636;">Login</a></li>
                        <li><a class="dropdown-item btn-prm hover-red-dark" href="/account/create">Register</a></li>
                        @endif
                        @if (Auth::check())
                        @if(session('account')->status=='PKL')
                        <li><a class="dropdown-item cl-white hover-red-dark" href="/Dashboard-Penjualan/{{{session('account')->id}}}VToday" style="background-color: #a73636;">Data Penjualan</a></li>
                        <li><a class="dropdown-item cl-white hover-red-dark" href="/dataPKL/{{session('account')['id']}}" style="background-color: #a73636;">Data PKL</a></li>
                        <li><a class="dropdown-item cl-white hover-red-dark" href="/pesanan/show/?id={{session('account')['id']}}&wht={{{'Pesanan Baru'}}}" style="background-color: #a73636;">List Pesanan</a></li>
                        @endif
                        <li><a class="dropdown-item cl-white hover-red-dark" href="/profile" style="background-color: #a73636;">My Profile</a></li>
                        <li><a class="dropdown-item btn-prm hover-red-dark" href="/pesanan/show/?id={{{session('account')->id}}}&wht=Pesanan Baru">List Pesanan</a></li>
                        <li><a class="dropdown-item btn-prm hover-red-dark" href="/logout">Logout</a></li>
                        @endif
                        <!-- <li><  a class="dropdown-item" href="#">User Guide</a></li> -->
                    </ul>
                </div>
            </div>
            <div class=" d-none d-md-flex gap-3">

                @if (!Auth::check())
                <a href="/login" class="btn border border-danger hover-red-dark" style="border: 2px solid #991b1b !important; color: #991b1b;" onmouseover="this.style.color='white'" onmouseout="this.style.color='#991b1b'">
                    Login</a>
                <a href="/account/create"><button class="btn btn-prm hover-red-dark rounded-3">Register</button></a>
                @endif
                <!-- udh login -->
                @if (Auth::check())
                @if(session('account')->status=='PKL')
                <form action="/update-location" method="POST">
                    @csrf
                    <button type="button" class="btn bg-prim-dark cl-white btn-danger" onclick="getCurrentLocation(this)">Update Lokasi</button>
                    <input type="text" name="latitude" id="latitude" class="d-none">
                    <input type="text" name="longitude" id="longitude" class="d-none">
                </form>
                @endif
                <div class="w-auto h-100 d-flex flex-row position-relative gap-2 align-items-center justify-content-center">
                    <!-- <p class="fs-6 p-0 m-0">Hello, {{session('account')['nama']}}</p>
                      -->
                    <p class="fs-6 p-0 m-0">Hello, {{ explode(' ', session('account')['nama'])[0] }}</p>

                    <button class="btn h-100 rounded-5 p-1 m-0 w-auto border-line-red d-flex flex-row  gap-3 justify-content-center align-items-center"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="" class="circle-preview">
                        <i class="bi bi-caret-down-fill primary-color px-2 m-0"></i>
                    </button>
                    <ul class="dropdown-menu mt-3 position-absolute" style="right: -20px;">
                        @if (session('account')['status'] == 'PKL')
                        <li><a class="dropdown-item" href="/dataPKL/{{session('account')['id']}}">Data PKL</a></li>
                        <li><a class="dropdown-item" href="/Dashboard-Penjualan/{{{session('account')->id}}}VToday">Data Penjualan</a></li>
                        @endif
                        <li><a class="dropdown-item" href="/pesanan/show/?id={{session('account')['id']}}&wht={{{'Pesanan Baru'}}}">List Pesanan</a></li>
                        <li><a class="dropdown-item" href="/profile">My Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item bg-prim-dark cl-white" href="/logout">Logout</a></li>
                    </ul>

                </div>
                @endif

            </div>
        </div>
    </nav>

    <main role="main" class="flex-grow-1">
        <div class="position-relative z-3 d-flex flex-column flex-wrap" style="min-height:0px; max-width:100%; min-width: 0px;">
            @yield('AddOn')
        </div>

        <div class="position-relative z-2" style="width:100%;">
            @yield('isi')
        </div>
    </main>
    <footer class="mt-auto d-flex justify-content-end position-relative z-3 justify-content-md-between align-items-center grey-bg w-100 px-4" style="height: 30px;">
        <div class="d-none d-md-flex justify-content-center align-items-center">
            <p class="show-font">Jelajah Kuliner - Aplikasi Pelacakan Pedagang Kaki Lima Berbasis Web</p>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-row gap-3">
            <a href="/userguide" class="d-flex justify-content-center align-items-center flex-row gap-3">
                <p class="show-font">User Guide</p>
                <p class="tiny-font">User Guide</p>
            </a>
            <!-- <a href="" class="d-flex justify-content-center align-items-center flex-row gap-3">
                <p class="show-font">Help</p>
                <p class="tiny-font">Help</p>
            </a> -->
            <a href="https://api.whatsapp.com/send/?phone=088989694349&text&type=phone_number&app_absent=0" class="d-flex justify-content-center align-items-center flex-row gap-3">
                <p class="show-font">Contact Us</p>
                <p class="tiny-font">Contact Us</p>
            </a>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>

<script>
    function erorAlert(title, msg) {
        Swal.fire({
            icon: "error",
            title: title,
            text: msg,
        });
    }

    function successAlert(title, msg) {
        Swal.fire({
            icon: "success",
            title: title,
            text: msg,
        });
    }

    function formatRupiah(angka) {
        // Pastikan input berupa integer atau bisa diubah ke integer
        let number = parseInt(angka);

        if (isNaN(number)) return 'Rp. 0';

        return 'Rp. ' + number.toLocaleString('id-ID');
    }

    function MainSearch(elemen) {
        let AllPkl = document.querySelectorAll('.popup.getThis')
        // console.log(AllPkl, 'all')
        AllPkl.forEach(e => {
            e.closest('.leaflet-marker-icon').style.display = 'none'

            // console.log(e.textContent);
        });
        let match = []
        fetch(`/getData`)
            .then(response => response.json())
            .then(data => {
                data.forEach(e => {
                    // console.log(elemen.value.toLowerCase(),Object.values(e).join(' ').toLowerCase(),'cut')
                    if (Object.values(e).join(' ').toLowerCase().includes(elemen.value.toLowerCase())) {
                        // console.log(Object.values(e).join(' ').toLowerCase().includes(elemen.value.toLowerCase()))

                        match.push(e.id);
                    }
                })
                //here
                match.forEach(show => {
                    AllPkl.forEach(e => {
                        if (e.classList.contains('ProdukPopUp' + show)) {
                            e.closest('.leaflet-marker-icon').style.display = ''
                        }
                    })
                })
            });





    }
</script>
@yield('js')


</html>