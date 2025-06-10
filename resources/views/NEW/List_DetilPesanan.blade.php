@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/List.css') }}">

<style>
    .semiHeader p {
        font-size: 12px !important;
    }
</style>
@endsection

@section('AddOn')


@endsection

@section('isi')
<div class="second-bg w-100 h-100 p-3" style="min-width: 100%; min-height: 100%;">
    <div class="w-100 d-flex flex-row justify-content-between">
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
        <div>
            <button>Tes</button>
        </div>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item text-black">
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#">Pending</a>
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
                        @foreach($produk as $item)
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
        </section>
    </div>
</div>


@endsection

@section('js')
<script src="{{ auto_asset('js/List.js') }}"></script>

@endsection