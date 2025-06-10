@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/dashboard-user.css') }}">
<link rel="stylesheet" href="{{ auto_asset('css/base.css') }}">


<style>
    body {
        /* overflow-y: hidden; */
    }

    .produkSpace {
        width: 60% !important;
    }
    .fullSetengah{
        width: 75% !important;
    }

    @media (max-width: 768px) {
        .fullSetengah{
        width: 100% !important;
    }
        body {
            /* overflow-y: scroll; */
        }
        .produkKiri{
            width: 300px !important;
        }
        .produkSpace {
            width: 100% !important;
        }

        .Pesanan {
            /* position: absolute; */
            width: 100% !important;
            height: 100%;
            z-index: 4;
            font-size: 10px !important;
            background-color: #6D2323 !important;

            .TotalArea {
                height: fit-content !important;
                gap: 10px;

                .labelTotalArea {
                    width: 100px !important;
                    max-width: 100px !important;
                    min-width: 100px !important;
                }
            }

        }

    }

    .area.produks {
        /* overflow-y: scroll; */
    }

    .clean-number {
        appearance: textfield;
        /* Untuk sebagian besar browser */
        -moz-appearance: textfield;
        /* Firefox */
        -webkit-appearance: none;
        /* WebKit browsers */

        border: none;
        padding: 0;
        margin: 0;

        font: inherit;
        /* Gunakan font seperti elemen lain */
        color: inherit;

        width: auto;
        /* Lebar mengikuti konten */
        height: 100%;
        /* Atur sesuai konteks */

        background: transparent;
        /* Jika kamu ingin input tampak 'flat' */
    }

    /* Hilangkan spinner di WebKit */
    .clean-number::-webkit-inner-spin-button,
    .clean-number::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

@endsection

@section('AddOn')


@endsection

@section('isi')
<form action="{{ route('pesanan.store') }}" method="POST" class="contPesanan position-relative d-flex flex-md-row flex-column w-100 h-100 justify-content-between bg-prim-dark">
    @csrf

   
    <div class="produkSpace h-100 d-flex bg-body flex-column justify-content-evenly align-items-center" style="min-height: 100%; max-height:100%; width: 60%;">
        <div class="d-flex p-5 justify-content-center align-items-center">
            <h1 class="p-clear cl-prim-dark fw-bolder">PKL JAWA'S PRODUK</h1>
        </div>
        <div class="w-100 d-flex mb-5 justify-content-center align-items-center flex-1" style="min-height: 100%; max-height:100%;">
            <div class="area produks SecondScroll fullSetengah gap-4 d-flex flex-column overflow-y-auto h-100 justify-content-start align-items-center"
                style="width: fit-content; max-width: 100%; max-height: 70vh;">
                @if($produk->isEmpty())
                <p>Belum ada produk yang terdaftar</p>
                @else
                @foreach($produk as $item)
                <div class="produkKiri produk{{{$item->id}}} align-items-center position-relative d-flex gap-2 flex-row justify-content-end align-items-end" style="height:170px; min-height: 170px; width: 470px;">
                    <div class="position-absolute z-2 gap-0 border border-danger shadow d-flex flex-wrap justify-content-between align-items-center right-0 p-1 bg-white border-left-top border-right-bottom" style="width:110px; height: 40px; bottom: -10px;">
                        <div class="tambahproduk{{{$item->id}}} d-flex awal w-50" onclick="showButton(this,'{{{$item->id}}}')">
                            <p class="p-clear lh-1 poppins fw-bolder cl-prim-dark" style="font-size: 12px;">TAMBAH PRODUK</p>
                        </div>
                        <button type="button" onclick="minus('{{{$item->id}}}')" class="minusButton{{{$item->id}}} border d-none justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;">
                            <i class="p-clear fs-5 bi bi-dash-lg"></i>
                        </button>
                        <input type="number" data-id="{{{$item->id}}}" name="produk{{{$item->id}}}" class="inputNumber{{{$item->id}}} d-none text-center clean-number border-0 p-0" data-qty="100" data-price="{{{$item->harga}}}" value="0" style="width: 30px; height: 100%;" name="" id="qty{{{$item->id}}}">
                        <button type="button" onclick="plus('{{{$item->id}}}','1',this)" class="plusButton{{{$item->id}}} border d-flex justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;">
                            <i class="p-clear fs-5 bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <img class="circle-preview d-none d-lg-flex d-md-flex position-absolute z-1 shadow" src="{{auto_asset('storage/'.$item->foto)}}" alt="" style="height: 75%; width: fit-content; left: 0;">
                    <div class="position-absolute shadow z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:87%; height:95%; max-height: 95%; min-height: 95%;  ">

                        <div class="contisi d-flex flex-column first-cl justify-content-end align-items-end w-50">
                            <p class="fw-bolder p-clear" style="font-size: 14px;">{{{$item->nama}}}</p>
                        </div>
                        <div class="pe-1 text-justify first-cl" style="width: 80%; flex:1; ">
                            <div class="textDexscription scroll-bg-dark h-75" style="overflow: auto;">
                                <p class="text-justify p-clear" style="text-indent: 12px; font-size: 10px; text-align: justify;">{{{$item->deskripsi}}}</p>
                            </div>
                            <div class="w-75 fw-bolder cl-white justify-content-start align-items-center">
                                <p class="p-clear">{{{$item->harga}}}</p>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="Pesanan d-flex h-100 p-3 cl-white flex-column flex-1" style="min-height: 100%; width: 40%;"
        id="offcanvasExample">
        <div class="w-100 justify-content-start gap-3 align-items-center h-100 d-flex flex-column">
            <div class="w-25">
                <img src="{{ auto_asset('assets/logoWhite.svg') }}" alt="Logo"
                    class="w-100">
            </div>
            <div class="bg-body gap-3 p-4 flex-column h-75 d-flex rounded-2 justify-content-start align-items-center" style="width: 90% !important; min-height: 75vh;">
                <div class="w-100 text-black fw-bolder d-flex flex-row justify-content-evenly">
                    <p class="p-clear">TANGGAL: {{{date('Y-m-d')}}}
                    </p>
                    <p class="p-clear">
                        WAKTU: {{{date('H:i:s')}}}
                    </p>
                </div>
                <div class="w-100 d-flex flex-column SecondScroll justify-content-start overflow-y-scroll overflow-x-hidden gap-0 align-items-center" style="height: 35vh; font-size: 10px !important;">
                    @if($produk->isEmpty())
                    <p>Belum ada produk yang terdaftar</p>
                    @else
                    @foreach($produk as $item)
                    <div class="produk{{{$item->id}}} align-items-center produkNota{{{$item->id}}} position-relative d-none gap-2 flex-row justify-content-end align-items-end" style="height:125px; min-height: 125px; width: 100%;">
                        <img class="circle-preview position-absolute z-1 shadow" src="{{asset('storage/'.$item->foto)}}" alt="" style="height: 50%; width: fit-content; left: 0;">
                        <div class="position-absolute shadow z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-center bg-prim-dark border-left-top border-right-bottom" style="right: 0; padding-left: 70px; width:90%; height:95%; max-height: 95%; min-height: 95%;">

                            <div class="contisi d-flex flex-column first-cl justify-content-start align-items-start w-100 flex-1">
                                <p class="fw-bolder p-clear" style="font-size: 14px;">{{{$item->nama}}}</p>
                            </div>
                            <div class="d-flex flex-column justify-content-evenly w-100 h-100">
                                <div class="d-flex p-1  flex-row w-100" style="height: 30px;">
                                    <div class="w-50 h-100 d-flex fw-bolder align-items-center justify-content-start">
                                        Kuantitas
                                    </div>
                                    <div class="QtyProduk w-50 h-100 d-flex fw-bolder bg-light border-left-top border-right-bottom text-black align-items-center justify-content-start ps-3">

                                    </div>
                                </div>
                                <div class="d-flex p-1  flex-row w-100" style="height: 30px;">
                                    <div class="w-50 h-100 d-flex fw-bolder align-items-center justify-content-start">
                                        Total harga
                                    </div>
                                    <div class="TotalHarga w-50 h-100 d-flex fw-bolder bg-light border-left-top border-right-bottom text-black align-items-center justify-content-start ps-3">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <div class="TotalArea bg-prim-dark w-100 p-2 d-flex flex-md-row flex-column justify-content-evenly" style="height: 50px;">
                    <div class="d-flex flex-row gap-3 h-100 justify-content-between w-25 align-items-center">
                        <p class="labelTotalArea p-clear">Kuantitas</p>
                        <div class=" qty bg-body text-black border-left-top border-right-bottom fw-bolder d-flex justify-content-center align-items-center" style="width: 50px; max-width: fit-content; min-width: 50px; height: 35px;">
                            <p class="qtyAll p-clear">0</p>

                        </div>
                    </div>
                    <div class="d-flex flex-row gap-3 h-100 justify-content-between align-items-center" style="width:fit-content;">
                        <p class="labelTotalArea p-clear">Total Pembelian</p>
                        <div class="total bg-body text-black p-1 border-left-top border-right-bottom fw-bolder d-flex justify-content-center align-items-center" style="width: 35px; min-width: 110px; max-width: fit-content; height: 35px;">
                            <input type="text" class="inputTotal d-none" name="totalHarga" id="" value="0">
                            <input type="text" class="inputTotal d-none" name="idPKL" id="" value="{{{$pkl->id}}}">
                            <p class="TotalAll p-clear">Rp. 0,-</p>
                        </div>
                    </div>
                </div>

                <div class="w-100 d-flex flex-column justify-content-center align-items-center" style="height: 100px;">
                    <div class="w-100 h-auto d-flex flex-row gap-1">
                        <p class="p-clear text-black" style="font-size: 14px;">Keterangan Tambahan</p>
                        <p class="p-clear fw-bolder text-black" style="font-size: 14px;">(Opsional)</p>
                    </div>
                    <div class="w-100 flex-1 ">
                        <textarea class="w-100 h-100 border-2 noOutline p-2 border-danger border-left-top border-right-bottom" name="keterangan" id=""
                            style="min-height: 100px; font-size: 14px;"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-danger mt-2">Pesan Sekarang</button>
            </div>
        </div>
</form>
@endsection

@section('js')
<script>
    function plus(idProduk, wht, elemen) {
        if (wht == '1') {
            let inp = document.querySelectorAll('.minusButton' + idProduk + ' , .inputNumber' + idProduk)
            inp.forEach(e => {
                e.classList.replace('d-none', 'd-flex')
            })
            elemen.setAttribute("onclick", "plus('" + idProduk + "','0',this)")
            document.querySelector('.tambahproduk' + idProduk).classList.replace('d-flex', 'd-none')

        } else {
            let inp = document.querySelector('#qty' + idProduk)
            let qty_awal = parseInt(inp.value)
            let stok = parseInt(inp.getAttribute('data-qty'));
            if (qty_awal <= (stok - 1)) {
                inp.value = qty_awal + 1;
            } else {
                erorAlert('Stok Terbatas', 'Stok produk hanya ' + stok)
            }
        }
        changeInput(idProduk, '+')
    }
    everyChange()

    function changeInput(id, wht) {
        let inp = document.querySelector('.produkKiri.produk' + id + ' input');
        console.log(inp)
        let contData = document.querySelector('.produkNota' + id)
        let datakanan = document.querySelector('.produkNota' + id + ' .QtyProduk')
        let totalPrice = document.querySelector('.produkNota' + id + ' .TotalHarga')
        // console.log('datakanan', datakanan, '.produkNota'+id+' .QtyProduk')
        let qtyAwal = parseInt(inp.value)
        if (wht == '+') {
            if (qtyAwal <= parseInt(inp.getAttribute('data-qty'))) {
                if (qtyAwal == 0) {
                    contData.classList.replace('d-none', 'd-flex')
                }
                // let currentQty = qtyAwal += 1
                // inp.value = currentQty
                datakanan.textContent = (inp.value);
                totalPrice.textContent = formatRupiah(parseInt(inp.value) * parseInt(inp.getAttribute('data-price')))
                SumAll()

            }
        } else {
            if (qtyAwal >= 0) {
                if (qtyAwal == 0) {
                    contData.classList.replace('d-flex', 'd-none')
                }
                // let currentQty = qtyAwal += 1
                // inp.value = currentQty
                // console.log(inp.value)
                datakanan.textContent = inp.value;
                totalPrice.textContent = formatRupiah(parseInt(inp.value) * parseInt(inp.getAttribute('data-price')))
                SumAll()
                console.log(',masul')
            }
        }
    }

    function SumAll() {
        let allInp = document.querySelectorAll('.produkKiri input');
        let qty = 0;
        let sum = 0;
        allInp.forEach(e => {
            let isi = parseInt(e.value)
            let harga = parseInt(e.getAttribute('data-price'))
            qty += parseInt(isi)
            sum += (isi * harga)
        })

        document.querySelector('.qtyAll').textContent = qty
        document.querySelector('.TotalAll').textContent = formatRupiah(sum)
        document.querySelector('.inputTotal').value = sum;

    }

    function minus(idProduk) {
        let inp = document.querySelector('#qty' + idProduk)
        let qty_awal = parseInt(inp.value)
        let stok = parseInt(inp.getAttribute('data-qty'));
        if (qty_awal > 0) {
            inp.value = qty_awal - 1;
        } else {
            erorAlert('Eror', 'Qty sudah 0')
        }

        changeInput(idProduk, '-')
    }

    function showButton(elemen, idProduk) {
        elemen.classList.replace('d-flex', 'd-none')
        let inp = document.querySelectorAll('.minusButton' + idProduk + ' , .inputNumber' + idProduk)
        inp.forEach(e => {
            e.classList.replace('d-none', 'd-flex')
        })
    }
</script>
@endsection