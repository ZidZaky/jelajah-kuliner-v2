@extends('layouts.layout2')

@section('title')
    ULASAN
@endsection

@section('css')
    <link rel="stylesheet" href="/css/ulasan.css">
@endsection


@section('isiAlert')
    @if((session('alert'))!=null)

            @php echo session('alert'); @endphp
    @endif
@endsection

@section('main')
    <div class="kotak">

        <form class="form-ulasan" action="/ulasan" method="POST">
            @csrf
            <h1>ayo beri ulasan anda !</h1>


            <div class="rating-slider">
                <p1>berapa bintang untuk penjual ini?</p1>
                <input type="range" min="1" max="5" value="1" class="slider" name="rating"
                    id="rating" list="tickmarks">
                <div class="slider-value" id="ratingValue" >1</div>
                <datalist id="tickmarks">
                    <option value="1">
                    <option value="2">
                    <option value="3">
                    <option value="4">
                    <option value="5">
                </datalist>
            </div>


            <div class="form-floating">
                <input type="text" class="form-control" id="ulasan" name="ulasan" placeholder="masukkan deskripsi">
                <label for="ulasan">deskripsi</label>
            </div>

            <input type="text" name="idPKL" id="idPKL" value="{{$idPKL}}" hidden>
            <input type="text" name="idAccount" id="idAccount" value="{{session('account')['id']}}" hidden>

            <button class="btn btn-success" type="submit">Post</button>

            <p class="mt-5 mb-3 text-muted">&copy; 2024</p>

        </form>
    </div>
    </div>
    <script>
    const slider = document.getElementById("rating");
    const ratingValue = document.getElementById("ratingValue");
    const form = document.querySelector(".form-ulasan");
    const ulasanInput = document.getElementById("ulasan");

    slider.addEventListener("input", function() {
        ratingValue.textContent = this.value;
    });

    form.addEventListener("submit", function(e) {
        if (ulasanInput.value.trim() === "") {
            e.preventDefault(); // Mencegah form terkirim
            alert("Ulasan tidak boleh kosong!");
            ulasanInput.focus(); // Fokus ke input deskripsi
        }
    });
</script>

@endsection
