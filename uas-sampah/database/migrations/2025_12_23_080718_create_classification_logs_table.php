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
        Schema::create('classification_logs', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');      // Lokasi file gambar
            $table->string('detected_result'); // Hasil simulasi (Plastik/Kertas/dll)
            $table->float('confidence_score'); // Akurasi simulasi (e.g. 95.5%)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classification_logs');
    }
};
