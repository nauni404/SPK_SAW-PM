<?php

namespace Database\Seeders;

use App\Models\Smartphone;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmartphoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Smartphone::create([
            'nama' => 'HP1',
            'harga' => 3000000,
            'chipset' => 90,
            'GPU' => 85,
            'ram' => 8,
            'rom' => 64,
            'kamera' => 14,
            'kapasitas_baterai' => 5000,
            'tahun_rilis' => 2023,
        ]);
        Smartphone::create([
            'nama' => 'HP2',
            'harga' => 2990000,
            'chipset' => 85,
            'GPU' => 85,
            'ram' => 8,
            'rom' => 64,
            'kamera' => 14,
            'kapasitas_baterai' => 4500,
            'tahun_rilis' => 2023,
        ]);
        Smartphone::create([
            'nama' => 'HP3',
            'harga' => 2890000,
            'chipset' => 88,
            'GPU' => 90,
            'ram' => 8,
            'rom' => 64,
            'kamera' => 12,
            'kapasitas_baterai' => 4500,
            'tahun_rilis' => 2023,
        ]);
        Smartphone::create([
            'nama' => 'HP4',
            'harga' => 3000000,
            'chipset' => 88,
            'GPU' => 88,
            'ram' => 8,
            'rom' => 64,
            'kamera' => 24,
            'kapasitas_baterai' => 5500,
            'tahun_rilis' => 2023,
        ]);
    }
}
