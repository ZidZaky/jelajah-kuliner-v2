@extends('layouts.layout2')

@section('title')
    PESAN KULINERMU!
@endsection

@section('css')
    <link rel="stylesheet" href="/css/pesan.css">
@endsection

@section('main')
@section('isiAlert')
    @if((session('alert'))!=null)

            @php echo session('alert'); @endphp
    @endif
@endsection
    <div class="all">
        <div class="up border border-bottom d-flex justify-content-between align-items-center">
            <a href="/dashboard"><button class="btn btn-danger">Batalkan Pesanan</button></a>
            <p class="namaakun m-0">Mau jajan apa, {{ session('account')['nama'] }}? 🤔</p>
            <form action="/pesanan" method="POST" class="m-0">
                <button type="submit" class="btn btn-success">Ajukan Pesanan!&#9998;</button>
        </div>
        <div class="nmpkl">

        </div>

        <div class="showmenu" style="padding-top: 5px; padding-bottom: 5px">
            <div class="kiri border border-right" style="width: 100%;">
                <h3 class="namap" style="border-bottom: 1px solid #ccc;"><strong>{{ $pkl->namaPKL }}</strong></h3>
                <p class="deskri">{{ $pkl->desc }}</p>

                    @csrf
                    <input type="text" name="idAccount" id="idAccount" value="{{ session('account')['id'] }}" hidden>
                    <input type="text" name="idPKL" id="idPKL" value="{{ $pkl->id }}" hidden>
                    {{-- {{dd($produk)}} --}}
                    @if ($produk->count() > 0)
                        @foreach ($produk as $p)
                            <div class="card" style="margin-top: 10px">
                                <div class="inCard" id="theImage">
                                    <img src="/storage/{{$p->foto}}" alt="" style="border: black 1px solid; border-radius: 40px">

                                </div>
                                <div class="inCard" id="mid">
                                    <p class="np">{{ $p->nama }}</p>
                                    <p class="Des">{{ $p->deskripsi }}</p>
                                    <p class="hrg">Rp. {{ number_format($p->harga, 2, ',', '.') }}</p>
                                </div>
                                <div class="inCard" id="leftt">
                                    <div class="warn" >
                                        <p id="warning{{$p->id}}" style="display:none;">melebihi stok</p>
                                    </div>
                                    <div class="stokAr">
                                        @if($p->sisaStok==0)
                                            <p>stok habis</p>
                                            <p id="sisaStok{{$p->id}}" style="display:none;">{{$p->sisaStok}}</p>
                                            <button type="button" class="btn btn-primary decrementButton" style="display:none;"> - </button>
                                            <span class="quantity mx-2" id="quantity_{{ $p->id }}" style="display:none;"> 0 </span>
                                            <button type="button" id="incrementBut{{$p->id}}" style="display:none;" onclick="incrementBut('{{$p->id}}')" class="btn btn-primary incrementButton"> + </button>
                                            <input type="hidden" id="myInput_{{ $p->id }}" style="display:none;"
                                                name="produk_{{ $p->id }}" value="0">
                                        @else
                                            <p id="sisaStok{{$p->id}}" style="display: none">{{$p->sisaStok}}</p>
                                            <button type="button" class="btn btn-primary decrementButton"> - </button>
                                            <span class="quantity mx-2" id="quantity_{{ $p->id }}"> 0 </span>
                                            <button type="button" id="incrementBut{{$p->id}}" onclick="incrementBut('{{$p->id}}')" class="btn btn-primary incrementButton"> + </button>
                                            <input type="hidden" id="myInput_{{ $p->id }}"
                                                name="produk_{{ $p->id }}" value="0">
                                        @endif
                                    </div>
                                    <div class="forStok">
                                        <p>Stok Tersisa: {{$p->sisaStok}}</p>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="namap" style="text-align: center">Produk Kosong</p>
                    @endif


                    <input type="text" name="totalHarga" id="totalPrice" value="0" hidden>


                    <input type="text" name="status" id="status" value="Pesanan Baru" hidden>

            </div>

            <div class="kanan border border-right d-flex flex-column justify-content-between"
                style="height: 100%; width: 50%; margin-left: 5px;">
                <p style="margin-top: 1vh; margin-bottom: 1vh; text-align: center;"><strong>(👉ﾟヮﾟ)👉  {{ now()->format('l, d F Y') }}  👈(ﾟヮﾟ👈)</strong></p>
                <table id="tabelStruk" class="table" style="position: absolute; width: 33%; margin-top: 5vh">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Produk</th>
                            <th>Quantity</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total Quantity</td>
                            <td id="totalQuantity"></td>
                        </tr>
                        <tr>
                            <td colspan="3">Total Keseluruhan</td>
                            <td id="totalKeseluruhan"></td>
                        </tr>
                    </tfoot>
                </table>
                <div style="height: 100%; margin-top: 50vh;">
                    <label for="keterangan">Keterangan Tambahan (Opsional):</label>
                    <br>
                    <input type="text" name="keterangan" id="keterangan" value=" " placeholder="Contoh: Tidak pedas ya mas!" style="width: 80%; height: 5vh;">
                </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.incrementButton').forEach(button => {
            button.addEventListener('click', function() {
                // let quantityElement = this.closest('.inCard').querySelector('.quantity');
                // let quantity = parseInt(quantityElement.textContent);
                // quantity++;
                // quantityElement.textContent = quantity;
                // this.nextElementSibling.value = quantity; // Update hidden input value
                updateTotalPriceAndTable();
            });
        });

        document.querySelectorAll('.decrementButton').forEach(button => {
            button.addEventListener('click', function() {
                let quantityElement = this.closest('.inCard').querySelector('.quantity');
                let quantity = parseInt(quantityElement.textContent);
                if (quantity > 0) {
                    quantity--;
                    quantityElement.textContent = quantity;
                    this.nextElementSibling.value = quantity; // Update hidden input value
                    updateTotalPriceAndTable();
                }
            });
        });

        function updateTotalPriceAndTable() {
            var totalPrice = 0;
            var totalQuantity = 0;
            var tabelStruk = document.getElementById('tabelStruk').querySelector('tbody');
            tabelStruk.innerHTML = ''; // Clear the table on update
            let nomor = 1;

            document.querySelectorAll('.card').forEach(card => {
                let quantity = parseInt(card.querySelector('.quantity').textContent);
                if (quantity > 0) {
                    let productName = card.querySelector('.np').textContent;
                    let productPrice = parseInt(card.querySelector('.hrg').textContent.replace('Rp. ', '').replace(
                        /\./g, '').replace(/,00/g, ''));
                    let totalHarga = quantity * productPrice;
                    totalPrice += totalHarga;
                    totalQuantity += quantity;
                    let row = `<tr>
                                <td>${nomor++}</td>
                                <td>${productName}</td>
                                <td>${quantity}</td>
                                <td>Rp. ${totalHarga.toLocaleString('id-ID', {minimumFractionDigits: 2})}</td>
                                </tr>`;
                    tabelStruk.innerHTML += row;
                }
            });

            document.getElementById('totalPrice').value = totalPrice.toLocaleString('id-ID');
            document.getElementById('totalKeseluruhan').textContent =
                `Rp. ${totalPrice.toLocaleString('id-ID', {minimumFractionDigits: 2})}`;
            document.getElementById('totalQuantity').textContent = totalQuantity;
        }

        function incrementBut(id){
            // console.log('tes');
            let warn = document.getElementById('warning'+id)
            let inpProd = document.getElementById('myInput_'+id);
            let inpstok = document.getElementById('sisaStok'+id);
            let teks2 = document.getElementById('quantity_'+id);
            let rilStok = parseInt(inpstok.textContent);
            let numb = parseInt(teks2.textContent,10)
            console.log(numb)

            if(numb!=rilStok){
                numb=numb+1;
                inpProd.value = numb;
                teks2.textContent=numb;
                warn.style.display = "none";
            }
            else{
                warn.style.display = "flex";
                warn.style.color = "red";

                setTimeout(function(){
                    warn.style.display = "none";
                },1000);
            }
            // console.log('teks2 : '+);

            // console.log()
        }
    </script>
    <style>
        #leftt{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        #leftt>div{
            /* border: black 1px solid; */
            display: flex;
            align-items: center;
            width: 100%;
        }
        .warn{
            padding-top: 10px;
            height: 20%;
            justify-content: center;

            /* display: none; */
        }
        .warn>p{
            padding: 0 0;
            margin: 0 0;
        }
        .stokAr{
            height: 60%;
            /* padding-bottom: 20%; */
        }
        .forStok{
            display: flex;
            height: 20%;
        }
        .forStok>p{
            padding: 0 0;
            margin: 0 0;
            padding-bottom: 10px;
        }
    </style>
@endsection
