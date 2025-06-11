<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Account;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase; // Wajib ada untuk membersihkan database setiap kali tes dijalankan
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test registrasi berhasil.
     */
    

    /**
     * Test registrasi gagal karena email sudah ada.
     */
    public function test_register_duplicate_email(): void
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
    public function test_register_success(): void
    {
        // 1. Persiapan: Siapkan data untuk pengguna baru
        $userData = [
            'nama' => 'User Baru',
            'email' => 'userbaru@example.com',
            'nohp' => '081234567890',
            'password' => 'password123',
            'passwordkonf' => 'password123',
            'status' => 'Pelanggan',
        ];

        // 2. Aksi: Kirim request POST ke route resource 'account' (yaitu '/account')
        $response = $this->post('/account', $userData);

        // 3. Pengecekan:
        $response->assertRedirect('/login'); // Controller mengarahkan ke /login setelah sukses
        $this->assertDatabaseHas('accounts', [
            'email' => 'userbaru@example.com',
            'nama' => 'User Baru',
        ]);
    }

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