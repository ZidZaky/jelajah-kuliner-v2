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
    public function test_add_New_History( )
    {
        $hsc = new HistoryStokController();
        $tu = TestUnit::class; 
        $prep = $this->prepared();
        $store = $hsc->store($prep[2]->id,30,$prep[1]->id);
        $tu::assertNotNull($store);
        $tu::assertIsInt($store);
        return $store;
    }

    public function test_Update_Stok_Online()
    {
        $hsc = new HistoryStokController();
        $tu = TestUnit::class;
        $idStok = $this->test_add_New_History();
        $cek = $hsc->UpdatestokOnline(50,$idStok);
        $tu::assertTrue($cek);
    }

    public function test_Update_Stok_Akhir()
    {
        $hsc = new HistoryStokController();
        $tu = TestUnit::class;
        $idStok = $this->test_add_New_History();
        $cek = $hsc->UpdatestokAkhir(1,$idStok);
        $tu::assertTrue($cek);
    }

    public function prepared(){
        $akun = Account::factory()->count(1)->create([
            'status'=>'PKL',
        ]);

        //buat akun pkl
        $pkl = PKL::factory()->create([
            'idAccount'=>$akun[0]->id,
        ]);
        //buat 1 product
        $product = Produk::factory()->create([
            'idPKL'=>$pkl->id,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        $res=$this->post('/loginAccount',[
            'email' => $akun[0]->email,
            'password' => 'pwCuy',
        ]);

        return [$akun[0],$pkl,$product];
    }
}
