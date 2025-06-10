<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Models\Produk;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $pkls = PKL::all(); // Mengambil semua data PKL

        $coordinates = $pkls->map(function ($pkl) {
            // $pkl->picture dari database SUDAH 'pkl/namafile.jpg' (contoh: 'pkl/zzz.jpg')
            $pathGambarDiDalamStoragePublic = $pkl->picture;

            return [
                'id' => $pkl->id,
                // Jika Anda punya kolom namaPKL, gunakan itu. Jika tidak, sesuaikan.
                // Dari phpMyAdmin terlihat ada kolom 'desc', mungkin itu namaPKL?
                'namaPKL' => $pkl->namaPKL ?? $pkl->desc, // Sesuaikan dengan nama kolom yang benar
                'latitude' => $pkl->latitude,
                'longitude' => $pkl->longitude,
                'picture_from_db' => asset('storage/' . $pathGambarDiDalamStoragePublic), // Ini akan menampilkan 'pkl/zzz.jpg'
                // 'picture_url' akan menjadi asset('storage/' . 'pkl/zzz.jpg')
                // yang menghasilkan http://localhost:8000/storage/pkl/zzz.jpg
                'picture_url' => asset('storage/' . $pathGambarDiDalamStoragePublic),
                'rating' => $pkl->rating ?? 0, // Asumsi ada kolom rating
                'description' => $pkl->desc, // Menggunakan kolom 'desc' dari database
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
    public function getIdPKL($id)
    {
        $rs = DB::select("select id from p_k_l_s
                            where idAccount=" . $id);
        if ($rs == []) {
            return 0;
        }
        return ($rs[0]->id);
    }

    public function getNamePklById($id){
        $hasil = PKL::firstWhere('id', $id);
        return $hasil->namaPKL;
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

    public function getDataPklbyId($id){    
        $hasil = PKL::firstWhere('idAccount', $id);
        // dd($hasil, 'hasi;',session('account')->id);
        return $hasil;
        
    }

    public function updateLocation(Request $request)
    {
        // dd($request);
        // Validate the request data
        $valdata = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        $valdata['idAccount']=session('account')->id;
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

    public function updatePklPhoto(Request $request)
    {
        // 1. Validasi request: pastikan file yang diupload adalah gambar
        dd($request->all());
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Maks 5MB
        ]);

        
        // 2. Dapatkan data PKL berdasarkan user yang sedang login
        $user = Auth::user();
        $pkl = PKL::where('idAccount', $user->id)->first();

        // Tambahan: Handle jika user belum punya profil PKL
        if (!$pkl) {
            return response()->json([
                'success' => false,
                'message' => 'Profil PKL tidak ditemukan.',
            ], 404); // 404 Not Found
        }

        // 3. Hapus foto lama jika ada untuk menghemat ruang penyimpanan
        //    Gunakan kolom 'picture' sesuai model PKL
        if ($pkl->picture && Storage::disk('public')->exists($pkl->picture)) {
            Storage::disk('public')->delete($pkl->picture);
        }

        // 4. Simpan file baru di folder 'pkl' dan dapatkan path-nya
        $filePath = $request->file('foto')->store('pkl', 'public');

        // 5. Update kolom 'picture' di database untuk PKL tersebut
        $pkl->picture = $filePath;
        $pkl->save();

        // 6. Kembalikan response JSON yang menandakan sukses
        return response()->json([
            'success'       => true,
            'message'       => 'Foto PKL berhasil diperbarui.',
            'new_photo_url' => Storage::url($filePath) // Kirim URL foto baru ke frontend
        ]);
    }
}
