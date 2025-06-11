@extends('layouts.layout')

@section('title', 'Account Reports')

@section('css')
<link rel="stylesheet" href="{{ auto_asset('css/List.css') }}">
<style>
    /* Menambahkan beberapa style agar tombol terlihat bagus di dalam tabel */
    .action-buttons {
        display: flex;
        gap: 0.5rem; /* Memberi jarak antar tombol */
        align-items: center;
        justify-content: flex-start;
    }
    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .user-info img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
@endsection

@section('isi')
<div class="second-bg w-100 h-100 p-3" style="min-height: 100vh;">
    <div class="d-flex flex-column justify-content-start align-items-start mb-3">
        <h2 class="">List Account Reported</h2>
        <p>Dashboard ini disiapkan agar kamu lebih mudah melihat siapa saja yang dilaporkan.</p>
    </div>
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active text-black text-decoration-none" aria-current="page" href="#">Need Action</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black text-decoration-none" href="#">Accepted Report</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-black text-decoration-none" href="#">Rejected Report</a>
            </li>
        </ul>
    </div>
    <div>
        <section class="d-flex gap-4 flex-column shadow">
            <div class="tbl-header rounded-2">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>ID Report</th>
                            <th>Pengguna Dilaporkan</th>
                            <th>PKL Pelapor</th>
                            <th>Alasan</th>
                            <th>ID Pesanan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        @forelse ($reports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>
                                {{-- Menampilkan info pengguna dengan lebih baik --}}
                                @if($report->reportedUser)
                                <div class="user-info">
                                    <img src="{{ asset('storage/' . $report->reportedUser->foto) }}" alt="Foto">
                                    <span>{{ $report->reportedUser->nama }}</span>
                                </div>
                                @else
                                <span class="text-danger">Akun Dihapus</span>
                                @endif
                            </td>
                            <td>
                                {{-- Menampilkan nama PKL pelapor --}}
                                {{ $report->reporterPkl->namaPKL ?? 'PKL Dihapus' }}
                            </td>
                            <td>{{ $report->alasan }}</td>
                            <td>
                                {{-- Jadikan link jika perlu --}}
                                <a href="/pesanDetail/{{ $report->idPesanan }}">{{ $report->idPesanan }}</a>
                            </td>
                            <td>
                                {{-- Tombol Aksi dari halaman lama --}}
                                <div class="action-buttons">
                                    @if($report->reportedUser && $report->reportedUser->status != "alert")
                                        <button class="btn btn-sm btn-danger" onclick="confirmBan('{{ $report->id }}')">Ban</button>
                                    @elseif($report->reportedUser)
                                        <button class="btn btn-sm btn-success" onclick="confirmUnBan('{{ $report->id }}')">Unban</button>
                                    @endif

                                    <form action="{{ route('report.destroy', $report->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">Clear</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            {{-- colspan="6" agar pesan memenuhi semua kolom tabel --}}
                            <td colspan="6" class="text-center">Semua Baik-baik Saja! Tidak ada laporan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection

@section('js')
{{-- JavaScript dari halaman lama, dengan perbaikan pada delete --}}
<script>
    function confirmBan(reportId) {
        if (confirm("Apakah kamu yakin untuk Melakukan Ban Kepada Pengguna ini?")) {
            // Route ini sudah benar sesuai file web.php Anda
            window.location.href = "/banUser/" + reportId;
        }
    }

    function confirmUnBan(reportId) {
        if (confirm("Apakah kamu yakin untuk Melakukan UnBan Kepada Pengguna ini?")) {
            // Route ini sudah benar sesuai file web.php Anda
            window.location.href = "/unbanUser/" + reportId;
        }
    }

    // Fungsi deletereport() tidak diperlukan lagi.
    // Kita menggunakan konfirmasi langsung di tombol 'Clear'.
</script>
@endsection