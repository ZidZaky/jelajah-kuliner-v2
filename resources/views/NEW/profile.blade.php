@extends('NEW.EVI.base-page')

@section('css')

<style>
    .greenButton {
        border: #4CDB5C solid 1px !important;
        color: #4CDB5C !important;
        transform: scale(0.8);
        transform-origin: center;

    }

    .w-md-25 {
        width: 30% !important;
    }

    .w-full-ls {
        width: fit-content !important;
        justify-content: start !important;
    }

    textarea {
        height: 100px;
        min-height: 100px;
        outline: none;
    }

    @media (max-width: 768px) {
        .width-full-xs {
            width: 100% !important;
            height: calc(100vh - 90px - 20px) !important;
        }

        .w-md-25 {
            width: 100% !important;
        }

        .w-full-ls {
            width: 100% !important;
            justify-content: space-between !important;
        }


    }
</style>

@endsection

@section('AddOn')


@endsection

@section('isi')
<div class="bg-prim-dark p-5 d-flex w-100 h-100 flex-column gap-5 justify-content-start align-items-center" style="height: 100%; min-height: 85.4vh;">
    <div class="w-100" style="height: fit-content;">
        <div class="ms-3 d-flex cl-white gap-2 pb-2 flex-row align-items-center w-full-ls">
            <h3>Profile</h3>
            <button type="button" onclick="pklRole(1,this)" class="customer-role btn d-flex greenButton btn-btn-outline-dark rounded-5 justify-content-between d-flex flex-row gap-1"
                type="button" style="width: 120px;">
                <p class="p-clear ">Customer</p>
                <i class="bi bi-toggle2-on"></i>
            </button>
            <button type="button" onclick="customerRole(1,this)" class="pkl-role btn d-none greenButton btn-outline-dark justify-content-between rounded-5 d-flex flex-row gap-1"
                type="button" style="width: 120px;">
                <p class="p-clear ">PKL</p>
                <i class="bi bi-toggle2-off"></i>
            </button>


        </div>
    </div>

    <div class="d-flex flex-column cl-white gap-md-5 gap-5 flex-md-row" style="width: 100%; ">
        <div class="w-md-25 pe-3 d-flex justify-content-center flex-column align-items-center">
            <div class="contfoto d-flex flex-column w-auto h-100">
                <div class="edit-foto-customer w-auto h-auto d-flex justify-content-end" style="width:16px; height: 18px; max-height: 18px; min-height: 18px;">
                    <button class="edit-photo-customer d-flex w-auto h-auto bg-transparent border-0 cl-white" onclick="editPhoto(this,'customer')"
                        style="width:16px; height: 16px;">
                        <i class="p-clear bi bi-pencil-square"></i>
                    </button>
                    <button class="save-photo-customer d-none w-auto h-auto bg-transparent border-0 cl-white" onclick="savePhoto(this,'customer')"
                        style="width:16px; height: 16px;">
                        <svg class="p-clear" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                            <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                            <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                        </svg>
                    </button>
                </div>
                <div class="edit-foto-pkl w-auto h-auto d-none justify-content-end" style="width:16px; height: 18px; max-height: 18px; min-height: 18px;">
                    <button class="edit-photo-pkl d-flex w-auto h-auto bg-transparent border-0 cl-white" onclick="editPhoto(this,'pkl')"
                        style="width:16px; height: 16px;">
                        <i class="p-clear bi bi-pencil-square"></i>
                    </button>
                    <button class="save-photo-pkl d-none w-auto h-auto bg-transparent border-0 cl-white" onclick="savePhoto(this,'pkl')"
                        style="width:16px; height: 16px;">
                        <svg class="p-clear" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                            <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                            <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                        </svg>
                    </button>
                </div>
                <div class="mb-3" style="width: 300px; height:300px;">
                    <div class="foto-customer d-flex h-100 position-relative" style="width:100%;">
                        <button onclick="takefile('Customer')" class="w-100 h-100 cl-white circle-preview opacity-50 d-none bg-dark flex-column justify-content-center align-items-center position-absolute">
                            <i class="cl-white bi bi-folder2-open"></i>
                            Klik untuk ubah foto
                        </button>
                        <img class="circle-preview w-100 h-100" src="{{ auto_asset('assets/profile-icon.png') }}" alt="">
                    </div>
                    <div class="foto-pkl d-none h-100 position-relative" style="width:100%;">
                        <button onclick="takefile('Pkl')" class="w-100 h-100 cl-white circle-preview opacity-50 d-none bg-dark flex-column justify-content-center align-items-center position-absolute">
                            <i class="cl-white bi bi-folder2-open"></i>
                            Klik untuk ubah foto
                        </button>
                        <img class="circle-preview w-100 h-100" src="{{ auto_asset('assets/farhan.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <h2>Zhao Linghe</h2>
        </div>
        <div class="rounded-2 p-4 border-2 border-opacity-50 btn-outline-success border h-auto" style="flex: 1 1;">
            <div class="header-profile d-flex flex-row justify-content-between align-items-center">
                <h2>Bio & other details</h2>
                <button class="edit-bio-right-customer d-flex w-auto h-auto bg-transparent border-0 cl-white" onclick="editBioRight(this,'customer')"
                    style="width:16px; height: 16px;">
                    <i class=" bi bi-pencil-square"></i>
                </button>
                <button class="save-bio-right-customer d-none w-auto h-auto bg-transparent border-0 cl-white" onclick="saveBioRight(this,'customer')"
                    style="width:16px; height: 16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                        <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                    </svg>
                </button>
                <button class="edit-bio-right-pkl d-none w-auto h-auto bg-transparent border-0 cl-white" onclick="editBioRight(this,'pkl')"
                    style="width:16px; height: 16px;">
                    <i class=" bi bi-pencil-square"></i>
                </button>
                <button class="save-bio-right-pkl d-none w-auto h-auto bg-transparent border-0 cl-white" onclick="saveBioRight(this,'pkl')"
                    style="width:16px; height: 16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0H3v5.5A1.5 1.5 0 0 0 4.5 7h7A1.5 1.5 0 0 0 13 5.5V0h.086a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5H14v-5.5A1.5 1.5 0 0 0 12.5 9h-9A1.5 1.5 0 0 0 2 10.5V16h-.5A1.5 1.5 0 0 1 0 14.5z" />
                        <path d="M3 16h10v-5.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5zm9-16H4v5.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5zM9 1h2v4H9z" />
                    </svg>
                </button>
            </div>
            <form class="customer d-flex flex-column ps-3 ps-md-5 pt-5 gap-3">
                <div class="d-flex flex-column">
                    <p class="p-clear opacity-50">Nama Lengkap</p>
                    <input type="text" class="p-clear bg-transparent border-0 cl-white" value="Zhang Linghe" style="outline: none;">
                </div>
                <div class="d-flex flex-column">
                    <p class="p-clear opacity-50">Nomor Telepon</p>
                    <input type="text" class="p-clear bg-transparent border-0 cl-white" value="0897524164486" style="outline: none;" disabled>
                </div>
                <div class="d-none flex-column">
                    <p class="p-clear opacity-50">Nama PKL</p>
                    <input type="file" accept="image/*" class="inpFotoCustomer p-clear bg-transparent border-0 cl-white" value="mamang Pentol carok madura" style="outline: none;">
                </div>
                <div class="d-flex flex-column">
                    <p class="p-clear opacity-50">Email</p>
                    <input type="text" class="p-clear bg-transparent border-0 cl-white" value="0897524164486" style="outline: none;" disabled>
                </div>
            </form>
            <form class="pkl d-none flex-column ps-3 ps-md-5 pt-5 gap-3" style="height: fit-content; min-height: 200px;">
                <div class="d-flex flex-column">
                    <p class="p-clear opacity-50">Nama PKL</p>
                    <input type="text" class="p-clear bg-transparent border-0 cl-white" value="mamang Pentol carok madura" style="outline: none;" disabled>
                </div>
                <div class="d-none flex-column">
                    <p class="p-clear opacity-50">Nama PKL</p>
                    <input type="file" accept="image/*" class="inpFotoPkl p-clear bg-transparent border-0 cl-white" value="mamang Pentol carok madura" style="outline: none;">
                </div>
                <div class="d-flex flex-column h-auto">
                    <p class="p-clear opacity-50">Deskripsi</p>
                    <p class="d-flex desprkripsiPkl p-clear">Mamang Pentol Carok Madura</p>
                    <!-- jika di edit -->
                    <textarea name="" class="p-clear d-none text-start bg-transparent border-0 cl-white align " id="" style="height: fit-content;">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus ad deserunt quaerat sapiente maiores, ut voluptate rerum assumenda voluptas ea nulla nemo earum error obcaecati reiciendis quas molestiae debitis enim.
                    </textarea>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    function takefile(wht){
        let inp = document.querySelector('.inpFoto'+wht)
        console.log(inp)
        inp.click();
    }
    function customerRole(what, elemen) {
        let button = document.querySelector('.customer-role');
        let foto = document.querySelector('.foto-customer');
        let button_foto = document.querySelector('.edit-foto-customer')
        let editfield = document.querySelector('.edit-bio-right-customer')
        let toflex = [button,foto,button_foto,editfield]
        if (what == 1) {
            toflex.forEach(e=>{
                e.classList.replace('d-none', 'd-flex')
            })
        }
        let fotoPkl = document.querySelector('.foto-pkl')
        let button_foto2 = document.querySelector('.edit-foto-pkl')
        let editfield2 = document.querySelector('.edit-bio-right-pkl')
        let editfield3 = document.querySelector('.save-bio-right-pkl')
        let toNone = [fotoPkl, elemen,button_foto2,editfield2,editfield3]
        toNone.forEach(e=>{
            e.classList.replace('d-flex', 'd-none')

        })
        
        showCustomerData();
        // pklRole(0)
    }

    function pklRole(what, elemen) {
        let button = document.querySelector('.pkl-role');
        let foto = document.querySelector('.foto-pkl')
        let button_foto = document.querySelector('.edit-foto-pkl')
        let editfield = document.querySelector('.edit-bio-right-pkl')

        let toflex = [button,foto,button_foto,editfield];
        if (what == 1) {
            toflex.forEach(e=>{
                e.classList.replace('d-none', 'd-flex')

            })
        }

        let fotoCus = document.querySelector('.foto-customer')
        let button_foto2 = document.querySelector('.edit-foto-customer')
        let editfield2 = document.querySelector('.edit-bio-right-customer')
        let savefield3 = document.querySelector('.save-bio-right-customer')

        let toNone = [fotoCus, elemen,button_foto2,editfield2,savefield3];
        
        toNone.forEach(e=>{
            e.classList.replace('d-flex', 'd-none')
        })

        showPklData()
        // customerRole(0)
    }

    function showPklData() {
        let pklData = document.querySelector('.pkl')
        pklData.classList.replace('d-none', 'd-flex')
        let custData = document.querySelector('.customer')
        custData.classList.replace('d-flex', 'd-none')
    }

    function showCustomerData() {
        let custData = document.querySelector('.customer')
        custData.classList.replace('d-none', 'd-flex')
        let pklData = document.querySelector('.pkl')
        pklData.classList.replace('d-flex', 'd-none')
    }

    function editPhoto(elemen,wht) {
        console.log(wht)
        elemen.classList.replace('d-flex', 'd-none')
        
        
        let edit = document.querySelector('.save-photo-'+wht)
        let button_edit = document.querySelector('.foto-'+wht+' button')
        let toflex= [edit,button_edit]
        toflex.forEach(e=>{
            e.classList.replace('d-none', 'd-flex')
        })
    }
    
    function savePhoto(elemen,wht) {
        console.log(wht)
        let button_edit = document.querySelector('.foto-'+wht+' button')
        let toflex= [elemen,button_edit]
        toflex.forEach(e=>{
            e.classList.replace('d-flex', 'd-none')
            // e.classList.replace('d-flex', 'd-none')
        })
        
        
        let edit = document.querySelector('.edit-photo-'+wht)
        edit.classList.replace('d-none', 'd-flex')
    }

    function editBioRight(elemen,wht) {
        elemen.classList.replace('d-flex', 'd-none')
        let edit = document.querySelector('.save-bio-right-'+wht)
        edit.classList.replace('d-none', 'd-flex')

        let form = document.querySelector('.'+wht);
        let all_inp = form.querySelectorAll('input')
        if(wht=='pkl'){
            let txtarea = document.querySelector('textarea')
            txtarea.classList.replace('d-none','d-flex')
            let desk = document.querySelector('.desprkripsiPkl')
            desk.classList.replace('d-flex','d-none')
        }
        console.log(all_inp)
        all_inp.forEach(e=>{
            e.disabled = false;
        })
    }

    function saveBioRight(elemen,wht) {
        elemen.classList.replace('d-flex', 'd-none')
        let edit = document.querySelector('.edit-bio-right-'+wht)
        edit.classList.replace('d-none', 'd-flex')



        let form = document.querySelector('.'+wht);
        let all_inp = form.querySelectorAll('input')
        all_inp.forEach(e=>{
            e.disabled = true;
        })
        if(wht=='pkl'){
            let txtarea = document.querySelector('textarea')
            txtarea.classList.replace('d-flex','d-none')
            let desk = document.querySelector('.desprkripsiPkl')
            desk.classList.replace('d-none','d-flex')
        }
    }



    triggerFoto('Customer')
    triggerFoto('Pkl')
    function triggerFoto(wht){
        
        document.querySelector('.inpFoto'+wht).addEventListener('change',function(event){
            const file = event.target.files[0]
            console.log(file)
            if(wht=='Customer'){
                wht='customer'
            }
            else{
                wht='pkl'
            }
    
            if(file && file.type.startsWith('image/')){
                let imgurl = URL.createObjectURL(file);
                let img = document.querySelector('.foto-'+wht+' img')
                img.src = imgurl
            }
        })
    }
</script>
@endsection