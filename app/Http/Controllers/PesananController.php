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
    public static function index($id)
    {
        $Pesanan = Pesanan::find($id);

        if ($Pesanan) {
            $Produks = Produk::where('idPesanan', $Pesanan->id)->get();

            return view('pesanan', [
                'Pesanan' => $Pesanan,
                'Produks' => $Produks
            ]);
        }

        return response()->view('errors.404', [], 404);
    }

    public function create($id)
    {
        return view('CreatePesanan');
    }

    // =====================
    // STORE
    // =====================
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'totalHarga' => 'required|not_in:0'
        ], ['totalHarga.not_in' => 'Belum ada barang yang dicheckout']);

        if ($validate->fails()) {
            return back()->with('alert', 'Belum ada barang yang dicheckout');
        }

        $pesanan = new Pesanan();
        $pesanan->idAccount = session('account')->id;
        $pesanan->idPKL = $request->idPKL;
        $pesanan->Keterangan = $request->keterangan ?? '';
        $pesanan->TotalBayar = $request->totalHarga;
        $pesanan->status = 'Pesanan Baru';

        if ($pesanan->save()) {
            $idPesanan = $pesanan->id;

            foreach ($request->except(['_token', 'idAccount', 'idPKL', 'totalHarga', 'keterangan', 'status']) as $key => $value) {
                $idProduk = explode('produk', $key)[1];

                if ($value != 0) {
                    DB::table('produk_dipesan')->insert([
                        'idPesanan' => $idPesanan,
                        'idProduk' => $idProduk,
                        'JumlahProduk' => $value
                    ]);
                }
            }

            return redirect()
                ->route('dashboard.index')
                ->with('alert', ['Pesanan berhasil disimpan', 'ID Pesanan: ' . $idPesanan]);
        }

        return redirect()
            ->route('pesanan.create')
            ->with('error', 'Gagal menyimpan data Pesanan.');
    }

    public function edit(Pesanan $Pesanan)
    {
        return view('editPesanan', compact('Pesanan'));
    }

    public function update(Request $request, Pesanan $Pesanan)
    {
        $Pesanan->update($request->validate([
            'namaPesanan' => 'required',
            'desc' => 'required',
            'idAccount' => 'required'
        ]));

        return redirect()->route('pesanan.index');
    }

    public function destroy(Pesanan $Pesanan)
    {
        $Pesanan->delete();
        return redirect()->route('account.index');
    }

    public static function show(Request $request)
    {
        $id = $request->query('id');
        $wht = $request->query('wht');
        $role = session('account')->status;

        if ($role == 'PKL') {
            $idPKL = ((new PKLController())->getDataPklbyId(session('account')->id))->id;
            $Pesanan = Pesanan::where('idPKL', $idPKL)->get();
            foreach ($Pesanan as $p) {
                $p->namaPemesan = (new AccountController())->getNameById($p->idAccount);
            }
        } else {
            $Pesanan = Pesanan::where('idAccount', $id)->get();
            foreach ($Pesanan as $p) {
                $p->namaPKL = (new PKLController())->getNamePklById($p->idPKL);
            }
        }

        return view('List_Pesanan', compact('Pesanan', 'wht'));
    }

    public function pesanDetail($id)
    {
        $pesan = Pesanan::find($id);

        if (session('account')->status == 'PKL') {
            $pesan->namaPemesan = (new AccountController())->getNameById($pesan->idAccount);
        } else {
            $pesan->namaPKL = (new PKLController())->getNamePklById($pesan->idPKL);
        }

        $produk = DB::select("select * from produk_dipesan where idPesanan = ?", [$id]);
        foreach ($produk as $item) {
            $data = (new ProdukController())->getDataNameById($item->idProduk);
            $item->nama = $data->namaProduk;
            $item->hargaSatuan = $data->harga;
        }

        return view('List_DetilPesanan', [
            'pesan' => $pesan,
            'produks' => $produk
        ]);
    }

    // =====================
    // STATUS HANDLER
    // =====================
    public function terimaPesanan(Request $request)
    {
        $id = $request->query('id');
        $wht = $request->query('wht');

        $pesan = Pesanan::find($id);
        $pesan->status = 'Pesanan Diproses';
        $pesan->save();

        return $wht == 'Pesanan'
            ? redirect()->route('pesanan.index', ['id' => session('account')->id, 'wht' => 'Pesanan Baru'])
            : redirect()->route('pesanan.detil', $id);
    }

    public function tolakPesanan(Request $request)
    {
        $id = $request->query('id');
        $wht = $request->query('wht');

        $pesan = Pesanan::find($id);
        $pesan->status = 'Pesanan Ditolak';
        $pesan->save();

        return $wht == 'Pesanan'
            ? redirect()->route('pesanan.index', ['id' => session('account')->id, 'wht' => 'Pesanan Baru'])
            : redirect()->route('pesanan.detil', $id);
    }

    public function batalPesanan(Request $request)
    {
        $id = $request->query('id');
        $wht = $request->query('wht');

        $pesan = Pesanan::find($id);

        if ($pesan->status == 'Pesanan Baru') {
            $pesan->status = 'Pesanan Dibatalkan';
            $pesan->save();

            return $wht == 'Pesanan'
                ? redirect()->route('pesanan.index', ['id' => session('account')->id, 'wht' => 'Pesanan Baru'])
                    ->with('alert', ['Berhasil', 'Pesanan Berhasil Dibatalkan'])
                : redirect()->route('pesanan.detil', $id)
                    ->with('alert', ['Berhasil', 'Pesanan Berhasil Dibatalkan']);
        }

        return back()->with('erorAlert', ['Gagal', 'Pesanan Sudah Diproses']);
    }

    public function selesaiPesanan(Request $request)
    {
        $id = $request->query('id');
        $wht = $request->query('wht');

        $pesan = Pesanan::find($id);
        $pesan->status = 'Pesanan Selesai';
        $pesan->save();

        return $wht == 'Pesanan'
            ? redirect()->route('pesanan.index', ['id' => session('account')->id, 'wht' => 'Pesanan Siap Diambil'])
            : redirect()->route('pesanan.detil', $id);
    }

    public function siapDiambilPesanan(Request $request)
    {
        $id = $request->query('id');
        $wht = $request->query('wht');

        $pesan = Pesanan::find($id);
        $produk = DB::select("select * from produk_dipesan where idPesanan = ?", [$id]);

        foreach ($produk as $p) {
            $barang = Produk::find($p->idProduk);
            (new HistoryStokController())->UpdatestokOnline($p->JumlahProduk, $barang->stokAktif);
        }

        $pesan->status = 'Pesanan Siap Diambil';
        $pesan->save();

        return $wht == 'Pesanan'
            ? redirect()->route('pesanan.index', ['id' => session('account')->id, 'wht' => 'Pesanan Diproses'])
            : redirect()->route('pesanan.detil', $id);
    }
}
