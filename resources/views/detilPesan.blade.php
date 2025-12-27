@extends('layouts.layout')

@section('title')
DETIL PESANAN!
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/pesan.css') }}">
@endsection

@section('main')
<div class="all">
    <div class="up border border-bottom d-flex justify-content-between align-items-center">
        <a href="{{ route('dashboard.index') }}">
            <button class="btn btn-danger">Back to Dashboard</button>
        </a>
        <p class="namaakun m-0">
            Mau ngerjakan orderan siapa, {{ session('account')['nama'] }}? 🤔
        </p>
    </div>

    {{-- INFO PKL --}}
    <div class="nmpkl">
        @foreach ($produks as $p)
            @php
                $produk = App\Models\Produk::where('id', $p->idProduk)->first();
                $pkl = App\Models\PKL::where('id', $produk->idPKL)->first();
            @endphp
        @endforeach
    </div>

    <div class="showmenu" style="padding-top:5px;padding-bottom:5px">
        {{-- KIRI --}}
        <div class="kiri border border-right" style="width:100%;">
            <h3 class="namap" style="border-bottom:1px solid #ccc;">
                <strong>{{ $pkl->namaPKL }}</strong>
            </h3>
            <p class="deskri">{{ $pkl->desc }}</p>

            {{-- PRODUK --}}
            @if (count($produks) > 0)
                @php $jmlhtotal = 0; @endphp
                @foreach ($produks as $p)
                    @php $produk = App\Models\Produk::where('id', $p->idProduk)->first(); @endphp
                    @if ($p->JumlahProduk != 0)
                        <div class="card">
                            <div class="inCard">
                                <img src="{{ asset('storage/'.$produk->fotoProduk) }}"
                                     style="border:1px solid black;border-radius:40px;max-width:130px;">
                            </div>
                            <div class="inCard">
                                <p class="np">{{ $produk->namaProduk }}</p>
                                <p class="Des">{{ $produk->namaProduk }}</p>
                                <p class="hrg">Rp. {{ $produk->harga }}</p>
                            </div>
                            <div class="inCard">
                                <p>Quantity: {{ $p->JumlahProduk }}</p>
                            </div>
                        </div>
                        @php $jmlhtotal += $p->JumlahProduk; @endphp
                    @endif
                @endforeach
            @else
                <p class="namap text-center">Produk Kosong</p>
            @endif

            {{-- BUTTON PKL --}}
            @if ($pesan->status == 'Pesanan Baru' && session('account')['status'] == 'PKL')
            <div class="d-flex justify-content-between my-3">
                <button class="btn btn-danger" onclick="tolakPesanan('{{ $pesan->id }}')">
                    Tolak Pesanan
                </button>
                <button class="btn btn-success" onclick="terimaPesanan('{{ $pesan->id }}')">
                    Terima Pesanan
                </button>
            </div>
            @endif
        </div>

        {{-- KANAN --}}
        <div class="kanan border border-right d-flex flex-column justify-content-between"
             style="width:50%;margin-left:5px;">

            <p class="text-center fw-bold">
                {{ now()->translatedFormat('l, d F Y') }}
            </p>

            {{-- STRUK --}}
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produks as $p)
                        @php $produk = App\Models\Produk::find($p->idProduk); @endphp
                        @if ($p->JumlahProduk != 0)
                        <tr>
                            <td>{{ $p->idProduk }}</td>
                            <td>{{ $produk->namaProduk }}</td>
                            <td>{{ $p->JumlahProduk }}</td>
                            <td>{{ $p->JumlahProduk * $produk->harga }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total Quantity</td>
                        <td>{{ $jmlhtotal }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Total Bayar</td>
                        <td>{{ $pesan->TotalBayar }}</td>
                    </tr>
                </tfoot>
            </table>

            {{-- STATUS --}}
            <div class="px-3">
                <label>Status Pesanan</label>
                <input type="text" value="{{ $pesan->status }}" readonly>
            </div>

            {{-- SELESAI --}}
            @php $pklLogin = App\Models\PKL::where('idAccount', session('account')->id)->first(); @endphp
            @if ($pklLogin && $pesan->status == 'Pesanan Diproses')
                <div id="butstatus">
                    <button onclick="selesaiPesanan('{{ $pesan->id }}')">
                        Pesanan Selesai
                    </button>
                </div>
            @endif

            {{-- BATAL / LAPOR --}}
            <div class="d-flex justify-content-center gap-2 pb-4">
                @if ($pesan->status == 'Pesanan Baru')
                    <button class="btn btn-danger"
                        onclick="batalPesanan('{{ $pesan->id }}')">
                        Batalkan Pesanan
                    </button>
                @endif

                @if (session('account')['status'] == 'PKL')
                <button class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#laporModal">
                    Laporkan Pelanggan
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- MODAL LAPOR --}}
<div class="modal fade" id="laporModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('report.store') }}">
            @csrf
            <input type="hidden" name="idPengguna" value="{{ $pesan->idAccount }}">
            <input type="hidden" name="idPesanan" value="{{ $pesan->id }}">
            <input type="hidden" name="idPelapor" value="{{ $pesan->idPKL }}">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Laporkan Pelanggan</h5>
                </div>
                <div class="modal-body">
                    <input type="text" name="alasan" class="form-control"
                        placeholder="Alasan laporan">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-danger" type="submit">Laporkan</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- JS --}}
<script>
function terimaPesanan(id){
    if(confirm('Terima pesanan ini?')){
        window.location.href = "{{ route('pesanan.terima') }}?id=" + id;
    }
}
function tolakPesanan(id){
    if(confirm('Tolak pesanan ini?')){
        window.location.href = "{{ route('pesanan.tolak') }}?id=" + id;
    }
}
function batalPesanan(id){
    if(confirm('Batalkan pesanan ini?')){
        window.location.href = "{{ route('pesanan.batal') }}?id=" + id;
    }
}
function selesaiPesanan(id){
    if(confirm('Pesanan selesai?')){
        window.location.href = "{{ route('pesanan.selesai') }}?id=" + id;
    }
}
</script>
@endsection
