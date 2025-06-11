<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase; // Wajib ada untuk membersihkan database setiap kali tes dijalankan
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\PKL;
use Illuminate\Foundation\Testing\WithFaker;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_pkl_account_registration_is_successful_with_full_data(): void
    {
        // 1. Persiapan: Siapkan data lengkap untuk pengguna PKL
        // Semua field yang ada di form Blade Anda harus disertakan di sini.
        $pklData = [
            // Data Akun (Dari bagian 'Data Akun' di form)
            'nama' => 'Nama Pemilik PKL Baru',
            'email' => 'pemilik.pkl@example.com',
            'nohp' => '081234567891',
            'password' => 'passwordPKL123',
            'passwordkonf' => 'passwordPKL123',
            'status' => 'PKL', // PENTING: statusnya harus 'PKL'
            'foto' => 'misal.jpg', // Dummy string untuk foto profil akun

            // Data PKL (Dari bagian 'Data PKL' di form)
            'namaPKL' => 'Toko Nasi Goreng Mantap',
            'desc' => 'Menyediakan nasi goreng spesial dengan banyak topping.',
            'latitude' => -6.208763, // Contoh koordinat
            'longitude' => 106.845599, // Contoh koordinat
            'picture' => 'misal.jpg', // Dummy string untuk foto toko PKL
        ];

        // 2. Aksi: Kirim request POST ke route '/account'
        $response = $this->post('/account', $pklData);

        // 3. Assertions: Verifikasi hasil
        // Controller mengarahkan ke /login setelah sukses (sesuai controller Anda)
        $response->assertStatus(302);
        // $response->assertRedirect('/login');

        // Memastikan ada session flash message sukses
        // $response->assertSessionHas('alert', ['Registrasi Berhasil', 'Silahkan Login']);

        // Memastikan akun telah tersimpan di database
        $this->assertDatabaseHas('accounts', [
            'email' => 'pemilik.pkl@example.com',
            'nama' => 'Nama Pemilik PKL Baru',
            'nohp' => '081234567891',
            'status' => 'PKL',
            'foto' => 'misal.jpg', // Verifikasi nilai dummy foto akun
        ]);

        // Cari akun yang baru dibuat untuk mendapatkan ID-nya
        $account = Account::where('email', 'pemilik.pkl@example.com')->first();
        $this->assertNotNull($account, "Akun PKL harusnya ditemukan setelah registrasi.");

        // Memastikan data PKL telah dibuat di database dan terhubung dengan akun yang benar
        $this->assertDatabaseHas('p_k_l_s', [ // Sesuaikan nama tabel jika berbeda dari 'p_k_l_s'
            'idAccount' => $account->id,
            'namaPKL' => 'Toko Nasi Goreng Mantap',
            'desc' => 'Menyediakan nasi goreng spesial dengan banyak topping.',
            'latitude' => -6.208763,
            'longitude' => 106.845599,
            // 'picture' => 'path/to/default/pkl_store_image.jpg', // Verifikasi nilai dummy foto toko
        ]);
    }

    public function test_pkl_registration_fails_if_email_already_exists(): void
    {
        // 1. Persiapan: Buat akun dummy dengan email yang akan kita coba daftarkan lagi
        Account::factory()->create([
            'email' => 'existing.pkl.email@example.com',
            'nohp' => '081234567899', // Pastikan nohp unik
            'status' => 'Pelanggan', // Status tidak masalah untuk ini
            'foto' => 'path/to/existing/foto.jpg',
        ]);

        // Siapkan data registrasi PKL dengan email yang sama
        $invalidPklData = [
            'nama' => 'User PKL Duplikat Email',
            'email' => 'existing.pkl.email@example.com', // Email yang sudah ada
            'nohp' => '081234567800', // NoHP baru
            'password' => 'password123',
            'passwordkonf' => 'password123',
            'status' => 'PKL',
            'foto' => 'path/to/new/foto.jpg',
            'namaPKL' => 'Toko Duplikat Email',
            'desc' => 'Deskripsi toko duplikat email.',
            'latitude' => -6.208700,
            'longitude' => 106.845000,
            'picture' => 'path/to/new/picture.jpg',
        ];

        // 2. Aksi: Kirim request POST ke '/account'
        $response = $this->post('/account', $invalidPklData);

        // 3. Assertions: Verifikasi hasil
        // Validasi akan mengarahkan kembali (redirect back)
        $response->assertStatus(302);
        $response->assertRedirect();

        // Memastikan ada error validasi untuk field 'email'
        $response->assertSessionHasErrors('email');

        // Memastikan ada session flash 'alert' dengan pesan spesifik dari controller
        // $response->assertSessionHas('alert', 'Email sudah terdaftar');

        // Memastikan tidak ada akun PKL baru yang dibuat di database dengan email tersebut
        $this->assertDatabaseMissing('accounts', [
            'nama' => 'User PKL Duplikat Email',
            'email' => 'existing.pkl.email@example.com',
            'status' => 'PKL', // Pastikan tidak ada PKL baru dengan email ini
        ]);
        // Pastikan jumlah akun di database hanya 1 (yang sudah dibuat di awal)
        $this->assertEquals(1, Account::count());
        // Memastikan tidak ada data PKL baru yang dibuat
        $this->assertEquals(0, PKL::count());
    }
    // use RefreshDatabase; // Ini akan me-reset database Anda secara otomatis setelah setiap tes

    /**
     * Tes untuk skenario login yang berhasil.
     */
    // public function test_login_success(): void
    // {
    //     // 1. Persiapan: Buat user palsu di database
    //     $password = 'password123';
    //     $user = Account::factory()->create([
    //         'email' => 'test@example.com',
    //         'password' => Hash::make($password),
    //         'status' => 'Pelanggan', // Pastikan status bukan 'alert'
    //     ]);

    //     // 2. Aksi: Kirim request POST ke route login dengan data yang benar
    //     $response = $this->post('/loginAccount', [
    //         'email' => 'test@example.com',
    //         'password' => $password,
    //     ]);

    //     // 3. Pengecekan (Assertion):
    //     $response->assertStatus(302); // Memastikan terjadi redirect
    //     $response->assertRedirect('/dashboard'); // Memastikan redirect ke halaman dashboard
    //     $this->assertAuthenticated(); // Memastikan pengguna berhasil terautentikasi
    // }

    // /**
    //  * Tes untuk skenario login yang gagal karena password salah.
    //  */
    // public function test_login_failed_wrong_password(): void
    // {
    //     // 1. Persiapan: Buat user
    //     $user = Account::factory()->create([
    //         'email' => 'test@example.com',
    //     ]);

    //     // 2. Aksi: Kirim request POST dengan password yang salah
    //     $response = $this->post('/loginAccount', [
    //         'email' => 'test@example.com',
    //         'password' => 'password-salah',
    //     ]);

    //     // 3. Pengecekan:
    //     $response->assertStatus(302); // Redirect kembali ke halaman sebelumnya
    //     $response->assertSessionHas('erorAlert'); // Memastikan ada pesan error di session
    //     $this->assertGuest(); // Memastikan pengguna tidak terautentikasi
    // }

    // /**
    //  * Tes untuk registrasi pengguna baru yang berhasil.
    //  */
    // public function test_register_success(): void
    // {
    //     // 1. Persiapan: Siapkan data untuk pengguna baru
    //     $userData = [
    //         'nama' => 'User Baru',
    //         'email' => 'userbaru@example.com',
    //         'nohp' => '081234567890',
    //         'password' => 'password123',
    //         'passwordkonf' => 'password123',
    //         'status' => 'Pelanggan',
    //     ];

    //     // 2. Aksi: Kirim request POST ke route resource 'account' (yaitu '/account')
    //     $response = $this->post('/account', $userData);

    //     // 3. Pengecekan:
    //     $response->assertRedirect('/login'); // Controller mengarahkan ke /login setelah sukses
    //     $this->assertDatabaseHas('accounts', [
    //         'email' => 'userbaru@example.com',
    //         'nama' => 'User Baru',
    //     ]);
    // }

    // /**
    //  * Tes untuk registrasi dengan email yang sudah ada.
    //  */
    // public function test_register_duplicate_email(): void
    // {
    //     // 1. Persiapan: Buat user pertama dengan email tertentu
    //     Account::factory()->create(['email' => 'sudahada@example.com']);

    //     // 2. Aksi: Coba registrasi lagi dengan email yang sama
    //     $response = $this->post('/account', [
    //         'nama' => 'User Duplikat',
    //         'email' => 'sudahada@example.com', // Email yang sama
    //         'nohp' => '089876543210',
    //         'password' => 'password123',
    //         'passwordkonf' => 'password123',
    //         'status' => 'Pelanggan',
    //     ]);

    //     // 3. Pengecekan:
    //     $response->assertStatus(302); // Redirect kembali
    //     // Mengecek apakah ada validation error untuk field 'email'
    //     // Ini lebih baik daripada mengecek session 'alert' karena lebih spesifik ke validasi.
    //     $response->assertSessionHasErrors('email');
    // }

    // /**
    //  * Tes untuk update profil pengguna.
    //  */
    // public function test_update_profile(): void
    // {
    //     // 1. Persiapan: Buat user dan loginkan
    //     $user = Account::factory()->create();

    //     // Data baru untuk update
    //     $newData = [
    //         'nama' => 'Nama Sudah Diupdate',
    //         'email' => 'emailbaru@example.com',
    //         'nohp' => '999999',
    //     ];

    //     // 2. Aksi: Kirim request PUT sebagai user yang sudah login
    //     // Resource controller untuk update menggunakan method PUT
    //     $response = $this->actingAs($user)->put('/account/' . $user->id, $newData);

    //     // 3. Pengecekan:
    //     $response->assertRedirect('/profile'); // Memastikan redirect ke halaman profil
    //     $this->assertDatabaseHas('accounts', [
    //         'id' => $user->id,
    //         'nama' => 'Nama Sudah Diupdate', // Cek apakah nama sudah berubah
    //     ]);
    // }

    // /**
    //  * Tes untuk menghapus akun.
    //  */
    // public function test_delete_account(): void
    // {
    //     // 1. Persiapan: Buat user dan loginkan
    //     $user = Account::factory()->create();
        
    //     // 2. Aksi: Kirim request DELETE sebagai user tersebut
    //     $response = $this->actingAs($user)->delete('/account/' . $user->id);
        
    //     // 3. Pengecekan:
    //     $response->assertRedirect('account-list'); // Memastikan redirect ke list akun
    //     $this->assertDatabaseMissing('accounts', [
    //         'id' => $user->id, // Memastikan data user sudah tidak ada di database
    //     ]);
    // }
}