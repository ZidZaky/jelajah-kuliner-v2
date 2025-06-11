<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UlasanController extends Controller
{
    //
    public static function index()
    {
        return view('list-ulasan', [
            'Produks' => Ulasan::all()
        ]);
    }

    //create
    public function create()
    {
        return view('ulasan');
    }

    public function createWithId($id)
    {
        // Handle creation with the provided ID
        return view('ulasan', ['idPKL' => $id]);
    }


    //save
    public function store(Request $request)
    {
        // dd($request);
        $valdata = $request->validate([
            'ulasan' => 'required',
            'rating' => 'required',
            'idAccount' => 'required',
            'idPKL' => 'required',
            'created_at' => 'nullable', // Assuming you want to use the default value for created_at
            'updated_at' => 'nullable',
        ]);
        // dd($valdata);
        // dd($valdata);
        $berhasil = DB::table('ulasans')->insert([
            'ulasan' => $valdata['ulasan'],
            'rating' => $valdata['rating'],
            'idAccount' => $valdata['idAccount'],
            'idPKL' => $valdata['idPKL'],
            'created_at' => now(), // Assuming you want to use the default value for created_at
            'updated_at' => null, // Assuming you want to use the default value for updated_at
        ]);


        if ($berhasil) {
            return redirect('/dashboard')->with('alert',['Terimakasih', 'Ulasan anda berhasil disimpan']);
        } else {
            return redirect('/Ulasan/create')->with('error', 'Password berbeda');
        }
    }

    //edit
    public function edit(Ulasan $Ulasan)
    {
        return view('editUlasan', ['Ulasan' => $Ulasan]);
    }

    //update
    public function update(Request $request, Ulasan $Ulasan)
    {
        $valdata = $request->validate([
            'namaProduk' => 'required',
            'desc' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'foto' => 'nullable',
            'idAccount' => 'required'
        ]);

        $Ulasan->update($valdata);

        return redirect('/');
    }

    //delete
    public function destroy(Ulasan $Ulasan)
    {
        Ulasan::destroy($Ulasan->id);
        return redirect('/');
    }

    public function getUlasan($id)
    {
        // LANGKAH DEBUGGING PENTING JIKA MASIH ERROR:
        // 1. Periksa file log Laravel di storage/logs/laravel.log untuk detail error 500.
        // 2. Pastikan nama tabel 'ulasans' dan 'users' (atau tabel akun Anda) sudah benar.
        // 3. Pastikan nama kolom 'ulasans.idPKL', 'ulasans.idAccount', 'users.id', dan 'users.name' sudah benar.

        try {
            // Menggunakan Query Builder untuk join tabel ulasans dengan tabel users (atau tabel akun Anda)
            // Asumsi:
            // - Tabel ulasan bernama 'ulasans'
            // - Tabel pengguna/akun bernama 'users' (ganti jika nama tabel Anda berbeda, misal 'accounts')
            // - Foreign key di 'ulasans' adalah 'idAccount' yang merujuk ke 'id' di tabel 'users'
            // - Kolom nama di tabel 'users' adalah 'name'

            $ulasans = DB::table('ulasans')
                ->join('accounts', 'ulasans.idAccount', '=', 'accounts.id') // Sesuaikan 'users' dan 'users.id' jika perlu
                ->select(
                    'ulasans.id',               // ID ulasan
                    'ulasans.ulasan',
                    'ulasans.rating',
                    'ulasans.idAccount',
                    'ulasans.idPKL',
                    'ulasans.created_at',
                    'ulasans.updated_at',
                    'accounts.nama as namaPengulas' // Mengambil kolom 'name' dari tabel 'users' dan menamakannya 'namaPengulas'
                    // Sesuaikan 'users.name' jika nama kolomnya berbeda
                )
                ->where('ulasans.idPKL', $id)
                ->orderBy('ulasans.created_at', 'desc')
                ->get();

            // Jika Anda ingin memformat tanggal atau menambahkan URL gambar default jika tidak ada dari DB
            // Anda bisa melakukannya di sini dengan loop, contoh:
            /*
            $formattedUlasans = $ulasans->map(function ($item) {
                $item->userImageUrl = $item->gambar_profil_user_dari_db ?? 'https://i.pinimg.com/564x/02/b8/50/02b850fcc321beaa87d8459daa6509de.jpg';
                $item->tanggalUlasan = $item->created_at ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y H:i') : null;
                return $item;
            });
            return response()->json($formattedUlasans);
            */

            // Jika tidak ada pemformatan tambahan, langsung kembalikan hasil query
            return response()->json($ulasans);
        } catch (\Exception $e) {
            // Log::error("Error fetching ulasan (Query Builder) for PKL ID {$id}: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());

            return response()->json([
                'error' => 'Gagal mengambil data ulasan.',
                'message' => $e->getMessage() // Hanya untuk development/debug
            ], 500);
        }
    }

    public function getUlasanAll()
    {
        // Fetch latitude and longitude data from your database
        $ulasan = Ulasan::select('idAccount', 'ulasan', 'rating')->get();

        // Return latitude and longitude data as JSON
        return $ulasan;
    }
}
