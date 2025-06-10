@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/List.css') }}">
<style>
    .buttongroup button{
        font-size: 12px !important;
    }
</style>
@endsection

@section('AddOn')


@endsection

@section('isi')
<div class="second-bg w-100 h-100 p-3" style="min-width: 100%; min-height: 100%;">
    <div class="d-flex flex-column justify-content-start align-items-start">
        <h2 class="">List Pesanan</h2>
        <p>Dashboard ini disiapkan agar kamu lebih mudah melihat pesanan-pesanananmu</p>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item text-black">
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#">Pesanan Baru</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link text-black text-decoration-none" href="#">Pesanan Di Proses</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link text-black text-decoration-none" href="#">Pesanan Selesai</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link text-black text-decoration-none" href="#">Pesanan Ditolak</a>
            </li>
        </ul>
    </div>
    <div>
        <section class="d-flex gap-4 flex-column shadow">
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Id Pesanan</th>
                            <th>Nama User</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Total Bayar</th>
                            <th>Tanggal</th>
                            <th class="d-flex justify-content-center">Action</th>
                            <th >Detail</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content pending">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        <tr>
                            @foreach($dataPesanan as $data)
                            @if($data->status=='Pesanan Siap Diambil')
                            <td>{{{$data->id}}}</td>
                            <td>{{{$data->namaPemesan}}} </td>
                            <td>{{{$data->Keterangan}}}</td>

                            <td class="d-flex">
                                <div class="statusReport w-auto px-2 open bg-transparent border rounded-4 d-flex justify-content-center align-items-center">
                                    <p class="p-clear p-1">{{{$data->status}}}</p>
                                </div>
                            </td>
                            <td>{{{$data->TotalBayar}}}</td>

                            <td class="actionButton d-flex flex-row gap-2">
                                {{{$data->created_at}}}
                            </td>
                            <td>
                                <div class="buttongroup btn-group w-100 " role="group" aria-label="Basic mixed styles example">
                                    <button type="button" class="btn btn-outline-success"><p class="p-clear">Terima</p></button>
                                    <button type="button" class="btn btn-outline-danger"><p class="p-clear">Tolak</p>
                                    </button>
                                </div>
                            </td>



                            <td>
                                <a href="/Detil/{{{$data->id}}}" class="text-decoration-none text-black"> Detail</a>
                            </td>
                            @endif
                            @endforeach
                        </tr>
                        <p class="w-100 d-flex justify-content-center">Tidak ada pesanan lagi</p>

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