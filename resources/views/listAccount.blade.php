@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/List.css') }}">


@endsection

@section('AddOn')


@endsection
@section('isi')

<div class="second-bg w-100 h-100 p-3" style="min-width: 100%; min-height: 100%;">
    <div class="d-flex flex-column justify-content-start align-items-start">
        <h2 class="">List Account</h2>
        <p>Dashboard ini disiapkan agar kamu lebih mudah melihat siapa saja yang terdaftar</p>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item text-black">
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#">Active User</a>
            </li>
        </ul>
    </div>
    <div>
        <section class="d-flex gap-4 flex-column shadow">
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        @foreach ($account as $account)
                        <tr>
                            <td>{{ $account->nama }}</td>
                            <td>{{ $account->email }}</td>
                            <td>{{ $account->nohp }}</td>
                            <td class="d-flex">
                                <div class="statusReport w-auto px-2 open bg-transparent border rounded-4 d-flex justify-content-center align-items-center">
                                    <p class="p-clear p-1">{{ $account->status }}</p>
                                </div>
                            </td>
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