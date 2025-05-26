<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\PKL;
use App\Models\Account;

class PKLControllerTest extends TestCase
{
    //berhasil
    public function testCreateView()
    {
        // Buat akun baru di database
        $account = \App\Models\Account::factory()->create([
            'nama' => 'PKL Test User',
            'email' => 'pkl@example.com',
            'nohp' => '08123456789',
            'password' => bcrypt('password'), // atau Hash::make
            'status' => 'PKL'
        ]);

        // Simulasikan session seolah user tersebut sedang login
        $this->withSession([
            'account' => [
                'id' => $account->id,
                'nama' => $account->nama,
                'email' => $account->email,
                'nohp' => $account->nohp,
                'status' => $account->status
            ]
        ]);

        // Lakukan request ke halaman create
        $response = $this->get('/PKL/create');

        // Pastikan halaman berhasil dimuat
        $response->assertStatus(200);
    }

    //berhasil
    public function testStorePKL()
    {
        // Simulasikan penyimpanan file
        Storage::fake('public');

        // Buat akun terlebih dahulu karena field idAccount berelasi
        $account = \App\Models\Account::factory()->create([
            'status' => 'PKL'
        ]);

        // Buat file gambar palsu
        $fakeImage = UploadedFile::fake()->image('pkl.jpg');

        // Kirim permintaan POST untuk menyimpan data PKL
        $response = $this->post('/PKL', [
            'namaPKL' => 'PKL A',
            'desc' => 'Deskripsi PKL A',
            'picture' => $fakeImage,
            'latitude' => -6.2,
            'longitude' => 106.8,
            'idAccount' => $account->id
        ]);

        // Pastikan diarahkan ke halaman dashboard
        $response->assertRedirect('/dashboard');

        // Pastikan data tersimpan di database
        $this->assertDatabaseHas('p_k_l_s', [
            'namaPKL' => 'PKL A',
            'desc' => 'Deskripsi PKL A',
            'latitude' => -6.2,
            'longitude' => 106.8,
            'idAccount' => $account->id
        ]);
    }

    // public function testEditView()
    // {
    //     // Buat data akun (jika dibutuhkan)
    //     $account = Account::factory()->create([
    //         'status' => 'PKL'
    //     ]);

    //     // Buat data PKL dengan idAccount sesuai akun di atas
    //     $pkl = PKL::factory()->create([
    //         'idAccount' => $account->id
    //     ]);

    //     // Simulasi session untuk user login sebagai PKL
    //     $response = $this
    //         ->withSession(['account' => ['id' => $account->id, 'status' => 'PKL']])
    //         ->get('/PKL/' . $pkl->id . '/edit');

    //     $response->assertStatus(200);
    //     $response->assertViewIs('editPKL');
    //     $response->assertViewHas('pkl', $pkl);
    // }

    // public function testUpdatePKL()
    // {
    //     $pkl = PKL::factory()->create();
    //     $response = $this->put('/PKL/' . $pkl->id, [
    //         'namaPKL' => 'PKL Updated',
    //         'desc' => 'Deskripsi Baru',
    //         'idAccount' => 1
    //     ]);

    //     $response->assertRedirect('/PKL');
    //     $this->assertDatabaseHas('p_k_l_s', [
    //         'namaPKL' => 'PKL Updated'
    //     ]);
    // }

    // public function testDestroyPKL()
    // {
    //     $pkl = PKL::factory()->create();
    //     $response = $this->delete('/PKL/' . $pkl->id);
    //     $response->assertRedirect('account-list');
    //     $this->assertDatabaseMissing('p_k_l_s', [
    //         'id' => $pkl->id
    //     ]);
    // }

    //Berhasil
    public function testGetCoordinates()
    {
        PKL::factory()->create();
        $response = $this->get('/getCoordinates');
        $response->assertStatus(200);
        $response->assertJsonStructure([['id', 'namaPKL', 'latitude', 'longitude', 'picture']]);
    }

    //Berhasil
    public function testGetPictureByID()
    {
        $pkl = PKL::factory()->create();
        $response = $this->get('/getPictureByID/' . $pkl->id);
        $response->assertStatus(200);
        $response->assertJsonStructure(['picture']);
    }

    //berhasil
    public function testGetIdPKL()
    {
        $response = $this->get('/getIDPkl/1');
        $response->assertStatus(200);
    }


    //Berhasil
    public function testGetDataPKL()
    {
        $response = $this->get('/getData');
        $response->assertStatus(200);
    }

    //berhasil
    public function testUpdateLocation()
    {
        // Ambil data acak dari tabel PKL
        $pkl = \App\Models\PKL::inRandomOrder()->first();

        // Pastikan data ada dalam database
        $this->assertNotNull($pkl);

        // Simulasikan permintaan POST untuk memperbarui lokasi
        $response = $this->post('/update-location', [
            'idAccount' => $pkl->idAccount,  // Gunakan ID yang acak
            'latitude' => -6.2,
            'longitude' => 106.8,
        ]);

        // Periksa apakah berhasil mengarahkan ke dashboard
        $response->assertRedirect('dashboard');

        // Verifikasi perubahan data dalam database
        $this->assertDatabaseHas('p_k_l_s', [
            'idAccount' => $pkl->idAccount,  // Gunakan ID yang acak
            'latitude' => -6.2,
            'longitude' => 106.8
        ]);
    }
}
