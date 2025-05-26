@extends('layouts.layout2')

@section('title')
    BUAT DATA PKL || JELAJAHKULINER
@endsection

@section('css')
    <link rel="stylesheet" href="/css/register.css">
@endsection

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center" style="color: #F08A5D"><strong>Lengkapilah Data PKL Anda!</strong>
                </h5><br>
                <form id="myForm" method="POST" action="/PKL" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="namaPKL" class="form-label">Nama PKL</label>
                        <input type="text" class="form-control" id="namaPKL" name="namaPKL" placeholder="Nama PKL">
                    </div>

                    <div class="mb-3">
                        <label for="desc" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="desc" name="desc" placeholder="Deskripsi PKL"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="picture" class="form-label">Foto PKL</label>
                        <input type="file" class="form-control" id="picture" name="picture" placeholder="Masukkan Foto PKL">
                    </div>

                    <input type="text" name="latitude" id="latitude" placeholder="Latitude" hidden>
                    <input type="text" name="longitude" id="longitude" placeholder="Longitude" hidden>

                    <input type="text" class="form-control" id="idAccount" name="idAccount" placeholder="ID Akun"
                        value="{{ session('account')['id'] }}" readonly hidden>

                    <button type="submit" class="btn btn-success d-grid gap-2 col-4 mx-auto">Simpan Data</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        // Function to capture current location
        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        // Function to display latitude and longitude
        function showPosition(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;

            // Submit the form
            document.getElementById("myForm").submit();
        }

        // Attach event listener to form submission
        document.getElementById("myForm").addEventListener("submit", function(event) {
            // Prevent default form submission
            event.preventDefault();

            // Call function to get current location
            getCurrentLocation();
        });
    </script>
@endsection
