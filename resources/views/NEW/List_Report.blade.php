@extends('layouts.layout')

@section('css')
    <link rel="stylesheet" href="{{ auto_asset('css/List.css') }}">

@endsection

@section('AddOn')


@endsection

@section('isi')
<div class="second-bg w-100 h-100 p-3" style="min-width: 100%; min-height: 100%;">
    <div class="d-flex flex-column justify-content-start align-items-start">
        <h2 class="">List Account Reported</h2>
        <p>Dashboard ini disiapkan agar kamu lebih mudah melihat siapa saja yang dilaporkan</p>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item text-black">
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#">Need Action</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link text-black text-decoration-none" href="#">Accepted Report</a>
            </li>
            <li class="nav-item text-black">
                <a class="nav-link text-black text-decoration-none" href="#">Rejected Report</a>
            </li>
        </ul>
    </div>
    <div>
        <section class="d-flex gap-4 flex-column shadow">
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>User Dilaporkan</th>
                            <th >Alasan</th>
                            <th>Status Report</th>
                            <th>User Pelapor</th>
                            <th >Action</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        @for($i=0;$i<=20;$i++)
                            <tr>
                            <td>Alifa Nakila</td>
                            <td>Memesan tapi tidak diambil </td>
                            <td class="d-flex">
                                <div class="statusReport w-auto px-2 open bg-transparent border rounded-4 d-flex justify-content-center align-items-center">
                                    <p class="p-clear p-1">Open</p>
                                </div>
                            </td>
                            <td>Mamang Adi</td>
                            <td class="actionButton d-flex flex-row gap-2">
                                <button type="button" class="btn btn-dark">
                                    <p class="p-clear">Accept Report</p>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    <p class="p-clear">Reject Report</p>
                                </button>

                            </td>
                            <td>
                                <a href="" class="text-decoration-none text-black"> Detail</a>
                            </td>
                            </tr>
                            @endfor
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