<?php

namespace App\Http\Controllers;

use App\Models\PKL;
use App\Models\Produk;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PKLController extends Controller
{
    // =====================
    // INDEX
    // =====================
    public static function index($id)
    {
        $PKL = PKL::find($id);

        if ($PKL) {
            return view('dataPKL', [
                'PKL'     => $PKL,
                'Produks' => Produk::where('idPKL', $PKL->id)->get(),
                'ulasan'  => Ulasan::where('idPKL', $PKL->id)->get()
            ]);
        }

        return response()->view('errors.404', [], 404);
    }

    // =====================
    // CREATE
    // =====================
    public function create()
    {
        return view('CreateDataPKL');
    }

    // =====================
    // STORE
    // =====================
    public function store(Request $request)
    {
        $valdata = $request->validate([
            'namaPKL'   => 'required',
            'desc'      => 'required',
            'picture'   => 'nullable',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'idAccount' => 'required'
        ]);

        if ($request->hasFile('picture')) {
            $valdata['picture'] = $request->file('picture')
                ->storeAs('pkl', $valdata['namaPKL'] . '.' . $request->picture->extension(), 'public');
        } else {
            $valdata['picture'] = null;
        }

        $pkl = PKL::create($valdata);

        if ($pkl) {
            return redirect()->route('dashboard.index');
        }

        return redirect()
            ->route('PKL.create')
            ->with('error', 'Gagal menyimpan data PKL.');
    }

    // =====================
    // EDIT
    // =====================
    public function edit(PKL $pkl)
    {
        return view('editPKL', compact('pkl'));
    }

    // =====================
    // UPDATE
    // =====================
    public function update(Request $request, PKL $pkl)
    {
        $valdata = $request->validate([
            'idPKL'   => 'required',
            'namaPKL' => 'required',
            'desc'    => 'required',
        ]);

        try {
            $pkl = PKL::findOrFail($valdata['idPKL']);
            $pkl->update([
                'namaPKL' => $valdata['namaPKL'],
                'desc'    => $valdata['desc'],
            ]);

            session(['PKL' => $pkl]);

            return redirect()
                ->route('profile.index')
                ->with('alert', ['Terimakasih', 'Data PKL berhasil diperbarui.']);
        } catch (\Exception $e) {
            return back()->with('erorAlert', ['Gagal memperbarui data.', $e->getMessage()]);
        }
    }

    // =====================
    // DESTROY
    // =====================
    public function destroy(PKL $pkl)
    {
        $pkl->delete();
        return redirect()->route('account.index');
    }

    // =====================
    // DETAIL PKL
    // =====================
    public static function showDetail($idAccount)
    {
        $pklData = PKL::where('idAccount', $idAccount)->firstOrFail();

        $produk = DB::table('produks as p')
            ->join('history_stoks as h', 'p.stokAktif', '=', 'h.id')
            ->where('p.idPKL', $pklData->id)
            ->select([
                'p.id',
                'p.desc as deskripsi',
                'p.namaProduk as nama',
                'p.harga',
                'p.idPKL',
                'p.fotoProduk',
                DB::raw('CASE WHEN h.statusIsi = 0 THEN h.stokAwal - h.TerjualOnline ELSE h.stokAkhir END as sisaStok')
            ])
            ->get();

        session(['pkl' => $pklData]);

        return view('dataPKL', [
            'pkl'    => $pklData,
            'produk' => $produk,
            'ulasan' => Ulasan::where('idPKL', $pklData->id)->get()
        ]);
    }

    // =====================
    // COORDINATES
    // =====================
    public function getCoordinates()
    {
        return response()->json(
            PKL::all()->map(fn ($pkl) => [
                'id'          => $pkl->id,
                'namaPKL'     => $pkl->namaPKL,
                'latitude'    => $pkl->latitude,
                'longitude'   => $pkl->longitude,
                'picture_url' => asset('storage/' . $pkl->picture),
                'rating'      => $pkl->rating ?? 0,
                'description' => $pkl->desc
            ])
        );
    }

    public function getPictureByID($id)
    {
        $pkl = PKL::find($id);
        return $pkl
            ? response()->json(['picture' => $pkl->picture])
            : response()->json(['error' => 'PKL not found'], 404);
    }

    public function getIdPKL($id)
    {
        $rs = DB::select("select id from p_k_l_s where idAccount = ?", [$id]);
        return $rs == [] ? 0 : $rs[0]->id;
    }

    public function getNamePklById($id)
    {
        return PKL::find($id)?->namaPKL;
    }

    public function getDataPKL()
    {
        return DB::table('p_k_l_s as p')
            ->join('produks as b', 'p.id', '=', 'b.idPKL')
            ->select('p.id', 'p.namaPKL', DB::raw("GROUP_CONCAT(b.namaProduk SEPARATOR ',') as menu"))
            ->groupBy('p.id', 'p.namaPKL')
            ->get();
    }

    public function getDataPklbyId($id)
    {
        return PKL::firstWhere('idAccount', $id);
    }

    // =====================
    // UPDATE LOCATION
    // =====================
    public function updateLocation(Request $request)
    {
        $valdata = $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        try {
            PKL::where('idAccount', session('account')->id)->update($valdata);

            return redirect()
                ->route('dashboard.index')
                ->with('success', 'Update Lokasi Berhasil');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()
                ->route('dashboard.index')
                ->with('error', 'Update Lokasi Gagal');
        }
    }

    // =====================
    // UPDATE FOTO PKL
    // =====================
    public function updatePklPhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:5120',
        ]);

        $pkl = PKL::where('idAccount', Auth::id())->first();

        if (!$pkl) {
            return response()->json([
                'success' => false,
                'message' => 'Profil PKL tidak ditemukan.'
            ], 404);
        }

        if ($pkl->picture && Storage::disk('public')->exists($pkl->picture)) {
            Storage::disk('public')->delete($pkl->picture);
        }

        $filePath = $request->file('foto')->store('pkl', 'public');
        $pkl->picture = $filePath;
        $pkl->save();

        return response()->json([
            'success'       => true,
            'message'       => 'Foto PKL berhasil diperbarui.',
            'new_photo_url' => Storage::url($filePath)
        ]);
    }
}
