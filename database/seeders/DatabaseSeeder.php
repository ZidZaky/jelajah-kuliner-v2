<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\historyStok;
use App\Models\PKL;
use App\Models\Produk;
use App\Models\Ulasan;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // database/seeders/DatabaseSeeder.php
    public function run(): void
    {
        $accounts = \App\Models\Account::factory()->count(40)->create();
        $allPkl = [];
        foreach ($accounts as $akun) {
            if($akun->status=="PKL"){
                $pkl = PKL::factory()->create(
                    [
                        'idAccount'=>$akun->id,
                    ]
                );
                $allPkl[] = $pkl->id;
                $products = Produk::factory()->count(10)->create([
                    'idPKL'=>$pkl->id,
                ]);

                $produkAll = [];
                foreach($products as $product){
                    
                    $historyStok = historyStok::factory()->create([
                        'idProduk'=>$product->id,
                        'idPKL'=>$pkl->id,
                        'stokAwal'=>fake()->numberBetween(3,100),
                        'stokAkhir'=>20,
                        'TerjualOnline'=>20,
                        'statusIsi'=>1,
                    ]);
                    
                    $product->stokAktif = $historyStok->id;
                    $product->save();
                    $produkAll[] = $product->id;
                    
                    
                    
                }

                
                $pesanan = Pesanan::factory()->count(10)->create([
                'idAccount'=>fake()->numberBetween(1,40),
                'idPKL'=>$pkl->id,
                ]);

                foreach($pesanan as $pesan){
                    DB::table('produk_dipesan')
                    ->where('idPesanan', $pesan->id)
                    ->where('idProduk', fake()->numberBetween($produkAll))
                    ->first();
                }
                

                $ulasans = Ulasan::factory()->count(3)->create([
                    'idPKL'=>$pkl->id,
                    'idAccount'=>fake()->numberBetween(1,40),
                ]);

                
            }
            // dd($allPkl);
        }
        // dd($allPkl);
        
                // dd($pesanan);
        
        // Membuat pesanan dan menambahkan produk ke dalamnya
        // \App\Models\Pesanan::factory(15)->create();
    }
}
