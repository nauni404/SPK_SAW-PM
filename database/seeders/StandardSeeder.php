<?php

namespace Database\Seeders;

use App\Models\Standard;
use App\Models\Smartphone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StandardSeeder extends Seeder
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

            Standard::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'harga',
                'nilai' => 99,
                'keterangan' => 'cost',
            ]);
            Standard::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'chipset',
                'nilai' => 99,
                'keterangan' => 'benefit',
            ]);
            Standard::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'GPU',
                'nilai' => 99,
                'keterangan' => 'benefit',
            ]);
            Standard::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'ram',
                'nilai' => 95,
                'keterangan' => 'benefit',
            ]);
            Standard::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'rom',
                'nilai' => 95,
                'keterangan' => 'benefit',
            ]);
            Standard::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'kamera',
                'nilai' => 50,
                'keterangan' => 'benefit',
            ]);
            Standard::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'kapasitas_baterai',
                'nilai' => 90,
                'keterangan' => 'benefit',
            ]);
            Standard::create([
                'smartphone_id' => $smartphone->id,
                'kriteria' => 'tahun_rilis',
                'nilai' => 100,
                'keterangan' => 'benefit',
            ]);
        }
    }
}
