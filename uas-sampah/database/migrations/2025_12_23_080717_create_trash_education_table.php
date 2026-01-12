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
        Schema::create('trash_education', function (Blueprint $table) {
            $table->id();
            $table->string('category_name'); // e.g. Organik
            $table->text('description');     // Penjelasan
            $table->text('recycling_method'); // Cara daur ulang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_education');
    }
};
