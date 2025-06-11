@extends('layouts.layout')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ auto_asset('css/dashboard-user.css') }}">
<link rel="stylesheet" href="{{ auto_asset('css/base.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        /* overflow: hidden; */
    }

    .buttonsArea {
        button {
            border: none;
        }
    }

    .modal {
        z-index: 9999 !important;
    }

    .modal-backdrop {
        z-index: 9998 !important;
    }
</style>

@endsection
@section('unrelative')
<form action="/MakeStokAwal" method="POST" class="modal fade AddNewStock" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @csrf
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Stok Awal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-3">
  <input type="number" maxlength="50" name="stokAwal" class="form-control" id="floatingInput" placeholder="50">
  <input type="text"  name="idproduk" class="form-control inputIdproduct d-none" id="floatingInput" placeholder="50">
  <label for="floatingInput">Stok Awal Penjualan</label>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</form>

<form action="/updateStokAkhir" method="POST" class="modal fade AddEndStock" id="endStok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @csrf
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Stok Akhir</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-3">
  <input type="number" maxlength="50" name="stokAkhir" class="form-control" id="floatingInput" placeholder="50">
  <input type="text"  name="idproduk" class="form-control d-none inputIdproduct" id="floatingInput" placeholder="50">
  <label for="floatingInput">Stok Akhir Penjualan</label>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</form>

@endsection

@section('AddOn')


@endsection

@section('isi')

<div class="contPesanan position-relative bg-body d-flex flex-md-row flex-column w-100 h-100 justify-content-between" style="min-height: 82vh; max-height: 82vh;">
    <div class="produkSpace h-100 d-flex bg-body flex-column justify-content-evenly align-items-center" style="min-height: 100%; max-height:100%; min-width: 70%;">
        <div class="d-flex p-3 justify-content-center align-items-center">
            <h1 class="p-clear cl-prim-dark fw-bolder">Selamat Datang, {{$pkl->namaPKL}}</h1>
        </div>
        <button class="btn btn-info border-0 mb-3"><a href="/produk/create" class="text-decoration-none text-black">Buat Produk Baru</a></button>
        <div class="w-100 d-flex mb-5 justify-content-center align-items-center flex-1" style="min-height: 100%; max-height:100%;">
            <div class="area produks SecondScroll w-75 gap-4 d-flex flex-column overflow-y-auto h-100 justify-content-start align-items-center"
                style="width: fit-content; max-width: 100%; max-height: 65vh; min-height: 65vh;">
                @if ($produk->count() == 0)
                <p class="p-clear" style="font-size: 12px;">Belum ada produk</p>
                @endif
                @if ($produk->count() > 0)
                @foreach($produk as $item)
                <div class="produk{{{$item->id}}} align-items-center position-relative d-flex gap-2 flex-row justify-content-end align-items-end" style="height:200px; min-height: 200px; width: 470px;">


                    <img class="circle-preview position-absolute z-1 shadow" src="/assets/contoh.jpg" alt="" style="height: 60%; width: fit-content; left: 0;">
                    <div class="position-absolute shadow z-0 pe-0 d-flex flex-row gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:87%; height:95%; max-height: 95%; min-height: 95%;  ">
                        <div class="h-100 py-2">
                            <button class="bg-transparent border-0" style="left: 0; top: 0;">
                                <i class="bi bi-trash text-white"></i>
                            </button>
                        </div>
                        <div class="shadow z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:90%; height:95%; max-height: 95%; min-height: 95%;  ">
                            <div class="contisi d-flex flex-column first-cl justify-content-end align-items-end w-50">
                                <p class="fw-bolder p-clear" style="font-size: 14px;">{{ $item->nama.' '.$item->id }}</p>
                            </div>
                            <div class="pe-1 text-justify first-cl" style="width: 75%; flex:1; ">
                                <div class="textDexscription scroll-bg-dark h-75" style="overflow: auto;">
                                    <p class="text-justify p-clear" style="text-indent: 12px; font-size: 10px; text-align: justify;">{{ $item->deskripsi }}</p>
                                </div>
                                <div class="w-75 fw-bolder d-flex cl-white justify-content-between align-items-center">
                                    <p class="p-clear">Rp. {{ $item->harga }},-</p>
                                    <p class="p-clear">Stok: {{$item->sisaStok}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="buttonsArea bg-body d-flex flex-column justify-content-evenly align-items-center" style="min-width: 35px;max-width: 35px; height: 100%;">
                            <button type="button" class="d-flex cl-prim-dark justify-content-center align-items-center bg-transparent"
                                data-bs-toggle="popover" onclick="BuatStokAwal('{{{$item->id}}}')" data-bs-trigger="hover" data-bs-title="Set Stok Awal" data-bs-content="Gunakan tombol ini untuk menetapkan jumlah stok awal barang sebelum jualan harian dimulai."><i class="bi bi-file-earmark-plus-fill"  data-bs-toggle="modal" data-bs-target="#exampleModal"></i></button>
                            <button type="button" onclick="BuatStokAkhir('{{{$item->id}}}')" class="d-flex cl-prim-dark justify-content-center align-items-center bg-transparent"
                                data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Set Stok Akhir" data-bs-content="Gunakan tombol ini untuk menyesuaikan stok berdasarkan hasil akhir masa jualan harian."> <i class="bi bi-file-earmark-minus-fill" data-bs-toggle="modal" data-bs-target="#endStok"></i></button>
                            <button type="button" onclick="window.location.href='/History-Stok/{{{$item->id}}}'" class="d-flex cl-prim-dark justify-content-center align-items-center bg-transparent"
                                data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Riwayat Stok" data-bs-content="Lihat riwayat lengkap pergerakan stok masuk dan keluar di sini."> <i class="bi bi-clock-history"></i></button>
                            
                        </div>
                    </div>
                </div>
                @endforeach

                @endif
            </div>
        </div>
    </div>





    <div class="d-flex containerPopup bg-success d-flex flex-column justify-content-between width-full-xs z-3" style="width: 30%; height: 100%; right:0; top: 90px;">
        {{-- Header Popup --}}
        <div class="container d-flex justify-content-between align-items-center" style="height: 30px; font-size: 12px; background-color: #2B1010 !important; color: white;">
            <div class="d-flex flex-row gap-2 justify-content-start align-items-center">
                <p class="p-clear fw-bolder" id="popupVendorName">{{$pkl->namaPKL}}</p>
                <p class="p-clear">|</p>
                <div class="d-flex flex-row gap-1" id="popupVendorRating">
                    {{$pkl->desc}}
                    {{-- Bintang rating akan diisi oleh JavaScript --}}
                </div>
            </div>
        </div>

        {{-- Info Vendor (Gambar & Deskripsi Singkat) --}}
        <div class="container d-flex flex-row gap-2 align-items-center justify-content-between" style="height: 100px; max-height: 100px; background-color: #6D2323;">
            <img class="circle-preview" src="/assets/contoh.jpg" alt="" style="height: 80%; width: fit-content;">
            <div class="h-75" style="width: 1px; background-color:rgba(255, 255, 255, 0.36);"></div>
            <p class="p-clear h-auto" id="popupVendorDescription" style="color:rgba(253, 253, 253, 0.87);font-size: 10px; flex:1; overflow-y:auto;">{{$pkl->desc}}</p>
        </div>

        {{-- Konten Utama Popup (Produk/Ulasan) --}}
        <div class="bg-white d-flex flex-column justify-content-between" style="height: calc(100% - 30px - 100px); max-height: calc(100% - 30px - 100px);">
            {{-- Tombol Tab Produk/Ulasan --}}

            {{-- Area Konten Dinamis (Produk atau Ulasan) --}}
            <div class="d-flex flex-column justify-content-start" style="flex: 1; overflow: hidden;"> {{-- justify-content-start, flex:1, overflow:hidden --}}
                <div class="container mt-3 d-flex flex-column gap-0" style="height: 30px; min-height:30px;">
                    <p class="p-clear" id="popupCurrentTabTitle">Ulasan</p>
                    <hr class="m-0" style="height: 2px; border: 1px solid #6D2323; background-color: #6D2323;">
                </div>
                {{-- Kontainer Ulasan --}}
                <div class="container mt-2 area ulasans d-flex flex-column gap-2" style="flex: 1; min-height: 53vh;max-height: 53vh; overflow-y: auto;">
                    <div class="w-100 h-100 d-flex flex-column gap-2 py-2 justify-content-center align-items-center initial-review-placeholder">
                        @if ($ulasan->count() == 0)
                        <p class="p-clear" style="font-size: 12px;">Belum ada ulasan</p>
                        @endif
                        @if($ulasan->count() > 0)
                        @foreach($ulasan as $ulasan)
                        <div class="produk ulasan align-items-center border-left-top border-right-bottom py-2 px-3 gap-2 position-relative d-flex flex-column justify-content-start align-items-center w-100" style="min-height: 100px; background-color: #D8D8D8;">
                            <div class="d-flex justify-content-between align-items-center w-100 h-auto">
                                <div class="d-flex flex-row gap-1" style="font-size: 8px;">{{$ulasan->rating}}</div>
                                <p class="p-clear cl-prim-dark fw-bolder" style="font-size: 13px;">{{$ulasan->idAccount}}</p>
                            </div>
                            <div class="w-100" style="flex:1; overflow: auto;">
                                <p class="p-clear" style="font-size: 10px; text-indent: 12px; text-align: justify;">{{$ulasan->ulasan}}</p>
                            </div>

                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection

    @section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
        }

        function showButton(elemen, idProduk) {
            elemen.classList.replace('d-flex', 'd-none')
            let inp = document.querySelectorAll('.minusButton' + idProduk + ' , .inputNumber' + idProduk)
            inp.forEach(e => {
                e.classList.replace('d-none', 'd-flex')
            })
        }
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
        document.addEventListener('DOMContentLoaded', function() {
            const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            popoverTriggerList.forEach(function(popoverTriggerEl) {
                new bootstrap.Popover(popoverTriggerEl)
            })
        });

        function BuatStokAwal($id) {
            document.querySelector('.AddNewStock .inputIdproduct').value = $id;
        }

        function BuatStokAkhir($id) {
            document.querySelector('.AddEndStock .inputIdproduct').value = $id;
        }
    </script>
    @endsection