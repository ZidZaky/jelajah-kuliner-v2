<?php

namespace Tests\Unit;

use Tests\TestCase;
use PHPUnit\Framework\Assert as TestUnit;
use App\Models\Account;
use App\Models\PKL;
use App\Models\Produk;
use App\Http\Controllers\HistoryStokController;

class HistoryStokControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function test_add_New_History( )
    // {
    //     $hsc = new HistoryStokController();
    //     $tu = TestUnit::class; 
    //     $prep = $this->prepared();
    //     $store = $hsc->store($prep[2]->id,30,$prep[1]->id);
    //     $tu::assertNotNull($store);
    //     $tu::assertIsInt($store);
    //     return $store;
    // }

    // public function test_Update_Stok_Online()
    // {
    //     $hsc = new HistoryStokController();
    //     $tu = TestUnit::class;
    //     $idStok = $this->test_add_New_History();
    //     $cek = $hsc->UpdatestokOnline(50,$idStok);
    //     $tu::assertTrue($cek);
    // }

    // public function test_Update_Stok_Akhir()
    // {
    //     $hsc = new HistoryStokController();
    //     $tu = TestUnit::class;
    //     $idStok = $this->test_add_New_History();
    //     $cek = $hsc->UpdatestokAkhir(1,$idStok);
    //     $tu::assertTrue($cek);
    // }

    public function prepared(){
        $akun = Account::factory()->count(1)->create([
            'status'=>'PKL',
        ]);
        $pkl = PKL::factory()->create([
            'idAccount'=>$akun[0]->id,
        ]);
        // dd($akun);
        // dd(;
        $res=$this->post('/loginAccount',[
            'email' => $akun[0]->email,
            'password' => 'pwCuy',
        ]);
        // dd($akun);

        //buat akun pkl
        
        // dd(session('PKL'));

        //buat 1 product
        $product = Produk::factory()->create([
            'idPKL'=>session('PKL')->id,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        

        return [$akun[0],$pkl,$product];
    }
    // $this->prepared();
    public function test_Buat_Stok_Awal_Success()
    {
        $prep = $this->prepared();
        $produk = $prep[2];
        $stokAwal = 40;
        $response = $this->post('/MakeStokAwal', [
            'stokAwal'=>$stokAwal,
            'idproduk'=>$produk->id,
        ]);
        // dd($response);

        //cek apakah mmengembalikan redirect
        $response->assertStatus(302);

        $response->assertSessionHas('alert', ['Berhasil', 'Tambah Stok Awal Berhasil']);
    }

    public function test_Buat_Stok_Awal_Failed()
    {
        $prep = $this->prepared();
        $produk = $prep[2];
        $stokAwal = 'kj';
        $response = $this->post('/MakeStokAwal', [
            'stokAwal'=>$stokAwal,
            'idproduk'=>$produk->id,
        ]);
        // dd($response);

        //cek apakah mmengembalikan redirect
        $response->assertStatus(302);
        $response->assertSessionHas('erorAlert');
        $response->assertSessionHas('erorAlert', ['Gagal', 'Tambah Stok Awal Gagal']);
    }

    public function test_Buat_Stok_Akhir_Success()
    {
        $prep = $this->prepared();
        // dd($prep);
        $produk = $prep[2];
        $stokAkhir = 20;
        $stokAwal = 40;
        $preparedStokAwal = $this->post('/MakeStokAwal', [
            'stokAwal'=>$stokAwal,
            'idproduk'=>$produk->id,
        ]);

        $response = $this->post('/updateStokAkhir', [
            'stokAkhir'=>$stokAkhir,
            'idproduk'=>$produk->id,
        ]);
        // dd($response);

        //cek apakah mmengembalikan redirect
        $response->assertStatus(302);
        $response->assertSessionHas('alert', ['Berhasil', 'Ubah Stok Akhir Berhasil']);
    }

    public function test_Buat_Stok_Akhir_Failed()
    {
        $prep = $this->prepared();
        // dd($prep);
        $produk = $prep[2];
        $stokAkhir = 'ju';
        $stokAwal = 40;
        $preparedStokAwal = $this->post('/MakeStokAwal', [
            'stokAwal'=>$stokAwal,
            'idproduk'=>$produk->id,
        ]);

        $response = $this->post('/updateStokAkhir', [
            'stokAkhir'=>$stokAkhir,
            'idproduk'=>$produk->id,
        ]);
        // dd($response);

        //cek apakah mmengembalikan redirect
        $response->assertStatus(302);
        $response->assertSessionHas('erorAlert', ['Gagal Update Stok Akhir', 'field Stok Akhir tidak berupa nomor']);
    }
}
