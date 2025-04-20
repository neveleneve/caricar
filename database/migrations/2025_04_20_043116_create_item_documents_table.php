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
        Schema::create('item_documents', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id');
            $table->string('no_stnk')->nullable();
            $table->date('masa_berlaku_stnk')->nullable();
            $table->string('no_bpkb')->nullable();
            $table->string('nama_pemilik_stnk')->nullable();
            $table->string('nik_pemilik')->nullable();
            $table->enum('status_pajak', ['aktif', 'non_aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_documents');
    }
};
