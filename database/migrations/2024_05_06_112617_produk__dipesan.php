<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('produk_dipesan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPesanan')->constrained('pesanans'); // Correct the table name here
            $table->foreignId('idProduk')->constrained('produks'); // Correct the table name here
            $table->string('JumlahProduk'); // Correct the table name here
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
