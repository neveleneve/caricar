<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('item_details', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->string('nomor_polisi')->nullable();
            $table->string('nomor_rangka')->nullable();
            $table->string('deskripsi_kondisi')->nullable();
            $table->string('color')->nullable();
            $table->integer('kilometer')->nullable();
            $table->enum('transmission', ['manual', 'automatic'])->default('manual');
            $table->integer('indonesia_cities_code');
            $table->string('tahun_produksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('item_details');
    }
};
