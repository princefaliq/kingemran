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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // judul layanan
            $table->string('subtitle')->nullable(); // keterangan singkat
            $table->string('image'); // gambar utama (background/card)
            $table->string('icon')->nullable(); // icon png kecil
            $table->boolean('is_active')->default(true); // tampil / tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
