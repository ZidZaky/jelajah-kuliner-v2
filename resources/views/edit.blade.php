@extends('layouts.layout')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="css/register.css">
@endsection

@section('isiAlert')
    @if((session('alert'))!=null)
        
            @php echo session('alert'); @endphp
    @endif
@endsection

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Your Profile</h5>
                <form method="POST" action="/account/{{ $account->id }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="mb-3">
                        <label for="inputFirstName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="inputFirstName" name="nama" value="{{$account->nama}}">
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" value="{{$account->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="inputPhone" class="form-label">Nomor Handphone</label>
                        <input type="tel" class="form-control" id="inputPhone" name="nohp" value="{{$account->nohp}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
