@extends('layouts.layout')


@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/dashboard-user.css') }}">

{{-- Link CSS untuk Library Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.css" crossorigin="">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" crossorigin="" />
@endsection

@section('AddOn')
<!-- <div class="containerPopup bg-success d-flex flex-column justify-content-between width-full-xs position-fixed z-3" style="width: 350px; height: 80vh; right:0;"> -->
<div class="d-none containerPopup bg-success d-flex flex-column justify-content-between width-full-xs position-fixed z-3" style="width: 350px; height: 84.8vh; right:0; top: 90px; /* Atur 'top' sesuai tinggi navbar Anda jika popup tertutup */">
    {{-- Header Popup --}}
    <div class="container d-flex justify-content-between align-items-center" style="height: 30px; font-size: 12px; background-color: #2B1010 !important; color: white;">
        <div class="d-flex flex-row gap-2 justify-content-start align-items-center">
            <p class="p-clear fw-bolder" id="popupVendorName">NAMA VENDOR</p>
            <p class="p-clear">|</p>
            <div class="d-flex flex-row gap-1" id="popupVendorRating">
                {{-- Bintang rating akan diisi oleh JavaScript --}}
            </div>
        </div>
        <button type="button" onclick="closePopup()" class="closebutton bg-transparent border-0 noOutline p-0">
            <p class="text-decoration-underline p-clear m-0" style="color:rgba(255, 255, 255, 0.56);">close</p>
        </button>
    </div>

    {{-- Info Vendor (Gambar & Deskripsi Singkat) --}}
    <div class="container d-flex flex-row gap-2 align-items-center justify-content-between" style="height: 100px; max-height: 100px; background-color: #6D2323;">
        <!-- <img class="circle-preview" src="/assets/contoh.jpg" alt="" style="height: 80%; width: fit-content;"> -->
        <img class="circle-preview" src="" alt="Vendor Image" id="popupVendorImage" style="height: 80%; width: auto; max-width: 80px; object-fit: cover; border-radius:50%;">
        <div class="h-75" style="width: 1px; background-color:rgba(255, 255, 255, 0.36);"></div>
        <p class="p-clear h-auto" id="popupVendorDescription" style="color:rgba(253, 253, 253, 0.87);font-size: 10px; flex:1; overflow-y:auto;">Deskripsi Vendor.</p>
    </div>

    {{-- Konten Utama Popup (Produk/Ulasan) --}}
    <div class="bg-white d-flex flex-column justify-content-between" style="height: calc(100% - 30px - 100px); max-height: calc(100% - 30px - 100px);">
        {{-- Tombol Tab Produk/Ulasan --}}
        <div class="container d-flex flex-row gap-0 py-3 align-items-center justify-content-center h-auto">
            <div class="button1 d-flex flex-row gap-0 align-items-center justify-content-center">
                <button class="active rounded-start-5 px-3 border-start-0" style="font-size: 12px;" onclick="setViewPopupPKL('Produk')">Produk</button>
                <button class="nonactive rounded-end-5 px-3 border-end-0" style="font-size: 12px;" onclick="setViewPopupPKL('Ulasan')">Ulasan</button>
            </div>
        </div>

        {{-- Area Konten Dinamis (Produk atau Ulasan) --}}
        <div class="d-flex flex-column justify-content-start" style="flex: 1; overflow: hidden;"> {{-- justify-content-start, flex:1, overflow:hidden --}}
            <div class="container d-flex flex-column gap-0" style="height: 30px; min-height:30px;">
                <p class="p-clear" id="popupCurrentTabTitle">Produk</p>
                <hr class="m-0" style="height: 2px; border: 1px solid #6D2323; background-color: #6D2323;">
            </div>
            {{-- Kontainer Produk --}}
            <div class="container mt-2 area products produks d-flex flex-column gap-2" style="flex: 1; overflow-y: auto;"> {{-- flex:1 agar mengambil sisa ruang --}}
                <div class="w-100 h-100 d-flex justify-content-center align-items-center initial-product-placeholder">
                    <p class="p-clear" style="font-size: 12px;">Memuat produk...</p>
                </div>
            </div>
            {{-- Kontainer Ulasan --}}
            <div class="container mt-2 area ulasans d-none flex-column gap-2" style="flex: 1; overflow-y: auto;"> {{-- Awalnya d-none, flex:1 --}}
                <div class="w-100 h-100 d-flex justify-content-center align-items-center initial-review-placeholder">
                    <p class="p-clear" style="font-size: 12px;">Memuat ulasan...</p>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi Bawah --}}
        <div class="button2 d-flex flex-row gap-3 justify-content-center align-items-center" style="height: 50px; min-height:50px;" id="areaTombolAksi">
            <button class="nonactive rounded-5 px-3" onclick="hrefTo('/')" style="font-size: 12px; width: 40%; height: 30px;">Beri ulasan</button>
            <button class="active rounded-5 px-3 " onclick="hrefTo('/')" style="font-size: 12px; width: 40%; height: 30px;">Pesan Sekarang</button>
        </div>
    </div>
</div>
@endsection

@section('isi')
<div class="h-100 position-relative z-n1"> {{-- Tinggi diatur oleh #map --}}
    <div id="map"></div>
</div>
@endsection

@section('js')
{{-- Panggil script library Leaflet dan plugin terlebih dahulu --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
<script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js" crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet-vector@4.2.3/dist/esri-leaflet-vector.js" crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@3.1.4/dist/esri-leaflet-geocoder.js" crossorigin=""></script>

<script>
    // Fungsi-fungsi helper Anda
    function setViewPopupPKL(wht) {
        const popupNode = document.querySelector('.containerPopup');
        if (!popupNode) {
            console.error('Element .containerPopup tidak ditemukan oleh setViewPopupPKL!');
            return;
        }

        const button1Elements = popupNode.querySelector('.button1');
        const button2Elements = popupNode.querySelector('.button2');
        // containerAreaElements akan menjadi NodeList dari .products dan .ulasans
        const containerAreaElements = popupNode.querySelectorAll('.container.area');
        const tabTitleElement = document.getElementById('popupCurrentTabTitle');

        if (!button1Elements || !button2Elements || containerAreaElements.length < 2 || !tabTitleElement) {
            console.error('Elemen button, container area, atau tab title di dalam popup tidak lengkap.');
            return;
        }

        const buttons1 = button1Elements.querySelectorAll('button');
        const buttons2 = button2Elements.querySelectorAll('button');
        const loginbbutton = button2Elements.querySelector('.login');

        const productArea = popupNode.querySelector('.area.products'); // Lebih spesifik
        const reviewArea = popupNode.querySelector('.area.ulasans'); // Lebih spesifik

        if (!productArea || !reviewArea) {
            console.error('Area produk atau ulasan tidak ditemukan.');
            return;
        }

        buttons1.forEach(e => {
            if (wht === e.innerHTML) {
                e.classList.replace('nonactive', 'active');
            } else {
                e.classList.replace('active', 'nonactive');
            }
        });

        if (wht === 'Produk') {
            tabTitleElement.textContent = 'Produk';
            if (loginbbutton == null && buttons2.length > 1) {
                buttons2[1].classList.replace('nonactive', 'active');
                buttons2[0].classList.replace('active', 'nonactive');
            }
            reviewArea.classList.add('d-none');
            reviewArea.classList.remove('d-flex');
            productArea.classList.remove('d-none');
            productArea.classList.add('d-flex');
        } else { // Ulasan
            tabTitleElement.textContent = 'Ulasan';
            if (loginbbutton == null && buttons2.length > 1) {
                buttons2[0].classList.replace('nonactive', 'active');
                buttons2[1].classList.replace('active', 'nonactive');
            }
            productArea.classList.add('d-none');
            productArea.classList.remove('d-flex');
            reviewArea.classList.remove('d-none');
            reviewArea.classList.add('d-flex');
        }
    }

    function hrefTo(link) {
        window.location.href = link;
    }

    function closePopup() {
        const popupElement = document.querySelector('.containerPopup');
        if (popupElement) {
            popupElement.classList.add('d-none');
            popupElement.classList.remove('d-flex');
        }
    }

    function showPopup() {
        const popupElement = document.querySelector('.containerPopup');
        if (popupElement) {
            popupElement.classList.remove('d-none');
            popupElement.classList.add('d-flex');
        } else {
            console.error("Elemen .containerPopup tidak ditemukan oleh showPopup()");
        }
    }

    function populatePopup(vendor) {
        const vendorNameEl = document.getElementById('popupVendorName');
        if (vendorNameEl) vendorNameEl.textContent = vendor.name;

        const ratingContainer = document.getElementById('popupVendorRating');
        if (ratingContainer) {
            ratingContainer.innerHTML = '';
            for (let i = 0; i < 5; i++) {
                const starIcon = document.createElement('i');
                starIcon.classList.add('bi');
                if (i < vendor.rating) {
                    starIcon.classList.add('bi-star-fill', 'text-warning');
                } else {
                    starIcon.classList.add('bi-star', 'text-warning');
                }
                ratingContainer.appendChild(starIcon);
            }
        }

        const vendorImageEl = document.getElementById('popupVendorImage');
        if (vendorImageEl) {
            vendorImageEl.src = vendor.imageUrl;
            vendorImageEl.alt = vendor.name + "'s Profile Image";
        }
        const vendorDescEl = document.getElementById('popupVendorDescription');
        if (vendorDescEl) vendorDescEl.textContent = vendor.description;

        const areaTombolAksi = document.getElementById('areaTombolAksi');
        if (areaTombolAksi) {
            const pklId = vendor.id; // Ambil ID PKL dari objek vendor

            // Perbarui innerHTML dari div 'areaTombolAksi' dengan tombol-tombol baru
            // yang memiliki onclick dinamis
            areaTombolAksi.innerHTML = `
            <button class="nonactive rounded-5 px-3" onclick="hrefTo('/ulasan/create/${pklId}')" style="font-size: 12px; width: 40%; height: 30px;">Beri ulasan</button>
            <button class="active rounded-5 px-3 " onclick="hrefTo('/pesanan/create/${pklId}')" style="font-size: 12px; width: 40%; height: 30px;">Pesan Sekarang</button>
            {{-- Catatan: Sesuaikan URL '/pesan/${pklId}' jika targetnya berbeda atau statis. 
                 Jika tombol "Pesan Sekarang" selalu ke '/', gunakan: onclick="hrefTo('/')" --}}
        `;
        } else {
            console.warn("Elemen dengan ID 'areaTombolAksi' tidak ditemukan. Tombol aksi tidak dapat diupdate.");
        }

        getProduk(vendor.id); // Panggil fungsi untuk mendapatkan produk vendor

        getUlasan(vendor.id); // Panggil fungsi untuk mendapatkan ulasan vendor
        setViewPopupPKL('Produk');
    }

    // Inisialisasi map dan marker Anda
    var map = L.map('map').setView([-7.2575, 112.7521], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 5,
        maxZoom: 22,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    L.control.locate().addTo(map);

    function getUlasan(id) {
        // Fetch ulasan data for the specific PKL ID
        fetch(`/getUlasan/${id}`)
            .then(response => response.json()).then(data => {
                const reviewsContainer = document.querySelector('.containerPopup .area.ulasans');
                if (reviewsContainer) {
                    reviewsContainer.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(review => {
                            let reviewStarsHtml = '';
                            for (let i = 0; i < 5; i++) {
                                reviewStarsHtml += `<i class="p-clear bi bi-star-fill ${i < review.rating ? 'cl-prim-dark' : 'cl-grey-fade'}"></i>`;
                            }
                            const reviewHTML = `
                    <div class="produk ulasan align-items-center border-left-top border-right-bottom py-2 px-3 gap-2 position-relative d-flex flex-column justify-content-start align-items-center w-100" style="min-height: 100px; background-color: #D8D8D8;">
                        <div class="d-flex justify-content-between align-items-center w-100 h-auto">
                            <div class="d-flex flex-row gap-1" style="font-size: 8px;">${reviewStarsHtml}</div>
                            <p class="p-clear cl-prim-dark fw-bolder" style="font-size: 13px;">${review.namaPengulas}</p>
                        </div>
                        <div class="w-100" style="flex:1; overflow: auto;"><p class="p-clear" style="font-size: 10px; text-indent: 12px; text-align: justify;">${review.ulasan}</p></div>
                    </div>`;
                            reviewsContainer.innerHTML += reviewHTML;
                        });
                    } else {
                        reviewsContainer.innerHTML = `<div class="w-100 h-100 d-flex justify-content-center align-items-center"><p class="p-clear" style="font-size: 12px;">Belum ada Ulasan</p></div>`;
                    }
                }
            })
    }

    function getProduk(id) {
        // Fetch product data for the specific PKL ID
        fetch(`/getProduk/${id}`)
            .then(response => response.json()).then(data => {
                const productsContainer = document.querySelector('.containerPopup .area.products.produks');
                if (productsContainer) {
                    productsContainer.innerHTML = '';
                    if (data.length > 0) {
                        data.forEach(product => {
                            const productHTML = `
                    <div class="produk align-items-center position-relative d-flex flex-row justify-content-end align-items-end" style="height:110px; min-height: 110px;">
                        <img class="circle-preview position-absolute z-1 shadow" src="${product.image}" alt="${product.nama}" style="height: 75%; width: fit-content; left: 0; top: 50%; transform: translateY(-50%); object-fit: cover; border-radius: 8px;">
                        <div class="position-absolute z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:87%; height:95%; max-height: 95%; min-height: 95%;">
                            <div class="contisi d-flex flex-column first-cl justify-content-end align-items-end w-50">
                                <p class="fw-bolder" style="font-size: 10px; text-align: right; width:100%;">${product.nama}</p>
                                <hr class="w-100 m-0" style="border-top: 1px solid rgba(255,255,255,0.3);">
                                <div class="d-flex flex-row w-75 justify-content-between align-items-center" style="font-size: 10px;">
                                    <p class="p-clear">stok: ${product.sisaStok}</p>
                                    <p class="p-clear">|</p>
                                    <p class="p-clear">terjual: 0</p>
                                </div>
                            </div>
                            <div class="textDexscription scroll-bg-dark pe-1 text-justify first-cl" style="width: 80%; padding-left: 5px; flex:1; overflow: auto; font-size: 9px;">
                                <p class="text-justify p-clear" style="text-indent: 12px;">${product.deskripsi}</p>
                            </div>
                        </div>
                    </div>`;
                            productsContainer.innerHTML += productHTML;
                        });
                    } else {
                        productsContainer.innerHTML = `<div class="w-100 h-100 d-flex justify-content-center align-items-center"><p class="p-clear" style="font-size: 12px;">Belum ada Produk yang terdaftar</p></div>`;
                    }
                }
            })
    }


    fetch('/getCoordinates')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(databaseData => { // Mengganti nama variabel 'data' agar lebih jelas
            if (!Array.isArray(databaseData)) {
                console.error('Data dari server bukan array:', databaseData);
                return;
            }
            databaseData.forEach(dbVendor => {
                // Membuat objek 'vendor' yang sesuai dengan yang diharapkan populatePopup


                const vendorForPopup = {
                    id: dbVendor.id,
                    name: dbVendor.namaPKL,
                    lat: parseFloat(dbVendor.latitude),
                    lng: parseFloat(dbVendor.longitude),
                    imageUrl: dbVendor.picture_url, // <-- Gunakan ini!
                    rating: dbVendor.rating, // Jika Anda menambahkannya di PHP
                    description: dbVendor.description // Jika Anda menambahkannya di PHP
                };

                // Periksa apakah imageUrl valid (untuk debugging)
                // console.log("Vendor:", vendorForPopup.name, "Image URL:", vendorForPopup.imageUrl);

                const customSquareIcon = L.divIcon({
                    className: 'custom-square-marker-icon',
                    html: `<img src="${vendorForPopup.imageUrl}" alt="${vendorForPopup.name}'s Icon" class="pointImg">`,
                    iconSize: [60, 60],
                    iconAnchor: [30, 30],
                    popupAnchor: [0, -30]
                });

                



                const marker = L.marker([vendorForPopup.lat, vendorForPopup.lng], {
                        icon: customSquareIcon
                    })
                    .addTo(map);

                if (marker.getElement()) {
                    marker.getElement().id = 'marker' + vendorForPopup.id;
                    // Baris di bawah ini untuk debugging di console browser, bisa kamu uncomment jika perlu
                    // console.log('Marker DOM element ID set to:', marker.getElement().id); 
                } else {
                    // Ini akan muncul jika ada masalah saat Leaflet membuat elemen DOM untuk marker
                    console.warn("Tidak bisa mendapatkan elemen untuk marker ID:", vendorForPopup.id, "Nama:", vendorForPopup.name);
                }


                marker.on('click', function() {
                    console.log("Marker diklik untuk:", vendorForPopup.name);
                    populatePopup(vendorForPopup);
                    showPopup();
                    console.log("Popup seharusnya tampil untuk:", vendorForPopup.name);
                });
            });
        })
        .catch(error => {
            console.error('Error fetching or processing coordinates:', error);
        });
</script>
@endsection