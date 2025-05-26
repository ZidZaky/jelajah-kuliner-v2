<?php

namespace Tests\Feature;

use App\Models\Produk;
use App\Models\PKL;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProdukControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_buat_product()
    {
        Storage::fake('public');

        $account = Account::factory()->create();
        $pkl = PKL::factory()->create(['idAccount' => $account->id]);

        $this->withSession(['pkl' => ['id' => $pkl->id]]);

        $data = [
            'namaProduk' => 'Nasi Goreng',
            'jenisProduk' => 'Makanan',
            'desc' => 'Lezat dan bergizi',
            'harga' => 15000,
            'stok' => 10,
            'fotoProduk' => UploadedFile::fake()->image('produk.jpg'),
            'idPKL' => $pkl->id,
            'idAccount' => $pkl->idAccount,
        ];

        $response = $this->post('/produk', $data);
        $response->assertStatus(302);

        $this->assertDatabaseHas('produks', [
            'namaProduk' => 'Nasi Goreng',
            'jenisProduk' => 'Makanan',
            'harga' => 15000,
        ]);
    }

   public function test_store_history_stok()
{
    $produk = \App\Models\Produk::factory()->create();
    $pkl = \App\Models\PKL::factory()->create();

    $controller = new \App\Http\Controllers\HistoryStokController();
    $stokId = $controller->store($produk->id, 20, $pkl->id);

    $this->assertDatabaseHas('history_stoks', [
        'id' => $stokId,
        'idProduk' => $produk->id,
        'idPKL' => $pkl->id,
        'stokAwal' => 20
    ]);
}

public function test_update_stok_online_and_stok_akhir()
{
    $pkl = \App\Models\PKL::factory()->create();
    $produk = \App\Models\Produk::factory()->create(['idPKL' => $pkl->id]);

    $stok = \App\Models\historyStok::create([
        'idProduk' => $produk->id,
        'idPKL' => $pkl->id,
        'stokAwal' => 20,
        'stokAkhir' => 20,
        'TerjualOnline' => 0,
        'statusIsi' => 1,
    ]);

    $controller = new \App\Http\Controllers\HistoryStokController();
    $controller->UpdatestokOnline(5, $stok->id);

    $this->assertDatabaseHas('history_stoks', [
        'id' => $stok->id,
        'TerjualOnline' => 5,
        'stokAkhir' => 15,
        'statusIsi' => 1,
    ]);
}
    public function test_buat_history_post()
    {
        $produk = Produk::factory()->create();

        $response = $this->post('/buatHistory', [
            'idProduk' => $produk->id,
            'stokAwal' => 10,
            'stokAkhir' => 5,
        ]);

        $response->assertStatus(302); // Atau 200, tergantung redirect atau view
    }

    public function test_update_history_post()
    {
        $produk = Produk::factory()->create();

        $response = $this->post('/updateHistory', [
            'idProduk' => $produk->id,
            'stokAkhir' => 15,
        ]);

        $response->assertStatus(302); // Atau 200
    }

    public function test_get_produk_by_id_pkl()
    {
        $pkl = PKL::factory()->create();
        Produk::factory()->count(2)->create(['idPKL' => $pkl->id]);

        $response = $this->get("/getProduk/{$pkl->id}");
        $response->assertStatus(200);
    }
}
