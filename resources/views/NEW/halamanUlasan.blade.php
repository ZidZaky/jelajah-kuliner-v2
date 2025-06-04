@extends('NEW.EVI.base-page')

@section('css')
<link rel="stylesheet" href="/css/ulasan.css">
<link rel="stylesheet" href="{{ app()->environment('local') ? asset('css/base.css') : secure_asset('css/base.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

<style>
    #map {
       height: calc(100vh - 90px - 20px + 3px);
        filter: grayscale(100%);

    }


</style>
@endsection

@section('isiAlert')
    @if((session('alert')) != null)

        @php echo session('alert'); @endphp
    @endif
@endsection

@section('AddOn')
    <div class="kotak">

        {{-- <!-- <p class="fotoakun" style="text-align: left;">{{ session('account')[''] }} </p> -->
        <!-- <p class="namaakun" style="text-align: left;">{{ session('account')['nama'] }} </p> -->
        <!-- <p class="ratingakun" style="text-align: left;">{{ session('account')[''] }} </p> --> --}}
        <hr>

        <form class="form-ulasan" action="/ulasan" method="POST">
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

@endsection


@section('isi')
<div id="map"></div>
@endsection

@section('js')
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

<!-- Map scripts -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<script src="https://unpkg.com/esri-leaflet@3.0.12/dist/esri-leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet-vector@4.2.3/dist/esri-leaflet-vector.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css" />
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js"></script>

<script>
    var map = L.map('map').setView([-7.2575, 112.7521], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 5,
        maxZoom: 22,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
</script>
@endsection
