@extends('layouts.layout2')

@section('title')
List Account
@endsection

@section('css')
<link rel="stylesheet" href="css/dataPKL.css">
@endsection

@section('isiAlert')
    @if((session('alert'))!=null)
        
            @php echo session('alert'); @endphp
    @endif
@endsection

@section('main')

<div class="content">
    <div class="up" style=" display: flex; justify-content: space-between;">
        <div class="back" style="text-align: center; margin-left: 10px; margin-top: -3px;">
            <button class="btn btn-danger" style="margin: 0 auto;" onclick="window.location.href='/dashboard'; return false;">Back</button>
        </div>
        <div class="nmpkl" style="margin-top: 4px;">
            <p style="text-align: center;"><strong>📃 ACCOUNT LIST! 📃</strong></p>
        </div>
        <div class="upside" style="margin-right: 10px; margin-top: -4px">
            <p class="namaakun" style="text-align: right;">Hi, {{ session('account')['nama'] }} 👋</p>
        </div>
    </div>

    <hr id="hratas">
    <div class="batas" style="margin-top: 15px">
        @if ($account->count() > 0)
        @foreach ($account as $a)
        <div class="card" style="width: 500px">
            <img src="https://i.pinimg.com/236x/0d/c1/ba/0dc1babea2221d912247ca059e1231dd.jpg"
            alt="this should be the User's Profile Picture tho" class="profilePict2"
            style="
            @if($a->status == 'Pelanggan') box-shadow: 0px 0px 20px rgb(0, 255, 0);
            @elseif($a->status == 'PKL') box-shadow: 0px 0px 20px rgb(0, 0, 255);
            @else box-shadow: 0px 0px 20px rgb(0, 0, 0);
            @endif">

            <div class="desc" style="display: flex; flex-direction: column;">
                <div class="info" style="padding: 0 10px;">
                    <h5 class="listNama" style="margin-top: 5px; margin-bottom: 15px; text-align: center"><strong>{{ $a->nama }}</strong></h5>
                    <p class="listText" style="margin-bottom: 2px"><strong>Email: </strong> {{ $a->email }}</p>
                    <p class="listText" style="margin-bottom: 2px"><strong>Role: </strong> {{ $a->status }}</p>
                    <p class="listText"><strong>Nomor HP: </strong> {{ $a->nohp}}</p>
                </div>
            </div>
        </div>
        @endforeach
        @else
            <p class="namap" style="text-align: center;">Semua Baik2 Saja!</p>
        @endif
        {{-- @if ($account->count() > 0)
            @foreach ($account as $a)

                <div class="card border-danger text-bg-light mb-4" style="max-width: 500px;">
                    <div class="row g-0">
                        <div class="col-md-4 mt-3">
                            <img src="https://i.pinimg.com/236x/0d/c1/ba/0dc1babea2221d912247ca059e1231dd.jpg"
                                class="img-fluid rounded-start" alt="pernahkah kau merasa">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $a->nama }}</h5>
                                <p class="card-text">{{ $a->email }}</p>
                                <p class="card-text">{{ $a->status }}</p>
                                <p class="card-text">{{ $a->nohp }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="namap" style="text-align: center;">Kosong? astagfirullah</p>
        @endif --}}

    </div>
    @endsection
