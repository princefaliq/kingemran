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
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // nama paket (Umroh Ramadhan, dll)
            $table->string('slug')->unique();

            $table->string('thumbnail')->nullable(); // gambar utama (800x655)
            $table->integer('duration'); // contoh: 10 (hari)
            $table->string('duration_type')->default('days'); // days / nights

            $table->decimal('price', 12, 2); // harga sekarang
            $table->decimal('price_discount', 12, 2)->nullable(); // harga coret

            $table->string('location')->nullable(); // Mekkah, Madinah
            $table->string('departure_city')->nullable(); // Surabaya, Jakarta

            $table->date('departure_date')->nullable(); // tanggal berangkat
            $table->string('airline')->nullable(); // maskapai
            $table->string('hotel')->nullable(); // hotel

            $table->integer('quota')->nullable(); // jumlah jamaah

            $table->text('short_description')->nullable(); // deskripsi singkat
            $table->longText('description')->nullable(); // detail lengkap

            $table->boolean('is_featured')->default(false); // paket unggulan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
