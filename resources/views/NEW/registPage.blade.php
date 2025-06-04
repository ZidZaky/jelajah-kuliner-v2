@extends('NEW.EVI.base-page')

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
    <div class="position-fixed"
        style="width: 50%; height: 100%; right: 0; background-color: white; margin-top: -15px; padding: 1% 0;">
        <div class="position-fixed d-flex flex-column align-items-center"
            style="width: 40%; height: 70%; right: 5%">
            <img src="{{ auto_asset('assets/logoJelajahKuliner.svg') }}" alt="newLogoApp" class="mt-2" style="width: 40%;">

            <h5 class="mt-1 mb-1" style="text-align: center; width: 100%;"><strong>
                    Buat Akun, dan Mulailah Menjelajah!
                </strong></h5>

            <p class="mb-1"><strong>
                    Anda Akan Membuat Akun Sebagai?
                </strong></p>

            <!-- Bagian Button -->
            <div class="d-flex justify-content-center gap-2 mb-0">
                <div class="btn-group rounded-5 border border-danger overflow-hidden" role="group">
                    <input type="radio" class="btn-check" name="jenisAkun" id="PKL" value="PKL" autocomplete="off" checked
                        onchange="toggleForm('PKL')">
                    <label class="btn btn-outline-danger px-4 rounded-start-5"
                        style="border: 2px solid #991b1b !important; color: black;" for="PKL"><strong>PKL</strong></label>

                    <input type="radio" class="btn-check" name="jenisAkun" id="Pelanggan" value="Pelanggan"
                        autocomplete="off" onchange="toggleForm('Pelanggan')">
                    <label class="btn btn-outline-danger px-4 rounded-end-5"
                        style="border: 2px solid #991b1b !important; color: black;"
                        for="Pelanggan"><strong>Pelanggan</strong></label>
                </div>
            </div>
            <!-- Form PKL -->
            <div id="formPKL" class="w-100 px-4">
                <div class="d-flex gap-4">
                    <!-- Form Akun -->
                    <div class="w-50">
                        <h6 class="mb-1"><strong>Data Akun</strong></h6>
                        <div class="mb-2">
                            <input type="text" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-2">
                            <input type="email" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                placeholder="Email" required>
                        </div>
                        <div class="mb-0">
                            <input type="tel" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                placeholder="Nomor Telepon" required>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Upload foto profil Anda</small>
                            <input type="file" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;" accept="image/*"
                                required>
                        </div>
                        <div class="mb-2 position-relative">
                            <input type="password" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;" id="passwordPKL"
                                placeholder="Password" required>
                            <button class="btn position-absolute end-0 top-50 translate-middle-y me-2" type="button"
                                onclick="togglePasswordPKL()">
                                <i class="bi bi-eye" id="toggleIconPKL"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Form PKL -->
                    <div class="w-50">
                        <h6 class="mb-1 text-end"><strong>Data PKL</strong></h6>
                        <div class="mb-2">
                            <input type="text" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                placeholder="Nama Toko" required>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b;" placeholder="Deskripsi Toko"
                                rows="2" required></textarea>
                        </div>

                        <div class="mb-2 d-flex flex-column">
                            <small class="text-muted">Upload foto toko Anda</small>
                            <input type="file" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;" accept="image/*"
                                required>
                        </div>
                        <div class="mb-2 position-relative">
                            <input type="password" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                id="confirmPasswordPKL" placeholder="Konfirmasi Password" required>
                            <button class="btn position-absolute end-0 top-50 translate-middle-y me-2" type="button"
                                onclick="toggleConfirmPasswordPKL()">
                                <i class="bi bi-eye" id="toggleConfirmIconPKL"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Form Pelanggan -->
            <div id="formPelanggan" class="w-100 px-4 mt-0" style="display: none;">
                <div class="d-flex gap-4">
                    <div class="w-50 pt-4">
                        <div class="mb-3">
                            <input type="text" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                placeholder="Email" required>
                        </div>
                        <div class="mb-2">
                            <input type="tel" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                placeholder="Nomor Telepon" required>
                        </div>
                    </div>

                    <div class="w-50">
                        <div class="mb-3">
                            <small class="text-muted">Upload foto profil Anda</small>
                            <input type="file" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;" accept="image/*"
                                required>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                id="passwordPelanggan" placeholder="Password" required>
                            <button class="btn position-absolute end-0 top-50 translate-middle-y me-2" type="button"
                                onclick="togglePasswordPelanggan()">
                                <i class="bi bi-eye" id="toggleIconPelanggan"></i>
                            </button>
                        </div>
                        <div class="mb-3 position-relative">
                            <input type="password" class="form-control rounded-5"
                                style="background-color: #E5E5E5; border: 2px solid #991b1b; height: 35px;"
                                id="confirmPasswordPelanggan" placeholder="Konfirmasi Password" required>
                            <button class="btn position-absolute end-0 top-50 translate-middle-y me-2" type="button"
                                onclick="toggleConfirmPasswordPelanggan()">
                                <i class="bi bi-eye" id="toggleConfirmIconPelanggan"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            <style>
                .btn-check:checked+.btn-outline-danger {
                    background-color: #991b1b !important;
                    color: black !important;
                }
            </style>
        </div>
        <div class="d-flex flex-column align-items-center" style="position: absolute; bottom: 17%; width: 100%;">
            <button class="btn rounded-5 hover-red-dark"
                style="background-color: #991b1b; height: 35px; color: white; width: 35%;">
                <strong>Buat Akun!</strong>
            </button>

            <div class="d-flex justify-content-center gap-1 mt-2">
                <strong>
                    <p class="mb-0" style="color: #666666;">Sudah punya akun?</p>
                </strong>
                <strong><a href="/baseLogin" class="text-decoration-none" style="color: #FF0000;"
                        onmouseover="this.style.color='#991b1b'" onmouseout="this.style.color='#FF0000'">Login
                        Disini!
                    </a></strong>
            </div>
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
        function togglePasswordPKL() {
            const passwordField = document.getElementById('passwordPKL');
            const toggleIcon = document.getElementById('toggleIconPKL');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        function toggleConfirmPasswordPKL() {
            const passwordField = document.getElementById('confirmPasswordPKL');
            const toggleIcon = document.getElementById('toggleConfirmIconPKL');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        function togglePasswordPelanggan() {
            const passwordField = document.getElementById('passwordPelanggan');
            const toggleIcon = document.getElementById('toggleIconPelanggan');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        function toggleConfirmPasswordPelanggan() {
            const passwordField = document.getElementById('confirmPasswordPelanggan');
            const toggleIcon = document.getElementById('toggleConfirmIconPelanggan');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
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

    <script>
        function toggleForm(jenis) {
            if (jenis === 'PKL') {
                document.getElementById('formPKL').style.display = 'block';
                document.getElementById('formPelanggan').style.display = 'none';
            } else {
                document.getElementById('formPKL').style.display = 'none';
                document.getElementById('formPelanggan').style.display = 'block';
            }
        }
    </script>
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
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.css">
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
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
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
        </script>
@endsection