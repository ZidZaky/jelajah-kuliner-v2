@extends('NEW.EVI.base-page')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/?.css') }}">

<style>


</style>

@endsection

@section('AddOn')


@endsection

@section('isi')
<div class="d-flex w-100 h-100 flex-column justify-content-center align-items-center">
    <div class="w-100 d-flex flex-row justify-content-start align-items-center">
        <p>Profile</p>
        <button type="button" class="btn btn-outline-success d-flex flex-row gap-1">
            <p class="p-clear">Customer</p>
            <i class="bi text-success bi-chevron-down"></i>
        </button>
    </div>

    <div class="d-flex flex-column  flex-md-row ">
        <div class="w-50">
            <i class="bi bi-pencil-square"></i>
            <div class="w-100">
                <div class="h-100" style="width:90%;">
                    <img class="w-100 h-100" src="{{ auto_asset('assets/profile-icon.png') }}" alt="">
                </div>
            </div>
            <p>Zhao Linghe</p>
        </div>
        <div>
            <div class="header-profile">
                <h1>Bio & other details</h1>
                <i class="bi bi-pen-fill"></i>
            </div>
            <div class="d-flex flex-column gap-3">
                @for($i=0;$i<=3;$i++)
                    <div class="d-flex flex-column">
                    <p class="p-clear">Nama Lengkap</p>
                    <p class="p-clear">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Non reiciendis expedita odio tempora accusamus repudiandae? Soluta ipsam quisquam quod laborum. Quaerat earum obcaecati corrupti at aspernatur. Odio eius exercitationem ducimus.</p>
            </div>
            @endfor
        </div>
    </div>
</div>
</div>

@endsection

@section('js')
<script>

</script>
@endsection