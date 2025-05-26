@extends('layouts.layout2')

@section('title')
    Feel Free to "JELAJAH" Kuliner dsekitarmu!
@endsection

@section('css')
    <link rel="stylesheet" href="css/login.css">
@endsection

@section('isiAlert')
    @if((session('alert'))!=null)
        @php echo session('alert'); @endphp
    @endif
@endsection

@section('main')

<div class="container d-flex justify-content-center align-items-center h-100">
    <div class="card">
        <h1 class="h3 mb-3 fw-normal" id="titleLogin">LOGIN</h1>
        <div class="line-divider"></div>
        <form class="form-signin" action="/loginAccount" method="POST" id="loginForm">
            @csrf

            <div class="form">
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email ">
            </div>
            <div class="form">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="mb-3" id="showPass">
                <input type="checkbox" onchange="togglePasswordVisibility()" name="showPassword" id="cbShow">
                <label for="cbShow">Perlihatkan</label>
            </div>
            <div class="form-floating">
                <button id="ButLogin" class="w-100 btn btn-lg btn-success" type="submit">Login</button>
            </div>

        </form>
        <div class="line-divider"></div>
        <div class="regisPkl">
            <p>Belum Punya Akun? </p>
            <a href="/account/create"><p>Register</p></a>
        </div>
    </div>
</div>

<script src="/js/login.js"></script>
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        passwordInput.type = passwordInput.type === "password" ? "text" : "password";
    }

    document.getElementById("loginForm").addEventListener("submit", function (e) {
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();

        if (email === "" || password === "") {
            e.preventDefault(); // Mencegah form dikirim
            alert("Email dan Password tidak boleh kosong!");
        }
    });
</script>

@endsection
