@extends('layouts.layout2')

@section('title')
    DATA PKL
@endsection

@section('css')
    <link rel="stylesheet" href="/css/dataPKL.css">
@endsection

@section('main')
    <div class="riwayatstok" id="RiwayatArea" style="display:none;">
        <div class="batasrwt">

                <div class="navrwt">
                    <div>
                        <p id="NamaStokBarang">Riwayat Stok</p>
                    </div>
                    <div class="navbut">
                        <button onclick="closeRiwayat()">x</button>
                    </div>
                </div>
                <div class="contentrwt">
                    <div class="table" id="tuebel">
                        <div class="allPesanan">
                            <div class="subTable">
                                <p class="tpemesan">TANGGAL</p>
                                <p class="tproduk">Stok Awal</p>
                                <p class="tstok">Terjual Online</p>
                                <p class="ttotal">Terjual Offline</p>
                                <p class="tstatus">Sisa</p>
                            </div>
                            <div class="TableSide" id="SemuaPesanan" >
                                <!-- @for($i=0;$i<3;$i++) -->
                                    <!-- <div class="deTable">
                                        <div class="isiDeTable">
                                            <p class="tpemesan">12 Mei 2024</p>
                                            <p class="tproduk">5</p>
                                            <p class="tstok">3</p>
                                            <p class="ttotal">1</p>
                                            <p class="tstatus">1</p>
                                        </div>
                                    </div> -->
                                <!-- @endfor      -->
                            </div>


                        </div>
                    </div>
                </div>

        </div>
    </div>

    <div class="content">
        <div class="up" style="display: flex; justify-content: space-between;">
            <div class="back" style="text-align: center; margin-left: 10px; margin-top: -3px;">
                <button class="btn btn-danger" style="margin: 0 auto;" onclick="window.location.href='/dashboard'; return false;">Back</button>
            </div>
            <div class="nmpkl" style="margin-top: 4px;">
                <p style="text-align: center;"><strong>📝 DATA PKL! 📝</strong></p>
            </div>
            <div class="upside" style="margin-right: 10px; margin-top: -4px">
                <p class="namaakun" style="text-align: right;">Hi, {{ session('account')['nama'] }} 👋</p>
            </div>
        </div>

        <hr id="hratas">
        <div class="outer">
            <div class="demain">
                <div class="nmpkl" style="text-align: center; margin-bottom: -25px">
                    <p class="namap">{{ $pkl->namaPKL }}</p>
                    <p class="deskri">{{ $pkl->desc }}</p>
                    <p><strong>Produk Anda</strong></p>
                </div>
                <hr>

                        <div class="batas" >
                            <div class="butButtonFront" style="text-align: center;">

                                <a href="/produk/create" style="width:35%; margin: 0 auto; margin-top: -5px">
                                    <button type="" class="btn btn-success" id="butEdit">
                                        <span>Tambah Produk &#9998</span>
                                    </button>
                                </a>
                            </div>
                        @if($produk->count()>0)
                            @foreach($produk as $p)
                            <div class="card">
                                <div class="inCard" id="theImage">
                                    <img src="/storage/{{$p->fotoProduk}}"
                                        alt="" style="border: black 1px solid; border-radius: 40px; max-width: 130px; max-height: 130px">
                                </div>
                                <div class="inCard" id="mid">
                                    <p class="np">{{$p->nama}}</p>
                                    <p class="Des">{{$p->deskripsi}}</p>
                                    <p class="hrg">Rp. {{$p->harga}}</p>
                                </div>
                                <div class="PopArea" id="PoPUp{{$p->id}}" style="display:none;">
                                    <div>
                                        <div class="subArea">
                                            <p id="desk{{$p->id}}">Masukkan Stok</p>
                                            <p>{{$p->nama}}</p>
                                        </div>

                                        <div class="inpArea" id="inform{{$p->id}}">
                                            <form action="" method="post" id="form{{$p->id}}">
                                                @csrf
                                                <input type="number" name="stokAwal" id="stokAwal{{$p->id}}" placeholder="0" style="display:none;">
                                                <input type="number" name="stokAkhir" id="stokAkhir{{$p->id}}" placeholder="0" style="display:none;">
                                                <input type="number" name="idproduk" id="idProduk{{$p->id}}" value="{{$p->id}}" style="display:none;">
                                                <input type="number" name="idPKL" id="idPKL{{$p->id}}" value="{{$pkl->id}}" style="display:none;">
                                            </form>
                                            <div>
                                                <button onclick="ClosePop(1,'{{$p->id}}')" class="cncl">Batal</button>
                                                <button class="sv" id="butSave1{{$p->id}}" onclick="simpan(event, 1, '{{$p->id}}')">Save</button>
                                                <button class="sv" id="butSave2{{$p->id}}" onclick="simpan(event, 2, '{{$p->id}}')">Save</button>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                                <div class="inCard" id="leftt">
                                    <div class="stokArea">
                                        <p class="stok">Stok</p>
                                        <div class="showStok">
                                            <p class="numberrs">@php if($p->sisaStok>0){echo $p->sisaStok;}else{echo '0';} @endphp</p>
                                        </div>
                                    </div>

                                    <div class="butStok">
                                            <a href="/produk/create" style="width:40%;">
                                                <button class="StokAwal btn-success" onclick="showPop(event,1,'{{($p->id)}}')" id="butSetAwal{{$p->id}}">
                                                    <p>
                                                        Set Stok Awal
                                                    </p>

                                                </button>
                                            </a>
                                            <a href="/produk/create" style="width:40%;">
                                                <button onclick="showPop(event,2,'{{($p->id)}}')" class="StokAkhir btn-success">
                                                    <p>
                                                        Set Stok Akhir
                                                    </p>
                                                </button>
                                            </a>
                                            <a href="" style="width:40%;">
                                                <button onclick="showRiwayat(event,'{{$pkl->id}}p{{$p->id}}','{{$p->nama}}')" class="riwayat btn-success">
                                                    <p>
                                                        Riwayat Stok
                                                    </p>
                                                </button>
                                            </a>

                                    </div>


                                </div>
                            </div>
                            @endforeach
                        @else
                            <p class="namap" style="text-align: center;">Produk kosong</p>
                        @endif
                        </div>


            </div>

            <hr id="hrmiring">
            <div class="side">
                <div class="namapp">
                    <p class="namap">Ulasan PKL</p>
                </div>
                <hr>
                @if (count($ulasan) == 0)
                    <p class="namap" style="text-align: center">Data Ulasan Kosong</p>
                @else
                    <div class="batasRev">
                        <div class="chart">
                            @php
                                $bintang = [0, 0, 0, 0, 0];
                                $total = 0;
                                foreach ($ulasan as $ul) {
                                    $bintang[$ul->rating - 1]++;
                                    $total++;
                                }
                            @endphp
                            @for ($i = 5; $i >= 1; $i--)
                                <div class="rating-chart">
                                    <p class="derating">⭐️ {{ $i }}</p>
                                    <div class="bar" style="--rating: {{ ($bintang[$i - 1] / $total) * 20 }}%;"></div>
                                    <div class="percentage">{{ $bintang[$i - 1] }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <hr>
                    <div class="listRev">
                        @foreach ($ulasan as $ul)
                            <div class="cardRev">
                                <p id="namaRev">{{ $ul->idAccount }}</p>
                                <hr>
                                <p id="bintangRev">{{ Bintang($ul->rating) }}</p>
                                <p id="desRev">{{ $ul->ulasan }}</p>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        function closeRiwayat(){
            let riwayat = document.getElementById("RiwayatArea");
            riwayat.style.display="none";
        }
         async function showRiwayat(event, IDPKLpIDPRODUK,nama){
            event.preventDefault();
            let idmerge = IDPKLpIDPRODUK;
            let namajudul = document.getElementById('NamaStokBarang');
            namajudul.textContent="Riwayat Stok Produk "+nama;
            let respon = await fetch(('/rwt/'+idmerge));
            if(!respon.ok){
                console.log('eror : '+ respon.statusText);
            }
            else{
                let data = await respon.json();
                // console.log(data);
                let riwayat = document.getElementById("RiwayatArea");
                riwayat.style.display="flex";
                let Tableside = document.getElementById("SemuaPesanan");
                // kosongi isi class Tableside apabila ada
                while(Tableside.firstChild){
                    Tableside.removeChild(Tableside.firstChild);
                }

                if(data.length>0){
                    for(let q=0;q<data.length;q++){
                        // console.log(data[q].);
                        var div = document.createElement('div');
                            div.className="deTable";
                        var div2 = document.createElement('div')
                            div2.className="isiDeTable"
                        console.log(data[q])
                        var p1 = document.createElement('p')
                            p1.className = 'tpemesan'
                        var p2 = document.createElement('p')
                            p2.className= 'tproduk'
                        var p3 = document.createElement('p')
                            p3.className = ('tstok')
                        var p4 = document.createElement('p')
                            p4.className = ('ttotal')
                        var p5 = document.createElement('p')
                            p5.className = ('tstatus')

                        // // get only the date
                        let dt = data[q];
                        let tgl = getOnlyTheDate(data[q].created_at);
                        p1.textContent=tgl;
                            div2.appendChild(p1);
                        p2.textContent=dt.stokAwal;
                            div2.appendChild(p2);
                        p3.textContent=dt.TerjualOnline;
                            div2.appendChild(p3)
                        let offl = getTerjualOffline(dt);
                        console.log(offl)
                        p4.textContent=offl;
                            div2.appendChild(p4)
                        let sisa = getSisa(offl,data);
                        console.log(sisa);
                        p5.textContent=getSisa(offl,dt);
                            div2.appendChild(p5)

                        div.appendChild(div2);
                        Tableside.appendChild(div);
                    }
                }

            }

        }
        function getSisa(offline,data){
            let back = 0;
            // console.log('status '+data.statusIsi)
            if(data.statusIsi==0){
                back = data.stokAwal - data.TerjualOnline
                // console.log('if : '+back)
            }
            else{
                back = data.stokAwal - data.TerjualOnline - offline
                // console.log('else : '+back)
            }
            return back
        }
        function getTerjualOffline(data){
            let back
            if(data.statusIsi==0){
                back = 0
            }
            else{
                back = data.stokAwal - data.stokAkhir - data.TerjualOnline
            }
            return back;
        }
        function getOnlyTheDate(dateString){
            let date = dateString
            let back = date.split(' ')[0];
            return back;
        }
        function showPop(event,apa,id){
            event.preventDefault();
            // console.log('PoPUp'+id);

            document.getElementById(('PoPUp'+id)).style.display="flex";
            let form = document.querySelector(('#inform'+id+'>form'));
            let inp1 = document.getElementById(('stokAwal'+id));
            let inp2 = document.getElementById(('stokAkhir'+id));
            let save1 = document.getElementById(('butSave1'+id));
            let save2 = document.getElementById(('butSave2'+id));
            let des = document.getElementById(('desk'+id))


            save1.style.display="none";
            save2.style.display="none";
            inp1.style.display="none"
            inp2.style.display="none"
            if(apa==1){
                form.action = "/MakeStokAwal";
                if(inp1){
                    console.log('masuk')
                }
                inp1.style.display="flex"


                des.textContent = 'Berapa Stok Awal Hari Ini'
                save1.style.display="flex";
            }
            if(apa==2){
                form.action = "/updateStokAkhir";
                inp2.style.display=""

                des.textContent = 'Berapa Stok Akhir Hari Ini'
                save2.style.display="flex";
            }
        }

        function ClosePop(apa,id){
            document.getElementById('PoPUp'+id).style.display="none";
        }
        function simpan(event, apa, id){
            event.preventDefault();
            let form = document.getElementById('form'+id);
            form.submit();
        }
    </script>
    <style>

        html{
            scrollbar-width: none;
        }
        body {
            font-family: "Nunito", sans-serif;

            height: 100vh;
            /* background-image: url(/assets/JELAJAHKULINER.jpg); */
            background-color: aliceblue;
            background-size: cover;
            /* border: #000000; */
            /* border-style: double; */
            /* background-color: rgba(0, 255, 255, 0); */
        }
        .countent{
            display: flex;
            flex-direction: column;
        }
        .countent>*{
            /* border-style: double; */
        }
        .up{
            display:flex ;
            flex-direction: row;
            justify-content: space-between;
            /* margin-top: 10px; */
            padding-top: 10px;
        }
        .up>*{
            /* border-style: double; */
        }
        .upside{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .outer{
            height: auto;
            display: flex;
            flex-direction: row;
        }
        .demain{
            display: flex;
            flex-direction: column;
            width: 70%;
            /* border-style: double; */
        }
        .side{
            width: 30%;
            /* border-style: double; */
        }
        .demain>.nmpkl{
            /* font-family: 'Montserrat'; */
            margin-left: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* border-style: double; */
        }
        .namaakun{
            font-family: 'Montserrat';
            font-weight: 750;
            font-size: 20px;
            padding-left: 20px;
            margin-bottom: 0;
        }
        #butEdit{
            font-size: 20px;
            width: 100%;
            /* margin-right: 20px; */
            /* margin-bottom: 9px; */
            background-color: #9c242c; /* Blue background color */
            color: white; /* White text color */
            border: none; /* No border */
            padding: 5px 10px; /* Padding inside the button */
            /* border-radius: 12px; Rounded corners */
            cursor: pointer; /* Show pointer cursor on hover */
        }
        #butEdit span {
            /* margin-right: 5px; Add a small space between icon and text */
        }

        #hratas{
            margin-top: 2px;
            margin-bottom: 2px;
        }

        .namap{
            font-family: 'Montserrat';
            font-weight: 800;
            font-size: 30px;
            margin-bottom: 0;

        }
        .deskri{
            font-family:Arial, Helvetica, sans-serif;
        }
        .side>hr{
            margin-top: 0;
            margin-bottom: 0;
        }

        .deskri{
            width: 70%;
        }




        /* -------- card------------- */
        img{
            width: 140px;
            border-radius: 12px;
            /* height: 80%; */
            /* float: left; */
            /* background-color: blue;
            border: black; */
            /* border-style: double; */


        }
        .batas{
            position: relative;
            z-index: 1;
            margin-left: 4%;
            display: flex;
            flex-direction: column;
            width: 95%;
            height: auto;
            /* justify-content: center; */
            align-items: center;
            /* background-color: blue; */
        }
        .card{
            display: flex;
            flex-direction: row;
            width: 600px;
            height: 150px;
            margin-bottom: 10px;
            border-radius: 12px;
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1);
            /* z-index: 2; */
            /* justify-content: space-between; */
        }
        @media screen and (max-width: 900px) {
            .card{
                width: 95%;
            }
        }

        .card>#theImage{
            width: 35%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card>#mid>*{
            /* border: black;
            border-style: double; */
        }
        .card>#mid{
            width: 35%;
            padding-left: 2%;
        }
        .card>#leftt{
            width: 50%;
            /* gap: 10px; */
            margin-right: 10px;
            display: flex;
            flex-direction: row;
            /* border: #000 1px solid; */
            align-items: center;
            justify-content: center;
        }
        .stokArea{
            padding: 0 0;
            margin: 0 0;
            display: flex;
            flex-direction: column;
            width: 30%;
            height: 100%;
            align-items: center;
            /* border: yellow 1px solid; */

            /* gap: 20px; */
            /* justify-content: space-between; */
        }
        .stokArea>*{
            /* border: #000 1px solid; */
        }
        .stokArea p{
            margin: 0 0;
            padding: 0 0;
            text-align: center;
        }
        /* .stokArea>p{
            height: 20%;
        } */
        .showStok{
            width: 100%;
            height: 70%;
        }
        .numberrs{
            width: 100%;
            font-size: xx-large;
            height: 100% !important;
            display: flex;
            text-align: center;
            align-items: center;
            justify-content: center;
            /* font-weight: 500; */
        }
        .PopArea{
            position: fixed;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            /* display: none; */
            background-color: rgb(0,0,0,0.7);
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 700 !important;
        }
        .PopArea>div{
            width: 250px;
            height: 200px;
            background-color: #9c242c;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0 0;
            margin: 0 0;
            border-radius: 12px 12px 0 0;
        }
        .subArea{
            width: 100%;
            height: 30%;
            display: flex;
            flex-direction: column;
            gap: 2px;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            color: white;
        }
        .subArea>p{
            padding:  0 0;
            margin: 0 0;
        }
        .inpArea{
            height: 70%;
            width: 100%;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .inpArea>div{
            display: flex;
            flex-direction: row;
            gap: 10px;
        }
        .inpArea>div>button{
            border-radius: 5px;
            font-size: 15px;
            padding: 2px 10px;
            color: white;
            border: none;
        }
        .cncl{
            background-color: #AE0001;
        }
        .cncl:hover{
            background-color: #680000;
        }
        .sv{
            background-color: #1A472A;
        }
        .sv{
            background-color: #0c2214;
        }
        .inpArea>form{
            width: 50%;
            /* border: 1px solid #000; */
            height: 50%;
        }

        .inpArea>form>input{
            width: 100%;
            height: 100%;
            font-size: xx-large;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: none;
            outline: none;
        }
        .inpArea>form>input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
            }

            .inpArea>form>input[type="number"]::-webkit-outer-spin-button,
            .inpArea>form>input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none; /* Chrome, Safari, Opera */
            margin: 0;
            }

            /* Menghilangkan spinner di semua browser */
            .inpArea>form>input[type="number"] {
            -moz-appearance: textfield; /* Firefox */
            }

            .inpArea>form>input[type="number"]:hover,
            .inpArea>form>input[type="number"]:focus {
            outline: none;
            }
        .stok{
            width: 100%;
            font-weight: 600;
            height: 20%;
        }



        .butStok{
            display: flex;
            flex-direction: column;
            width: 70%;
            height: 100%;
            gap: 3px;
            /* border:#000 1px solid; */
            align-items: center;
            justify-content: center;
        }

        .butStok>a{
            width: 90% !important;
            height: 25%;
            /* border:#000 1px solid; */
            display: flex;
            align-items: center;
            justify-content: center;
            /* border-radius: 8px !important; */


        }
        .butStok>a>button{
            padding: 0 0;
            margin: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            border-radius: 8px !important;
        }
        .butStok>a>button>p{
            padding: 3px 5px !important;
        }
        .riwayat{
            background-color: #1A7277;
            color: white;
        }

        #mid>.np{
            /* border: rgb(81, 8, 241);
            border-style: double; */
            font-family: 'Montserrat';
            font-weight: 800;
            padding-top: 10px;
            padding-bottom: 0px;
            margin-bottom: 0;
            height: 25%;
            align-items: center;
        }
        #mid>.Des{
            /* margin-top: -2px; */
            font-family:Arial, Helvetica, sans-serif;
            font-size: 10px;
            height: 45%;
            margin-bottom: 0;
            overflow-y: auto;
            scrollbar-width: none;

        }
        #mid>.hrg{
            font-family:Arial, Helvetica, sans-serif;
            height: 30%;
            font-weight: 500;
            /* border: rgb(81, 8, 241);
            border-style: double; */
            /* font-size: ; */
        }

        /* .card>#mid{
            width: 300px;
            background-color: aquamarine;
        } */
        .card>*{
            /* border: black;
            border-style: double; */
        }
        #lefft{

        }
        #leftt>*{
            display: flex;
            /* flex-direction: column; */
            /* border: black;
            border-style: double; */
            align-items: center;
            justify-content: center;
        }

        #leftt>.stok{
            /* border: rgb(81, 8, 241);
            border-style: double; */
            font-family: 'Montserrat';
            font-weight: 800;
            padding-top: 10px;
            margin-bottom: 0;
            height: 25%;
            align-items: center;
            justify-content: center;
            /* height: 35%; */
        }
        #leftt>.numberr{
            font-size: 30px;
            height: 40%;
            margin-bottom: 0;
        }

        #leftt>.plmn{
            height: 25%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .plmn>*{
            border-radius: 5px;
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: 10px;
        }
        #hrmiring{

            height: auto; /* Tinggi garis */
            width: 1px; /* Lebar garis */
            background-color: #000; /* Warna garis */
            margin: 20px 0;
            /* Margin atas dan bawah */
            /* border-style: double; */


        }


        /* ------------ CHART ------- */
        .batasRev{
            width: 100%;
        }
        .chart{
            width: 100%;
            /* border-style: double; */
        }
        .rating-chart {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 10px;
        }
        .rating-chart>*{
            /* border-style: double; */
        }
        .derating{
            width: 50px;
            margin-bottom: 0;

        }
        .bar {
            width: var(--rating);
            height: 30px;
            background-color: #4caf50;
            transition: width 0.5s ease;
            border-radius: 5px;
        }

        .percentage {
            margin-left: 10px;
            font-weight: bold;
        }
        .chart{
            padding-top: 10px;
        }
        .chart>.rating-chart{
            /* border-style: double; */
        }
        .tessni{
            display: flex;
            flex-direction: row;
            width: auto;
        }

        /* -----SIDE------ */
        .side>*{
            margin-left: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;


        }
        .side>*{
            /* border-style: double; */
        }
        .side>.namapp{
            align-items: center;
            justify-content: center;
        }

        /* --------CARD REVIEEW--- */
        .listRev{

            display: flex;
            flex-direction: column;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 10px;
        }
        .listRev>*{
            margin-top: 10px;
            display: flex;
            flex-direction: column;
            box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1);
            background-color: white;
            border-radius: 12px;
            padding: 10px 10px;

        }
        .listRev>*>*{
            /* border-style: double; */
            margin-bottom: 0;
        }
        /* namaRev */
        /* bintangRev */
        /* desRev */
        #desRev{
            font-weight: 400;
            font-family: 'Montserrat';
            font-size:12px;
        }
        .cardRev>hr{
            margin-top: 0;
        }
        .butButtonFront{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            align-items:center;
            margin-bottom: 10px;
            width: 100%;
            padding: 0 20%;
            /* border: #000 1px solid; */
        }

        @media screen and (max-width: 900px) {
            .butButtonFront{
            padding: 0 12px;
            }
        }

        .butButtonFront>a{
            display: flex;
            width: 100%;
            /* border: 1px black solid; */
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        .butStok>a>button{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            /* align-items:center;  */
            margin-bottom: 5px;
            width: 100%;
            padding: 0 20%;
            font-size: 12px;
            /* background-color: rgb(104, 185, 104); */
            color: white;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            padding: 5px;
            text-align: center;
        }
        .butStok>a>button>p{
            margin: 0 0;
            padding: 0 0;
            width: 100%;
        }

        .butStok>a{
            /* border: 1px rgb(252, 0, 0) solid; */
            width: 100%;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .butStok{
            display: flex;
            flex-direction: column;
            /* border: 1px black solid; */
        }
        .butStok>a>.StokAwal{
            background-color: green;
        }
        .butStok>a>.StokAkhir{
            background-color: rgb(103, 36, 36);
        }
        .deskhusus{
            /* margin-top: -2px; */
            font-family:Arial, Helvetica, sans-serif;
            font-size: 10px;
            margin-bottom: 0;
            overflow-y: auto;
            scrollbar-width: none;
        }

        /* ---------- riwayat stok -------------- */

        .riwayatstok{
            position: fixed;
            background-color: rgb(0,0,0,0.5);
            min-width: 100%;
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 900;
        }
        .riwayatstok p{
            padding: 0 0;
            margin: 0 0;
        }
        .batasrwt{
            width: 700px;
            height: 500px;
            background-color: white;
            border-radius: 5px;
            /* padding: 10px; */
        }
        @media(max-width:900px){
            .batasrwt{
                width: 500px;
                /* heigh; */
            }
            .subTable>p{
                font-size: 10px;
            }
        }
        @media(min-width:901px){
            .subTable>p{
                font-size: 12px;
            }
        }
        .batasrwt *{
            /* border: 1px solid black; */
        }
        .navrwt{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            background-color: #9c242c;
            color: white;
            padding: 2px;
            padding-left: 20px;
            align-items: center;
            border-radius: 5px 5px 0 0;
            /* justify-content: center; */
        }
        .navrwt>div>p{
            font-size: 13px;
        }
        .contentrwt{
            display: flex;
            flex-direction: column;
            padding: 10px;
            height: auto;
        }
        .contentrwt>table{
            width: 100%;
        }
        /* ------------------------ */
        tbody{
            /* align-items: center;
            justify-content: center; */
            border: 1px solid black;
            /* height: 800px; */
            height: 300px;
            overflow-y: auto;
        }

        /* -------------Table--------------- */
        /* .table{
            border: 1px solid #000;
            height: 300px;
            overflow-y: auto;
        } */
        .listPesanan{
            position: absolute;
            z-index: 100;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 100vh;
            height: 70vh;
            padding: 10px;
            border: 1px solid #ccc;
            /* display: none; */
            background-color: #9c242c;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
        }
        @media screen and (max-width: 900px) {
            .listPesanan{
                width: 78vh;
            }
        }
        .NavbarAtasPesanan{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding:0 0;
            /* border-style: double; */
        }

        .miniNavbar{
            /* border-style: double; */
            height: 4vh;
            /* padding-left: 3px; */
            width: 100%;
            /* border-style: double; */
        }
        .miniNavbar>button{
            width: auto;
            /* border-style: double; */
            font-size: 12px;
            color: white;
            background-color: rgba(25, 24, 24, 0.703);

            padding: 2px 5px;
            /* border: 1px solid rgba(25, 24, 24, 0.703); */
            /* transform:skew(20deg); */
            /* border-radius: 5px 5px 0 0; */
            outline: none;
            border: none;
            cursor: pointer;
            opacity: 40%;
        }



        .NavbarAtasPesanan>p{
            color: white;
            padding: 0 0;
            margin: 0 0;
        }
        .ContentPesanan{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: row;
        }
                .tablePesanan{
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .table{
            background-color: white;
            width: 100%;
            height: 450px;
            margin-top: 2px;
            padding: 0 0;
            margin: 0 3px;
            border-radius: 0 0 10px 10px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            /* border: 1px black solid; */
            /* display: flex; */
            /* flex-direction: row; */
        }
        .table>div{
            height: 100%;
            padding: 0 0;
            margin: 0 0;
            border-radius: 0 10px 0 0;

        }
        .subTable{
            display: flex;
            flex-direction: row;
            padding: 0 0;
            margin: 0 0;
            height: 20%;
            /* border-radius: 0 10px 0 0; */
        }

        .TableSide{
            width: 100%;
            height: 90%;
            /* border: black;
            border-style: double; */
            padding: 0 0;
            margin: 0 0;
            padding: 0 5px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            /* scrollbar-width: 1px; */

        }
        .TableSide::-webkit-scrollbar{
            width: 10px;
            /* height: 100%; */

        }
        .TableSide::-webkit-scrollbar-thumb{
            background-color: #9c242c;
            border-radius: 10px;
            border: white solid;
        }
        .deTable{
            display: flex;
            flex-direction: column;
            text-align: center;
            align-items: center;
            padding: 0 4px 0 4px !important;
            /* padding-top: 0; */
        }
        .isiDeTable>p,.isiDeTable>div{
            /* margin: 5px 0; */
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .isiDeTable>p{
            /* font-size: 10px !important; */
        }
        .deTable>div{
            width: 100%;
            display: flex;
            flex-direction: row;
        }
        /* .allPesanan{
            height: 70%;
        } */
        .allPesanan>div{
            width: 100%;
        }
        .subTable{
            /* background-color: #9a464b; */
            display: flex;
            flex-direction: row;
            /* justify-content: space-between; */
            height: 8%;
            align-items: center;
            padding: 8px;
            padding-bottom: 0 !important;
            border-radius: 4pxs;
        }
        .subTable>p{
            /* padding: 0 0; */
            width: 100%;
            margin: 0 0;
            background-color: #a7a7a7;
            padding: 0 4px;
            color: black;
            text-align: center;
            /* font-size: 12px; */
            /* border-radius: 0 10px 0 0; */
        }
        .subTable>.tpemesan{
            border-radius: 4px 0 0 0;
        }
        .subTable>.tstatus{
            border-radius: 0 4px 0 0;
        }
        .isiDeTable{
            /* width: 70%; */
            display: flex;
            flex-direction: row;
            align-items: center;
            border-bottom: 1px solid #858585;
            /* border: 1px solid black; */
        }
        .isiDeTable>p{
            /* border-style: double; */
            padding: 0 0;
            margin: 0 0;
            font-size: 12px;
        }
        .tstatus>button{
            padding: 3px 0;
            margin: 0 0;
            border-radius: 12px;
            font-size: 10px;
            height: 70%;
            width: 70%;
            background-color: rgba(0, 0, 255, 0.568);
            color: white;
            border: none;
        }
        .isiDeTable>.tstatus{
            display: flex;
            align-items: center;
            justify-self: center;
            justify-content: center;
        }
        .subTable>p{
            /* border-style: double; */
        }
        .isiDeTable>p{
            /* border: 1px solid black; */
        }

        .subTable>.tpemesan,.isiDeTable>.tpemesan{
            width: 15%;
        }
        .subTable>.tproduk,.isiDeTable>.tproduk{
            width: 22%;
        }
        .subTable>.tstok,.isiDeTable>.tstok{
            width: 18%;
        }
        .subTable>.ttotal,.isiDeTable>.ttotal{
            width: 30%;
        }
        .subTable>.tstatus,.isiDeTable>.tstatus{
            width: 15%;
        }


        /* ------------SILANG PESANAN---------- */
        .NavbarAtasPesanan>button{
            background-color: rgba(255, 255, 255, 0.747);
            padding: 5px 5px;
            margin: 0 0;
            border-radius: 3px;
            font-size: 10px;
            height: 4vh;
            width: 4vh;
            /* background-color: blue; */
            color: black;
            border: none;
            font-size: 15px;
        }

        /* ----------------- button pesan ----------- */
        #contentPesan{
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0;
            padding: 0 0 !important;
        }
        #contentPesan>*{
            border: 1px solid white double;
        }
        #contentPesan>button{
            width: 100%;
            display: flex;
            flex-direction: row;
            background-color: #ffffff;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 5px;
        }

        #contentPesan>p{
            font-size: 70%;
            margin: 0 0;
            padding: 0 0;
            margin-left: 2%;
        }
        .navbut{
            /* border: #0c2214 1px solid; */
            width: 30px;
            padding: 2px;
            height: 20px;
            margin-right: 5px;

        }
        .navbut>button{

            background-color: grey;
            padding: 3px;
            border: none;
            width: 100%;
            height: 100%;
            border-radius: 3px;
            color: white;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;

        }
    </style>
@endsection
@php 
    function Bintang($rating){
        $back='kosong';
        for($k=1;$k<=$rating;$k++){
            if($back==='kosong'){
                $back ='⭐️';
            }
            else{
                $back .= '⭐️';
            }
        }
        return $back;
    }
@endphp


