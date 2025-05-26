@extends('layouts.layout')

@section('title')
Tracking Map - Jelajah Kuliner
@endsection

@section('css')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="/css/style.css">
@endsection

@section('main')
<div id="map"></div>
<div id="accountDetails">
    <button onclick="closeAccountDetails()" class="btn btn-danger">X</button>
    {{-- <button class="btn btn-danger">X</button> --}}
    <p id="namaPKL"></p><br>
    <img src="https://i.pinimg.com/736x/da/5e/ba/da5eba94367e1a2aaa683f1acc105f97.jpg" alt="PKL Photo Goes Here">

    <div id="tsur" style="">
        <button onclick="changeContent('Ulasan')" type="button" class="btn btn-success">Ulasan</button>
        <button onclick="changeContent('Menu')" type="button" class="btn btn-success">Menu</button>
        <button onclick="changeContent('Pesan')" type="button" class="btn btn-success">Pesan</button>
    </div>

    <div id="createUlasan" style="margin: 0">

    </div>
    <div id="contentWrapper">

        <div id="contentUlasan">

            <div class="cardUlasan">
                <div>
                    <img src="https://i.pinimg.com/564x/02/b8/50/02b850fcc321beaa87d8459daa6509de.jpg" alt="">
                    <div>
                        <p id="nmAkun"></p>
                        <p> - </p>
                    </div>
                    <p id="rating"></p>
                </div>
                <hr>
                <p id="ulasan"></p>
            </div>

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
                        <p id="stock">Stok :</p>
                        <p id="numstok"></p>
                    </div>
                </div>
            </div>

        </div>

        <div id="contentPesan" style="display: none;">
            <h4 style="text-align: center; padding-top: 10px; padding-left: 5px">Login Terlebih Dahulu!</h4>
            <button href="/login" type="button" class="btn" style="border-radius: 10px; background-color: rgb(0, 200, 0); width: 200px; margin: 0 auto;">Login</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/leaflet/dist/leaflet.js"></script>
<script>
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
                // Create a marker for each coordinate on the map
                const marker = L.marker([coordinates.latitude, coordinates.longitude]).addTo(map);

                // Pass the id to the displayAccountDetails function when marker is clicked
                marker.on('click', function() {
                    displayAccountDetails(coordinates.id, coordinates.namaPKL);
                    fillContentUlasan(coordinates.id);
                    fillContentMenu(coordinates.id);

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
    function changeContent(buttonName) {
        // Hide all content divs
        document.getElementById('contentUlasan').style.display = 'none';
        document.getElementById('contentMenu').style.display = 'none';
        document.getElementById('contentPesan').style.display = 'none';


        // Show the corresponding content div
        document.getElementById('content' + buttonName).style.display = 'block';

    }

    function fillContentUlasan(id) {
        // Fetch ulasan data for the specific PKL ID
        fetch(`/getUlasan/${id}`)
            .then(response => response.json())
            .then(data => {
                const ulasanContainer = document.getElementById('contentUlasan');
                ulasanContainer.innerHTML = ''; // Clear previous ulasan

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
                        console.log(ulasan);
                        console.log("iniapa");

                        const namaAkun = document.createElement('p');
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
                    // console.log(data);
                    const emptyDataMessage = document.createElement('h1');
                    emptyDataMessage.innerText = 'Data Menu Kosong';
                    menuContainer.appendChild(emptyDataMessage);

                    ulasanContainer.appendChild(emptyDataMessage);
                } else {

                    data.forEach(product => {
                        console.log(product)
                        // console.log(data)
                        const cardMenuDiv = document.createElement('div');
                        cardMenuDiv.classList.add('cardMenu');

                        const leftDiv = document.createElement('div');
                        leftDiv.classList.add('leffft');

                        const img = document.createElement('img');
                        img.src = "https://i.pinimg.com/564x/b8/cf/ab/b8cfabff7a8e6a304d82a0a33c2c5e8e.jpg";
                        img.alt = product.nama;
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
                        stockP.innerText = 'Stok :';
                        forStokDiv.appendChild(stockP);

                        const numStokP = document.createElement('p');
                        numStokP.id = 'numstok';
                        numStokP.innerText = product.sisaStok;
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
</script>
<style>
    #loginMessage {
        text-align: center;
        padding-top: 10px;
        padding-left: 5px;
    }

    .btn {
        border-radius: 10px;
        background-color: rgb(0, 200, 0);
        width: 200px;
        margin: 0 auto;
        display: block;
        text-align: center;
        padding: 10px 0;
        cursor: pointer;
    }
</style>
@endsection