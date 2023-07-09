<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemetaan_gap', function (Blueprint $table) {
            $table->id();
            $table->integer('gap')->unique();
            $table->float('nilai')->nullable();
            $table->timestamps();
        });

        // Seed the table
        $this->seedData();
    }

    /**
     * Seed the table with data.
     *
     * @return void
     */
    private function seedData()
    {
        $pemetaanGap = [
            0 => 10,
            1 => 9.9,
            -1 => 9.8,
            2 => 9.7,
            -2 => 9.6,
            3 => 9.5,
            -3 => 9.4,
            4 => 9.3,
            -4 => 9.2,
            5 => 9.1,
            -5 => 9,
            6 => 8.9,
            -6 => 8.8,
            7 => 8.7,
            -7 => 8.6,
            8 => 8.5,
            -8 => 8.4,
            9 => 8.3,
            -9 => 8.2,
        ];

        foreach ($pemetaanGap as $gap => $nilai) {
            DB::table('pemetaan_gap')->insert([
                'gap' => $gap,
                'nilai' => $nilai,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /**
         * Reverse the migrations.
         */
    }
        public function down(): void
        {
            Schema::dropIfExists('pemetaan_gap');
        }
};
