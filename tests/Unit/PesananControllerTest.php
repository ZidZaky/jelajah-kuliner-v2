<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\ProdukDipesan;
use App\Models\PKL;
use App\Models\Produk;
use App\Http\Controllers\HistoryStokController;
use App\Http\Requests\PesananRequest;
use App\Http\Requests\PesananUpdateRequest;
use App\Http\Resources\PesananResource;
use App\Http\Resources\PesananCollection;
use App\Http\Controllers\PesananController;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Account;
use Illuminate\Support\Facades\Session;




class PesananControllerTest extends TestCase
{
    public function test_batalPesanan_successful_if_status_is_new_order(): void
    {
        // 1. Persiapan:
        $account = Account::factory()->create([
            'status' => 'Pelanggan',
            'email' => 'pelanggan@test.com',
            'nohp' => '081234567890',
            'foto' => 'dummy/foto.jpg',
        ]);
        Session::put('account', $account);

        $pkl = PKL::factory()->create([
            'namaPKL' => 'Test PKL',
            'desc' => 'Test Deskripsi',
            'latitude' => -7.2,
            'longitude' => 112.7,
            'picture' => 'dummy/picture.jpg',
            'idAccount' => Account::factory()->create(['status' => 'PKL'])->id,
        ]);

        $pesanan = Pesanan::factory()->create([
            'idAccount' => $account->id,
            'idPKL' => $pkl->id,
            'status' => 'Pesanan Baru', // PENTING: Status awal harus 'Pesanan Baru'
            'TotalBayar' => 50000,
            'Keterangan' => 'Test Keterangan',
        ]);

        // 2. Aksi: Kirim request GET ke route 'batalPesanan' dengan query parameter id dan wht
        $response = $this->get('/batalPesanan?id=' . $pesanan->id . '&wht=Pesanan');

        // Debug: Cek status pesanan setelah request
        $pesananAfterRequest = Pesanan::find($pesanan->id);
        echo "\nStatus pesanan setelah request: " . $pesananAfterRequest->status;

        // 3. Assertions: Verifikasi hasil
        // Memastikan status 302 (redirect)
        $response->assertStatus(302);

        // Memastikan redirect ke URL yang benar
        $response->assertRedirect('/pesanan/show/?id=' . $account->id . '&wht=Pesanan Baru');

        // Memastikan session flash message sukses ada
        $response->assertSessionHas('alert', ['Berhasil', 'Pesanan Berhasil Dibatalkan']);

        // Memastikan status pesanan di database telah berubah menjadi 'Pesanan Dibatalkan'
        $this->assertDatabaseHas('pesanans', [
            'id' => $pesanan->id,
            'status' => 'Pesanan Dibatalkan',
        ]);
    }

    // use RefreshDatabase;

    // public function testCreateView()
    // {
    //     // Buat akun baru di database
    //     $account = \App\Models\Account::factory()->create([
    //         'nama' => 'PKL Test User',
    //         'email' => 'pkl@example.com',
    //         'nohp' => '08123456789',
    //         'password' => bcrypt('password'), // atau Hash::make
    //         'status' => 'PKL'
    //     ]);

    //     // Simulasikan session seolah user tersebut sedang login
    //     $this->withSession([
    //         'account' => [
    //             'id' => $account->id,
    //             'nama' => $account->nama,
    //             'email' => $account->email,
    //             'nohp' => $account->nohp,
    //             'status' => $account->status
    //         ]
    //     ]);

    //     // Ambil ID PKL secara acak dari database
    //     $randomId = \App\Models\Pkl::inRandomOrder()->first()->id;

    //     // Kirimkan request ke URL create pesanan dengan ID yang diambil secara acak
    //     $response = $this->get("/pesanan/create/{$randomId}");
    //     // dd($response);
    //     // Verifikasi bahwa pengguna diarahkan ke halaman create pesanan
    //     $response->assertStatus(status: 200);  // atau sesuaikan dengan status yang benar

    //     // Atau untuk verifikasi lebih lanjut, bisa cek URL yang diteruskan
    //     // $response->assertRedirect("/pesanan/create/{$randomId}");
    // }

    // public function testStorePesanan()
    // {
    //     // Buat akun baru di database
    //     $account = \App\Models\Account::factory()->create([
    //         'nama' => 'PKL Test User',
    //         'email' => 'pkl@example.com',
    //         'nohp' => '08123456789',
    //         'password' => bcrypt('password'),
    //         'status' => 'PKL'
    //     ]);

    //     // Simulasikan session login
    //     $this->withSession([
    //         'account' => [
    //             'id' => $account->id,
    //             'nama' => $account->nama,
    //             'email' => $account->email,
    //             'nohp' => $account->nohp,
    //             'status' => $account->status
    //         ]
    //     ]);

    //     // Ambil ID PKL secara acak dari database
    //     $randomId = \App\Models\Pkl::inRandomOrder()->first()->id;

    //     // Buat produk untuk PKL tersebut
    //     $produk = \App\Models\Produk::factory()->create([
    //         'idPKL' => $randomId,
    //     ]);
    //     $produkId = $produk->id;

    //     // Kirimkan POST request ke /pesanan
    //     $response = $this->post('/pesanan', [
    //         'idAccount' => $account->id, // ✅ Pakai ID account yang benar
    //         'idPKL' => $randomId,
    //         'totalHarga' => 20000,
    //         'status' => 'Pesanan Baru',
    //         'keterangan' => 'Tidak pedas ya mas!',
    //         'produk_' . $produkId => 2,
    //     ]);

    //     // Pastikan statusnya 200
    //     $response->assertStatus(302);

    //     // Verifikasi bahwa pesanan tersimpan dalam database
    //     $this->assertDatabaseHas('pesanans', [
    //         'idAccount' => $account->id,
    //         'idPKL' => $randomId,
    //         'TotalBayar' => 20000,
    //         'status' => 'Pesanan Baru',
    //         'Keterangan' => 'Tidak pedas ya mas!',
    //     ]);

    //     // Ambil ID pesanan terakhir
    //     $lastPesananId = \App\Models\Pesanan::latest()->first()->id;

    //     // Cek bahwa produk dipesan tercatat
    //     $this->assertDatabaseHas('produk_dipesan', [
    //         'idPesanan' => $lastPesananId,
    //         'idProduk' => $produkId,
    //         'JumlahProduk' => 2,
    //     ]);
    // }

    // public function testCreateWithId()
    // {
    //     $account = \App\Models\Account::factory()->create([
    //         'nama' => 'PKL Test User',
    //         'email' => 'pkl@example.com',
    //         'nohp' => '08123456789',
    //         'password' => bcrypt('password'), // atau Hash::make
    //         'status' => 'PKL'
    //     ]);

    //     // Simulasikan session seolah user tersebut sedang login
    //     $this->withSession([
    //         'account' => [
    //             'id' => $account->id,
    //             'nama' => $account->nama,
    //             'email' => $account->email,
    //             'nohp' => $account->nohp,
    //             'status' => $account->status
    //         ]
    //     ]);

    //     $pkl = \App\Models\Pkl::inRandomOrder()->first();
    //     // dd($pkl);
    //     $response = $this->get('/pesanan/create/' . $pkl->id);
    //     // dd($response[0]);

    //     // Cek hasil response
    //     $response->assertStatus(200);
    //     $response->assertViewIs('pesan');
    //     $response->assertViewHas('pkl');
    //     $response->assertViewHas('produk');
    // }

    // public function testPesanDetail()
    // {
    //     $account = \App\Models\Account::factory()->create([
    //         'nama' => 'PKL Test User',
    //         'email' => 'pkl@example.com',
    //         'nohp' => '08123456789',
    //         'password' => bcrypt('password'), // atau Hash::make
    //         'status' => 'PKL'
    //     ]);

    //     // Simulasikan session seolah user tersebut sedang login
    //     $this->withSession([
    //         'account' => [
    //             'id' => $account->id,
    //             'nama' => $account->nama,
    //             'email' => $account->email,
    //             'nohp' => $account->nohp,
    //             'status' => $account->status
    //         ]
    //     ]);

    //     $pesanan = \App\Models\Pesanan::inRandomOrder()->first();
    //     // dd($pesanan);
    //     $response = $this->get('pesanDetail/' . $pesanan->id);
    //     // dd($response[0]);
    //     $response->assertStatus(200);
    // }

    // public function testTerimaPesanan()
    // {
    //     $account = \App\Models\Account::factory()->create([
    //         'nama' => 'PKL Test User',
    //         'email' => 'pkl@example.com',
    //         'nohp' => '08123456789',
    //         'password' => bcrypt('password'), // atau Hash::make
    //         'status' => 'PKL'
    //     ]);

    //     // Simulasikan session seolah user tersebut sedang login
    //     $this->withSession([
    //         'account' => [
    //             'id' => $account->id,
    //             'nama' => $account->nama,
    //             'email' => $account->email,
    //             'nohp' => $account->nohp,
    //             'status' => $account->status
    //         ]
    //     ]);

    //     $pesanan = \App\Models\Pesanan::factory()->create();
    //     DB::table('produk_dipesan')->insert([
    //         'idPesanan' => $pesanan->id,
    //         'idProduk' => \App\Models\Produk::factory()->create()->id,
    //         'JumlahProduk' => 1
    //     ]);

    //     $response = $this->get('/terimaPesanan/' . $pesanan->id);
    //     // dd($response[0]);
    //     $response->assertStatus(200);
    //     $this->assertEquals('Pesanan Diproses', $pesanan->fresh()->status);
    // }

    // public function testTolakPesanan()
    // {
    //     $account = \App\Models\Account::factory()->create([
    //         'nama' => 'PKL Test User',
    //         'email' => 'pkl@example.com',
    //         'nohp' => '08123456789',
    //         'password' => bcrypt('password'), // atau Hash::make
    //         'status' => 'PKL'
    //     ]);

    //     // Simulasikan session seolah user tersebut sedang login
    //     $this->withSession([
    //         'account' => [
    //             'id' => $account->id,
    //             'nama' => $account->nama,
    //             'email' => $account->email,
    //             'nohp' => $account->nohp,
    //             'status' => $account->status
    //         ]
    //     ]);

    //     $pesanan = \App\Models\Pesanan::factory()->create();
    //     DB::table('produk_dipesan')->insert([
    //         'idPesanan' => $pesanan->id,
    //         'idProduk' => \App\Models\Produk::factory()->create()->id,
    //         'JumlahProduk' => 1
    //     ]);

    //     $response = $this->get('/tolakPesanan/' . $pesanan->id);
    //     // dd($response[0]);

    //     $response->assertStatus(200);
    //     $this->assertEquals('Pesanan Ditolak', $pesanan->fresh()->status);
    // }

    // public function testBatalPesanan()
    // {
    //     $account = \App\Models\Account::factory()->create([
    //         'nama' => 'PKL Test User',
    //         'email' => 'pkl@example.com',
    //         'nohp' => '08123456789',
    //         'password' => bcrypt('password'), // atau Hash::make
    //         'status' => 'PKL'
    //     ]);

    //     // Simulasikan session seolah user tersebut sedang login
    //     $this->withSession([
    //         'account' => [
    //             'id' => $account->id,
    //             'nama' => $account->nama,
    //             'email' => $account->email,
    //             'nohp' => $account->nohp,
    //             'status' => $account->status
    //         ]
    //     ]);

    //     $pesanan = \App\Models\Pesanan::factory()->create();
    //     DB::table('produk_dipesan')->insert([
    //         'idPesanan' => $pesanan->id,
    //         'idProduk' => \App\Models\Produk::factory()->create()->id,
    //         'JumlahProduk' => 1
    //     ]);

    //     $response = $this->get('/batalPesanan/' . $pesanan->id);
    //     $response->assertStatus(200);
    //     $this->assertEquals('Pesanan Dibatalkan', $pesanan->fresh()->status);
    // }

    // public function testSelesaiPesanan()
    // {
    //     // 1. Buat Account
    //     $account = \App\Models\Account::factory()->create([
    //         'status' => 'PKL'
    //     ]);

    //     // 2. Buat PKL terkait account ini
    //     $pkl = \App\Models\PKL::factory()->create([
    //         'idAccount' => $account->id
    //     ]);

    //     // 3. Simulasi login session
    //     $this->withSession([
    //         'account' => [
    //             'id' => $pkl->id, // ← pastikan ini ID PKL karena UpdatestokOnline pakai ini
    //             'nama' => $account->nama,
    //             'email' => $account->email,
    //             'nohp' => $account->nohp,
    //             'status' => $account->status
    //         ]
    //     ]);

    //     // 4. Produk yang akan dipesan
    //     $produk = \App\Models\Produk::factory()->create([
    //         'stokAktif' => 10
    //     ]);

    //     // 5. Create HistoryStok and capture the id for testing
    //     $historyStok = \App\Models\HistoryStok::factory()->create([
    //         'idProduk' => $produk->id,
    //         'idPKL' => $pkl->id,
    //         'stokAwal' => 20,
    //         'stokAkhir' => 10, // ← harus sama dengan produk->stokAktif
    //         'TerjualOnline' => 0,
    //         'statusIsi' => 1
    //     ]);

    //     // 6. Now, use the ID from the created HistoryStok for the update
    //     $pesanan = \App\Models\Pesanan::factory()->create([
    //         'status' => 'Menunggu'
    //     ]);

    //     // 7. Insert produk_dipesan for the order
    //     DB::table('produk_dipesan')->insert([
    //         'idPesanan' => $pesanan->id,
    //         'idProduk' => $produk->id,
    //         'JumlahProduk' => 2
    //     ]);

    //     // 8. Call the selesaiPesanan route and verify the behavior
    //     $response = $this->get('selesaiPesanan/' . $pesanan->id);
    //     // dd($response[0]);
    //     $response->assertStatus(200);
    //     $this->assertEquals('Pesanan Selesai', $pesanan->fresh()->status);
    // }
}
