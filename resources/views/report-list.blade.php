@extends('layouts.layout')


@section('title')
    Report Account
@endsection

@section('css')
    <link rel="stylesheet" href="css/dataPKL.css">
@endsection

@section('isiAlert')
    @if((session('alert')) != null)

        @php echo session('alert'); @endphp
    @endif
@endsection

@section('isi')
    <div
        style="border: 1px solid green; height: 600px; background-color: white; margin: auto 15px; border-radius: 5px; padding: 10px;">
        <div class="d-flex">
            <!-- BIRU -->
            <div style="border: 1px solid blue; width: 70%; padding: 10px; margin-right: 10px; height: 580px;">
                <div style="border: 1px solid green; height: 15%; margin-bottom: 10px;">
                    <h2><strong>List Account Reported!</strong></h2>
                    <h5>Dashboard ini Disiapkan Agar Kamu Lebih Mudah Melihat Siapa Saja yang Dilaporkan.</h5>
                </div>
                <div style="border: 1px solid orange; height: 85%;">
                    <div class="d-flex flex-column align-items-start gap-2 mb-3">
                        <div class="btn-group gap-1" role="group">
                            <input type="radio" class="btn-check" name="reportStatus" id="needAction" value="needAction"
                                autocomplete="off" checked onchange="toggleForm('needAction')">
                            <label class="btn d-flex justify-content-center align-items-center"
                                style="height: 30px; width: 170px; border: 2px solid #6D2323; border-radius: 5px 5px 0 0; background-color: #6D2323; color: white;"
                                for="needAction"><strong>Need Action</strong></label>

                            <input type="radio" class="btn-check" name="reportStatus" id="accepted" value="accepted"
                                autocomplete="off" onchange="toggleForm('accepted')">
                            <label class="btn d-flex justify-content-center align-items-center"
                                style="height: 30px; width: 170px; border: 2px solid #6D2323; border-radius: 5px 5px 0 0; background-color: white; color: #6D2323;"
                                for="accepted"><strong>Accepted Report</strong></label>

                            <input type="radio" class="btn-check" name="reportStatus" id="rejected" value="rejected"
                                autocomplete="off" onchange="toggleForm('rejected')">
                            <label class="btn d-flex justify-content-center align-items-center"
                                style="height: 30px; width: 170px; border: 2px solid #6D2323; border-radius: 5px 5px 0 0; background-color: white; color: #6D2323;"
                                for="rejected"><strong>Rejected Report</strong></label>
                        </div>

                        <style>
                            .btn:hover {
                                background-color: #6D2323 !important;
                                color: white !important;
                            }

                            .btn-check:checked+.btn {
                                background-color: #6D2323 !important;
                                color: white !important;
                            }

                            .btn-check:checked+.btn:hover {
                                background-color: #6D2323 !important;
                                color: white !important;
                            }
                        </style>
                        <div class="table-responsive w-100">
                            <table class="table table-hover w-100">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nama User</th>
                                        <th>Alasan</th>
                                        <th>Status Report</th>
                                        <th>Bukti</th>
                                        <th>User Pelapor</th>
                                        <th>Action</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td>John Doe</td>
                                        <td>Pelanggaran Ketentuan</td>
                                        <td><label class="badge" style="border: 1px solid #6D2323; color: #6D2323; background-color: white; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#6D2323'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#6D2323'">Open</label></td>
                                        <td>
                                            <a href="#" class="text-primary text-decoration-none">Lihat Bukti</a>
                                        </td>
                                        <td>Jane Smith</td>
                                        <td>
                                            <div class="btn-group gap-1">
                                                <label class="badge" style="border: 1px solid #198754; color: white; background-color: #0f5232; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#18ab67'" onmouseout="this.style.backgroundColor='#0f5232'">Accept Report</label>
                                                <label class="badge" style="border: 1px solid #6D2323; color: #6D2323; background-color: white; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#6D2323'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#6D2323'">Reject Report</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-primary text-decoration-none">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sarah Johnson</td>
                                        <td>Konten Tidak Pantas</td>
                                        <td><label class="badge" style="border: 1px solid #6D2323; color: #6D2323; background-color: white; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#6D2323'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#6D2323'">Open</label></td>
                                        <td>
                                            <a href="#" class="text-primary text-decoration-none">Lihat Bukti</a>
                                        </td>
                                        <td>Mike Brown</td>
                                        <td>
                                            <div class="btn-group gap-1">
                                                <label class="badge" style="border: 1px solid #198754; color: white; background-color: #0f5232; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#18ab67'" onmouseout="this.style.backgroundColor='#0f5232'">Accept Report</label>
                                                <label class="badge" style="border: 1px solid #6D2323; color: #6D2323; background-color: white; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#6D2323'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#6D2323'">Reject Report</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-primary text-decoration-none">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>David Wilson</td>
                                        <td>Spam</td>
                                        <td><label class="badge" style="border: 1px solid #6D2323; color: #6D2323; background-color: white; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#6D2323'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#6D2323'">Open</label></td>
                                        <td>
                                            <a href="#" class="text-primary text-decoration-none">Lihat Bukti</a>
                                        </td>
                                        <td>Lisa Anderson</td>
                                        <td>
                                            <div class="btn-group gap-1">
                                                <label class="badge" style="border: 1px solid #198754; color: white; background-color: #0f5232; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#18ab67'" onmouseout="this.style.backgroundColor='#0f5232'">Accept Report</label>
                                                <label class="badge" style="border: 1px solid #6D2323; color: #6D2323; background-color: white; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#6D2323'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#6D2323'">Reject Report</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-primary text-decoration-none">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Emily Davis</td>
                                        <td>Pelanggaran Hak Cipta</td>
                                        <td><label class="badge" style="border: 1px solid #6D2323; color: #6D2323; background-color: white; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#6D2323'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#6D2323'">Open</label></td>
                                        <td>
                                            <a href="#" class="text-primary text-decoration-none">Lihat Bukti</a>
                                        </td>
                                        <td>Robert Taylor</td>
                                        <td>
                                            <div class="btn-group gap-1">
                                                <label class="badge" style="border: 1px solid #198754; color: white; background-color: #0f5232; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#18ab67'" onmouseout="this.style.backgroundColor='#0f5232'">Accept Report</label>
                                                <label class="badge" style="border: 1px solid #6D2323; color: #6D2323; background-color: white; transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.backgroundColor='#6D2323'; this.style.color='white'" onmouseout="this.style.backgroundColor='white'; this.style.color='#6D2323'">Reject Report</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-primary text-decoration-none">Lihat Detail</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div id="needActionContent" class="mt-3 w-100">
                            <h1>Need Action Content</h1>
                        </div>

                        <div id="acceptedContent" class="mt-3 d-none w-100">
                            <h1>Accepted Report Content</h1>
                        </div>

                        <div id="rejectedContent" class="mt-3 d-none w-100">
                            <h1>Rejected Report Content</h1>
                        </div>

                        <script>
                            function toggleForm(jenis) {
                                if (jenis === 'needAction') {
                                    document.getElementById('needActionContent').classList.remove('d-none');
                                    document.getElementById('acceptedContent').classList.add('d-none');
                                    document.getElementById('rejectedContent').classList.add('d-none');
                                } else if (jenis === 'accepted') {
                                    document.getElementById('needActionContent').classList.add('d-none');
                                    document.getElementById('acceptedContent').classList.remove('d-none');
                                    document.getElementById('rejectedContent').classList.add('d-none');
                                } else {
                                    document.getElementById('needActionContent').classList.add('d-none');
                                    document.getElementById('acceptedContent').classList.add('d-none');
                                    document.getElementById('rejectedContent').classList.remove('d-none');
                                }
                            }
                        </script>
                    </div>
                    <style>
                        .btn-check:checked+.btn-outline-danger {
                            background-color: #6D2323 !important;
                            color: white !important;
                        }
                    </style>
                    <script>
                        function changeLabel(label) {
                            // Reset semua button ke inactive
                            document.getElementById('needAction').checked = false;
                            document.getElementById('accepted').checked = false;
                            document.getElementById('rejected').checked = false;

                            // Set button yang dipilih ke active
                            document.getElementById(label).checked = true;
                        }
                    </script>
                </div>
            </div>
            <!-- MERAH -->
            <div style="border: 1px solid red; width: 30%; padding: 10px;">

            </div>
        </div>
    </div>

@endsection