<html>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <div class="back">
            <p>Selamat Pagi, Dika</p>
            <p id="ket">Dashboard ini di siapkan agar kamu lebih mudah melihat rangkuman penjualanmu</p>
        </div>
        <div class="content">
            <div class="filter">
                <button onclick="filter('Today')">Today</button>
                <p>|</p>
                <button onclick="filter('Bulan Ini')">Bulan Ini</button>
                <p>|</p>
                <button onclick="filter('Tahun Ini')">Tahun Ini</button>
            </div>
            <hr>
            <div class="isi">
                <div class="Overview">
                    <p>Analytics Overview</p>
                    <div>
                        <div>
                            <p class="subjudul">Omset Hari Ini</p>
                            <p class="subisi">{{$omset->semua}}</p>
                            <p class="subsatuan">Rupiah</p>
                        </div>
                        <div>
                            <p class="subjudul">Total Keseluruhan</p>
                            <p class="subisi">{{$stok->semua}}</p>
                            <p class="subsatuan">Pcs</p>
                        </div>
                        <div>
                            <p class="subjudul">Pendapatan Online</p>
                            <p class="subisi">{{$omset->online}}</p>
                            <p class="subsatuan">Rupiah</p>
                        </div>
                        <div>
                            <p class="subjudul">Pendapatan Offline</p>
                            <p class="subisi">{{$omset->offline}}</p>
                            <p class="subsatuan">Rupiah</p>
                        </div>
                        <div>
                            <p class="subjudul">Terjual Online</p>
                            <p class="subisi">{{$stok->online}}</p>
                            <p class="subsatuan">Pcs</p>
                        </div>
                        <div>
                            <p class="subjudul">Terjual Offline</p>
                            <p class="subisi">{{$stok->offline}}</p>
                            <p class="subsatuan">Pcs</p>
                        </div>
                    </div>
                    
                    
                    
                </div>
                <hr>
                <div class="product">
                    <p>Analytics Product</p>
                    <div>
                        <div class="Bagan">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                        <div class="legend-container" id="legend"></div>
                    </div>
                    
                </div>
            </div>

        </div>
    </body>

    <script>
        filter('Today')
        function filter($apa){
            let buts = document.querySelectorAll('.filter button');
            buts.forEach(a =>{
                a.style.backgroundColor = "rgb(255,255,255,0.2)"
                a.style.color = "rgb(0,0,0,0.5)"
                if($apa==a.innerText){
                    console.log('sama');
                    a.style.backgroundColor = "rgb(255,255,255,0.7)"
                    a.style.color = "rgb(0,0,0,0.9)"
                }
            });
        }


        // <block:setup:1>
        // Kode konfigurasi Chart.js
        const data = {
            labels: [
                'Pentol Rebus',
                'Kentang Bakar Enak',
                'Yellow',
                'tes'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100,20],
                backgroundColor: [
                    '#FFFFDD',
                    '#995556',
                    '#220000',
                    'white'
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                plugins: {
                    legend: {
                        display: false // Menonaktifkan legend bawaan
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.raw !== null) {
                                    label += context.raw;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        };

        // Inisialisasi dan render grafik
        window.onload = function() {
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, config);

            // Membuat legend custom
            const legendContainer = document.getElementById('legend');
            data.labels.forEach((label, index) => {
                const legendItem = document.createElement('div');
                legendItem.style.display = 'flex';
                legendItem.style.alignItems = 'center';
                legendItem.style.marginBottom = '10px';

                const colorBox = document.createElement('span');
                colorBox.style.backgroundColor = data.datasets[0].backgroundColor[index];
                colorBox.style.width = '20px';
                colorBox.style.height = '20px';
                colorBox.style.display = 'inline-block';
                colorBox.style.marginRight = '10px';

                const labelText = document.createElement('span');
                labelText.textContent = label;
                labelText.style.color = 'white';

                legendItem.appendChild(colorBox);
                legendItem.appendChild(labelText);
                legendContainer.appendChild(legendItem);
            });
        };
    </script>
    <style>
        html::-webkit-scrollbar{
            width: 0;
        }
        body{
            /* width: 100%; */
            /* height: 100%; */
            background-color: #D9D9D9;
            padding: 1%;
            padding-top: 3%;
        }
        body>*{
            /* border:1px black solid; */
        }
        .back{
            display: flex;
            flex-direction: column;
            font-size: 40px;
            font-family: 'Quando', serif;
            font-weight: 800;
            padding: 0 0;
            margin: 0 0;
            margin-bottom: 20px;
        }
        .back>p{
            padding: 0 0;
            margin: 0 0;
        }
        #ket{
            font-weight: 100;
            font-size: 15px;
        }
        .content{
            background-color: #8F2F30;
            padding: 20px;
            border-radius: 20px 20px 0 0;
        }
        hr{
            background-color: white;
            color: white;
        }
        .filter{
            display: flex;
            flex-direction: row;
            gap: 20px;
            width: 300px;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .filter>*{
            /* border: 1px white solid; */
        }
        .filter>hr{
            transform: rotate(90deg);
            width: 100%;
            height: 100%;
            /* width: ; */
        }
        .filter>button{
            background-color: rgb(255,255,255,0.2);
            padding: 5px 10px;
            border:none;
            width: fit-content;
            margin: 0 0;
            color: rgb(0,0,0,0.5);
            border-radius: 8px;
        }
        .filter>button:hover{
            background-color: rgb(255,255,255,0.7);
            color: rgb(0,0,0,0.9);

        }

        .isi{
            display: flex;
            flex-direction: row;
            /* border: #D9D9D9 1px solid; */
            width: 100%;
            height: 70%;
        }
        .isi>*{
            /* border: #D9D9D9 1px solid; */

        }
        .Overview{
            width: 60%;
            display: flex;
            flex-direction: column; 
        }
        .Overview>*{
            /* border: #D9D9D9 1px solid; */
        }
        .Overview>p{
            padding: 0 0;
            margin: 0 0;
            /* height: 20%; */
            margin-top: 5%;
            margin-bottom: 12px;
            padding-left: 4%;
            font-size:x-large;
            color: white;
            /* padding-left: 10px; */
            font-weight: 700;
            font-family: Arial, Helvetica, sans-serif;
            /* justify-content: ; */
            /* align-items:; */
        }
        .Overview>div{
            /* border: yellow 1px solid !important; */
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 10px 3%;
            height: 90%;
            /* padding: 12px ; */
        }
        .Overview>div>*{
            /* border: yellow 1px solid !important; */

        }
        .Overview>div>div{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content:space-between;
            width: 45%;
            height: 25%;
            background-color: #D9D9D9;
            border-radius: 12px;
            gap: 10px;
            padding: 0.5% 0;
        }
        @font-face {
            font-family: 'Inter';
            src: url('fonts/Inter-Regular.woff2') format('woff2'),
                url('fonts/Inter-Regular.woff') format('woff');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Inter';
            src: url('fonts/Inter-Bold.woff2') format('woff2'),
                url('fonts/Inter-Bold.woff') format('woff');
            font-weight: 700;
            font-style: normal;
        }
        .Overview>div>div>p{
            /* font-size: 15px; */
            padding: 0 0;
            margin: 0 0;
            color: #8F2F30;
            font-weight: 800;
            font-family:'Inter', sans-serif;
        }
        .subjudul,.subsatuan{
            font-size: 15px;
        }
        .subisi{
            font-size: xx-large;
        }
        .subisi:hover{
            font-size: 40px;
        }
        .product{
            width: 38%;
            /* height: ; */
            display: flex;
            flex-direction: column; 
        }
        .product>*{
            /* border: #D9D9D9 1px solid; */
        }
        .Product>p{
            width: 100%;
            text-align:center;
            padding: 0 0;
            margin: 0 0;
            /* height: 20%; */
            margin-top: 7.5%;
            margin-bottom: 12px;
            padding-left: 4%;
            font-size:x-large;
            color: white;
            /* padding-left: 10px; */
            font-weight: 700;
            font-family: Arial, Helvetica, sans-serif;
            /* justify-content: ; */
            /* align-items:; */
        }
        .product>div{
            display: flex;
            flex-direction: row;
            /* flex-wrap: wrap; */
            align-items: center;
            justify-content: center;
            gap: 10px 3%;
            height: 90%;
        }
        .product>div>*{
            /* border: #D9D9D9 1px solid; */
        }
        .product>div>.Bagan{
            width: 350px;
        }
    </style>
</html>