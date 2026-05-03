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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama pemberi review
            $table->string('image')->nullable();
            $table->foreignId('tour_package_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->index();
            $table->text('content'); // isi review
            $table->tinyInteger('rating')->default(5);
            $table->boolean('is_active')->default(false); // tampil / tidak
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
