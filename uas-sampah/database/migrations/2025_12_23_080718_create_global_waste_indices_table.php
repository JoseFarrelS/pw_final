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
        Schema::create('global_waste_indices', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->integer('rank'); // Peringkat limbah (1 = paling buruk/baik tergantung konteks)
            $table->float('waste_per_capita_kg'); // Kg sampah per orang
            $table->float('recycling_rate_percent'); // Tingkat daur ulang
            $table->year('year_recorded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_waste_indices');
    }
};
