@extends('layouts.layout')


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

    textarea.profile-input {
        height: 100px;
        min-height: 100px;
        outline: none;
        resize: vertical;
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
            <h3>{{ session('account')['nama'] }}</h3>
            @if (session('account')['status'] == 'Pelanggan')
            <button type="button" class="customer-role-btn btn greenButton btn-btn-outline-dark rounded-5 justify-content-between d-flex flex-row gap-1" style="width: fit-content;">
                <p class="p-clear">{{ session('account')['status'] }}</p>
            </button>
            @endif
            {{-- Tombol untuk beralih ke mode PKL --}}
            @if (session('account')['status'] == 'PKL')
            <button type="button" onclick="switchRoleView('pkl')" class="customer-role-btn btn greenButton btn-btn-outline-dark rounded-5 justify-content-between d-flex flex-row gap-1" style="width: fit-content;">
                <p class="p-clear">Customer</p>
                <i class="bi bi-toggle2-on"></i>
            </button>
            @endif


            {{-- Tombol untuk beralih kembali ke mode Customer --}}
            @if (session('account')['status'] == 'PKL')
            <button type="button" onclick="switchRoleView('customer')" class="pkl-role-btn btn d-none greenButton btn-outline-dark justify-content-between rounded-5 d-flex flex-row gap-1" style="width: 120px;">
                <p class="p-clear">PKL</p>
                <i class="bi bi-toggle2-off"></i>
            </button>
            @endif
        </div>
    </div>

    <div class="d-flex flex-column cl-white gap-md-5 gap-5 flex-md-row" style="width: 100%; ">
        <div class="w-md-25 pe-3 d-flex justify-content-center flex-column align-items-center">
            <div class="contfoto d-flex flex-column w-auto h-100 align-items-center">

                <input type="file" id="customer-photo-input" class="d-none" accept="image/*">
                <input type="file" id="pkl-photo-input" class="d-none" accept="image/*">
                @csrf


                <div class="mb-3 position-relative" style="width: 300px; height: 300px;">

                    <div id="customer-section" class="w-100 h-100">
                        <div class="position-absolute top-0 end-0 p-2 z-1">
                            <button class="edit-photo-customer btn btn-sm btn-light bg-transparent border-0" onclick="editPhoto('customer')">
                                <i class="bi bi-pencil-square text-white"></i>
                            </button>
                            <button class="save-photo-customer btn btn-sm btn-light bg-transparent d-none" onclick="savePhoto('customer')">
                                <i class="bi bi-floppy-fill text-white"></i>
                            </button>
                        </div>
                        <img id="customer-photo-preview" class="circle-preview w-100 h-100" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Customer">
                    </div>

                    @if (session('account')['status'] == 'PKL')
                    <div id="pkl-section" class="w-100 h-100 d-none">
                        <div class="position-absolute top-0 end-0 p-2 z-1">
                            <button class="edit-photo-pkl btn btn-sm btn-light bg-transparent" onclick="editPhoto('pkl')">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="save-photo-pkl btn btn-sm btn-light bg-transparent d-none" onclick="savePhoto('pkl')">
                                <i class="bi bi-floppy-fill text-white"></i>
                            </button>
                        </div>
                        <img id="pkl-photo-preview" class="circle-preview w-100 h-100" src="{{ session('PKL')['picture'] ? asset('storage/' . session('PKL')['picture']) : 'https://via.placeholder.com/300' }}" alt="Foto PKL">
                    </div>

                    @endif

                </div>
            </div>
            <h2>{{session('account')['nama']}}</h2>
        </div>
        <div class="rounded-2 p-4 border-2 border-opacity-50 btn-outline-success border h-auto" style="flex: 1 1;">
            <div class="header-profile d-flex flex-row justify-content-between align-items-center">
                <h2>Bio & other details</h2>

                {{-- Tombol Edit Customer --}}
                <button class="edit-bio-right-customer d-flex w-auto h-auto bg-transparent border-0 cl-white" onclick="editBio(true)">
                    <i class="bi bi-pencil-square"></i>
                </button>
                {{-- Tombol Save Customer --}}
                <button type="submit" form="profileForm" class="save-bio-right-customer d-none w-auto h-auto bg-transparent border-0 cl-white">
                    <i class="bi bi-floppy-fill"></i>
                </button>

                {{-- PERBAIKAN: Menambahkan tombol Edit & Save untuk PKL --}}
                @if (session('account')['status'] == 'PKL')
                {{-- Tombol Edit PKL (Awalnya disembunyikan) --}}
                <button class="edit-bio-right-pkl d-none w-auto h-auto bg-transparent border-0 cl-white" onclick="editBio(false)">
                    <i class="bi bi-pencil-square"></i>
                </button>
                {{-- Tombol Save PKL (Awalnya disembunyikan) --}}
                <button type="submit" form="pklForm" class="save-bio-right-pkl d-none w-auto h-auto bg-transparent border-0 cl-white">
                    <i class="bi bi-floppy-fill"></i>
                </button>
                @endif
            </div>

            {{-- Form untuk Customer --}}
            <form id="profileForm" method="POST" action="/account/{{ session('account')['id'] }}" class="customer d-flex flex-column ps-3 ps-md-5 pt-5 gap-3">
                @csrf
                @method('PUT')

                <div class="d-flex flex-column">
                    <p class="p-clear opacity-50">Nama Lengkap</p>
                    <input name="nama" type="text" class="p-clear bg-transparent border-0 cl-white profile-input" value="{{ $account->nama ?? session('account')['nama'] }}" style="outline: none;" readonly>
                </div>
                <div class="d-flex flex-column">
                    <p class="p-clear opacity-50">Nomor Telepon</p>
                    <input name="nohp" type="text" class="p-clear bg-transparent border-0 cl-white profile-input" value="{{ $account->nohp ?? session('account')['nohp'] }}" style="outline: none;" readonly>
                </div>
                <div class="d-flex flex-column">
                    <p class="p-clear opacity-50">Email</p>
                    <input name="email" type="email" class="p-clear bg-transparent border-0 cl-white profile-input" value="{{ $account->email ?? session('account')['email'] }}" style="outline: none;" readonly>
                </div>
            </form>

            {{-- Form untuk PKL --}}
            @if (session('account')['status'] == 'PKL')
            <form id="pklForm" method="POST" action="/pkl/{{ session('PKL')['id'] ?? '' }}" class="pkl d-none flex-column ps-3 ps-md-5 pt-5 gap-3">
                @csrf
                @method('PUT')

                <div class="d-flex flex-column">
                    <p class="p-clear opacity-50">Nama PKL</p>
                    <input name="namaPKL" type="text" class="p-clear bg-transparent border-0 cl-white profile-input" value="{{session('PKL')['namaPKL']}}" style="outline: none;" readonly>
                </div>

                <div class="d-flex flex-column h-auto">
                    <p class="p-clear opacity-50">Deskripsi</p>
                    {{-- PERBAIKAN: Menggunakan textarea untuk deskripsi --}}
                    <textarea name="desc" class="p-clear bg-transparent border-0 cl-white profile-input" style="outline: none;" readonly>{{session('PKL')['desc']}}</textarea>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    const APP_ROUTES = {
        customerPhoto: "{{ route('account.updatePhoto') }}",
        // Gunakan kondisi Blade untuk mencegah error jika user bukan PKL
        pklPhoto: "{{ route('pkl.updatePhoto') }}",
    };
</script>
<script>
    // =================================================================
    // KODE JAVASCRIPT YANG BERSIH DAN SUDAH DIPERBAIKI
    // =================================================================

    function switchRoleView(roleToShow) {
        const customerPhotoSection = document.getElementById('customer-section');
        const pklPhotoSection = document.getElementById('pkl-section');
        const customerForm = document.querySelector('form.customer');
        const pklForm = document.querySelector('form.pkl');
        const customerEditBtn = document.querySelector('.edit-bio-right-customer');
        const pklEditBtn = document.querySelector('.edit-bio-right-pkl'); // Sekarang akan ditemukan
        const customerSaveBtn = document.querySelector('.save-bio-right-customer');
        const pklSaveBtn = document.querySelector('.save-bio-right-pkl');

        const customerRoleBtn = document.querySelector('.customer-role-btn');
        const pklRoleBtn = document.querySelector('.pkl-role-btn');

        // Reset semua ke kondisi awal sebelum menampilkan yang baru
        customerSaveBtn.classList.add('d-none');
        if (pklSaveBtn) pklSaveBtn.classList.add('d-none');

        if (roleToShow === 'customer') {
            customerPhotoSection.classList.remove('d-none');
            customerForm.classList.remove('d-none');
            customerEditBtn.classList.remove('d-none');

            if (pklPhotoSection) pklPhotoSection.classList.add('d-none');
            if (pklForm) pklForm.classList.add('d-none');
            if (pklEditBtn) pklEditBtn.classList.add('d-none');

            if (pklRoleBtn) pklRoleBtn.classList.add('d-none');
            customerRoleBtn.classList.remove('d-none');

        } else if (roleToShow === 'pkl') {
            customerPhotoSection.classList.add('d-none');
            customerForm.classList.add('d-none');
            customerEditBtn.classList.add('d-none');

            if (pklPhotoSection) pklPhotoSection.classList.remove('d-none');
            if (pklForm) pklForm.classList.remove('d-none');
            if (pklEditBtn) pklEditBtn.classList.remove('d-none');

            if (pklRoleBtn) pklRoleBtn.classList.remove('d-none');
            customerRoleBtn.classList.add('d-none');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        switchRoleView('customer');
        // Hanya setup photo preview jika elemennya ada
        if (document.getElementById('customer-photo-input')) {
            setupPhotoPreview('customer');
        }
        if (document.getElementById('pkl-photo-input')) {
            setupPhotoPreview('pkl');
        }
    });

    function editBio(isCustomer) {
        const formSelector = isCustomer ? '#profileForm' : '#pklForm';
        const inputs = document.querySelectorAll(formSelector + ' .profile-input');

        inputs.forEach(input => {
            input.readOnly = false;
        });

        if (inputs.length > 0) {
            inputs[0].focus();
        }

        const editButtonSelector = isCustomer ? '.edit-bio-right-customer' : '.edit-bio-right-pkl';
        const saveButtonSelector = isCustomer ? '.save-bio-right-customer' : '.save-bio-right-pkl';

        document.querySelector(editButtonSelector).classList.add('d-none');
        document.querySelector(saveButtonSelector).classList.remove('d-none');
    }

    function editPhoto(type) {
        document.getElementById(type + '-photo-input').click();
    }

    function setupPhotoPreview(type) {
        const fileInput = document.getElementById(type + '-photo-input');
        const previewImage = document.getElementById(type + '-photo-preview');
        const editButton = document.querySelector('.edit-photo-' + type);
        const saveButton = document.querySelector('.save-photo-' + type);

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                }
                reader.readAsDataURL(file);
                editButton.classList.add('d-none');
                saveButton.classList.remove('d-none');
            }
        });
    }

    async function savePhoto(type) {
        const fileInput = document.getElementById(type + '-photo-input');
        const file = fileInput.files[0];
        const token = document.querySelector('input[name="_token"]').value;

        if (!file) {
            alert('Silakan pilih foto terlebih dahulu.');
            return;
        }

        // Mengambil URL dari objek global (metode yang sudah benar)
        let url = (type === 'customer') ? APP_ROUTES.customerPhoto : APP_ROUTES.pklPhoto;

        if (!url) {
            console.error('URL endpoint tidak ditemukan untuk tipe:', type);
            alert('Terjadi kesalahan konfigurasi. URL tidak ditemukan.');
            return;
        }

        const formData = new FormData();
        formData.append('foto', file);

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: formData
            });

            // ==========================================================
            // PERUBAHAN UTAMA UNTUK MENANGKAP ERROR VALIDASI (422)
            // ==========================================================
            if (!response.ok) {
                // Coba baca body response sebagai JSON untuk mendapatkan detail error
                const errorData = await response.json();

                // Laravel mengirim error dalam format { message: "...", errors: { field: ["message"] } }
                // Kita akan gabungkan semua pesan error menjadi satu string.
                if (errorData.errors) {
                    const errorMessages = Object.values(errorData.errors).flat().join('\n');
                    throw new Error(errorMessages);
                }

                // Jika formatnya tidak seperti di atas, lempar error HTTP biasa
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            // ==========================================================

            const result = await response.json();

            if (result.success) {
                alert(result.message);
                document.getElementById(type + '-photo-preview').src = result.new_photo_url;
            } else {
                alert(result.message || 'Gagal mengupdate foto.');
            }

        } catch (error) {
            console.error('Terjadi kesalahan saat upload:', error);
            // Sekarang alert akan menampilkan pesan error yang spesifik dari Laravel
            alert('Gagal mengupload foto:\n' + error.message);
        } finally {
            document.querySelector('.edit-photo-' + type).classList.remove('d-none');
            document.querySelector('.save-photo-' + type).classList.add('d-none');
            fileInput.value = '';
        }
    }
</script>
@endsection