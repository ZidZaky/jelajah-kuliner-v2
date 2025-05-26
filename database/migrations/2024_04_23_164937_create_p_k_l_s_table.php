<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_k_l_s', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('namaPKL');
            $table->text('desc');
            $table->string('picture')->nullable();
            $table->decimal('latitude', 10, 8); // Decimal for latitude with precision and scale
            $table->decimal('longitude', 11, 8);
            $table->foreignId('idAccount')->constrained('accounts'); // Correct the table name here
            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_k_l_s');
    }
};
