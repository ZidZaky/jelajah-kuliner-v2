@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/List.css') }}">

<style>
    .semiHeader p {
        font-size: 12px !important;
    }

    .tbl-content {
        min-height: 200px;
        height: 200px !important;

    }

    .widthFullSeparuh {
        width: 25%;
    }

    @media (max-width: 768px) {
        .widthFullSeparuh {
            width: 100% !important;
        }
    }
</style>
@endsection

@section('AddOn')


@endsection

@section('isi')
<div class="second-bg w-100 h-100 p-3" style="min-width: 100%; min-height: 100%;">
    <div class="w-100 pe-3 d-flex flex-column flex-md-row justify-content-between">
        <div class="semiHeader d-flex flex-column justify-content-start align-items-start">
            <h2 class="">Detil Pesanan id #{{{$pesan->id}}}</h2>
            <div class="d-flex flex-row gap-2 w-100">
                <p style="width: 100px; min-width: 100px; max-width: 100px;">Pemesan</p>
                <p>:</p>
                <p>{{{$pesan->namaPemesan}}}</p>
            </div>
            <div class="d-flex flex-row gap-2 w-100">
                <p style="width: 100px; min-width: 100px; max-width: 100px;">Tanggal: </p>
                <p>:</p>
                <p>{{{$pesan->created_at}}}</p>
            </div>
            <div class="d-flex flex-row gap-2 w-90">
                <p style="width: 100px; min-width: 100px; max-width: 100px;">Keterangan</p>
                <p>:</p>
                <p>{{{$pesan->Keterangan}}}</p>
            </div>
        </div>
        <div class="widthFullSeparuh d-flex gap-4 justify-content-center align-items-center">
            @if($pesan->status=='pesanan baru')
            <button class="btn btn-success px-4" onclick="window.location.href='/terimaPesanan/{{{$pesan->id}}}'">Terima Pesanan</button>
            <button class="btn btn-success px-4" onclick="window.location.href='/tolakPesanan/{{{$pesan->id}}}'">Tolak Pesanan</button>
            @elseif($pesan->status=='Pesanan Diproses')
            <button class="btn btn-success px-4" onclick="window.location.href='/siapDiambilPesanan/{{{$pesan->id}}}'">Pesanan Siap Diambil</button>
            @elseif($pesan->status=='Pesanan Siap Diambil')
            <button class="btn btn-success px-4" onclick="window.location.href='/selesaiPesanan/{{{$pesan->id}}}'">Selesaikan Pesanan</button>
            @elseif($pesan->status=='Pesanan Selesai')
            @endif
        </div>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item text-black">
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#">{{{$pesan->status}}}</a>
            </li>
        </ul>
    </div>
    <div>
        <section class="d-flex gap-4 flex-column shadow">
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>QTY</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        @foreach($produks as $item)
                        <tr>
                            <td>{{{$item->nama}}}</td>
                            <td>{{{$item->JumlahProduk}}}</td>
                            <td>{{{$item->hargaSatuan}}}</td>
                            <td>{{{intval($item->hargaSatuan)*intval($item->JumlahProduk)}}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead class="">
                        <tr class="">
                            <th>Total Transaksi</th>
                            <th></th>
                            <th></th>
                            <th>100000</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </div>
    @if($pesan->status!='Pesanan Selesai')

    <div class="w-100 d-flex justify-content-center align-items-center">
        <button class="btn btn-warning px-4">Laporkan Pesanan</button>
    </div>
    @endif
</div>


@endsection

@section('js')
<script src="{{ auto_asset('js/List.js') }}"></script>

@endsection