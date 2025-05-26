<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Models\Produk;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PKLController extends Controller
{


    //
    public static function index($id)
    {
        // Retrieve PKL data
        $PKL = PKL::find($id);

        // Check if PKL data exists
        if ($PKL) {
            // Retrieve associated products
            $Produks = Produk::where('idPKL', $PKL->id)->get();

            // Retrieve associated ulasan based on PKL ID
            $ulasan = Ulasan::where('idPKL', $PKL->id)->get();;


            return view('dataPKL', [
                'PKL' => $PKL,
                'Produks' => $Produks,
                'ulasan' => $ulasan
            ]);
        } else {
            // Handle case where PKL data does not exist
            return response()->view('errors.404', [], 404);
        }
    }


    //create
    public function create()
    {
        return view('CreateDataPKL');
    }


    //save
    public function store(Request $request)
    {
        // dd($request);
        $valdata = $request->validate([
            'namaPKL' => 'required',
            'desc' => 'required',
            'picture' => 'nullable',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'idAccount' => 'required'
        ]);

        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = $valdata['namaPKL'] . "." . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('pkl', $filename, 'public');

            $valdata['picture'] = $filePath;
        } else {
            $valdata['picture'] = null;
        }
        // dd($valdata);
        $pkl = new PKL();
        $pkl->namaPKL = $valdata['namaPKL'];
        $pkl->desc = $valdata['desc'];
        $pkl->picture = $valdata['picture'];
        $pkl->latitude = $valdata['latitude'];
        $pkl->longitude = $valdata['longitude'];
        $pkl->idAccount = $valdata['idAccount'];
        $berhasil = $pkl->save();
        if ($berhasil) {
            return redirect('/dashboard');
        } else {
            return redirect('/PKL/create')->with('error', 'Gagal menyimpan data PKL.');
        }
    }


    //edit
    public function edit(PKL $pkl)
    {
        return view('editPKL', ['pkl' => $pkl]);
    }

    //update
    public function update(Request $request, PKL $pkl)
    {
        $valdata = $request->validate([
            'namaPKL' => 'required',
            'desc' => 'required',
            'idAccount' => 'required'
        ]);

        $pkl->update($valdata);

        return redirect('/PKL');
    }

    //delete
    public function destroy(PKL $pkl)
    {
        PKL::destroy($pkl->id);
        return redirect('account-list');
    }

    public static function showAll()
    {
        $pkl = PKL::all();
        return
            ['dataPKL' => $pkl];
    }
    public static function showDetail($idAccount)
    {
        // dd($idAccount);
        $pklData = PKL::where('idAccount', $idAccount)->first();
        // dd($pklData);
        // $produk = Produk::where('idPKL', $pklData->id)->get();
        $produk = DB::table('produks as p')
            ->join('history_stoks as h', 'p.stokAktif', '=', 'h.id')
            ->where('p.idPKL', $pklData->id)
            ->select([
                'p.id as id',
                'p.desc as deskripsi',
                'p.namaProduk as nama',
                'p.harga as harga',
                'p.idPKL as idPKL',
                'p.fotoProduk as fotoProduk',
                DB::raw('CASE WHEN h.statusIsi = 0 THEN h.stokAwal - h.TerjualOnline WHEN h.statusIsi = 1 THEN h.stokAkhir END as sisaStok')
            ])
            ->get();
        // dd($produk);
        $ulasan = Ulasan::where('idPKL', $pklData->id)->get();;
        session(['pkl' => $pklData]);

        return view('dataPKL', [
            'pkl' => $pklData,
            'produk' => $produk,
            'ulasan' => $ulasan
        ]);
    }

    public function getCoordinates()
    {
        $pkls = PKL::all();

        $coordinates = $pkls->map(function ($pkl) {
            return [
                'id' => $pkl->id,
                'namaPKL' => $pkl->namaPKL,
                'latitude' => $pkl->latitude,
                'longitude' => $pkl->longitude,
                'picture' => $pkl->picture
            ];
        });

        return response()->json($coordinates);
    }

    public function getPictureByID($id)
    {
        $pkl = PKL::where('id', $id)->first();

        if ($pkl) {
            return response()->json(['picture' => $pkl->picture]);
        } else {
            return response()->json(['error' => 'PKL not found'], 404);
        }
    }
    public function getIdPKL($id){
        $rs = DB::select("select id from p_k_l_s
                            where idAccount=".$id);
        if($rs==[]){
            return 0;
        }
        return ($rs[0]->id);
    }

    public function getDataPKL()
    {

        $results = DB::table('p_k_l_s as p')
            ->select('p.id as id', 'p.namaPKL as nama', DB::raw("GROUP_CONCAT(b.namaProduk SEPARATOR ',') as menu"))
            ->join('produks as b', 'p.id', '=', 'b.idPKL')
            ->groupBy('p.id', 'p.namaPKL')
            ->get();

        return $results;
    }

    public function updateLocation(Request $request)
    {
        // Validate the request data
        $valdata = $request->validate([
            'idAccount' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        // dd($valdata);

        try {
            // Update the location in the database
            $updated = PKL::where('idAccount', $valdata['idAccount'])
                ->update([
                    'latitude' => $valdata['latitude'],
                    'longitude' => $valdata['longitude'],
                ]);
            if ($updated) {
                return redirect('dashboard')->with('success', 'Update Lokasi Berhasil');
            } else {
                return redirect('dashboard')->with('error', 'Update Lokasi Gagal');
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error updating location: ' . $e->getMessage());

            // Optionally, return the error details to the user
            return redirect('dashboard')->with('error', 'Update Lokasi Gagal: ' . $e->getMessage());
        }
    }
}
