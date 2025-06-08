@extends('layouts.layout')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/dashboard-user.css') }}">

<style>
    .clean-number {
        appearance: textfield;
        /* Untuk sebagian besar browser */
        -moz-appearance: textfield;
        /* Firefox */
        -webkit-appearance: none;
        /* WebKit browsers */

        border: none;
        padding: 0;
        margin: 0;

        font: inherit;
        /* Gunakan font seperti elemen lain */
        color: inherit;

        width: auto;
        /* Lebar mengikuti konten */
        height: 100%;
        /* Atur sesuai konteks */

        background: transparent;
        /* Jika kamu ingin input tampak 'flat' */
    }

    /* Hilangkan spinner di WebKit */
    .clean-number::-webkit-inner-spin-button,
    .clean-number::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .contPesanan {
        >* {
            width: 49%;
        }
    }
</style>

@endsection

@section('AddOn')


@endsection

@section('isi')
<!-- <div class="contPesanan w-100 d-flex flex-row h-100 justify-content-between" style="display: flex; flex-direction: row;">
    <div class="d-flex flex-column position-relative h-auto">
        <div class="d-flex p-5 justify-content-center align-items-center">
            <h1 class="p-clear cl-prim-dark fw-bolder">PKL JAWA'S PRODUK</h1>
        </div>
        <div class="w-100 d-flex mb-5 justify-content-center align-items-center h-auto">
            <div class="p-3 area justify-content-evenly justify-content-md-between align-items-center products produks d-flex flex-row flex-wrap gap-4"
                style="width: fit-content; max-width: 90%;">
                @for($i=0;$i<=20;$i++)
                    <div class="produk{{{$i}}} align-items-center position-relative d-flex gap-2 flex-row justify-content-end align-items-end" style="height:170px; min-height: 110px; width: 470px;">
                    <div class="position-absolute z-2 gap-0 border border-danger shadow d-flex flex-wrap justify-content-between align-items-center right-0 p-1 bg-white border-left-top border-right-bottom" style="width:110px; height: 40px; bottom: -10px;">
                        <div class="tambahproduk{{{$i}}} d-flex awal w-50" onclick="showButton(this,'{{{$i}}}')">
                            <p class="p-clear lh-1 poppins fw-bolder cl-prim-dark" style="font-size: 12px;">TAMBAH PRODUK</p>
                        </div>
                        <button onclick="minus('{{{$i}}}')" class="minusButton{{{$i}}} border d-none justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;">
                            <i class="p-clear fs-5 bi bi-dash-lg"></i>
                        </button>
                        <input type="number" class="inputNumber{{{$i}}} d-none text-center clean-number border-0 p-0" data-qty="2" value="0" style="width: 30px; height: 100%;" name="" id="qty{{{$i}}}">
                        <button onclick="plus('{{{$i}}}','1',this)" class="plusButton{{{$i}}} border d-flex justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;">
                            <i class="p-clear fs-5 bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <img class="circle-preview position-absolute z-1 shadow" src="/assets/contoh.jpg" alt="" style="height: 75%; width: fit-content; left: 0;">
                    <div class="position-absolute shadow z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:87%; height:95%; max-height: 95%; min-height: 95%;  ">

                        <div class="contisi d-flex flex-column first-cl justify-content-end align-items-end w-50">
                            <p class="fw-bolder p-clear" style="font-size: 14px;">PENTOL GILA</p>
                        </div>
                        <div class="pe-1 text-justify first-cl" style="width: 80%; flex:1; ">
                            <div class="textDexscription scroll-bg-dark h-75" style="overflow: auto;">
                                <p class="text-justify p-clear" style="text-indent: 12px; font-size: 10px; text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae dolor fuga quaerat minima quos sit porro? Quis a incidunt eligendi fugiat nulla, libero nihil accusamus ducimus. Fugit exercitationem unde explicabo. aliquam deleniti? Aliquam fugiat similique, vitae consequuntur fugit doloremque perferendis quis quasi? Incidunt, quam! Laboriosam aut placeat esse consequuntur! Ea, velit?</p>
                            </div>
                            <div class="w-75 fw-bolder cl-white justify-content-start align-items-center">
                                <p class="p-clear">Rp. 10000,-</p>
                            </div>
                        </div>

                    </div>
            </div>
            @endfor
        </div>
    </div>
    <div class="d-flex bg-black flex-column">
        
    </div>
</div> -->


<div class="contPesanan d-flex justify-content-between flex-row gap-1 w-100 h-auto bg-success" style="min-height: 84.95vh;">
    <div class="d-flex flex-column h-100" style="min-height: 84.95vh; height: 100%; max-height: fit-content;">
        <div class="d-flex p-5 justify-content-center align-items-center">
            <h1 class="p-clear cl-prim-dark fw-bolder">PKL JAWA'S PRODUK</h1>
        </div>
        <div class="w-100 d-flex mb-5 justify-content-center align-items-center h-auto">
            <div class="p-3 area justify-content-evenly justify-content-md-between align-items-center products produks d-flex flex-row flex-wrap gap-4"
                style="width: fit-content; max-width: 90%;">
                @for($i=0;$i<=20;$i++)
                    <div class="produk{{{$i}}} align-items-center position-relative d-flex gap-2 flex-row justify-content-end align-items-end" style="height:170px; min-height: 110px; width: 470px;">
                    <div class="position-absolute z-2 gap-0 border border-danger shadow d-flex flex-wrap justify-content-between align-items-center right-0 p-1 bg-white border-left-top border-right-bottom" style="width:110px; height: 40px; bottom: -10px;">
                        <div class="tambahproduk{{{$i}}} d-flex awal w-50" onclick="showButton(this,'{{{$i}}}')">
                            <p class="p-clear lh-1 poppins fw-bolder cl-prim-dark" style="font-size: 12px;">TAMBAH PRODUK</p>
                        </div>
                        <button onclick="minus('{{{$i}}}')" class="minusButton{{{$i}}} border d-none justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;">
                            <i class="p-clear fs-5 bi bi-dash-lg"></i>
                        </button>
                        <input type="number" class="inputNumber{{{$i}}} d-none text-center clean-number border-0 p-0" data-qty="2" value="0" style="width: 30px; height: 100%;" name="" id="qty{{{$i}}}">
                        <button onclick="plus('{{{$i}}}','1',this)" class="plusButton{{{$i}}} border d-flex justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;">
                            <i class="p-clear fs-5 bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <img class="circle-preview position-absolute z-1 shadow" src="/assets/contoh.jpg" alt="" style="height: 75%; width: fit-content; left: 0;">
                    <div class="position-absolute shadow z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:87%; height:95%; max-height: 95%; min-height: 95%;  ">

                        <div class="contisi d-flex flex-column first-cl justify-content-end align-items-end w-50">
                            <p class="fw-bolder p-clear" style="font-size: 14px;">PENTOL GILA</p>
                        </div>
                        <div class="pe-1 text-justify first-cl" style="width: 80%; flex:1; ">
                            <div class="textDexscription scroll-bg-dark h-75" style="overflow: auto;">
                                <p class="text-justify p-clear" style="text-indent: 12px; font-size: 10px; text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae dolor fuga quaerat minima quos sit porro? Quis a incidunt eligendi fugiat nulla, libero nihil accusamus ducimus. Fugit exercitationem unde explicabo. aliquam deleniti? Aliquam fugiat similique, vitae consequuntur fugit doloremque perferendis quis quasi? Incidunt, quam! Laboriosam aut placeat esse consequuntur! Ea, velit?</p>
                            </div>
                            <div class="w-75 fw-bolder cl-white justify-content-start align-items-center">
                                <p class="p-clear">Rp. 10000,-</p>
                            </div>
                        </div>

                    </div>
            </div>
            @endfor
        </div>
    </div>
    <div class="d-flex flex-column bg-danger h-100" style="min-height: 84.95vh; height: 100%; max-height: fit-content;">
        <div>
            <a href="/" class="logo h-auto" style="width: 100px;">
                <img src="{{ auto_asset('assets/logoJelajahKuliner.svg') }}" alt="Logo"
                    class="w-50">
            </a>
        </div>
        <div>
            <div>
                <p>Tanggal: 17/05/2025</p>
                <p>22.50</p>
            </div>
            <div>
                @for($i=0;$i<=20;$i++)
                    <div class="produk{{{$i}}} align-items-center position-relative d-flex gap-2 flex-row justify-content-end align-items-end" style="height:170px; min-height: 110px; width: 200px;">
                    <div class="position-absolute z-2 gap-0 border border-danger shadow d-flex flex-wrap justify-content-between align-items-center right-0 p-1 bg-white border-left-top border-right-bottom" style="width:110px; height: 40px; bottom: -10px;">
                        <div class="tambahproduk{{{$i}}} d-flex awal w-50" onclick="showButton(this,'{{{$i}}}')">
                            <p class="p-clear lh-1 poppins fw-bolder cl-prim-dark" style="font-size: 12px;">TAMBAH PRODUK</p>
                        </div>
                        <button onclick="minus('{{{$i}}}')" class="minusButton{{{$i}}} border d-none justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;">
                            <i class="p-clear fs-5 bi bi-dash-lg"></i>
                        </button>
                        <input type="number" class="inputNumber{{{$i}}} d-none text-center clean-number border-0 p-0" data-qty="2" value="0" style="width: 30px; height: 100%;" name="" id="qty{{{$i}}}">
                        <button onclick="plus('{{{$i}}}','1',this)" class="plusButton{{{$i}}} border d-flex justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;">
                            <i class="p-clear fs-5 bi bi-plus-lg"></i>
                        </button>
                    </div>
                    <img class="circle-preview position-absolute z-1 shadow" src="/assets/contoh.jpg" alt="" style="height: 75%; width: fit-content; left: 0;">
                    <div class="position-absolute shadow z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:87%; height:95%; max-height: 95%; min-height: 95%;  ">

                        <div class="contisi d-flex flex-column first-cl justify-content-end align-items-end w-50">
                            <p class="fw-bolder p-clear" style="font-size: 14px;">PENTOL GILA</p>
                        </div>
                        <div class="pe-1 text-justify first-cl" style="width: 80%; flex:1; ">
                            <div class="textDexscription scroll-bg-dark h-75" style="overflow: auto;">
                                <p class="text-justify p-clear" style="text-indent: 12px; font-size: 10px; text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quae dolor fuga quaerat minima quos sit porro? Quis a incidunt eligendi fugiat nulla, libero nihil accusamus ducimus. Fugit exercitationem unde explicabo. aliquam deleniti? Aliquam fugiat similique, vitae consequuntur fugit doloremque perferendis quis quasi? Incidunt, quam! Laboriosam aut placeat esse consequuntur! Ea, velit?</p>
                            </div>
                            <div class="w-75 fw-bolder cl-white justify-content-start align-items-center">
                                <p class="p-clear">Rp. 10000,-</p>
                            </div>
                        </div>

                    </div>
            </div>
            @endfor
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function plus(idProduk, wht, elemen) {
        if (wht == '1') {
            let inp = document.querySelectorAll('.minusButton' + idProduk + ' , .inputNumber' + idProduk)
            inp.forEach(e => {
                e.classList.replace('d-none', 'd-flex')
            })
            elemen.setAttribute("onclick", "plus('" + idProduk + "','0',this)")
            document.querySelector('.tambahproduk' + idProduk).classList.replace('d-flex', 'd-none')

        } else {
            let inp = document.querySelector('#qty' + idProduk)
            let qty_awal = parseInt(inp.value)
            let stok = parseInt(inp.getAttribute('data-qty'));
            if (qty_awal <= (stok - 1)) {
                inp.value = qty_awal + 1;
            } else {
                erorAlert('Stok Terbatas', 'Stok produk hanya ' + stok)
            }
        }
    }

    function minus(idProduk) {
        let inp = document.querySelector('#qty' + idProduk)
        let qty_awal = parseInt(inp.value)
        let stok = parseInt(inp.getAttribute('data-qty'));
        if (qty_awal > 0) {
            inp.value = qty_awal - 1;
        } else {
            erorAlert('Eror', 'Qty sudah 0')
        }
    }

    function showButton(elemen, idProduk) {
        elemen.classList.replace('d-flex', 'd-none')
        let inp = document.querySelectorAll('.minusButton' + idProduk + ' , .inputNumber' + idProduk)
        inp.forEach(e => {
            e.classList.replace('d-none', 'd-flex')
        })
    }
</script>
@endsection