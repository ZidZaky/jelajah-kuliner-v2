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

    //create
    public function create()
    {
        return view('addProduct');
    }


    //save
    public function store(Request $request)
    {

        $valdata = $request->validate([
            'namaProduk'=>'required',
            'jenisProduk'=>'required',
            'desc'=>'required',
            'harga'=>'required',
            'stok'=>'required',
            'idPKL'=>'required'
        ]);



        // dd($valdata);

        if ($request->hasFile('fotoProduk')) {
            $file = $request->file('fotoProduk');
            $filename = $request->namaProduk . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('product', $filename, 'public');
            $valdata['fotoProduk'] = $filePath;
        } else {
            $isnull = 'null';
            $valdata['fotoProduk'] = $isnull;
        }

        $produk = new Produk();
        $produk->namaProduk = $valdata['namaProduk'];
        $produk->desc = $valdata['desc'];
        $produk->harga = $valdata['harga'];
        $produk->jenisProduk = $valdata['jenisProduk'];
        $produk->fotoProduk = $valdata['fotoProduk'];
        $produk->idPKL = $valdata['idPKL'];
        $produk->save();
        $id= $produk->id;

        $stok = new HistoryStokController();
        $idStok = $stok->store($id,$valdata['stok'],$valdata['idPKL']);
        $cek = $this->updateStokAktif($id,$idStok);
        if($cek){
            $pkl = PKL::findOrFail($valdata['idPKL']);
            return redirect('/dataPKL/'.$pkl->idAccount);
            // return redirect('/dataPKL/'+);
        }

    }


    //edit
    public function edit(Produk $produk)
    {
        return view('editProduk', ['Produk' => $produk]);
    }

    public function updateStokAktif($idProduk,$idStok){
        $find = Produk::findOrFail($idProduk);
        // dd($find);
        $find->stokAktif = $idStok;
        $cek = $find->save();
        // dd($cek);
        return ($cek);
    }
    public function findStok($idProduk){
        $find = Produk::findOrFail($idProduk);
        return $find->stokAktif;
    }
    //update
    public function update(Request $request, Produk $produk)
    {
        $valdata = $request->validate([
            'namaProduk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'foto' => 'nullable',
            'idAccount' => 'required'
        ]);

        $produk->update($valdata);

        return redirect('/PKL');
    }

    //delete
    public function destroy(Produk $produk)
    {
        Produk::destroy($produk->id);
        return redirect('/PKL');
    }


    public function getProduk($id)
    {
        // Fetch ulasan data for the specific PKL ID
        $produk = DB::table('produks as p')
        ->join('history_stoks as h', 'p.stokAktif', '=', 'h.id')
        ->where('p.idPKL', $id)
        ->select([
            'p.id as id',
            'p.desc as deskripsi',
            'p.namaProduk as nama',
            'p.harga as harga',
            'p.fotoProduk as foto',
            'p.idPKL as idPKL',
            DB::raw('CASE WHEN h.statusIsi = 0 THEN h.stokAwal - h.TerjualOnline WHEN h.statusIsi = 1 THEN h.stokAkhir END as sisaStok')
        ])
        ->get();
            // dd($produk);
        // Return ulasan data as JSON
        return response()->json($produk);
    }

    public function riwayatProduk($id) {
        // Find the Pesanan by its ID
        $pkl = PKL::find($id);

         // Retrieve the related products for the Pesanan
         $query = "select * from history_stok where idPKL = ?";
         $riwayat = DB::select($query, [$id]);

        // Check if Pesanan is found

            // Return the view with the updated Pesanan and related products
            return view('riwayatProduk', [
                'riwayat' => $riwayat,
                'pkl' => $pkl
            ]);

    }

    public function buatHistory(Request $request){
        $valdata = $request->validate([
            'idPKL' => 'required',
            'idProduk' => 'required',
            'stokAwal' => 'required'
        ]);

        $berhasil = DB::update('UPDATE `produks` SET `stok` = ? WHERE `id` = ? AND `idpkl` = ?', [
            $valdata['stokAwal'],  // Assuming you want to update the stok with stokAkhir value
            $valdata['idProduk'],
            $valdata['idPKL']
        ]);

        $berhasil2 = DB::insert('INSERT INTO history_stok (id, idProduk, stokAwal, stokAkhir, idPKL, created_at, updated_at) VALUES (NULL, ?, ?, ?, ?, ?, ?)', [
            $valdata['idProduk'],
            $valdata['stokAwal'],
            0,
            $valdata['idPKL'],
            now(),
            now()
        ]);

        if ($berhasil && $berhasil2) {
            return redirect("/riwayatProduk/{$valdata['idPKL']}");
        } else {
            return back()->with('error', 'Failed to save the history.');
        }
    }

public function updateHistory(Request $request)
    {
    $valdata = $request->validate([
        'idPKL' => 'required',
        'idProduk' => 'required',
        'stokAkhir' => 'required'
    ]);

    $affected = DB::update('UPDATE history_stok SET stokAkhir = ?, updated_at = ? WHERE idPKL = ? AND idProduk = ?', [
        $valdata['stokAkhir'],
        now(),
        $valdata['idPKL'],
        $valdata['idProduk']
    ]);

    $berhasil = DB::update('UPDATE `produks` SET `stok` = ? WHERE `id` = ? AND `idpkl` = ?', [
        $valdata['stokAkhir'],  // Assuming you want to update the stok with stokAkhir value
        $valdata['idProduk'],
        $valdata['idPKL']
    ]);

    if ($affected && $berhasil) {
        return redirect("/riwayatProduk/{$valdata['idPKL']}")->with('success', 'History updated successfully.');
    } else {
        return back()->with('error', 'Failed to update the history.');
    }
    }




}
