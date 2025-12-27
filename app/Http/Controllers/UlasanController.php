<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UlasanController extends Controller
{
    // =====================
    // INDEX
    // =====================
    public static function index()
    {
        return view('list-ulasan', [
            'Produks' => Ulasan::all()
        ]);
    }

    // =====================
    // CREATE
    // =====================
    public function create()
    {
        return view('ulasan');
    }

    public function createWithId($id)
    {
        return view('ulasan', ['idPKL' => $id]);
    }

    // =====================
    // STORE
    // =====================
    public function store(Request $request)
    {
        $valdata = $request->validate([
            'ulasan'    => 'required',
            'rating'    => 'required',
            'idAccount' => 'required',
            'idPKL'     => 'required',
            'created_at'=> 'nullable',
            'updated_at'=> 'nullable',
        ]);

        $berhasil = DB::table('ulasans')->insert([
            'ulasan'     => $valdata['ulasan'],
            'rating'     => $valdata['rating'],
            'idAccount'  => $valdata['idAccount'],
            'idPKL'      => $valdata['idPKL'],
            'created_at' => now(),
            'updated_at' => null,
        ]);

        if ($berhasil) {
            return redirect()
                ->route('dashboard.index')
                ->with('alert', ['Terimakasih', 'Ulasan anda berhasil disimpan']);
        }

        return redirect()
            ->route('ulasan.create')
            ->with('error', 'Gagal menyimpan ulasan');
    }

    // =====================
    // EDIT
    // =====================
    public function edit(Ulasan $Ulasan)
    {
        return view('editUlasan', ['Ulasan' => $Ulasan]);
    }

    // =====================
    // UPDATE
    // =====================
    public function update(Request $request, Ulasan $Ulasan)
    {
        $valdata = $request->validate([
            'namaProduk' => 'required',
            'desc'       => 'required',
            'harga'      => 'required',
            'stok'       => 'required',
            'foto'       => 'nullable',
            'idAccount'  => 'required'
        ]);

        $Ulasan->update($valdata);

        return redirect()->route('dashboard.index');
    }

    // =====================
    // DELETE
    // =====================
    public function destroy(Ulasan $Ulasan)
    {
        Ulasan::destroy($Ulasan->id);

        return redirect()->route('dashboard.index');
    }

    // =====================
    // GET ULASAN BY PKL
    // =====================
    public function getUlasan($id)
    {
        try {
            $ulasans = DB::table('ulasans')
                ->join('accounts', 'ulasans.idAccount', '=', 'accounts.id')
                ->select(
                    'ulasans.id',
                    'ulasans.ulasan',
                    'ulasans.rating',
                    'ulasans.idAccount',
                    'ulasans.idPKL',
                    'ulasans.created_at',
                    'ulasans.updated_at',
                    'accounts.nama as namaPengulas'
                )
                ->where('ulasans.idPKL', $id)
                ->orderBy('ulasans.created_at', 'desc')
                ->get();

            return response()->json($ulasans);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'Gagal mengambil data ulasan.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // =====================
    // GET ALL ULASAN (JSON)
    // =====================
    public function getUlasanAll()
    {
        return Ulasan::select('idAccount', 'ulasan', 'rating')->get();
    }
}
