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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPengguna')->constrained('accounts'); // Correct the table name here
            $table->foreignId('idPelapor')->constrained('p_k_l_s'); // Correct the table name here
            $table->foreignId('idPesanan')->constrained('pesanans'); // Correct the table name here
            $table->string('alasan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
