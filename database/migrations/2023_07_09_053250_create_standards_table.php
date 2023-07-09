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
        Schema::create('standards', function (Blueprint $table) {
            // untuk Profile Matching
            $table->id();
            $table->unsignedBigInteger('smartphone_id');
            $table->string('kriteria');
            $table->float('nilai');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('smartphone_id')->references('id')->on('smartphones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standards');
    }
};
