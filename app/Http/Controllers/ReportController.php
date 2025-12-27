<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Account;
use App\Models\PKL;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // =====================
    // INDEX
    // =====================
    public static function index()
    {
        return view('report-list', [
            'reports' => Report::all()
        ]);
    }

    // =====================
    // STORE (REPORT USER)
    // =====================
    public function store(Request $request)
    {
        $valdata = $request->validate([
            'idPengguna' => 'required',
            'idPelapor'  => 'required',
            'idPesanan'  => 'required',
            'alasan'     => 'required'
        ]);

        Report::create($valdata);

        return redirect()
            ->route('pesanan.tolak', ['id' => $valdata['idPesanan']])
            ->with('alert', 'Pengguna berhasil dilaporkan dan pesanan ditolak.');
    }

    // =====================
    // BAN USER
    // =====================
    public function banUser($id)
    {
        $report = Report::find($id);

        if ($report) {
            $account = Account::find($report->idPengguna);

            if ($account) {
                $account->status = 'alert';
                $account->save();
            }

            return redirect()->route('report.index');
        }

        return redirect()->back()->with('error', 'Account not found.');
    }

    // =====================
    // UNBAN USER
    // =====================
    public function unbanUser($id)
    {
        $report = Report::find($id);

        if ($report) {
            $account = Account::find($report->idPengguna);

            if ($account) {
                $pkl = PKL::where('idAccount', $account->id)->first();
                $account->status = $pkl ? 'PKL' : 'Pelanggan';
                $account->save();
            }

            return redirect()->route('report.index');
        }

        return redirect()->back()->with('error', 'Account not found.');
    }

    // =====================
    // DELETE REPORT
    // =====================
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();

        return redirect()
            ->route('report.index')
            ->with('success', 'Report deleted successfully');
    }
}
