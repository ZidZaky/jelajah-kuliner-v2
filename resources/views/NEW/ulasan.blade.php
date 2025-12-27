@extends('layouts.layout')

@section('title')
    Halaman Ulasan
@endsection

@section(section: 'css')
    {{-- <link rel="stylesheet" href="/css/ulasan.css"> --}}
<link rel="stylesheet" href="{{ auto_asset('css/ulasan.css') }}">

@endsection


@section('isiAlert')
    @if((session('alert')) != null)

        @php echo session('alert'); @endphp
    @endif
@endsection

@section('main')
    <div class="kotak">

        {{-- <!-- <p class="fotoakun" style="text-align: left;">{{ session('account')[''] }} </p> -->
        <!-- <p class="namaakun" style="text-align: left;">{{ session('account')['nama'] }} </p> -->
        <!-- <p class="ratingakun" style="text-align: left;">{{ session('account')[''] }} </p> --> --}}
        <hr>

        <form class="form-ulasan" action="{{ route('ulasan.create') }}" method="POST">
            @csrf

            <div class="rating-stars mb-3">
                <label>seberapa puas dengan pkl ini?</label>
                <div class="stars">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                        <label for="star{{ $i }}">★</label>
                    @endfor
                </div>
            </div>


            <!-- <div class="rating-slider">
                <p1>berapa bintang untuk penjual ini?</p1>
                <input type="range" min="1" max="5" value="1" class="slider" name="rating" id="rating" list="tickmarks">
                <div class="slider-value" id="ratingValue">1</div>
                <datalist id="tickmarks">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                    <option value="4">
                    <option value="5">
                </datalist>
            </div> -->


            <div class="form-floating  mt-5 text-muted">
                <input type="text" class="form-control" id="ulasan" name="ulasan" placeholder="masukkan deskripsi">
                <label for="ulasan">Tambahkan keterangan</label>
            </div>
{{-- <!--
            <input type="text" name="idPKL" id="idPKL" value="{{$idPKL}}" hidden>
            <input type="text" name="idAccount" id="idAccount" value="{{session('account')['id']}}" hidden> --> --}}
            <button class="btn btn-success" type="submit">Submit</button>
            <p class="mt-5 mb-3 text-muted">&copy; Jelajah Kuliner 2024</p>
<!-- hjk -->
        </form>
    </div>
    </div>
    <script>
        const slider = document.getElementById("rating");
        const ratingValue = document.getElementById("ratingValue");
        const form = document.querySelector(".form-ulasan");
        const ulasanInput = document.getElementById("ulasan");

        slider.addEventListener("input", function () {
            ratingValue.textContent = this.value;
        });

        form.addEventListener("submit", function (e) {
            if (ulasanInput.value.trim() === "") {
                e.preventDefault(); // Mencegah form terkirim
                alert("Ulasan tidak boleh kosong!");
                ulasanInput.focus(); // Fokus ke input deskripsi
            }
        });
    </script>

    <!-- 30 Mei 2025 3.12 aku rasa ini yg old ya, Evi -->
    <!-- <script>
        const form = document.querySelector(".form-ulasan");
        const ulasanInput = document.getElementById("ulasan");

        form.addEventListener("submit", function (e) {
            const ratingChecked = document.querySelector('input[name="rating"]:checked');
            if (!ratingChecked) {
                e.preventDefault();
                alert("Silakan pilih rating bintang terlebih dahulu!");
                return;
            }
            if (ulasanInput.value.trim() === "") {
                e.preventDefault();
                alert("Ulasan tidak boleh kosong!");
                ulasanInput.focus();
            }
        });
    </script> -->

@endsection
