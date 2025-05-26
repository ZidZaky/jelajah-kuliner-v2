<?php

namespace Tests\Unit;

use Tests\TestCase;
use function PHPUnit\Framework\assertSame;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class AccountControllerTest extends TestCase
{
    public function test_login_success()
    {
        $response = $this->get('/login', [
            'email' => 'pkl@pkl',
            'password' => '123',
        ]);
    
    $response->assertStatus(200);

    }

    public function test_login_failed()
    {
        $response = $this->get('/login', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpass'
        ]);

    $response->assertStatus(200);
    }

    public function test_register_success()
    {
        // Test redirect ke route account create
        $response = $this->get('/account/create');
        $response->assertStatus(200);
        $response->assertViewIs('register');

        // Test proses registrasi
        $response = $this->post('/account', [
            'nama' => 'Test User',
            'email' => 'Test@Test', 
            'nohp' => '08123456789',
            'password' => '321',
            'passwordkonf' => '321',
            'status' => 'Pelanggan'
        ]);

        $this->assertDatabaseHas('accounts', [
            'email' => 'Test@Test',
            'nama' => 'Test User'
        ]);
    }

    public function test_register_duplicate_email()
    {
        // Coba register dengan email yang sudah ada di database
        $response = $this->post('/account', [
            'nama' => 'PKL 2',
            'email' => 'pkl@pkl',
            'nohp' => '1234',
            'password' => '1234',
            'passwordkonf' => '1234',
            'status' => 'PKL'
        ]);

        $response = $this->post('/account', [
            'nama' => 'PKL 2',
            'email' => 'pkl@pkl',
            'nohp' => '1234',
            'password' => '1234',
            'passwordkonf' => '1234',
            'status' => 'PKL'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('alert', 'Email ini sudah pernah digunakan');
    }

    public function test_update_profile()
    {
        // Cek apakah akun dengan ID 71 ada di database
        $this->assertDatabaseHas('accounts', [
            'id' => 71
        ]);

        // Test update profile
        $response = $this->post('/account/71', [
            'nama' => 'PKL Updated',
            'email' => 'pkl@pkl',
            'nohp' => '123',
            'password' => '1234',
            'passwordkonf' => '1234'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_account()
    {
        $user = \App\Models\Account::factory()->create();
        
        $response = $this->actingAs($user)->delete('/account/' . $user->id);
        
        $response->assertRedirect('account-list');
        $this->assertDatabaseMissing('accounts', [
            'id' => $user->id
        ]);
    }
}
