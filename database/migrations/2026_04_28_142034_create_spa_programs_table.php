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
        Schema::create('spa_programs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket');
            $table->text('deskripsi')->nullable();
            $table->integer('harga')->nullable();
            $table->string('gambar')->nullable();
            $table->boolean('is_active')->default(true); // tampil / tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spa_programs');
    }
};
