@extends('layouts.layout2')

@section('title')
DETIL PESANAN!
@endsection

@section('css')
<link rel="stylesheet" href="/css/pesan.css">
@endsection

@section('main')
<div class="all">
    <div class="up border border-bottom d-flex justify-content-between align-items-center">
        <a href="/dashboard"><button class="btn btn-danger">Back to Dashboard</button></a>
        <p class="namaakun m-0">Mau ngerjakan orderan siapa, {{ session('account')['nama'] }}? 🤔</p>
    </div>
    <div class="nmpkl">
        @foreach ($produks as $p)
        @php
        $produk = App\Models\Produk::where('id', $p->idProduk)->first();
        $pkl = App\Models\PKL::where('id', $produk->idPKL)->first();
        @endphp
        @endforeach
    </div>

    <div class="showmenu" style="padding-top: 5px; padding-bottom: 5px">
        <div class="kiri border border-right" style="width: 100%;">
            <h3 class="namap" style="border-bottom: 1px solid #ccc;"><strong>{{ $pkl->namaPKL }}</strong></h3>
            <p class="deskri">{{ $pkl->desc }}</p>
            @if (count($produks) > 0)
            @foreach ($produks as $p)
            @php
            $produk = App\Models\Produk::where('id', $p->idProduk)->first();
            $jmlhtotal = 0;
            @endphp
            @if ($p->JumlahProduk != 0)
            <div class="card">
                <div class="inCard" id="theImage">
                    <img src="/storage/{{$produk->fotoProduk}}"
                        alt="" style="border: black 1px solid; border-radius: 40px; max-width: 130px; max-height: 130px">
                </div>
                <div class="inCard" id="mid">
                    <p class="np">{{ $produk->namaProduk }}</p>
                    <p class="Des">{{ $produk->namaProduk }}</p>
                    <p class="hrg">Rp. {{ $produk->harga }}</p>
                </div>
                <div class="inCard" id="leftt">
                    <p>Quantity: {{ $p->JumlahProduk }}</p>
                </div>
            </div>
            @endif
            @endforeach
            @else
            <p class="namap" style="text-align: center">Produk Kosong</p>
            @endif
            @if ($pesan->status == 'Pesanan Baru' && @session('account')['status'] == 'PKL')
            <br>
            <div class="d-flex justify-content-between">
                <button class="btn btn-danger me-2" onclick="confirmTolakPesanan('{{ $pesan->id }}')">
                    Tolak Pesanan
                </button>

                <button class="btn btn-success" onclick="confirmTerimaPesanan('{{ $pesan->id }}')">
                    Terima Pesanan
                </button>
            </div>
            <br>
            @endif
            @if ($pesan->status == 'Pesanan Baru' && $pesan->idAccount == session('account')['id'])
            <br>
            @endif

        </div>

        <div class="kanan border border-right d-flex flex-column justify-content-between"
            style="height: 100%; width: 50%; margin-left: 5px;">
            <p style="margin-top: 1vh; margin-bottom: 1vh; text-align: center;"><strong>(👉ﾟヮﾟ)👉
                    {{ now()->format('l, d F Y') }} 👈(ﾟヮﾟ👈)</strong></p>
            <table id="tabelStruk" class="table" style="position: absolute; width: 33%; margin-top: 5vh">
                <thead>
                    <tr>
                        <th>ID PRODUK</th>
                        <th>Nama Produk</th>
                        <th>Quantity</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    @foreach ($produks as $p)
                    @php
                    $produk = App\Models\Produk::where('id', $p->idProduk)->first();
                    @endphp
                    <tr>
                        @if ($p->JumlahProduk != 0)
                        <td>{{ $p->idProduk }}</td>
                        <td>{{ $produk->namaProduk }}</td>
                        <td>{{ $p->JumlahProduk }}</td>
                        <td>{{ $p->JumlahProduk * $produk->harga }}</td>
                        @endif
                    </tr>
                    @php
                    $jmlhtotal += $p->JumlahProduk;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="3">Total Quantity</td>
                        <td id="totalQuantity">{{ $jmlhtotal }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Total Keseluruhan</td>
                        <td id="totalKeseluruhan">{{ $pesan->TotalBayar }}</td>
                    </tr>
                </tfoot>
            </table>
            <div style="margin-top: 30vh; padding-left:10px; font-weight:600;">
                <label for="keterangan">Status Pesanan</label><br>
                <input type="text" style=" width:250px;" name="keterangan" id="keterangan" value="@php
                        if(@session('account')['status'] == 'PKL'){
                            echo $pesan->status;
                        }
                        else{
                            if($pesan->status=='Pesanan Baru'){
                                echo 'Menunggu Pesanan Diterima';
                            }
                            else{
                                echo $pesan->status;
                            }
                        }


                        @endphp" readonly>
            </div>
            <div style="margin-bottom: 20vh; padding-left:10px;">
                <label for="keterangan">Keterangan Tambahan (Opsional):</label><br>
                <input type="text" name="keterangan" id="keterangan" placeholder="Contoh: Tidak pedas ya mas!"
                    value="{{ $pesan->Keterangan }}" style="width: 80%; height: 5vh;">
            </div>
            @php
            $pkl = \App\Models\PKL::where('idAccount', session('account')['id'])->first();
            @endphp
            @if ($pkl)
            @if ($pesan->status == 'Pesanan Diproses' && @$pesan->idPKL == $pkl->id)
            <br>
            <div id="butstatus">
                <button class="btn" onclick="selesaiPesanan('{{ @$pesan->id }}')">
                    Pesanan Selesai
                </button>
            </div>

            <br>
            @endif
            @endif

            <div style="display: flex; justify-content: center; gap: 10px; padding-bottom:20px;">
                @if ($pesan->status == 'Pesanan Baru')
                <button class="btn btn-danger" style="width: 40%;"
                    onclick="confirmBatalPesanan('{{ $pesan->id }}')">Batalkan Pesanan!</button>
                @endif
                @php
                $report = \App\Models\Report::where('idPesanan', $pesan->id)->first();
                @endphp
                @if (session('account')['status'] == 'PKL' && $pesan->status != 'Pesanan Selesai' && !$report)
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop" style="width: 40%">
                    Laporkan Pelanggan!
                </button>
                @php
                // echo $pesan->idAccount;
                $account = \App\Models\Account::where('id', $pesan->idAccount)->first();
                // echo var_dump($account)
                @endphp
                <!-- Modal -->
                <div class="modal
                                fade" id="staticBackdrop"
                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Laporkan Pembeli :
                                    {{ $account->nama }}
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="/report" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <input type="number" name="idPengguna" value="{{ $pesan->idAccount }}"
                                        id="" hidden>
                                    <input type="number" name="idPesanan" value="{{ $pesan->id }}"
                                        id="" hidden>
                                    <input type="number" name="idPelapor" value="{{ $pesan->idPKL }}"
                                        id="" hidden>

                                    {{-- dropdown alasan pelaporan --}}
                                    {{-- <label for="alasan">Mengapa?</label><br>
                                            <select name="alasan" id="alasan" style="height: 4vh">
                                                <option value="1">== Pilih Alasan Pelaporan ==</option>
                                                <option value="2">Penipuan</option>
                                                <option value="3">Penggunaan Bahasa Kasar</option>
                                                <option value="4">Pesanan Aneh</option>
                                                <option value="5">Permintaan Pelanggan</option>
                                            </select><br><br> --}}

                                    <label for="alasan">Berikan Alasanmu! (optional)</label><br>
                                    <input type="text" name="alasan" id="alasan" style="height: 4vh">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Laporkan!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<style>
    #butstatus {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #butstatus>button {
        background-color: green;
        width: fit-content;
        border-radius: 10px;
        padding: 5px 10px;
        color: white;
    }

    #keterangan {
        background-color: rgb(0, 0, 0, 0);
        border: none;
        outline: none;
        margin-left: 10px;
    }

    #keterangan:active {
        border: none;
        outline: none;
    }
</style>
<script>
    function confirmTerimaPesanan(id) {
        if (confirm("Apakah kamu yakin untuk menerima pesanan ini?")) {
            window.location.href = "/terimaPesanan/" + id;
        }
    }

    function selesaiPesanan(id) {
        if (confirm("Apakah kamu yakin Pesanan Sudah Selesai?")) {
            window.location.href = "/selesaiPesanan/" + id;
        }
    }

    function confirmTolakPesanan(id) {
        if (confirm("Apakah kamu yakin untuk menolak pesanan ini?")) {
            window.location.href = "/tolakPesanan/" + id;
        }
    }

    function confirmBatalPesanan(id) {
        if (confirm("Apakah kamu yakin untuk Membatalkan pesanan ini?")) {
            window.location.href = "/batalPesanan/" + id;
        }
    }
</script>
@endsection