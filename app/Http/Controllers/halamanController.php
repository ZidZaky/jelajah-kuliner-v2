<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HistoryStokController;
use App\Models\Account;
use App\Models\PKL;
use App\Models\Produk;
use Exception;
use Illuminate\Support\Facades\DB;


class halamanController extends Controller
{
    // =====================
    // UPDATE STOK AWAL
    // =====================
    public function UpdateStatusStok(Request $req)
    {
        $val = $req->validate([
            'stokAwal' => 'required',
            'idproduk' => 'required',
        ]);

        $val['idPKL'] = session('PKL')->id;
        $pkl = PKL::findOrFail($val['idPKL']);

        if (is_numeric($val['stokAwal'])) {
            $stok = new HistoryStokController();
            $idStok = $stok->store($val['idproduk'], $val['stokAwal'], $val['idPKL']);

            $produk = new ProdukController();
            if ($produk->updateStokAktif($val['idproduk'], $idStok)) {
                return redirect()
                    ->route('pkl.detail', $pkl->idAccount)
                    ->with('alert', ['Berhasil', 'Tambah Stok Awal Berhasil']);
            }
        }

        return redirect()
            ->route('pkl.detail', $pkl->idAccount)
            ->with('erorAlert', ['Gagal', 'Tambah Stok Awal Gagal']);
    }

    // =====================
    // UPDATE STOK AKHIR
    // =====================
    public function UpdateStokAkhir(Request $req)
    {
        $val = $req->validate([
            'stokAkhir' => 'required',
            'idproduk' => 'required',
        ]);

        $val['idPKL'] = session('PKL')->id;
        $pkl = PKL::findOrFail($val['idPKL']);

        if (!is_numeric($val['stokAkhir'])) {
            return redirect()
                ->route('pkl.detail', $pkl->idAccount)
                ->with('erorAlert', [
                    'Gagal Update Stok Akhir',
                    'field Stok Akhir tidak berupa nomor'
                ]);
        }

        $produk = new ProdukController();
        $idStok = $produk->findStok($val['idproduk']);

        $stok = new HistoryStokController();
        if ($stok->UpdateStokAkhir($val['stokAkhir'], $idStok)) {
            return redirect()
                ->route('pkl.detail', $pkl->idAccount)
                ->with('alert', ['Berhasil', 'Ubah Stok Akhir Berhasil']);
        }
    }

    // =====================
    // DASHBOARD PENJUALAN
    // (tidak ada redirect hardcode → aman)
    // =====================

    // =====================
    // HISTORY STOK
    // =====================
    public function history($idProduk)
    {
        $data = $this->getrwtStok(session('pkl')->id, $idProduk);
        $namaProduk = (new ProdukController())->getNamaProdukById($idProduk);

        return view('HistoryStok', compact('data', 'namaProduk'));
    }
}
