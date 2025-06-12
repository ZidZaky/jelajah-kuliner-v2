<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\PKL;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HistoryStokController;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    //
    public static function index($id)
    {
        // Retrieve Pesanan data
        $Pesanan = Pesanan::find($id);

        // Check if Pesanan data exists
        if ($Pesanan) {
            // Retrieve associated products
            $Produks = Produk::where('idPesanan', $Pesanan->id)->get();

            return view('pesanan', [
                'Pesanan' => $Pesanan,
                'Produks' => $Produks
            ]);
        } else {
            // Handle case where Pesanan data does not exist
            return response()->view('errors.404', [], 404);
        }
    }


    //create
    public function create($id)
    {
        return view('CreatePesanan');
        // dd($id);
        // Retrieve Pesanan data
        $Pesanan = Pesanan::find($id);

        // Check if Pesanan data exists
        if ($Pesanan) {
            // Retrieve associated products
            $Produks = Produk::where('idPesanan', $Pesanan->id)->get();

            return view('CreatePesanan', [
                'Pesanan' => $Pesanan,
                'Produks' => $Produks
            ]);
        } else {
            // Handle case where Pesanan data does not exist
            return response()->view('errors.404', [], 404);
        }
    }


    //save
    public function store(Request $request)
    {
        // dd($request);
        // Create a new Pesanan instance
        // dd($request);
        $validate = Validator::make($request->all(), [
            'totalHarga' => 'required|not_in:0'
        ], ['totalHarga.not_in' => 'Belum ada barang yang dicheckout']);
        if ($validate->fails()) {
            // dd('masuk');
            return redirect()->back()->with('alert', 'Belum ada barang yang dicheckout');
        }
        $pesanan = new Pesanan();
        // dd( session('account')->id);
        $pesanan->idAccount = session('account')->id;
        $pesanan->idPKL = $request->input('idPKL');
        $pesanan->Keterangan = $request->input('keterangan') ?? '';
        $pesanan->TotalBayar = $request->input('totalHarga');
        $pesanan->status = 'Pesanan Baru';

        // Save the Pesanan instance
        if ($pesanan->save()) {
            // Retrieve the ID of the saved Pesanan
            $idPesanan = $pesanan->id;

            // Iterate through each product in the request
            foreach ($request->except(['_token', 'idAccount', 'idPKL', 'totalHarga', 'keterangan', 'status']) as $key => $value) {
                // Extract the product ID from the input name
                // dd($key);
                // dd($key);
                $idProduk = explode('produk', $key)[1];

                // Check if a record with the same idPesanan and idProduk already exists
                $existingRecord = DB::table('produk_dipesan')
                    ->where('idPesanan', $idPesanan)
                    ->where('idProduk', $idProduk)
                    ->first();

                // If no existing record found, insert a new record
                if (!$existingRecord) {
                    if ($value != 0) {
                        DB::table('produk_dipesan')->insert([
                            'idPesanan' => $idPesanan,
                            'idProduk' => $idProduk,
                            'JumlahProduk' => $value
                        ]);
                    }
                }
            }


            // Redirect to dashboard with success message
            return redirect('/dashboard')->with('alert', ['Pesanan berhasil disimpan',' ID Pesanan: ' . $idPesanan]);
        } else {
            // Redirect back to Pesanan create page with error message
            return redirect('/Pesanan/create')->with('error', 'Gagal menyimpan data Pesanan.');
        }
    }



    //edit
    public function edit(Pesanan $Pesanan)
    {
        return view('editPesanan', ['Pesanan' => $Pesanan]);
    }

    //update
    public function update(Request $request, Pesanan $Pesanan)
    {
        $valdata = $request->validate([
            'namaPesanan' => 'required',
            'desc' => 'required',
            'idAccount' => 'required'
        ]);

        $Pesanan->update($valdata);

        return redirect('/Pesanan');
    }

    //delete
    public function destroy(Pesanan $Pesanan)
    {
        Pesanan::destroy($Pesanan->id);
        return redirect('account-list');
    }

    public static function showAll()
    {
        $Pesanan = Pesanan::all();


        return
            ['dataPesanan' => $Pesanan];
    }

    public static function show(Request $request)
    {
        // dd($id,$wht);
        // dd($request);
        $id = $request->query('id');
        $wht = $request->query('wht');
        $role = session('account')->status;
        $idPKL = null;
        $Pesanan = null;
        if($role=='PKL'){
            $idPKL = ((new PKLController())->getDataPklbyId(session('account')->id))->id;
            $Pesanan = Pesanan::where('idPKL', $idPKL)->get();
            // dd($idPKL);
            foreach ($Pesanan as $data) {
                $data['namaPemesan'] = (new AccountController())->getNameById($data->idAccount);
            }
        }
        else{
            $Pesanan = Pesanan::where('idAccount', $id)->get();
            foreach ($Pesanan as $data) {
                $data['namaPKL'] = (new PKLController())->getNamePklById($data->idPKL);
            }
            // dd($Pesanan);
        }
        // dd($Pesanan);
        
        return view('List_Pesanan', ['dataPesanan' => $Pesanan, 'wht'=>$wht]);
    }

    public static function showDetail($idAccount)
    {
        $PesananData = Pesanan::where('idAccount', $idAccount)->first();
        // dd($PesananData);
        $produk = Produk::where('idPesanan', $PesananData->id)->get();
        // $ulasan = Ulasan::where('idPesanan', $PesananData->id)->get();;
        session(['Pesanan' => $PesananData]);

        return view('dataPesanan', [
            'Pesanan' => $PesananData,
            'produk' => $produk
            // 'ulasan' => $ulasan
        ]);
    }

    public function createWithId($id)
    {
        // Retrieve Pesanan data
        $PKL = PKL::find($id);

        // Check if Pesanan data exists
        if ($PKL) {
            // dd($PKL);
            // Retrieve associated products
            $Produks = DB::table('produks as p')
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
            // dd($Produks);


            return view('pesan', [
                'pkl' => $PKL,
                'produk' => $Produks
            ]);
        } else {
            // Handle case where Pesanan data does not exist
            return response()->view('errors.404', [], 404);
        }
    }
    public function pesanDetail($id)
    {
        $pesan = Pesanan::find($id);
        if(session('account')->status=='PKL'){
            $pesan->namaPemesan = (new AccountController())->getNameById($pesan->idAccount);
        }
        else{
            $pesan->namaPKL = (new PKLController())->getNamePklById($pesan->idPKL);
        }
        $query = "select * from produk_dipesan where idPesanan = ?";
        // Execute the query
        $produk = DB::select($query, [$pesan->id]);
        foreach ($produk as $item) {
            $data = (new ProdukController())->getDataNameById($item->idProduk);
            $item->nama = $data->namaProduk;
            $item->hargaSatuan = $data->harga;
        }
        // dd($pesan, $produk);
        // dd($pesan,$produk);

        // dd($produk);
        // $pesan = Pesanan::find($id);
        return view('List_DetilPesanan', [
            'pesan' => $pesan,
            'produks' => $produk
        ]);
    }

    public function terimaPesanan(Request $request)
    {
        // Find the Pesanan by its ID
        $id = $request->query('id');
        $wht = $request->query('wht');
        $pesan = Pesanan::find($id);

        // Check if Pesanan is found
        if ($pesan) {
            // Update the status to "Pesanan Diproses"
            $pesan->status = 'Pesanan Diproses';

            // Save the changes to the database
            $pesan->save();

            // Retrieve the related products for the Pesanan
            $query = "select * from produk_dipesan where idPesanan = ?";
            $produk = DB::select($query, [$pesan->id]);

            // Return the view with the updated Pesanan and related products
            if($wht=='Pesanan'){
                return redirect('/pesanan/show/?id='.session('account')['id'].'&wht=Pesanan Baru');
            }
            else{
                return redirect('Detil/' . $id);
            }
        } else {
            // Handle the case where Pesanan is not found
            return redirect()->back()->with('error', 'Pesanan not found.');
        }
    }

    public function tolakPesanan(Request $request)
    {
        // Find the Pesanan by its ID
        $id = $request->query('id');
        $wht = $request->query('wht');

        $pesan = Pesanan::find($id);

        // Check if Pesanan is found
        if ($pesan) {
            // Update the status to "Pesanan Diproses"
            $pesan->status = 'Pesanan Ditolak';

            // Save the changes to the database
            $pesan->save();
            if($wht=='Pesanan'){
                return redirect('/pesanan/show/?id='.session('account')['id'].'&wht=Pesanan Baru');
            }
            else{
                return redirect('Detil/' . $id);
            }
        } else {
            // Handle the case where Pesanan is not found
            return redirect()->back()->with('error', 'Pesanan not found.');
        }
    }

    public function batalPesanan(Request $request)
    {
        // dd($request);
        $id = $request->query('id');
        $wht = $request->query('wht');
        // Find the Pesanan by its ID
        // dd($id);
        $pesan = Pesanan::find($id);
        // dd($pesan);

        // Check if Pesanan is found
        if ($pesan) {
            // dd($pesan);
            // Update the status to "Pesanan Diproses"
            if($pesan->status == 'Pesanan Baru'){
                $pesan->status = 'Pesanan Dibatalkan';
                // Save the changes to the database
                $pesan->save();
    
                // Retrieve the related products for the Pesanan
                // $query = "select * from produk_dipesan where idPesanan = ?";
                // Execute the query
                // dd($produk);
                // $pesan = Pesanan::find($id);
                if($wht=='Pesanan'){
                    // dd('masuk1');
                    return redirect('/pesanan/show/?id='.session('account')['id'].'&wht=Pesanan Baru')->with('alert',['Berhasil', 'Pesanan Berhasil Dibatalkan']);
                }
                else{
                    // dd('masuk2');
                    // if()
                    return redirect('Detil/' . $id)->with('alert',['Berhasil', 'Pesanan Berhasil Dibatalkan']);;
                }
            }
            else{
                if($wht=='Pesanan'){
                    // dd('masuk1');
                    return redirect('/pesanan/show/?id='.session('account')['id'].'&wht=Pesanan Baru')->with('erorAlert',['Gagal', 'Pesanan Sudah Diproses Oleh Penjual']);
                }
                else{
                    // dd('masuk2');
                    // if()
                    return redirect('Detil/' . $id)->with('erorAlert',['Gagal', 'Pesanan Sudah Diproses Oleh Penjual']);;
                }
            }

        } else {
            // Handle the case where Pesanan is not found
            return redirect()->back()->with('error', 'Pesanan not found.');
        }
    }
    public function DetilPesanan($idPesanan) {}
    public function selesaiPesanan(Request $request)
    {
        // Find the Pesanan by its ID
        $id = $request->query('id');
        $wht = $request->query('wht');
        $pesan = Pesanan::find($id);
        $pesan->status = 'Pesanan Selesai';
        $pesan->save();
        if($wht=='Pesanan'){
                return redirect('/pesanan/show/?id='.session('account')['id'].'&wht=Pesanan Siap Diambil');
            }
            else{
                return redirect('Detil/' . $id);
            }
    }

    public function reportPesanan($id)
    {
        $pesan = Pesanan::find($id);
        $pesan->Dilaporkan = 'Ya';
        $pesan->save();
    }

    public function siapDiambilPesanan(Request $request)
    {
        // Find the Pesanan by its ID
        $id = $request->query('id');
        $wht = $request->query('wht');
        // Find the Pesanan by its ID
        $pesan = Pesanan::find($id);

        // Retrieve the related products for the Pesanan
        $query = "select * from produk_dipesan where idPesanan = ?";
        $produk = DB::select($query, [$pesan->id]);
        //  dd($produk);
        foreach ($produk as $p) {
            $barang = Produk::find($p->idProduk);
            // dd($barang);
            $stok = new HistoryStokController();
            // dd($p->JumlahProduk);
            if ($stok->UpdatestokOnline($p->JumlahProduk, $barang->stokAktif)) {
                // dd('true');
            }
        };


        // Check if Pesanan is found
        if ($pesan) {
            // Update the status to "Pesanan Diproses"
            $pesan->status = 'Pesanan Siap Diambil';

            // Save the changes to the database
            $pesan->save();



            // Return the view with the updated Pesanan and related products
            if($wht=='Pesanan'){
                return redirect('/pesanan/show/?id='.session('account')['id'].'&wht=Pesanan Diproses');
            }
            else{
                return redirect('Detil/' . $id);
            }
        } else {
            // Handle the case where Pesanan is not found
            return redirect()->back()->with('error', 'Pesanan not found.');
        }
    }
    public function getPesananSelesai($idPkl)
    {

        $pesanans = Pesanan::where('idPKL', 1)
            ->where('status', 'Pesanan Selesai')
            ->get();
    }
}
