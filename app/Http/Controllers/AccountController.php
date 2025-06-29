<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\PKL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public static function index()
    {
        return view('listAccount', [
            'account' => Account::all()
        ]);
    }
    //login]=
    public function login(Request $request)
    {
        // 1. Validasi input seperti biasa
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Cari akun berdasarkan email yang diinput
        $account = \App\Models\Account::where('email', $validated['email'])->first();

        // 3. Jika akun ada DAN password-nya cocok
        if ($account && Hash::check($validated['password'], $account->password)) {

            // 4. Periksa status akun (setelah password dipastikan benar)
            if ($account->status == 'alert') {
                // Jika status 'alert', kembalikan ke login dengan pesan di-ban.
                // Pengguna TIDAK AKAN terautentikasi.
                return redirect('/login')->with('erorAlert', ['Anda Di Ban', 'Akun Anda telah dibanned. Silakan hubungi admin untuk informasi lebih lanjut.']);
            }

            // 5. Jika semua lolos, loginkan pengguna secara manual
            Auth::login($account);
            $request->session()->regenerate(); // Regenerate session untuk keamanan

            // Simpan data ke session seperti biasa
            session(['account' => $account]);
            if ($account->status == 'PKL') {
                $pkl = PKL::where('idAccount', $account->id)->first();
                session(['PKL' => $pkl]);
            }

            // Arahkan ke dashboard
            return redirect('/dashboard')->with('alert', ['Login Berhasil', 'Terimakasih']);
        }

        // Jika akun tidak ditemukan ATAU password salah
        return back()->with('erorAlert', ['Login Gagal', 'email atau password salah!']);
    }

    public function loginAccount(Request $request)
    {
        if (session()->has('account')) {
            session()->pull('account');
        }
        return redirect('/');
    }

    public function logoutAccount(Request $request)
    {
        if (session()->has('account')) {
            session()->flush();
            // Remove the 'account' key from the session
        }
        return redirect('/dashboard')->with('alert',['Logout Berhasil','Sesi anda berhasil diselesaikan']); // Redirect to the homepage or any other desired location
    }


    public static function showDetail(Account $account)
    {
        return view('profile', [
            'account' => $account
        ]);
    }



    //create
    public function create()
    {
        $active = 'Pelanggan';
        return view('register', ['active' => $active]);
    }

    public function RegisterAsPKL()
    {
        $active = 'Pkl';
        return view('registerPKL', ['active' => $active]);
    }


    //save
    public function store(Request $request)
    {

        // dd($request);
        // if ($request->password == $request->passwordkonf) {
        if ($request->password == $request->passwordkonf) {
            // dd($request);
            $valdata = $request->validate([
                'nama' => 'required',
                'email' => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) {
                        if (!$this->isExistEmail($value)) {
                            $fail('Email sudah terdaftar');
                        }
                    }
                ],
                'nohp' => [
                    'required',
                    'numeric',
                    function ($attribute, $value, $fail) {
                        if (!$this->isNohpExist($value)) {
                            $fail('Nomor sudah terdaftar');
                        }
                    }
                ],
                'password' => 'required',
                'passwordkonf' => 'required|same:password',
                'status' => 'required',
                'foto' => 'nullable',
            ], [
                'nama.required' => 'Nama wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'nohp.numeric' => 'Nomor telepon belum berbentuk hanya Angka .',
                'nohp.required' => 'Nomor HP wajib diisi.',
                'password.required' => 'Password wajib diisi.',
                'passwordkonf.required' => 'Konfirmasi password wajib diisi.',
                'passwordkonf.same' => 'Konfirmasi password tidak sama dengan password.',
                // 'foto.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
                'foto.max' => 'Ukuran maksimal hanya boleh 5 MB'
            ]);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = $valdata['nama'] . "." . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('account', $filename, 'public');

                $valdata['foto'] = $filePath;
            } else {
                $valdata['foto'] = "misal.jpg";
            }

            $cekEmail = Account::firstWhere('email', $valdata['email']);
            if ($cekEmail == null) {
                $valdata['password'] = Hash::make($valdata['password']);
                // Account::create($valdata);
                DB::insert('INSERT INTO accounts (nama, email, nohp, password, status, foto) VALUES (?, ?, ?, ?, ?, ?)', [
                    $valdata['nama'],
                    $valdata['email'],
                    $valdata['nohp'],
                    $valdata['password'],
                    $valdata['status'],
                    $valdata['foto'],
                ]);
            } else {
                return redirect()->back()->with('alert', 'Email ini sudah pernah digunakan');
            }

            if ($valdata['status'] == 'PKL') {
                // dd($request);

                $valdata = $request->validate([
                    'namaPKL' => 'required',
                    'desc' => 'required',
                    'picture' => 'nullable',
                    'latitude' => 'required|numeric',
                    'longitude' => 'required|numeric'
                ]);
                // dd($valdata);


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
                $pkl->idAccount = Account::where('email', $request['email'])->first()->id;
                // dd($pkl);
                $berhasil = $pkl->save();
                // dd($berhasil);
                if ($berhasil) {
                    return redirect('/login')->with('alert', ['Registrasi Berhasil', 'Silahkan Login']);
                } else {
                    return redirect('/account/create')->with('error', 'Gagal menyimpan data PKL.');
                }
            }

            return redirect('/login')->with('alert', ['Registrasi Berhasil', 'Silahkan Login']);
        } else {
            return redirect()->back()->with('alert', 'Password berbeda');
        }
    }
    // }

    public function isExistEmail($email)
    {
        $email = Account::firstWhere('email', $email);
        $result = false;
        if ($email == null) {
            $result = true;
        }
        return $result;
    }

    public function isNohpExist($number)
    {
        $hasil = Account::firstWhere('nohp', $number);
        $result = false;
        if ($hasil == null) {
            $result = true;
        }
        return $result;
    }

    //edit
    public function editProfile($id)
    {
        
        $account = Account::find($id)->first();
        return view('edit', ['account' => $account]);
    }

    public function getNameById($id)
    {
        $hasil = Account::firstWhere('id', $id);
        // dd($hasil, 'haisl');
        return $hasil->nama;
    }

    //update
    public function update(Request $request, Account $account)
    {
        // dd($request);
        $valdata = $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nohp' => 'required'
        ]);
        if(is_numeric($request->nohp)){
            $account->update($valdata);
            // dd($account);
            session(['account' => $account]);
            return redirect('profile')->with('alert', ['Terimakasih', 'Data Akun berhasil diperbarui.']);
        }else{
            return redirect()->back()->with('erorAlert', ['Gagal Memperbarui', 'Nomor Telepon belum sesuai (only number).']);

        }
    }

    //delete
    public function destroy(Account $account)
    {
        Account::destroy($account->id);
        return redirect('account-list');
    }

    public function updatePhoto(Request $request)
    {
        // 1. Validasi request: pastikan file yang diupload adalah gambar
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Maks 5MB
        ]);

        // 2. Dapatkan user yang sedang login
        $user = Auth::user();

        // 3. Hapus foto lama jika ada untuk menghemat ruang penyimpanan
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        // 4. Simpan file baru dan dapatkan path-nya
        $filePath = $request->file('foto')->store('account', 'public');

        // 5. Update kolom 'foto' di database untuk user tersebut
        $user->foto = $filePath;
        $user->save();

        // 6. Kembalikan response JSON yang menandakan sukses
        return response()->json([
            'success' => true,
            'message' => 'Foto profil berhasil diperbarui.',
            'new_photo_url' => Storage::url($filePath) // Kirim URL foto baru ke frontend
        ]);
    }
}
