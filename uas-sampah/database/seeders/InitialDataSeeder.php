<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrashEducation;
use App\Models\GlobalWasteIndex;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Data Dummy Edukasi
        TrashEducation::create([
            'category_name' => 'Plastik PET',
            'description' => 'Jenis plastik bening yang sering digunakan untuk botol minum.',
            'recycling_method' => 'Bersihkan, remukkan, dan bawa ke bank sampah.'
        ]);

        TrashEducation::create([
            'category_name' => 'Sampah Organik',
            'description' => 'Sisa makanan atau daun yang mudah membusuk.',
            'recycling_method' => 'Olah menjadi kompos atau pakan maggot.'
        ]);

        // 2. Data Statistik (Based on Sensoneo Global Waste Index Concept)
        // Data contoh: Negara dengan manajemen limbah yang bervariasi
        $stats = [
            ['South Korea', 1, 400.5, 60.0],
            ['Germany', 2, 630.0, 48.0],
            ['United States', 10, 811.0, 35.0], // High waste per capita
            ['Turkey', 25, 450.0, 12.0],        // Low recycling rate example
            ['Indonesia', 30, 300.0, 10.0],     // Contextual addition
        ];

        foreach ($stats as $stat) {
            GlobalWasteIndex::create([
                'country_name' => $stat[0],
                'rank' => $stat[1],
                'waste_per_capita_kg' => $stat[2],
                'recycling_rate_percent' => $stat[3],
                'year_recorded' => 2024
            ]);
        }
    }
}
