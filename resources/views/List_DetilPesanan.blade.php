@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/List.css') }}">

<style>
    .semiHeader p {
        font-size: 12px !important;
    }

    .tbl-content {
        min-height: 200px;
        height: 200px !important;

    }

    .widthFullSeparuh {
        width: 25%;
    }

    .setengahFull {
        width: 35% !important;
    }

    @media (max-width: 768px) {
        .widthFullSeparuh {
            width: 100% !important;
        }

        .setengahFull {
            width: 100% !important;
        }
    }
</style>
@endsection

@section('AddOn')
@endsection

@section('isi')
<div class="second-bg w-100 h-100 p-3" style="min-width: 100%; min-height: 100%;">
    <div class="w-100 pe-3 d-flex flex-column flex-md-row justify-content-between">
        <div class="semiHeader d-flex flex-column justify-content-start align-items-start">
            <h2 class="">Detil Pesanan id #{{{$pesan->id}}}</h2>
            <div class="d-flex flex-row gap-2 w-100">
                <p style="width: 100px; min-width: 100px; max-width: 100px;">Pemesan</p>
                <p>:</p>
                @if(session('account')->status=='PKL')

                <p>{{{$pesan->namaPemesan}}}</p>
                @else
                <p>{{{$pesan->namaPKL}}}</p>
                @endif
            </div>
            <div class="d-flex flex-row gap-2 w-100">
                <p style="width: 100px; min-width: 100px; max-width: 100px;">Tanggal: </p>
                <p>:</p>
                <p>{{{$pesan->created_at}}}</p>
            </div>
            <div class="d-flex flex-row gap-2 w-90">
                <p style="width: 100px; min-width: 100px; max-width: 100px;">Keterangan</p>
                <p>:</p>
                <p>{{{$pesan->Keterangan}}}</p>
            </div>
        </div>
        @if(session('account')->status=='PKL')
        <div class="widthFullSeparuh d-flex gap-4 justify-content-center align-items-center">
            @if($pesan->status=='Pesanan Baru')
            <button class="btn btn-success px-4" onclick="window.location.href='/terimaPesanan/?id={{{$pesan->id}}}&wht=DetilPesanan'">Terima Pesanan</button>
            <button class="btn btn-success px-4" onclick="window.location.href='/tolakPesanan/?id={{{$pesan->id}}}&wht=DetilPesanan'">Tolak Pesanan</button>
            @elseif($pesan->status=='Pesanan Diproses')
            <button class="btn btn-success px-4" onclick="window.location.href='/siapDiambilPesanan/?id={{{$pesan->id}}}&wht=DetilPesanan'">Pesanan Siap Diambil</button>
            @elseif($pesan->status=='Pesanan Siap Diambil')
            <button class="btn btn-success px-4" onclick="window.location.href='/selesaiPesanan/?id={{{$pesan->id}}}&wht=DetilPesanan'">Selesaikan Pesanan</button>
            @elseif($pesan->status=='Pesanan Selesai')
            @endif
        </div>
        @else
            @if($pesan->status=='Pesanan Baru')

        <div class="widthFullSeparuh d-flex gap-4 justify-content-center align-items-center">
            <button type="button" class="btn btn-secondary px-4" onclick="window.location.href='/batalPesanan/?id={{{$pesan->id}}}&wht=DetilPesanan'">Batalkan Pesanan</button>
        </div>
        @endif
        @endif
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item text-black">
                @if($pesan->status!='Pesanan Ditolak')
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#">{{{$pesan->status}}}</a>
                @else
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#" disabled>{{{$pesan->status}}}</a>
                @endif
            </li>
        </ul>
    </div>
    <div>
        <section class="d-flex gap-4 flex-column shadow">
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th class="text-center align-middle">Nama Produk</th>
                            <th class="text-center align-middle">QTY</th>
                            <th class="text-center align-middle">Harga Satuan</th>
                            <th class="text-center align-middle">Total</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        @foreach($produks as $item)
                        <tr>
                            <td class="text-center align-middle">{{{$item->nama}}}</td>
                            <td class="text-center align-middle">{{{$item->JumlahProduk}}}</td>
                            <td class="currency text-center align-middle">{{{$item->hargaSatuan}}}</td>
                            <td class="currency text-center align-middle">{{{intval($item->hargaSatuan)*intval($item->JumlahProduk)}}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead class="">
                        <tr class="">
                            <th class="text-center align-middle">Total Transaksi</th>
                            <th class="text-center align-middle"></th>
                            <th class="text-center align-middle"></th>
                            <th class="TotalCurrency text-center align-middle">0</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </div>
    @if(session('account')->status=='PKL')

    @if($pesan->status!='Pesanan Selesai'&&$pesan->Dilaporkan!="Ya")

    <div class="w-100 d-flex justify-content-center align-items-center">
        <button class="btn btn-warning px-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Laporkan Pesanan</button>
    </div>
    <div class="setengahFull border-0 shadow-none offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header bg-prim-dark cl-white">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Laporkan Customer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex justify-content-center align-items-center">
            <form action="{{ route('report.create') }}" method="POST" class="w-100 d-flex flex-column h-50 gap-3 justify-content-center align-items-center">
                @csrf
                <div class="form-floating">
                    <textarea class="form-control" name="alasan" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    <input type="text" class="d-none" name="idPengguna" id="" value="{{{$pesan->idAccount}}}">
                    <input type="text" name="idPesanan" class="d-none" id="" value="{{{$pesan->id}}}">
                    <input type="text" name="idPelapor" id="" class="d-none" value="{{{$pesan->idPKL}}}">
                    <label for="floatingTextarea2 cl-white">Alasan Dilaporkan</label>
                </div>
                <button type="submit" class="btn btn-warning">Submit Laporan</button>
            </form>
        </div>
    </div>

    @endif
    @endif
</div>


@endsection

@section('js')
<script src="{{ auto_asset('js/List.js') }}"></script>
<script>
    @if(session('alert') != null)
    successAlert("{{session('alert')[0]}}", "{{session('alert')[1]}}")
    @endif
    @if(session('erorAlert')!=null)
    erorAlert("{{session('erorAlert')[0]}}", "{{session('erorAlert')[1]}}")
    
    @endif
    Makeup()

    function Makeup() {
        let items = document.querySelectorAll('.currency')
        let sum = 0;
        items.forEach(e => {
            sum+=parseInt(e.textContent)
            e.textContent = formatRupiah(parseInt(e.textContent))
            console.log(e.textContent)
        })

        document.querySelector('.TotalCurrency').textContent=formatRupiah(sum);
    }
</script>

@endsection