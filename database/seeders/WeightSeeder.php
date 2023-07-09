<?php

namespace Database\Seeders;

use App\Models\Weight;
use App\Models\Smartphone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data smartphone
        $smartphones = Smartphone::all();

        // Seed standar kompetensi untuk setiap smartphone
        foreach ($smartphones as $smartphone) {
            Weight::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'harga',
                'bobot' => 8,
            ]);
            Weight::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'chipset',
                'bobot' => 7,
            ]);
            Weight::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'GPU',
                'bobot' => 6,
            ]);
            Weight::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'ram',
                'bobot' => 5,
            ]);
            Weight::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'rom',
                'bobot' => 5,
            ]);
            Weight::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'kamera',
                'bobot' => 2,
            ]);
            Weight::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'kapasitas_baterai',
                'bobot' => 5,
            ]);
            Weight::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'tahun_rilis',
                'bobot' => 2,
            ]);
        }
    }
}
