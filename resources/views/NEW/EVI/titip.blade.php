<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.6;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 2cm;
            box-sizing: border-box;
            page-break-after: always;
        }

        .kop {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .kop h2,
        .kop h3,
        .kop p {
            margin: 0;
        }

        .judul {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            text-decoration: underline;
        }

        .nomor {
            text-align: center;
            margin-bottom: 20px;
        }

        .isi {
            text-align: justify;
        }

        .ttd {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }

        .ttd p {
            text-align: left;
        }

        @media print {
            body {
                margin: 0;
            }

            .container {
                padding: 0;
            }
        }
    </style>
</head>

<body class="d-flex flex-column">

    @for ($i = 0; $i < 5; $i++)
        <div class="container">
            <div class="kop">
                <h2>UNIVERSITAS CONTOH</h2>
                <h3>FAKULTAS TEKNIK</h3>
                <p>Jl. Pendidikan No.1, Kota Ilmu, Indonesia | Telp: (021) 12345678 | Email: info@contoh.ac.id</p>
            </div>

            <div class="judul">SURAT PENGANTAR MAGANG</div>
            <div class="nomor">Nomor: 123/FT/PKL/2025</div>

            <div class="isi">
                <p>Kepada Yth.<br>
                    Tim Recrutment PT Teknologi Maju<br>
                    di Tempat</p>

                <p>Dengan hormat,</p>
                <p>Sehubungan dengan program akademik yang mewajibkan mahasiswa untuk melaksanakan kegiatan magang,
                    maka dengan ini kami memperkenalkan:</p>

                <ul>
                    <li><strong>Nama</strong> : Zidan Irfan Zaky</li>
                    <li><strong>NIM</strong> : 1201</li>
                    <li><strong>Program Studi</strong> : Software Engineering</li>
                    <li><strong>Fakultas</strong> : Fakultas Informatika</li>
                    <li><strong>Universitas</strong> : Universitas Telkom</li>
                </ul>

                <p>Mahasiswa tersebut direncanakan untuk melaksanakan magang selama <strong>2 bulan</strong>, terhitung
                    mulai tanggal <strong>1 Juli 2025</strong> sampai dengan <strong>31 Agustus 2025</strong>.</p>

                <p>Demikian surat pengantar ini kami sampaikan. Atas perhatian dan kerjasama Bapak/Ibu, kami ucapkan
                    terima kasih.</p>
            </div>

            <div class="ttd">
                <div>
                    <p>Kota Ilmu, 31 Mei 2025<br>
                        Ketua Program Studi</p>
                    <br><br><br>
                    <p><strong>Dr. Siti Rahmawati, M.T.</strong><br>
                        NIDN: 1234567890</p>
                </div>
            </div>
        </div>
    @endfor

</body>

</html>
