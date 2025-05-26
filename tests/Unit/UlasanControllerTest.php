<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ulasan;
use App\Models\User;

class UlasanControllerTest extends TestCase
{
    // // use RefreshDatabase;

    // // /** @test */
    // // public function it_can_show_ulasan_list()
    // // {
    // //     $response = $this->get('/Ulasan');
    // //     $response->assertStatus(200);
    // //     $response->assertViewIs('list-ulasan');
    // // }

    // // /** @test */
    // // public function it_can_show_create_ulasan_page()
    // // {
    // //     $response = $this->get('/Ulasan/create');
    // //     $response->assertStatus(200);
    // //     $response->assertViewIs('ulasan');
    // }

    /** @test */
    public function it_can_store_ulasan()
    {
        // Buat akun dan pkl secara dinamis menggunakan factory
        $account = \App\Models\Account::factory()->create();
        $pkl = \App\Models\PKL::factory()->create();

        $data = [
            'ulasan' => 'Pelayanan bagus',
            'rating' => rand(1, 5), // rating acak 1-5
            'idAccount' => $account->id,
            'idPKL' => $pkl->id,
        ];

        $response = $this->post('/ulasan', $data);

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseHas('ulasans', [
            'ulasan' => 'Pelayanan bagus',
            'rating' => $data['rating'],
            'idAccount' => $data['idAccount'],
            'idPKL' => $data['idPKL'],
        ]);
    }

    // /** @test */
    // public function it_fails_to_store_ulasan_with_missing_fields()
    // {
    //     $data = [
    //         'ulasan' => '',
    //         'rating' => '',
    //         'idAccount' => '',
    //         'idPKL' => '',
    //     ];

    //     $response = $this->post('/Ulasan', $data);
    //     $response->assertSessionHasErrors(['ulasan', 'rating', 'idAccount', 'idPKL']);
    // }

    /** @test */
    public function it_can_fetch_ulasan_by_id()
    {
        $account = \App\Models\Account::factory()->create();
        $pkl = \App\Models\PKL::factory()->create();

        $data = [
            'ulasan' => 'Pelayanan bagus',
            'rating' => rand(1, 5), // rating acak 1-5
            'idAccount' => $account->id,
            'idPKL' => $pkl->id,
        ];

        $response = $this->post('/ulasan', $data);

        $response = $this->get('/getUlasan/' . $pkl->id);

        $response->assertStatus(200);
        // $response->assertJsonFragment(['idPKL' => 1]);
    }

    /** @test */
    // public function it_can_fetch_all_ulasan()
    // {
    //     $account = \App\Models\Account::factory()->create();
    //     $pkl = \App\Models\PKL::factory()->create();
    //     $jumlahUlasan = rand(1, 3);

    //     \App\Models\Ulasan::factory()->count($jumlahUlasan)->create([
    //         'idAccount' => $account->id,
    //         'idPKL' => $pkl->id,
    //     ]);

    //     $response = $this->get('/getUlasanAll');

    //     dd($response[0]);
    //     $response->assertStatus(200);

    //     $response->assertJsonCount($jumlahUlasan);
    // }
}
