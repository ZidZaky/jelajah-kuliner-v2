<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Account;
use App\Models\PKL;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase; // Wajib ada untuk membersihkan database setiap kali tes dijalankan
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as FakerFactory;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_failed_duplicate_email(): void
    {
        Account::factory()->create([
            'email' => 'sudahada@example.com',
        ]);

        $response = $this->post('/account', [
            'nama' => 'User Duplikat',
            'email' => 'sudahada@example.com',
            'nohp' => '089876543210',
            'password' => 'password123',
            'passwordkonf' => 'password123',
            'status' => 'Pelanggan',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    public function test_register_success(): void
    {
        $userData = [
            'nama' => 'User Baru',
            'email' => 'userbaru@example.com',
            'nohp' => '081234567890',
            'password' => 'password123',
            'passwordkonf' => 'password123',
            'status' => 'Pelanggan',
        ];

        $response = $this->post('/account', $userData);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('accounts', [
            'email' => 'userbaru@example.com',
            'nama' => 'User Baru',
        ]);
    }

    public function test_berhasil_update_data_account()
    {

        $user = Account::factory()->create([
            'nama' => 'Nama Lama',
            'email' => 'joko@tes.com',
            'nohp' => '08123456789',
        ]);

        $response = $this->put("/account/{$user->id}", [
            'nama' => 'Nama Sudah Diupdate',
            'email' => $user->email,
            'nohp' => $user->nohp,
        ]);

        $response->assertRedirect('profile');

        $this->assertDatabaseHas('accounts', [
            'id' => $user->id,
            'nama' => 'Nama Sudah Diupdate',
        ]);
    }


    public function test_gagal_update_account_nohp_invalid()
    {

        $user = Account::factory()->create([
            'nama' => 'Nama Awal',
            'email' => 'joko@awal.com',
            'nohp' => '08123456789',
        ]);

        $response = $this->from('/profile')
            ->put("/account/{$user->id}", [
                'nama' => 'Nama Baru',
                'email' => 'joko@awal.com',
                'nohp' => 'invalid_nohp',
            ]);

        $response->assertRedirect('/profile');

        $response->assertSessionHas('erorAlert');

        $this->assertDatabaseHas('accounts', [
            'id' => $user->id,
            'nama' => 'Nama Awal',
            'nohp' => '08123456789',
        ]);
    }

    public function test_dataPKL_successful(): void
    {

        $pklData = [

            'nama' => 'Nama Pemilik PKL Baru',
            'email' => 'pemilik.pkl@example.com',
            'nohp' => '081234567891',
            'password' => 'passwordPKL123',
            'passwordkonf' => 'passwordPKL123',
            'status' => 'PKL',
            'foto' => 'path/to/default/user_profile.jpg',

            'namaPKL' => 'Toko Nasi Goreng Mantap',
            'desc' => 'Menyediakan nasi goreng spesial dengan banyak topping.',
            'latitude' => -6.208763,
            'longitude' => 106.845599,
            'picture' => 'misal.jpg',
        ];

        $response = $this->post('/account', $pklData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('accounts', [
            'email' => 'pemilik.pkl@example.com',
            'nama' => 'Nama Pemilik PKL Baru',
            'nohp' => '081234567891',
            'status' => 'PKL',
            'foto' => 'misal.jpg',
        ]);

        $account = Account::where('email', 'pemilik.pkl@example.com')->first();
        $this->assertNotNull($account, "Akun PKL harusnya ditemukan setelah registrasi.");

        $this->assertDatabaseHas('p_k_l_s', [
            'idAccount' => $account->id,
            'namaPKL' => 'Toko Nasi Goreng Mantap',
            'desc' => 'Menyediakan nasi goreng spesial dengan banyak topping.',
            'latitude' => -6.208763,
            'longitude' => 106.845599,
        ]);
    }

    public function test_dataPKL_fails_email_already_exists(): void
    {
        Account::factory()->create([
            'email' => 'existing.pkl.email@example.com',
            'nohp' => '081234567899',
            'status' => 'Pelanggan',
            'foto' => 'path/to/existing/foto.jpg',
        ]);

        $invalidPklData = [
            'nama' => 'User PKL Duplikat Email',
            'email' => 'existing.pkl.email@example.com',
            'nohp' => '081234567800',
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

        $response = $this->post('/account', $invalidPklData);

        $response->assertStatus(302);
        $response->assertRedirect();

        $response->assertSessionHasErrors('email');

        $this->assertDatabaseMissing('accounts', [
            'nama' => 'User PKL Duplikat Email',
            'email' => 'existing.pkl.email@example.com',
            'status' => 'PKL',
        ]);
        $this->assertEquals(1, Account::count());

        $this->assertEquals(0, PKL::count());
    }

    public function test_login_success(): void
    {
        $password = 'password123';
        $user = Account::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make($password),
            'status' => 'Pelanggan',
        ]);

        $response = $this->post('/loginAccount', [
            'email' => 'test@example.com',
            'password' => $password,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    // /**
    //  * Tes untuk skenario login yang gagal karena password salah.
    //  */
    public function test_login_failed_wrong_password(): void
    {
        $user = Account::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->post('/loginAccount', [
            'email' => 'test@example.com',
            'password' => 'password-salah',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('erorAlert');
        $this->assertGuest();
    }




    // use RefreshDatabase;

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
    //         'status' => 'Pelanggan',
    //     ]);

    //     // 2. Aksi: Kirim request POST ke route login dengan data yang benar
    //     $response = $this->post('/loginAccount', [
    //         'email' => 'test@example.com',
    //         'password' => $password,
    //     ]);

    //     // 3. Pengecekan (Assertion):
    //     $response->assertStatus(302); 
    //     $response->assertRedirect('/dashboard'); 
    //     $this->assertAuthenticated(); 
    // }


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
    //     $response->assertStatus(302); 
    //     $response->assertSessionHas('erorAlert'); 
    //     $this->assertGuest(); 
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
