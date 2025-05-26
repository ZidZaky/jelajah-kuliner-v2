@extends('layouts.layout2')

@section('title')
Tracking Map - Jelajah Kuliner
@endsection

@section('css')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="/css/style.css">
<style>
    /* Add this to your CSS file or within a <style> tag */
    .leaflet-marker-icon img {
        border-radius: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensures the image covers the entire circle */
    }
</style>
@endsection

@section('isiAlert')
@if((session('alert'))!=null)

@php echo session('alert'); @endphp
@endif
@endsection

@section('main')

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert" style="z-index: 100">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="z-index: 100">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div id="map"></div>

<div class="toSearch" id="tosearch1" style="display:none;">
    <button onclick="hide('input')">
        <svg alt="Search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
            style="transform: scale(1);">
            <path fill="#FFFFFF"
                d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z">
            </path>
        </svg>

    </button>
</div>
@if(session('account')!=null)
@if (session('account')['status'] == 'PKL' || session('account')['status'] == 'Pelanggan')
<div>
    <form id="myForm" method="POST" action="/update-location" enctype="multipart/form-data">
        @csrf
        <input type="text" name="latitude" id="latitude" placeholder="Latitude" hidden>
        <input type="text" name="longitude" id="longitude" placeholder="Longitude" hidden>

        <input type="text" class="form-control" id="idAccount" name="idAccount" placeholder="ID Akun"
            value="{{ session('account')['id'] }}" readonly hidden>
        <div class="updateLocation" id="updateLocation" style="">
            <button type="button" onclick="getCurrentLocation()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                </svg>
            </button>
        </div>
    </form>
</div>
@endif
@endif
<div class="forsearch" id="forsearch1">
    <div>
        <svg alt="Search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
            style="transform: scale(1);">
            <path fill="#9c242c"
                d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z">
            </path>
        </svg>
        <input type="text" id="inpSearch" oninput="cari5()" placeholder="Search">
        <button>Cari</button>
    </div>
    <button onclick="hide('cari')">X</button>

</div>
<a class="aboutus" href="/aboutus"><strong>About Us?</strong></a>
{{-- <a class="" href="/userguide"><strong>User Guide</strong></a> --}}
@if(session('account')!=null)
<div class="listPesanan" style="display:none;">
    <div class="NavbarAtasPesanan">
        <p>Pesanan</p>
        <button id="butClosePesanan" onclick="closePesanan()">X</button>
    </div>


    <div class="ContentPesanan">
        <div class="tablePesanan">
            <div class="miniNavbar" style="padding-bottom:0; margin-bottom:0;">
                <?php
                $pkl = \App\Models\PKL::where('idAccount', session('account')['id'])->first();
                // $loopingPesanan = $pesanan;
                $jmlh = 0;
                $jmlh_pb = 0;
                $jmlh_pd = 0;
                $jmlh_ps = 0;
                $jmlh_ptolak = 0;
                // dump($pesanan);
                // Iterate through the collection of orders
                foreach ($pesanan as $pesan) {
                    // Increment $jmlh if the order is associated with the current account or PKL
                    if ($pesan->idAccount == session('account')['id'] || ($pkl && $pkl->id == $pesan->idPKL)) {
                        $jmlh++;
                    }

                    // Increment counters based on order status and account association
                    if ($pesan->idAccount == session('account')['id']) {
                        if ($pesan->status == 'Pesanan Baru') {
                            $jmlh_pb++;
                        } elseif ($pesan->status == 'Pesanan Diproses') {
                            $jmlh_pd++;
                        } elseif ($pesan->status == 'Pesanan Selesai') {
                            $jmlh_ps++;
                        } elseif ($pesan->status == 'Pesanan Ditolak' || $pesan->status == 'Pesanan Dibatalkan') {
                            $jmlh_ptolak++;
                        }
                    } elseif ($pkl && $pkl->id == $pesan->idPKL) {
                        if ($pesan->status == 'Pesanan Baru') {
                            $jmlh_pb++;
                        } elseif ($pesan->status == 'Pesanan Diproses') {
                            $jmlh_pd++;
                        } elseif ($pesan->status == 'Pesanan Selesai') {
                            $jmlh_ps++;
                        } elseif ($pesan->status == 'Pesanan Ditolak' || $pesan->status == 'Pesanan Dibatalkan') {
                            $jmlh_ptolak++;
                        }
                    }
                }
                // foreach ($pesanan as $pesan) {

                // }

                //
                ?>
                <button type="" id="butAllPes" onclick="changePesanan('AllPesanan')">Semua Pesanan
                    ({{ $jmlh }})</button>
                <button type="" id="butNewPes" onclick="changePesanan('newPesanan')">Pesanan Baru
                    ({{ $jmlh_pb }})</button>
                <button type="" id="butAccPes" onclick="changePesanan('terimaPesanan')">Pesanan
                    Diproses({{ $jmlh_pd }})</button>
                <button type="" id="butDonePes" onclick="changePesanan('donePesanan')">Pesanan
                    Selesai({{ $jmlh_ps }})</button>
                <button type="" id="butTolPes" onclick="changePesanan('tolakPesanan')">Pesanan
                    Ditolak({{ $jmlh_ptolak }})</button>
            </div>
            <!-- <hr style="padding : 0 0; margin: 0 0; color: white;"> -->
            <div class="table" id="tuebel">
                <div class="allPesanan">
                    <div class="subTable">
                        <p class="tpemesan">TANGGAL</p>
                        <p class="tproduk">PEMESAN</p>
                        <p class="tstok">TOTAL</p>
                        <p class="ttotal">STATUS</p>
                        <p class="tstatus">DETIL</p>
                    </div>

                    <div class="TableSide" id="SemuaPesanan" style="display: none;">

                        @if ($jmlh != 0)

                        @foreach ($pesanan as $pesan)
                        @if ($pesan->idAccount == session('account')['id'] || @$pkl->id == $pesan->idPKL)
                        @php
                        $account = \App\Models\Account::where('id', $pesan->idAccount)->first();
                        @endphp
                        <div class="deTable">
                            <div class="isiDeTable">
                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                <p class="tproduk">{{ $account->nama }}</p>
                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                <div class="ttotal">
                                    <p class="dstatus">{{ $pesan->status }}</p>
                                </div>
                                <!-- <p class="ttotal">MENUNGGU DITERIMA</p> -->
                                <div class="tstatus">
                                    <button><a href="/pesanDetail/{{ $pesan->id }}"
                                            style="text-decoration:none; color:white">DETIL</a></button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <h2>Data Kosong</h2>
                        @endif
                    </div>
                    <div class="TableSide" id="NewPesanan" style="display: none;">

                        @if ($jmlh_pb != 0)
                        @foreach ($pesanan as $pesan)
                        @if ($pesan->idAccount == session('account')['id'] || @$pkl->id == $pesan->idPKL)
                        @if ($pesan->status == 'Pesanan Baru')
                        @php
                        $account = \App\Models\Account::where('id', $pesan->idAccount)->first();
                        @endphp
                        <div class="deTable">
                            <div class="isiDeTable">
                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                <p class="tproduk">{{ $account->nama }}</p>
                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                <div class="ttotal">
                                    <p class="dstatus">{{ $pesan->status }}</p>
                                </div>
                                <!-- <p class="ttotal">MENUNGGU DITERIMA</p> -->
                                <div class="tstatus">
                                    <button><a href="/pesanDetail/{{ $pesan->id }}"
                                            style="text-decoration:none; color:white">DETIL</a></button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endforeach
                        @else
                        <h2>Data Kosong</h2>
                        @endif


                    </div>
                    <div class="TableSide" id="DiterimaPesanan" style="display:none;">
                        @if ($jmlh_pd != 0)
                        @foreach ($pesanan as $pesan)
                        @if ($pesan->idAccount == session('account')['id'] || @$pkl->id == $pesan->idPKL)
                        @if ($pesan->status == 'Pesanan Diproses')
                        @php
                        $account = \App\Models\Account::where('id', $pesan->idAccount)->first();
                        @endphp
                        <div class="deTable">
                            <div class="isiDeTable">
                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                <p class="tproduk">{{ $account->nama }}</p>
                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                <div class="ttotal">
                                    <p class="dstatus">{{ $pesan->status }}</p>
                                </div>
                                <!-- <p class="ttotal">MENUNGGU DITERIMA</p> -->
                                <div class="tstatus">
                                    <button><a href="/pesanDetail/{{ $pesan->id }}"
                                            style="text-decoration:none; color:white">DETIL</a></button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endforeach
                        @else
                        <h2>Data Kosong</h2>
                        @endif

                    </div>
                    <div class="TableSide" id="DonePesanan" style="display:none;">
                        @if ($jmlh_ps != 0)
                        @foreach ($pesanan as $pesan)
                        @if ($pesan->idAccount == session('account')['id'] || @$pkl->id == $pesan->idPKL)
                        @if ($pesan->status == 'Pesanan Selesai')
                        @php
                        $account = \App\Models\Account::where('id', $pesan->idAccount)->first();
                        @endphp
                        <div class="deTable">
                            <div class="isiDeTable">
                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                <p class="tproduk">{{ $account->nama }}</p>
                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                <div class="ttotal">
                                    <p class="dstatus">{{ $pesan->status }}</p>
                                </div>
                                <!-- <p class="ttotal">MENUNGGU DITERIMA</p> -->
                                <div class="tstatus">
                                    <button><a href="/pesanDetail/{{ $pesan->id }}"
                                            style="text-decoration:none; color:white">DETIL</a></button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endforeach
                        @else
                        <h2>Data Kosong</h2>
                        @endif

                    </div>
                    <div class="TableSide" id="tolakPesanan" style="display:none;">
                        @if ($jmlh_ptolak != 0)
                        @foreach ($pesanan as $pesan)
                        @if ($pesan->idAccount == session('account')['id'] || @$pkl->id == $pesan->idPKL)
                        @if ($pesan->status == 'Pesanan Ditolak' || $pesan->status == 'Pesanan Dibatalkan')
                        @php
                        $account = \App\Models\Account::where('id', $pesan->idAccount)->first();
                        @endphp
                        <div class="deTable">
                            <div class="isiDeTable">
                                <p class="tpemesan">{{ $pesan->created_at->format('d-m-Y') }}</p>
                                <p class="tproduk">{{ $account->nama }}</p>
                                <p class="tstok">Rp. {{ $pesan->TotalBayar }},-</p>
                                <div class="ttotal">
                                    <p class="dstatus">{{ $pesan->status }}</p>
                                </div>
                                <div class="tstatus">
                                    <button><a href="/pesanDetail/{{ $pesan->id }}"
                                            style="text-decoration:none; color:white">DETIL</a></button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endforeach
                        @else
                        <h2>Data Kosong</h2>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div id="accountDetails">
    <button onclick="closeAccountDetails()" class="btn btn-danger">X</button>
    {{-- <button class="btn btn-danger">X</button> --}}
    <p id="namaPKL"></p><br>
    <img src="https://i.pinimg.com/736x/da/5e/ba/da5eba94367e1a2aaa683f1acc105f97.jpg" alt="PKL Photo Goes Here">

    <div id="tsur">
        <button id="butUlasan" onclick="changeContent('Ulasan')" type="button" class="btn btn-success"
            style="opacity:100%">Ulasan</button>
        <button id="butMenu" onclick="changeContent('Menu')" type="button" class="btn btn-success">Menu</button>
        <button id="butPesan" onclick="changeContent('Pesan')" type="button" class="btn btn-success">Pesan</button>
    </div>

    <div id="createUlasan" style="margin: 0">

    </div>
    <div id="contentWrapper">
        @if(session('account')!=null)
        @if(session('account')['status'] != 'PKL')
        <button id="reviewButton">
            <img src="https://www.gstatic.com/images/icons/material/system_gm/2x/rate_review_gm_blue_18dp.png"
                alt="Gambar">
            <p>Berikan Reviewmu</p>
        </button>
        @endif
        @endif
        <div id="contentUlasan">

        </div>

        <div id="contentMenu" style="display: none;">
            <div class="cardMenu">
                <div class="leffft">
                    <img src="https://i.pinimg.com/564x/b8/cf/ab/b8cfabff7a8e6a304d82a0a33c2c5e8e.jpg" alt="">
                    <p></p>
                </div>

                <div class="RightSide">
                    <p id="nmProduct"></p>
                    <p id="deskrip"></p>
                    <hr>
                    <div class="forStok">
                        <p id="stock">Stok: </p>
                        <p id="numstok"></p>
                    </div>
                </div>
            </div>
        </div>

        <div id="contentPesan">
        </div>
    </div>
</div>
<!-- <script>
        src = "js/pesanan.js"
    </script> -->
<script src="/js/pesanan.js"></script>


<script src="https://cdn.jsdelivr.net/npm/leaflet/dist/leaflet.js"></script>
<script>
    function cari5() {
        let pin = document.querySelectorAll(`.leaflet-marker-icon`);
        pin.forEach(o => {
            o.style.display = 'none';
        })
        // console.log(pin.length);
        let hasil = [];
        fetch(`/getData`)
            .then(response => response.json())
            .then(data => {
                data.forEach(e => {
                    // console.log(e);
                    let inp = document.getElementById('inpSearch');
                    let ary = [];
                    ary.push(e.nama)
                    ary.push(e.menu)

                    ary.forEach(i => {
                        // console.log(i+"tipe : "+typeof(i)+" lower : "+i.toLowerCase());
                        if (i.toLowerCase().includes(inp.value.toLowerCase())) {
                            // console.log(hasil.includes(e.id))
                            if (hasil.includes(e.id) == false) {
                                hasil.push(e.id);
                            }
                            console.log('hasil dalam : ' + hasil);
                        }
                    })

                })
                console.log('hasil luar : ' + hasil);
                hasil.forEach(c => {
                    // console.log(('marker'+c));
                    let depin = document.getElementById(('marker' + c));
                    depin.style.display = '';
                })
            })
            .catch(error => {
                console.error('Error fetching coordinates:', error);
            });

    }

    function search1() {
        let but = document.querySelectorAll(`#content1>button`)
        but.forEach(function(a) {
            let isi = document.getElementById('cari1');
            a.style.display = 'none';
            if (a.textContent.toLowerCase().includes(isi.value.toLowerCase())) {
                a.style.display = "";
            }
            // console.log(a.textContent);
        })
    }

    function hide($apa) {
        let cari = document.getElementById('tosearch1')
        let inp = document.getElementById('forsearch1')
        console.log('work')
        if ($apa == 'input') {
            cari.style.display = "none"
            inp.style.display = "flex";

        } else {


            inp.style.display = "none";
            cari.style.display = "flex";

        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var alert = document.querySelector('.alert');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000); // 5 seconds
    });
    // opacityList('Ulasan');
    function deBintang(rtg) {
        let back = "kosong";
        for (let i = 1; i <= rtg; i++) {
            if (back === 'kosong') {
                back = '⭐️';
            } else {
                let temp = '⭐️' + back;
                back = temp;
            }
        }
        // console.log(back);
        return back;
    }

    // document.getElementById('accountDetails').style.display = 'block';
    let ulas = document.getElementById('contentUlasan');
    let menu = document.getElementById('contentMenu');
    let pesan = document.getElementById('contentPesan');
    let bunkus = document.getElementById('contentWrapper');

    if (ulas.style.display == 'none' && menu.style.display == 'none' && pesan.style.display == 'none') {
        bunkus.style.height = '350px';
    }
    var map = L.map("map").setView([-7.2575, 112.7521], 12); // Set view to Surabaya, Indonesia

    var osm = L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    });
    osm.addTo(map);

    fetch('/getCoordinates')
        .then(response => response.json())
        .then(data => {
            data.forEach(coordinates => {
                // Create a custom icon using DivIcon
                const customIcon = L.divIcon({
                    className: 'custom-icon', // Custom class name for styling
                    html: `<img src="/storage/${coordinates.picture}" alt="PKL Photo" class="pointImg" />`,
                    iconSize: [38, 38], // Set the size of the icon
                    iconAnchor: [19, 38], // Set the anchor point of the icon
                    popupAnchor: [0, -38] // Set the popup anchor point
                });

                // Create a marker with the custom icon
                const marker = L.marker([coordinates.latitude, coordinates.longitude], {
                    icon: customIcon
                }).addTo(map);
                marker._icon.id = `marker${coordinates.id}`;

                // Pass the id to the displayAccountDetails function when marker is clicked
                marker.on('click', function() {
                    displayAccountDetails(coordinates.id, coordinates.namaPKL);
                    fillFoto(coordinates.id);
                    fillContentUlasan(coordinates.id);
                    fillContentMenu(coordinates.id);
                    fillContentPesan(coordinates.id);


                    // Get the button element
                    const button = document.getElementById('reviewButton');

                    // Add click event listener to the button
                    button.addEventListener('click', function() {
                        // Redirect to the specified URL when the button is clicked
                        window.location.href = `/ulasan/create/${coordinates.id}`;
                    });
                });
            });
        })
        .catch(error => {
            console.error('Error fetching coordinates:', error);
        });


    // Function to display account details in the accountDetails div
    function displayAccountDetails(id, namaPKL) {
        document.getElementById('namaPKL').innerText = namaPKL;
        document.getElementById('accountDetails').style.display = 'block';
    }

    // Event listener for marker click event


    function closeAccountDetails() {
        document.getElementById('accountDetails').style.display = 'none'; // Hide the accountDetails div
        // Reset account details
        // document.getElementById('accountName').innerText = '';
        document.getElementById('accountEmail').innerText = '';
        document.getElementById('accountNohp').innerText = '';
        document.getElementById('accountStatus').innerText = '';
    }

    // Function to change content based on button click
    function changeContent(buttonName, idacc) {
        // Hide all content divs

        document.getElementById('contentUlasan').style.display = 'none';
        document.getElementById('contentMenu').style.display = 'none';
        document.getElementById('contentPesan').style.display = 'none';
        // document.getElementById('reviewButton').style.display = 'none';

        // // Show the corresponding content div
        // if (buttonName == 'Ulasan') {
        //     document.getElementById('reviewButton').style.display = 'block';
        // }
        document.getElementById('content' + buttonName).style.display = 'block';
        opacityList(buttonName);
    }
    // opacityList('Ulasan');
    // opacityList("Ulasan");
    function opacityList(jenis) {
        let menu = document.getElementById('butMenu');
        let ulas = document.getElementById('butUlasan');
        let pesan = document.getElementById('butPesan');
        menu.style.opacity = "50%";
        ulas.style.opacity = "50%";
        pesan.style.opacity = "50%";
        if (jenis == 'Ulasan') {
            ulas.style.opacity = "100%";
        }
        if (jenis == 'Menu') {
            menu.style.opacity = "100%"
        }
        if (jenis == 'Pesan') {
            pesan.style.opacity = "100%";
        }
    }

    function fillFoto(id) {
        fetch(`/getPictureByID/${id}`)
            .then(response => response.json())
            .then(data => {
                const imgElement = document.querySelector('img[alt="PKL Photo Goes Here"]');
                if (imgElement && data.picture) {
                    imgElement.src = "/storage/" + data.picture; // Correct concatenation
                } else {
                    console.error('Image element not found or picture URL is missing');
                }
            })
            .catch(error => {
                console.error('Error fetching picture:', error);
            });
    }

    function fillContentUlasan(id) {
        // Fetch ulasan data for the specific PKL ID
        fetch(`/getUlasan/${id}`)
            .then(response => response.json())
            .then(data => {
                const ulasanContainer = document.getElementById('contentUlasan');
                ulasanContainer.innerHTML = ''; // Clear previous ulasan
                // console.log(data.length);
                if (data.length === 0) {
                    console.log('tes');
                    const emptyDataMessage = document.createElement('h1');
                    emptyDataMessage.innerText = 'Data Ulasan Kosong';
                    console.log('apani :' + emptyDataMessage.innerText);

                    ulasanContainer.appendChild(emptyDataMessage);
                } else {
                    data.forEach(ulasan => {
                        const ulasanDiv = document.createElement('div');
                        ulasanDiv.classList.add('cardUlasan');

                        const divWrapper = document.createElement('div');
                        divWrapper.classList.add('ulasan-content');

                        const img = document.createElement('img');
                        img.src = 'https://i.pinimg.com/564x/02/b8/50/02b850fcc321beaa87d8459daa6509de.jpg';
                        img.classList.add('ulasan-image');
                        divWrapper.appendChild(img);

                        const detailDiv = document.createElement('div');
                        detailDiv.classList.add('ulasan-details');

                        const namaAkun = document.createElement('p');
                        console.log(ulasan);
                        namaAkun.innerText = ulasan.idAccount;
                        namaAkun.classList.add('nmAkun');
                        detailDiv.appendChild(namaAkun);

                        const tanggal = document.createElement('p');
                        tanggal.innerText = 'tanggal';
                        tanggal.classList.add('nmAkun');
                        detailDiv.appendChild(tanggal);

                        divWrapper.appendChild(detailDiv);

                        divWrapper.appendChild(detailDiv);

                        ulasanDiv.appendChild(divWrapper);

                        const hr = document.createElement('hr');
                        ulasanDiv.appendChild(hr);

                        const ulasanParagraph = document.createElement('p');
                        ulasanParagraph.innerText = ulasan.ulasan;
                        ulasanParagraph.classList.add('ulasan');
                        ulasanDiv.appendChild(ulasanParagraph);


                        const rating = document.createElement('p');
                        rating.innerText = deBintang(ulasan.rating);
                        // deBintang(5);
                        // ulasan.rating +
                        rating.classList.add('rating');
                        divWrapper.appendChild(rating);

                        ulasanContainer.appendChild(ulasanDiv);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching ulasan:', error);
            });
    }

    function fillContentMenu(id) {
        // Fetch product data for the specific PKL ID
        fetch(`/getProduk/${id}`)
            .then(response => response.json())
            .then(data => {
                const menuContainer = document.getElementById('contentMenu');
                menuContainer.innerHTML = ''; // Clear previous menu

                if (data.length === 0) {
                    const emptyDataMessage = document.createElement('h1');
                    emptyDataMessage.innerText = 'Data Menu Kosong';
                    menuContainer.appendChild(emptyDataMessage);
                } else {
                    data.forEach(product => {
                        // console.log(product)
                        const cardMenuDiv = document.createElement('div');
                        cardMenuDiv.classList.add('cardMenu');

                        const leftDiv = document.createElement('div');
                        leftDiv.classList.add('leffft');

                        const img = document.createElement('img');
                        img.src = `/storage/${product.foto}`;
                        img.alt = product.fotoProduk;
                        leftDiv.appendChild(img);

                        const hargaP = document.createElement('p');
                        hargaP.innerText = `Rp.${product.harga},-`;
                        leftDiv.appendChild(hargaP);

                        cardMenuDiv.appendChild(leftDiv);

                        const rightDiv = document.createElement('div');
                        rightDiv.classList.add('RightSide');

                        const namaProdukP = document.createElement('p');
                        namaProdukP.id = 'nmProduct';
                        namaProdukP.innerText = product.nama;
                        rightDiv.appendChild(namaProdukP);

                        const deskripP = document.createElement('p');
                        deskripP.id = 'deskrip';
                        deskripP.innerText = product.deskripsi;
                        rightDiv.appendChild(deskripP);

                        const hr = document.createElement('hr');
                        rightDiv.appendChild(hr);

                        const forStokDiv = document.createElement('div');
                        forStokDiv.classList.add('forStok');

                        const stockP = document.createElement('p');
                        stockP.id = 'stock';
                        stockP.innerText = 'Stok : ';

                        forStokDiv.appendChild(stockP);

                        const numStokP = document.createElement('p');
                        numStokP.id = 'numstok';
                        if (product.sisaStok < 1) {
                            numStokP.innerText = " Habis";
                        } else {
                            numStokP.innerText = product.sisaStok;
                        }
                        // console.log(typeof product.sisaStok);
                        // console.log(product.sisaStok<1);
                        // if(product.sisaStok<1){
                        //     cardMenuDiv.style.display = "none";
                        // }
                        forStokDiv.appendChild(numStokP);

                        rightDiv.appendChild(forStokDiv);

                        cardMenuDiv.appendChild(rightDiv);

                        menuContainer.appendChild(cardMenuDiv);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching product data:', error);
            });
    }

    function fillContentPesan(id) {

        console.log("id 11 : " + id)
        // clear

        // Get the contentPesan div
        var contentPesanDiv = document.getElementById("contentPesan");

        while (contentPesanDiv.firstChild) {
            contentPesanDiv.removeChild(contentPesanDiv.firstChild);
        }
        @if(session('account') != null)
        contentPesanDiv.innerHTML = '';

        const button = document.createElement("button");

        button.textContent = "Pesan Sekarang!";

        button.addEventListener("click", function() {
            window.location.href = "pesanan/create/" + id;
        });

        contentPesanDiv.appendChild(button);
        @if(isset($pkl))
        let pkl = @json($pkl);
        if (pkl.id == id) {
            console.log('masuk')
            contentPesanDiv.style.display
            while (contentPesanDiv.firstChild) {
                contentPesanDiv.removeChild(contentPesanDiv.firstChild);
            }

        }

        @endif
        @else
        let h4Element = document.createElement("h4");
        h4Element.setAttribute("id", "h4Login");
        h4Element.textContent = "Login Terlebih Dahulu!";

        // Membuat elemen button
        let buttonElement = document.createElement("button");
        buttonElement.setAttribute("type", "button");
        buttonElement.setAttribute("class", "btn");
        buttonElement.setAttribute("id", "butLoginn");
        buttonElement.textContent = "Login";
        buttonElement.style.backgroundColor = "rgb(0,200,0";
        buttonElement.onclick = function() {
            window.location.href = "/login"
        };
        // buttonElement.href="/login";
        // buttonElement.onclick=toLogin;
        //add
        contentPesanDiv.appendChild(h4Element);
        contentPesanDiv.appendChild(buttonElement);
        @endif
        // Clear any existing content in the contentPesan div

    }

    // Function to capture current location
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }

    function showPosition(position) {
        document.getElementById("latitude").value = position.coords.latitude;
        document.getElementById("longitude").value = position.coords.longitude;

        // Submit the form
        document.getElementById("myForm").submit();
    }
</script>
<script>
    function closePesanan() {
        let btn = document.getElementById('butClosePesanan');
        let pesanan = document.getElementsByClassName('listPesanan')[0];
        pesanan.style.display = "none";
    }

    function OpenPesanan(event) {
        // event.preventDefault();
        let btn = document.getElementById('butClosePesanan');
        let pesanan = document.getElementsByClassName('listPesanan')[0];
        pesanan.style.display = "flex";
    }
    // butClosePesanan
    // --------------KONSIDIAN WIDTH TABLE >10-------------------------
    function ScanDeTable($TipePesanan) {
        let tipe = document.getElementById($TipePesanan);
        let deTableElements = tipe.querySelectorAll(".deTable");
        let tuebel = document.getElementById("tuebel");
        // console.log(deTableElements.length);
        console.log("tuebel : " + tuebel.style.height);
        if (deTableElements.length <= 10) {
            tuebel.style.height = "94%";

        } else {
            tuebel.style.height = "88.01%";

        }
    }
    // ScanDeTable('DiterimaPesanan');
    // --------------------WARNA STATUS-----------------------------
    let dstatuss = document.getElementsByClassName("dstatus");
    // console.log("apaini"+dstatus.textContent);
    Array.from(dstatuss).forEach(function(dstatus) {
        if (dstatus.textContent == "Pesanan Baru") {
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor = "rgba(0, 255, 255, 0.558)";
        }
        if (dstatus.textContent == "Pesanan Diproses") {
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor = "rgba(229, 255, 0)";
        }
        if (dstatus.textContent == "Pesanan Ditolak") {
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor = "rgb(255,0,0)";
            dstatus.style.color = "white";
        }
        if (dstatus.textContent == "Pesanan Selesai") {
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor = "rgb(0, 255, 38)";
        }
        if (dstatus.textContent == "Pesanan Dibatalkan") {
            // console.log("apaini"+dstatus.textContent);
            dstatus.style.backgroundColor = "rgb(230,0,0)";
            dstatus.style.color = "white";

        }
    })

    let allPes = document.getElementById('butAllPes');
    let tallPes = document.getElementById('SemuaPesanan');
    allPes.style.opacity = "100%";
    tallPes.style.display = "";

    function changePesanan(jenisPesanan) {
        let allPes = document.getElementById('butAllPes');
        let newPes = document.getElementById('butNewPes');
        let accPes = document.getElementById('butAccPes');
        let donePes = document.getElementById('butDonePes');
        let tolPes = document.getElementById('butTolPes');
        let tallPes = document.getElementById('SemuaPesanan');
        let tnewPes = document.getElementById('NewPesanan');
        let taccPes = document.getElementById('DiterimaPesanan');
        let tdonePes = document.getElementById('DonePesanan');
        let ttolakPes = document.getElementById('tolakPesanan');

        allPes.style.opacity = "40%";
        newPes.style.opacity = "40%";
        accPes.style.opacity = "40%";
        donePes.style.opacity = "40%";
        tolPes.style.opacity = "40%";
        tallPes.style.display = "none";
        tnewPes.style.display = "none";
        taccPes.style.display = "none";
        tdonePes.style.display = "none";
        ttolakPes.style.display = "none";
        if (jenisPesanan == 'AllPesanan') {
            allPes.style.opacity = "100%";
            tallPes.style.display = "";
            ScanDeTable('SemuaPesanan');
        }
        if (jenisPesanan == 'newPesanan') {
            tnewPes.style.display = "";
            newPes.style.opacity = "100%";
            ScanDeTable('NewPesanan');
        }
        if (jenisPesanan == 'terimaPesanan') {
            taccPes.style.display = "";
            accPes.style.opacity = "100%";
            ScanDeTable('DiterimaPesanan');
        }
        if (jenisPesanan == 'donePesanan') {
            tdonePes.style.display = "";
            donePes.style.opacity = "100%";
            ScanDeTable('DonePesanan');
        }
        if (jenisPesanan == 'tolakPesanan') {
            ttolakPes.style.display = "";
            tolPes.style.opacity = "100%";
            ScanDeTable('tolakPesanan');
        }
    }
</script>
<style>
    #butLoginn {
        border-radius: 3px;
        background-color: aqua;
        width: 200px;
        margin: 0 auto;
        /* border-radius: 10px; */
        border: none;
    }

    #h4Login {
        text-align: center;
        padding-top: 10px;
        padding-left: 5px;
    }

    /* ----------- STYLE TITIK IMG ----------------- */
    /* ----------- STYLE TITIK IMG ----------------- */

    .updateLocation {
        position: absolute;
        display: flex;
        flex-direction: row;
        gap: 10px;
        width: 100px;
        height: 50px;
        /* border: 1px black solid; */
        /* background-color: ; */
        z-index: 100;
        bottom: 2%;
        right: 2%;
        /* left: 50%; */
        /* transform: translateX(-50%); */
        margin: 0 0;
        padding: 0;
        /* border: 1px solid #ccc; */
        background-color: rgb(0 0 0 0);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toSearch {
        position: absolute;
        display: flex;
        flex-direction: row;
        gap: 10px;
        width: 100px;
        height: 50px;
        /* border: 1px black solid; */
        /* background-color: ; */
        z-index: 100;
        top: 2%;
        right: 2%;
        /* left: 50%; */
        /* transform: translateX(-50%); */
        margin: 0 0;
        padding: 0;
        /* border: 1px solid #ccc; */
        background-color: rgb(0 0 0 0);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toSearch>button>svg {
        padding: 2px 2px;
        color: white;
    }

    .toSearch>button {
        padding: 4px 10px;
        border-radius: 3px;
        font-size: 20px;
        background-color: #9c242c;
        box-shadow: 1px 1px #471e21;
        border: none;
    }

    .forsearch {
        position: absolute;
        display: flex;
        flex-direction: row;
        gap: 10px;
        width: 400px;
        height: 50px;
        border: 1px black solid;
        /* background-color: ; */
        z-index: 100;
        top: 2%;
        left: 50%;
        transform: translateX(-50%);
        margin: 0 0;
        padding: 0;
        border: 1px solid #ccc;
        background-color: #9c242c;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .aboutus {
        position: absolute;
        display: flex;
        flex-direction: row;
        z-index: 100;
        left: 50%;
        bottom: 1%;
        transform: translateX(-50%);
        margin: 0 0;
        padding: 5px;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: black;
    }

    .forsearch>* {
        /* border: blue 1px solid !important; */
    }

    .forsearch>button {
        padding: 4px 10px;
        border-radius: 3px;
        font-size: 20px;
        background-color: rgb(255, 255, 255, 0.2);
        border: none;
    }

    .forsearch>button:hover {
        background-color: #471e21;
        color: white;
    }

    .forsearch>div {
        width: 80%;
        height: 80%;
        background-color: white;
        display: flex;
        flex-direction: row;
        gap: 4px;
        border-radius: 10px;
        padding: 2px;
        padding-left: 10px;
        padding-right: 10px;
        /* padding-right: 0; */
        align-items: center;
        justify-content: center;
        border: white 1px solid !important;

        /* padding-left: /; */

    }

    .forsearch>div>svg {
        width: 10%;
        height: 70%;
        /* padding-right: 10px; */
    }

    .forsearch>div>input {
        width: 65%;
        padding: 2px;
        outline: none;
        border: none;
        background-color: none;
        color: white;
        font-size: 15px;
        color: black;

    }

    .forsearch>div>button {
        width: 25%;
        border: none;
        outline: none;
        background-color: rgb(0 0 0 0.4) !important;
        text-decoration: none;
        border-radius: 10px;

    }

    .forsearch>div>button:hover {
        background-color: #ccc;
    }
</style>
@endsection