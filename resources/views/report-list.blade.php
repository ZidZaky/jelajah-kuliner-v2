@extends('layouts.layout2')

@section('title')
Report Account
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
            <p style="text-align: center;"><strong>❌ ACCOUNT REPORTS! ❌</strong></p>
        </div>
        <div class="upside" style="margin-right: 10px; margin-top: -4px">
            <!-- <p class="namaakun" style="text-align: right;">Hi, {{ session('account')['nama'] }} 👋</p> -->
            <!-- <p class="namaakun" style="text-align: right;">Hi, {{ session('account')['nama'] ?? 'Guest' }} 👋</p> -->

        </div>
    </div>

</div>
</div>
<hr id="hratas">
<div class="outer" style=" margin-top: 15px;">
    <div class="batas">
        @if ($reports->count() > 0)
        @foreach ($reports as $rep)
        @php
        $account = \App\Models\Account::where('id', $rep->idPengguna)->first();
        // echo var_dump($account)
        @endphp

        <div class="card" style="width: 500px">
            <img src="https://i.pinimg.com/236x/0d/c1/ba/0dc1babea2221d912247ca059e1231dd.jpg"
                alt="this should be the User's Profile Picture tho" class="profilePict">

            <div class="desc" style="display: flex; flex-direction: column;">
                <div class="info">
                    <h5 class="np" style="text-align: center; margin-top: 5px"><strong>{{ $account->nama }}</strong></h5>
                    <p class="deskhusus" style="text-align: center; margin-top: -10px;">Kode Pesanan: {{ $rep->idPesanan }} || Jumlah Pelapor: {{ $rep->idPelapor }}</p>
                    <p class="hrg" style="text-align: center; margin-top: 15px">" {{ $rep->alasan }} "</p>
                </div>
                <div class="reportButton">
                    @if ($account->status != "alert")
                    <button class="btn btn-danger" style="width: auto;" onclick="confirmBan('{{ $rep->id }}')">Ban</button><br>

                    @else
                    <button class="btn btn-success" style="width: auto;" onclick="confirmUnBan('{{ $rep->id }}')">unBan</button><br>
                    @endif

                    <form action="{{ route('report.destroy', $rep->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning" style="width: auto;" onclick="deletereport('{{ $rep->id }}')">Clear Report</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <p class="namap" style="text-align: center;">Semua Baik2 Saja!</p>
        @endif
        {{-- this is the 2nd update for the card, you mothersucker! --}}
        {{-- @if ($reports->count() > 0)
                @foreach ($reports as $rep)
                    @php
                        $account = \App\Models\Account::where('id', $rep->idPengguna)->first();
                        // echo var_dump($account)
                    @endphp
                    <div class="x">
                        <div>
                            <img src="https://i.pinimg.com/236x/0d/c1/ba/0dc1babea2221d912247ca059e1231dd.jpg"
                                alt="this should be the User's Profile Picture tho" class="xImg">
                        </div>
                        <div class="xDesc">
                            <p class="np" style="text-align: center; margin-top: 5px"><strong>{{ $account->nama }}</strong></p>
        <p class="deskhusus" style="text-align: center; margin-top: -10px;">Kode Pesanan: {{ $rep->idPesanan }}</p>
        <p class="deskhusus" style="text-align: center; margin-top: 0px;">Pelapor: {{ $rep->idPelapor }}</p>
        <p class="hrg" style="text-align: center; margin-top: 15px">{{ $rep->alasan }}</p>
    </div>
    <div class="xButt">
        @if ($account->status != "Banned")

        <button class="btn btn-danger"
            style="width: auto; margin-top: 5px; margin-left: 5px" onclick="confirmBan('{{ $rep->id }}')">Ban</button><br>
        @else
        <button class="btn btn-success"
            style="width: auto; margin-top: 3px; margin-left: 5px" onclick="confirmUnBan('{{ $rep->id }}')">unBan</button><br>
        @endif
        <form action="{{ route('report.destroy', $rep->id) }}" method="POST" style="width: 100%;">
            @csrf
            @method('DELETE')
            <button class="btn btn-warning" style="width: auto; margin-top: 3px; margin-left: 5px"
                onclick="deletereport('{{ $rep->id }}')">Clear
                Report</button>
        </form>
    </div>
</div>
@endforeach
@else
<p class="namap" style="text-align: center;">Semua Baik2 Saja!</p>
@endif --}}

{{-- below is original --}}
{{-- @if ($reports->count() > 0)
                        @foreach ($reports as $rep)
                            @php
                                $account = \App\Models\Account::where('id', $rep->idPengguna)->first();
                                // echo var_dump($account)
                            @endphp
                            <div class="card">
                                <div class="inCard" id="theImage">
                                    <img src="https://i.pinimg.com/236x/0d/c1/ba/0dc1babea2221d912247ca059e1231dd.jpg"
                                        alt="">
                                </div>
                                <div class="inCard" id="mid">
                                    <div class="button-only" style=" display: flex; flex; flex-direction:row;">


                                        @if ($account->status == 'Banned')
                                            <button class="btn btn-success" style="width: 100%;"
                                                onclick="confirmUnBan('{{ $rep->id }}')">unban User</button>
@else
<button class="btn btn-danger" style="width: 100%;"
    onclick="confirmBan('{{ $rep->id }}')">Ban
    User!</button>
@endif
<form action="{{ route('report.destroy', $rep->id) }}" method="POST" style="width: 100%;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-success" style="width: 100%;" onclick="return confirm('Apakah kamu yakin untuk Melakukan Hapus Report ini?')">Delete Report</button>
</form>

</div>
<p class="np">{{ $account->nama }}</p>
<p class="deskhusus">Kode Pesanan : {{ $rep->idPesanan }}, Pelapor :
    {{ $rep->idPelapor }}

</p>
<p class="hrg">{{ $rep->alasan }}</p>

</div>
</div>
@endforeach
@else
<p class="namap" style="text-align: center;">Semua Baik2 Saja!</p>
@endif --}}
</div>
</div>
</div>
<script>
    function confirmBan(id) {
        if (confirm("Apakah kamu yakin untuk Melakukan Ban Kepada Pengguna ini?")) {
            window.location.href = "/banUser/" + id;
        }
    }

    function confirmUnBan(id) {
        if (confirm("Apakah kamu yakin untuk Melakukan UnBan Kepada Pengguna ini?")) {
            window.location.href = "/unbanUser/" + id;
        }
    }

    function deletereport(id) {
        if (confirm("Apakah kamu yakin untuk Melakukan Hapus Report ini?")) {
            window.location.href = "report/" + id + "/delete/";
        }
    }
</script>
@endsection