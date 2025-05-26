@extends('layouts.layout2')

@section('title')
    EDIT PROFILE!
@endsection

@section('css')
    <link rel="stylesheet" href="css/profile.css">
    <style>
        .modal-content {
            background-color: #9C242C;
        }
    </style>
@endsection

@section('isiAlert')
    @if((session('alert'))!=null)
        
            @php echo session('alert'); @endphp
    @endif
@endsection

@php
    $account = App\Models\Account::find(session('account')['id']);
@endphp

@section('main')
    <div id="penghalang" style="display: none;">

    </div>
    <div class="modal" style="display: none;" id="edite">
        <div class="modal-dialog" style="color: white">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close" onclick="show('profile')"></button>
                </div>

                <form method="POST" action="/account/{{ $account->id }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ $account->nama }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $account->email }}">
                        </div>

                        <div class="mb-3">
                            <label for="noHP" class="form-label">Nomor Telpon</label>
                            <input type="number" class="form-control" id="nohp" name="nohp"
                                value="{{ $account->nohp }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="show('profile')">batal</button>
                        <button type="submit" class="btn btn-success" onclick="show('profile')">simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center" style="color: #F08A5D"><strong>MY PROFILE</strong></h5><br>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ $account->nama }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Akun</label>
                        <input type="text" class="form-control" id="status" name="status"
                            value="{{ $account->status }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $account->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="noHP" class="form-label">Nomor Telpon</label>
                        <input type="number" class="form-control" id="noHP" name="noHP"
                            value="{{ $account->nohp }}" readonly>
                    </div>
                    <button type="button" id="profilee" class="btn btn-warning" data-bs-target="#staticBackdrop" onclick="show('edit')">
                        edit profile
                    </button>
            </div>
        </div>
    </div>
    <script>
        function show(apa){
            let blok = document.getElementById('penghalang');
            let edit = document.getElementById('edite');

                edit.style.display="none";
                blok.style.display="none";
            if(apa=='edit'){
                edit.style.display="flex";
                blok.style.display="flex";

            }
        }
    </script>
    <style>
        #penghalang{
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 50%;
            z-index: 200;
            /* background-color: white; */
        }
    </style>
@endsection
