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
            return redirect('/dashboard');
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
        // Fetch ulasan data for the specific PKL ID
        $ulasan = Ulasan::where('idPKL', $id)->get();

        // Return ulasan data as JSON
        return response()->json($ulasan);
    }

    public function getUlasanAll()
    {
        // Fetch latitude and longitude data from your database
        $ulasan = Ulasan::select('idAccount', 'ulasan', 'rating')->get();

        // Return latitude and longitude data as JSON
        return $ulasan;
    }
}
