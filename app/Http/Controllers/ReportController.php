<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public static function index()
    {
        return view('report-list', [
            'reports' => Report::all()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $valdata = $request->validate([
            'idPengguna' => 'required',
            'idPelapor' => 'required',
            'idPesanan' => 'required',
            'alasan' => 'required'
        ]);

        $report = new Report();
        $report->idPengguna = $valdata['idPengguna'];
        $report->idPelapor = $valdata['idPelapor'];
        $report->idPesanan = $valdata['idPesanan'];
        $report->alasan = $valdata['alasan'];
        $berhasil = $report->save();

        if ($berhasil) {
            return redirect('/dashboard');
        }
    }

    public function banUser($id)
    {
        // Find the Pesanan by its ID
        // dd($id);
        $report = Report::find($id);
        // dd($pesan);

        // Check if Pesanan is found
        if ($report) {
            // Update the status to "Pesanan Diproses"
            $account = \App\Models\Account::where('id', $report->idPengguna)->first();
            $account->status = 'alert';

            // Save the changes to the database
            $account->save();

            return redirect("/report");
        } else {
            // Handle the case where Pesanan is not found
            return redirect()->back()->with('error', 'Account not found.');
        }
    }

    public function unbanUser($id)
    {
        // Find the Pesanan by its ID
        // dd($id);
        $report = Report::find($id);
        // dd($pesan);

        // Check if Pesanan is found
        if ($report) {
            // Update the status to "Pesanan Diproses"
            $account = \App\Models\Account::where('id', $report->idPengguna)->first();
            $pkl = \App\Models\PKL::where('idAccount', $account->id)->first();

            if ($pkl) {
                $account->status = 'PKL';
            } else {
                $account->status = 'Pelanggan';
            }

            // Save the changes to the database
            $account->save();

            return redirect("/report");
        } else {
            // Handle the case where Pesanan is not found
            return redirect()->back()->with('error', 'Account not found.');
        }
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect('/report')->with('success', 'Report deleted successfully');
    }
}
