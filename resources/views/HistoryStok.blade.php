@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/List.css') }}">


@endsection

@section('AddOn')


@endsection

@section('isi')
<div class="second-bg w-100 h-100 p-3" style="min-width: 100%; min-height: 100%;">
    <div class="d-flex flex-column justify-content-start align-items-start">
        <h2 class="">History Stok</h2>
        <p>Menyajikan data stok anda</p>

    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item text-black">
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#">{{{$namaProduk}}}</a>
            </li>
        </ul>
    </div>
    <div>
        <section class="d-flex gap-4 flex-column shadow">
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Stok Awal</th>
                            <th>Terjual Online</th>
                            <th>Terjual Offline</th>
                            <th>Sisa Stok</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{{$item->created_at}}}</td>
                            <td>{{{$item->stokAwal}}}</td>
                            <td>{{{$item->TerjualOnline}}}</td>
                            <td>{{{intval($item->stokAwal)-intval($item->TerjualOnline)-intval($item->stokAkhir)}}}</td>
                            <td>{{{$item->stokAkhir}}}</td>
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