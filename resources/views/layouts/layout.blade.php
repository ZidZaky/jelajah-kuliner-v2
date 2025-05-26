<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('css')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" />

    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/sidebar.css">


</head>

<body>
    @if(session('alert')!=null)
    <div class="AllertArea" id="AreaAllert">
        <div class="theAllert">
            <p>Pemberitahuan</p>
            <div class="alrtkonten">
                <p class="Allrisiisi">@yield('isiAlert')</p>
            </div>
            <div>
                <button onclick="closeAlert()">Close</button>

            </div>
        </div>
    </div>
    @endif
    @include('components.navbar')
    <div class="main">

        @yield('main')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        function closeAlert(){
            let alrt = document.getElementById('AreaAllert');
            alrt.style.display="none";
        }
    </script>
</body>
<style>
    .AllertArea{
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: rgb(0,0,0,0.8);
        z-index: 900;
        display: flex;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    body{
        position: relative;
        z-index: 500;
    }
    .theAllert{
        width: 500px;
        height: fit-content;
        background-color:#902c34;
        border-radius: 8PX;
        padding: 10px 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .theAllert p{
        width: 100%;
        margin: 0;
        padding-bottom: 0;
        text-align: center;
    }
    .theAllert>p{
        color: rgb(255,255,255,0.8);

        border-bottom: 0.5px rgb(255,255,255,0.8) solid;

    }
    .theAllert button{
        background-color: green;
        color: rgb(255,255,255,0.8);
        border: none;
        border-radius: 5px;
        margin-top: 5px;
        font-size: 12px;
        padding: 2px 10px;
    }
    .theAllert>div{
        width: 100%;
        display: flex;
        /* flex-direction: ; */
        align-items: center;
        justify-content: center;
    }
    .alrtkonten{
        padding: 20px 0;
        border-bottom: 0.5px rgb(255,255,255,0.8) solid;
        background-color: rgb(255,255,255,0.5);
        color: black;
    }
    .Allrisi{
        color: black;
        /* padding: 20px 50px; */
    }

</style>
</html>
