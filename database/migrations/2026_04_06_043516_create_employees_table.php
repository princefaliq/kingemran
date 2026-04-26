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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            // Data utama
            $table->string('name');
            $table->string('position')->nullable(); // jabatan
            $table->string('phone')->nullable(); // no HP

            // Foto
            $table->string('photo')->nullable(); // simpan path gambar

            // Status aktif (opsional tapi bagus untuk admin)
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
