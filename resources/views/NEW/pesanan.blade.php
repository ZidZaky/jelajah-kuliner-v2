@extends('NEW.EVI.base-page')

@section('css')
<!-- <link rel="stylesheet" href="{{ auto_asset('css/?.css') }}"> -->
<link rel="stylesheet" href="{{ app()->environment('local')? asset('css/dashboard-user.css')">

<style>


</style>

@endsection

@section('AddOn')


@endsection

@section('isi')
<div class="d-flex flex-column position-relative w-100 h-auto">
    <button class="position-absolute bg-prim-dark d-flex border-left-top border-right-bottom justify-content-center align-items-center top-0" style="right: 0; height: 100px; width: 100px;" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
        <div class=" border border-1 d-flex cl-white justify-content-center align-items-center border-left-top border-right-bottom" style="width: 90%; height: 90%;">
            <i class="bi bi-cart3 " style="font-size: 30px;" ></i>
        </div>
</button>

<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="staticBackdropLabel">Offcanvas</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
      I will not close if you click outside of me.
    </div>
  </div>
</div>
<div class="d-flex p-5 justify-content-center align-items-center">
    <h1 class="p-clear cl-prim-dark fw-bolder">PKL JAWA'S PRODUK</h1>
</div>
<div class="w-100 d-flex mb-5 justify-content-center align-items-center h-auto">
    <div class="p-3 area justify-content-evenly justify-content-md-between align-items-center products produks d-flex flex-row flex-wrap gap-4"
    style="width: fit-content; max-width: 90%;">
        @for($i=0;$i<=20;$i++)
        <div class="produk align-items-center position-relative d-flex gap-2 flex-row justify-content-end align-items-end" style="height:170px; min-height: 110px; width: 470px;">
            <div class="position-absolute z-3 gap-0 border border-danger shadow d-flex flex-wrap justify-content-between align-items-center right-0 p-1 bg-white border-left-top border-right-bottom" style="width:110px; height: 40px; bottom: -10px;">
                <div class="w-50">
                    <p class="p-clear lh-1 poppins fw-bolder cl-prim-dark" style="font-size: 12px;">TAMBAH PRODUK</p>
                </div>
                <button class="border d-flex justify-content-center align-items-center p-clear border-danger border-left-top border-right-bottom h-auto" style="width: 30px; height: 30px; max-height: 30px;"><p class="p-clear fs-5">+</p></button>
            </div>
            <img class="circle-preview position-absolute z-1 shadow" src="/assets/contoh.jpg" alt="" style="height: 75%; width: fit-content; left: 0;">
            <div class="position-absolute shadow z-0 py-2 pe-2 d-flex flex-column gap-1 justify-content-between align-items-end bg-prim-dark border-left-top border-right-bottom" style="right: 0; width:87%; height:95%; max-height: 95%; min-height: 95%;  ">
                
                <div class="contisi d-flex flex-column first-cl justify-content-end align-items-end w-50">
                    <p class="fw-bolder p-clear" style="font-size: 14px;">PENTOL GILA</p>
                </div>
                <div class="pe-1 text-justify first-cl" style="width: 80%; flex:1; ">
                    <div class="textDexscription scroll-bg-dark h-75" style="overflow: auto;">
                        <p class="text-justify p-clear" style="text-indent: 12px; font-size: 10px; text-align: justify;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi, aliquam deleniti? Aliquam fugiat similique, vitae consequuntur fugit doloremque perferendis quis quasi? Incidunt, quam! Laboriosam aut placeat esse consequuntur! Ea, velit?</p>
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

    @endsection

    @section('js')
    <script>

    </script>
    @endsection