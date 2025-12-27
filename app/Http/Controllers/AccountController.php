<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public static function index()
    {
        return view('listAccount', [
            'account' => Account::all()
        ]);
    }

    // =====================
    // LOGIN
    // =====================
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $account = Account::where('email', $validated['email'])->first();

        if ($account && Hash::check($validated['password'], $account->password)) {

            if ($account->status == 'alert') {
                return redirect()
                    ->route('login.index')
                    ->with('erorAlert', [
                        'Anda Di Ban',
                        'Akun Anda telah dibanned. Silakan hubungi admin.'
                    ]);
            }

            Auth::login($account);
            $request->session()->regenerate();
            session(['account' => $account]);

            if ($account->status == 'PKL') {
                $pkl = PKL::where('idAccount', $account->id)->first();
                session(['PKL' => $pkl]);
            }

            return redirect()
                ->route('dashboard.index')
                ->with('alert', ['Login Berhasil', 'Terimakasih']);
        }

        return back()->with('erorAlert', ['Login Gagal', 'Email atau password salah!']);
    }

    public function loginAccount(Request $request)
    {
        if (session()->has('account')) {
            session()->forget('account');
        }

        return redirect()->route('home');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logoutAccount(Request $request)
    {
        if (session()->has('account')) {
            session()->flush();
        }

        return redirect()
            ->route('dashboard.index')
            ->with('alert', ['Logout Berhasil', 'Sesi anda berhasil diselesaikan']);
    }

    // =====================
    // REGISTER
    // =====================
    public function create()
    {
        return view('register', ['active' => 'Pelanggan']);
    }

    public function RegisterAsPKL()
    {
        return view('registerPKL', ['active' => 'Pkl']);
    }

    public function store(Request $request)
    {
        if ($request->password != $request->passwordkonf) {
            return back()->with('alert', 'Password berbeda');
        }

        $valdata = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nohp' => 'required|numeric',
            'password' => 'required',
            'passwordkonf' => 'required|same:password',
            'status' => 'required',
            'foto' => 'nullable'
        ]);

        if ($request->hasFile('foto')) {
            $valdata['foto'] = $request->file('foto')
                ->storeAs('account', $valdata['nama'] . '.' . $request->foto->extension(), 'public');
        } else {
            $valdata['foto'] = 'misal.jpg';
        }

        $valdata['password'] = Hash::make($valdata['password']);

        DB::insert(
            'INSERT INTO accounts (nama, email, nohp, password, status, foto) VALUES (?, ?, ?, ?, ?, ?)',
            [
                $valdata['nama'],
                $valdata['email'],
                $valdata['nohp'],
                $valdata['password'],
                $valdata['status'],
                $valdata['foto']
            ]
        );

        if ($valdata['status'] == 'PKL') {
            $pklData = $request->validate([
                'namaPKL' => 'required',
                'desc' => 'required',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric'
            ]);

            $pkl = new PKL();
            $pkl->fill($pklData);
            $pkl->idAccount = Account::where('email', $request->email)->first()->id;
            $pkl->save();
        }

        return redirect()
            ->route('login.index')
            ->with('alert', ['Registrasi Berhasil', 'Silahkan Login']);
    }

    // =====================
    // UPDATE PROFILE
    // =====================
    public function update(Request $request, Account $account)
    {
        $valdata = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nohp' => 'required'
        ]);

        if (!is_numeric($request->nohp)) {
            return back()->with('erorAlert', [
                'Gagal Memperbarui',
                'Nomor Telepon harus angka'
            ]);
        }

        $account->update($valdata);
        session(['account' => $account]);

        return redirect()
            ->route('profile.index')
            ->with('alert', ['Terimakasih', 'Data akun berhasil diperbarui']);
    }

    // =====================
    // DELETE
    // =====================
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('account.index');
    }

    // =====================
    // UPDATE PHOTO (AJAX)
    // =====================
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:5120'
        ]);

        $user = Auth::user();

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $filePath = $request->file('foto')->store('account', 'public');
        $user->foto = $filePath;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Foto profil berhasil diperbarui',
            'new_photo_url' => Storage::url($filePath)
        ]);
    }
}
