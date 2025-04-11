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
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata')->nullable(false);
            $table->string('alamat_wisata')->nullable(false);
            $table->string('tiket')->nullable(false);
            $table->string('jam_operasional')->nullable(false);
            $table->string('deskripsi')->nullable(false);
            $table->string('gambar')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};
