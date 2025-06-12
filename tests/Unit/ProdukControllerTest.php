<?php

namespace Tests\Feature;

use App\Models\Produk;
use App\Models\PKL;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\HistoryStokController;

class ProdukControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_store_produk_dengan_data_tidak_valid()
    {
        $this->withoutMiddleware(); // Hilangkan auth/csrf dll kalau perlu

        $response = $this->post('/produk', [
            'namaProduk' => '', // Kosong = tidak valid
            'jenisProduk' => '',
            'desc' => '',
            'harga' => '',
            'stok' => '',
            'fotoProduk' => UploadedFile::fake()->image('produk.jpg'),
            'idPKL' => '', // Kosong = invalid
        ]);

        // Validasi gagal = redirect kembali (HTTP 302)
        $response->assertStatus(302);

        // Pastikan ada redirect (default Laravel behavior jika validasi gagal)
        $response->assertRedirect();
    }

    public function setUp(): void
    {
        parent::setUp();

        // Buat dummy PKL
        $this->pkl = PKL::factory()->create();

        // Mock HistoryStokController
        $mock = \Mockery::mock(HistoryStokController::class);
        $mock->shouldReceive('store')
            ->andReturn(999); // ID stok palsu

        $this->app->instance(HistoryStokController::class, $mock);
    }

    public function test_store_produk_berhasil()
    {

        // dd($this->pkl->id,);
        $response = $this->post('/produk', [
            'namaProduk' => 'Nasi Goreng',
            'jenisProduk' => 'Makanan',
            'desc' => 'Lezat dan bergizi',
            'harga' => 15000,
            'stok' => 10,
            'fotoProduk' => UploadedFile::fake()->image('produk.jpg'),

            'idPKL' => $this->pkl->id,

        ]);

        $response->assertStatus(302); //ini

        $this->assertDatabaseHas('produks', [
            'namaProduk' => 'Nasi Goreng',
            'jenisProduk' => 'Makanan',
            'desc' => 'Lezat dan bergizi',
            'harga' => 15000,
            'idPKL' => $this->pkl->id,
        ]);
    }

    public function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }



    //     public function test_store_produk_berhasil()
    // {
    //     // Simulasi storage agar tidak menyimpan file asli
    //     Storage::fake('public');

    //     // Arrange: Buat PKL dummy
    //     $pkl = PKL::factory()->create();

    //     // Data produk valid
    //     $data = [
    //         'namaProduk' => 'Nasi Goreng',
    //         'jenisProduk' => 'Makanan',
    //         'desc' => 'Lezat dan bergizi',
    //         'harga' => 15000,
    //         'stok' => 10,
    //         'fotoProduk' => UploadedFile::fake()->image('produk.jpg'),
    //         'idPKL' => $pkl->id,
    //     ];

    //     // Act: Kirim request simpan produk
    //     $response = $this->post('/produk', $data); // sesuaikan jika route-nya berbeda

    //     // Assert: Harus redirect (302)
    //     $response->assertStatus(302);

    //     // Assert: Produk berhasil disimpan di database
    //     $this->assertDatabaseHas('produks', [
    //         'namaProduk' => 'Nasi Goreng',
    //         'jenisProduk' => 'Makanan',
    //         'desc' => 'Lezat dan bergizi',
    //         'harga' => 15000,
    //         'idPKL' => $pkl->id,
    //     ]);
    // }

    //     public function test_buat_product()
    //     {
    //         Storage::fake('public');

    //         $account = Account::factory()->create();
    //         $pkl = PKL::factory()->create(['idAccount' => $account->id]);

    //         $this->withSession(['pkl' => ['id' => $pkl->id]]);

    //         $data = [
    //             'namaProduk' => 'Nasi Goreng',
    //             'jenisProduk' => 'Makanan',
    //             'desc' => 'Lezat dan bergizi',
    //             'harga' => 15000,
    //             'stok' => 10,
    //             'fotoProduk' => UploadedFile::fake()->image('produk.jpg'),
    //             'idPKL' => $pkl->id,
    //             'idAccount' => $pkl->idAccount,
    //         ];

    //         $response = $this->post('/produk', $data);
    //         $response->assertStatus(302);

    //         $this->assertDatabaseHas('produks', [
    //             'namaProduk' => 'Nasi Goreng',
    //             'jenisProduk' => 'Makanan',
    //             'harga' => 15000,
    //         ]);
    //     }

    //    public function test_store_history_stok()
    // {
    //     $produk = \App\Models\Produk::factory()->create();
    //     $pkl = \App\Models\PKL::factory()->create();

    //     $controller = new \App\Http\Controllers\HistoryStokController();
    //     $stokId = $controller->store($produk->id, 20, $pkl->id);

    //     $this->assertDatabaseHas('history_stoks', [
    //         'id' => $stokId,
    //         'idProduk' => $produk->id,
    //         'idPKL' => $pkl->id,
    //         'stokAwal' => 20
    //     ]);
    // }

    // public function test_update_stok_online_and_stok_akhir()
    // {
    //     $pkl = \App\Models\PKL::factory()->create();
    //     $produk = \App\Models\Produk::factory()->create(['idPKL' => $pkl->id]);

    //     $stok = \App\Models\historyStok::create([
    //         'idProduk' => $produk->id,
    //         'idPKL' => $pkl->id,
    //         'stokAwal' => 20,
    //         'stokAkhir' => 20,
    //         'TerjualOnline' => 0,
    //         'statusIsi' => 1,
    //     ]);

    //     $controller = new \App\Http\Controllers\HistoryStokController();
    //     $controller->UpdatestokOnline(5, $stok->id);

    //     $this->assertDatabaseHas('history_stoks', [
    //         'id' => $stok->id,
    //         'TerjualOnline' => 5,
    //         'stokAkhir' => 15,
    //         'statusIsi' => 1,
    //     ]);
    // }
    //     public function test_buat_history_post()
    //     {
    //         $produk = Produk::factory()->create();

    //         $response = $this->post('/buatHistory', [
    //             'idProduk' => $produk->id,
    //             'stokAwal' => 10,
    //             'stokAkhir' => 5,
    //         ]);

    //         $response->assertStatus(302); // Atau 200, tergantung redirect atau view
    //     }

    //     public function test_update_history_post()
    //     {
    //         $produk = Produk::factory()->create();

    //         $response = $this->post('/updateHistory', [
    //             'idProduk' => $produk->id,
    //             'stokAkhir' => 15,
    //         ]);

    //         $response->assertStatus(302); // Atau 200
    //     }

    //     public function test_get_produk_by_id_pkl()
    //     {
    //         $pkl = PKL::factory()->create();
    //         Produk::factory()->count(2)->create(['idPKL' => $pkl->id]);

    //         $response = $this->get("/getProduk/{$pkl->id}");
    //         $response->assertStatus(200);
    //     }
}
