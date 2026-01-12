<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrashEducation;
use App\Models\GlobalWasteIndex;
use App\Models\ClassificationLog;
use Illuminate\Support\Facades\Storage;

class TrashController extends Controller
{
    /**
     * Use Case 1: Melihat Informasi Edukasi
     */
    public function getEducationData()
    {
        // Mengambil semua data edukasi dari DB
        $data = TrashEducation::all();

        // Return JSON (Standard Backend Response)
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Use Case 2: Melihat Data Statistik Global (Sensoneo)
     */
    public function getStatisticsData()
    {
        // Mengambil data statistik diurutkan berdasarkan ranking
        $stats = GlobalWasteIndex::orderBy('rank', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'source' => 'Global Waste Index by Sensoneo (Simulated)',
            'data' => $stats
        ]);
    }

    /**
     * Use Case 3 & 4: Upload Gambar & Simulasi Klasifikasi
     */
    public function classifyImage(Request $request)
    {
        // 1. Validasi Input (Hanya gambar)
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // Max 5MB
        ]);

        // 2. Proses Upload File
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Simpan di folder: storage/app/public/uploads
            $path = $file->store('uploads', 'public');

            // 3. LOGIKA SIMULASI AI (MOCKUP)
            // Karena tidak ada Python, kita acak hasilnya di sini.
            $possibleClasses = ['Botol Plastik', 'Kardus Bekas', 'Kaleng Logam', 'Sisa Makanan', 'Kaca'];

            // Random pick jenis sampah
            $simulatedResult = $possibleClasses[array_rand($possibleClasses)];

            // Random confidence score (antara 70% - 99%)
            $simulatedConfidence = rand(700, 999) / 10;

            // 4. Simpan ke Database (History)
            $log = ClassificationLog::create([
                'image_path' => $path,
                'detected_result' => $simulatedResult,
                'confidence_score' => $simulatedConfidence
            ]);

            // 5. Return Hasil ke Frontend
            return response()->json([
                'status' => 'success',
                'message' => 'Klasifikasi berhasil (Simulasi)',
                'data' => [
                    'image_url' => Storage::url($path),
                    'result' => $simulatedResult,
                    'confidence' => $simulatedConfidence . '%',
                    'advice' => $this->getAdvice($simulatedResult) // Helper function
                ]
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Upload gagal'], 400);
    }

    // Helper sederhana untuk memberikan saran berdasarkan hasil simulasi
    private function getAdvice($type)
    {
        return match($type) {
            'Botol Plastik' => 'Pastikan botol kosong, remukkan, lalu buang di tong sampah Anorganik (Kuning).',
            'Kardus Bekas' => 'Lipat kardus agar pipih, hindari terkena air, buang di tempat daur ulang kertas.',
            'Sisa Makanan' => 'Masukan ke lubang biopori atau jadikan kompos.',
            default => 'Pisahkan sesuai jenisnya.'
        };
    }
}
