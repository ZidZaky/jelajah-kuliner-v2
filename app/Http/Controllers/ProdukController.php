<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HistoryStokController;

class ProdukController extends Controller
{
    public static function index()
    {
        return view('list-produk', [
            'Produks' => Produk::all()
        ]);
    }

    // =====================
    // CREATE
    // =====================
    public function create()
    {
        return view('addProduct');
    }

    // =====================
    // STORE
    // =====================
    public function store(Request $request)
    {
        $valdata = $request->validate([
            'namaProduk'  => 'required',
            'jenisProduk' => 'required',
            'desc'        => 'required',
            'harga'       => 'required',
            'stok'        => 'required',
            'idPKL'       => 'required'
        ]);

        if ($request->hasFile('fotoProduk')) {
            $file = $request->file('fotoProduk');
            $filename = $request->namaProduk . '.' . $file->getClientOriginalExtension();
            $valdata['fotoProduk'] = $file->storeAs('product', $filename, 'public');
        } else {
            $valdata['fotoProduk'] = null;
        }

        $produk = Produk::create([
            'namaProduk'  => $valdata['namaProduk'],
            'desc'        => $valdata['desc'],
            'harga'       => $valdata['harga'],
            'jenisProduk' => $valdata['jenisProduk'],
            'fotoProduk'  => $valdata['fotoProduk'],
            'idPKL'       => $valdata['idPKL'],
        ]);

        $stok = new HistoryStokController();
        $idStok = $stok->store($produk->id, $valdata['stok'], $valdata['idPKL']);
        $this->updateStokAktif($produk->id, $idStok);

        $pkl = PKL::findOrFail($valdata['idPKL']);

        return redirect()
            ->route('pkl.detail', $pkl->idAccount)
            ->with('alert', ['Berhasil', 'Produk ' . $produk->namaProduk . ' berhasil ditambahkan']);
    }

    // =====================
    // EDIT
    // =====================
    public function edit(Produk $produk)
    {
        return view('editProduk', ['Produk' => $produk]);
    }

    // =====================
    // UPDATE STOK AKTIF
    // =====================
    public function updateStokAktif($idProduk, $idStok)
    {
        $produk = Produk::findOrFail($idProduk);
        $produk->stokAktif = $idStok;
        return $produk->save();
    }

    public function findStok($idProduk)
    {
        return Produk::findOrFail($idProduk)->stokAktif;
    }

    // =====================
    // UPDATE
    // =====================
    public function update(Request $request, Produk $produk)
    {
        $valdata = $request->validate([
            'namaProduk' => 'required',
            'desc'       => 'required',
            'harga'      => 'required',
            'stok'       => 'required',
            'foto'       => 'nullable',
            'idAccount'  => 'required'
        ]);

        $produk->update($valdata);

        return redirect()->route('PKL.index');
    }

    // =====================
    // DELETE
    // =====================
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('PKL.index');
    }

    // =====================
    // HELPER
    // =====================
    public function getDataNameById($idProduk)
    {
        return Produk::firstWhere('id', $idProduk);
    }

    public function getProduk($id)
    {
        $produk = DB::table('produks as p')
            ->join('history_stoks as h', 'p.stokAktif', '=', 'h.id')
            ->where('p.idPKL', $id)
            ->select([
                'p.id',
                'p.desc as deskripsi',
                'p.namaProduk as nama',
                'p.harga',
                'p.fotoProduk as foto',
                'p.idPKL',
                DB::raw('CASE 
                    WHEN h.statusIsi = 0 THEN h.stokAwal - h.TerjualOnline 
                    WHEN h.statusIsi = 1 THEN h.stokAkhir 
                END as sisaStok')
            ])
            ->get();

        return response()->json($produk);
    }

    public function riwayatProduk($id)
    {
        $pkl = PKL::findOrFail($id);
        $riwayat = DB::select("select * from history_stok where idPKL = ?", [$id]);

        return view('riwayatProduk', [
            'riwayat' => $riwayat,
            'pkl'     => $pkl
        ]);
    }

    public function getNamaProdukById($id)
    {
        return Produk::findOrFail($id)->namaProduk;
    }

    // =====================
    // HISTORY
    // =====================
    public function buatHistory(Request $request)
    {
        $valdata = $request->validate([
            'idPKL'    => 'required',
            'idProduk' => 'required',
            'stokAwal' => 'required'
        ]);

        DB::update(
            'UPDATE produks SET stok = ? WHERE id = ? AND idPKL = ?',
            [$valdata['stokAwal'], $valdata['idProduk'], $valdata['idPKL']]
        );

        DB::insert(
            'INSERT INTO history_stok (idProduk, stokAwal, stokAkhir, idPKL, created_at, updated_at)
             VALUES (?, ?, ?, ?, ?, ?)',
            [$valdata['idProduk'], $valdata['stokAwal'], 0, $valdata['idPKL'], now(), now()]
        );

        return redirect()->route('produk.riwayat', $valdata['idPKL']);
    }

    public function updateHistory(Request $request)
    {
        $valdata = $request->validate([
            'idPKL'     => 'required',
            'idProduk'  => 'required',
            'stokAkhir' => 'required'
        ]);

        DB::update(
            'UPDATE history_stok SET stokAkhir = ?, updated_at = ? WHERE idPKL = ? AND idProduk = ?',
            [$valdata['stokAkhir'], now(), $valdata['idPKL'], $valdata['idProduk']]
        );

        DB::update(
            'UPDATE produks SET stok = ? WHERE id = ? AND idPKL = ?',
            [$valdata['stokAkhir'], $valdata['idProduk'], $valdata['idPKL']]
        );

        return redirect()
            ->route('produk.riwayat', $valdata['idPKL'])
            ->with('success', 'History updated successfully.');
    }
}
