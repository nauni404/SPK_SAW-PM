<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Weight;
use App\Models\Smartphone;
use App\Models\Standard;
use Illuminate\Database\Seeder;
use Database\Seeders\WeightSeeder;
use Database\Seeders\SmartphoneSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SmartphoneSeeder::class);
        $this->call(WeightSeeder::class);
        $this->call(StandardSeeder::class);
    }
}
