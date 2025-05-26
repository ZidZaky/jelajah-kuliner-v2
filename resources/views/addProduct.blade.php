@extends('layouts.layout2')

@section('title')
    ADDPRODUCT || JELAJAHKULINER
@endsection

@section('css')
    <link rel="stylesheet" href="/css/addProduct.css">
@endsection

@section('main')
    <div class="container" >
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center" style="color: #F08A5D"><strong>TAMBAHKAN PRODUKMU!</strong></h5><br>
                <form method="POST" action="/produk" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="namaProduk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="namaProduk" name="namaProduk"
                            placeholder="Nama Produk">
                    </div>

                    <div>
                        <label for="roleProduk" class="form-label">Jenis Produk</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenisProduk" id="jenisProduk"
                                value="Makanan">
                            <label class="form-check-label" for="Makanan">Makanan</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenisProduk" id="jenisProduk"
                                value="Minuman">
                            <label class="form-check-label" for="Minuman">Minuman</label>
                        </div>
                    </div><br>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="10"></textarea>
                    </div>

                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="inputHarga" class="form-label">Harga Produk</label><br>
                            <div class="d-flex align-items-center">
                                <span>Rp. </span>
                                <span class="px-2"> <input type="number" id="inputHarga" class="form-control"
                                        name="harga" placeholder="Input Harga Produk">
                                </span>
                                <span>,00</span>
                            </div>
                        </div>
                    </div><br>

                    <div class="mb-3">
                        <label for="stokAwal" class="form-label">Stok Awal</label>
                        <input type="number" class="form-control" id="stokAwal" name="stok"
                            placeholder="Stok Awal Produk">
                    </div>

                    <div class="mb-4">
                        <label for="foto" class="form-label">Foto Diri</label>
                        <input class="form-control" name="fotoProduk" type="file" id="foto">
                    </div>
                    <br>

                    <input type="text" name="idPKL" id="idPKL" value="{{ session('pkl')['id'] }}" readonly hidden>
                    <input type="text" name="idAccount" id="idAccount" value="{{ session('pkl')['id'] }}" readonly hidden>

                    <button type="submit" class="btn btn-success d-grid gap-2 col-6 mx-auto">Tambahkan Produk!</button>
                </form>
            </div>
        </div>
    </div>
    {{-- {{ dd(session())}} --}}
@endsection
