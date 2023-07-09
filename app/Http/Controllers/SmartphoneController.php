<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use App\Models\Standard;
use App\Models\Smartphone;
use App\Models\PemetaanGap;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreSmartphoneRequest;
use App\Http\Requests\UpdateSmartphoneRequest;

class SmartphoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan data smartphone
        $smartphones = Smartphone::all();

        // Menampilkan view dengan data smartphone
        return view('index', compact('smartphones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSmartphoneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Smartphone $smartphone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Smartphone $smartphone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSmartphoneRequest $request, Smartphone $smartphone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Smartphone $smartphone)
    {
        //
    }

    public function calculateSAW()
    {
        // Mendapatkan data smartphone
        $smartphones = Smartphone::all();

        // Mendapatkan data bobot dari tabel weights
        $weights = Weight::all();

        // Menginisialisasi variabel untuk menyimpan hasil perhitungan SAW
        $rankings = [];

        // Menghitung nilai normalisasi bobot
        $normalizationFactors = $this->calculateNormalizationFactors($weights);
        // dd($normalizationFactors);

        // Melakukan perhitungan SAW untuk setiap smartphone
        foreach ($smartphones as $smartphone) {
            $score = 0;

            // Menghitung nilai SAW untuk setiap kriteria
            foreach ($weights as $weight) {
                $criteriaName = $weight->kriteria;
                $criteriaValue = $smartphone->$criteriaName;
                // dd($criteriaValue);

                // Mengecek apakah kriteria merupakan kriteria cost atau benefit
                $isCost = ($weight->kriteria === 'harga');


                // Menghitung nilai SAW
                $weightedScore = $criteriaValue / ($isCost ? $normalizationFactors[$criteriaName]['min'] : $normalizationFactors[$criteriaName]['max']);
                // $weightedScore *= $weight->normalisasi_bobot;

                // Menambahkan nilai SAW ke skor total
                $score += $weightedScore;
            }

            // Menyimpan hasil perhitungan SAW untuk setiap smartphone
            $smartphone->score = $score;
            $rankings[] = $smartphone;
            // dd($rankings);
    }

    // Mengurutkan hasil perhitungan SAW dari skor terbesar ke terkecil
    usort($rankings, function($a, $b) {
        return $b->score <=> $a->score;
    });

    // Menampilkan view dengan data hasil perhitungan SAW
    return view('saw', compact('rankings'));
    }

    private function calculateNormalizationFactors($weights)
    {
        $factors = [];
        $smartphones = Smartphone::all();

        // Inisialisasi faktor min dan max dengan nilai awal
        foreach ($weights as $weight) {
            $criteriaName = $weight->kriteria;
            $factors[$criteriaName] = [
                'min' => PHP_INT_MAX,
                'max' => 0
            ];
        }

        // Mencari faktor min dan max untuk setiap kriteria
        foreach ($smartphones as $smartphone) {
            foreach ($weights as $weight) {
                $criteriaName = $weight->kriteria;
                $criteriaValue = $smartphone->$criteriaName;

                if ($criteriaValue < $factors[$criteriaName]['min']) {
                    $factors[$criteriaName]['min'] = $criteriaValue;
                }

                if ($criteriaValue > $factors[$criteriaName]['max']) {
                    $factors[$criteriaName]['max'] = $criteriaValue;
                }
            }
        }

        return $factors;
    }

    public function calculateRanking(Request $request)
    {
        // Ambil data smartphone dari tabel 'smartphones'
        $smartphones = DB::table('smartphones')->get();

        // Menghitung nilai normalisasi untuk setiap kriteria pada metode Profile Matching
        $profileMatchingNormalizedValues = [];
        $standards = DB::table('standards')->get();

        foreach ($smartphones as $smartphone) {
            $normalizedValues = [];
            $normalizedValues['alternatif'] = $smartphone->nama;

            foreach ($standards as $standard) {
                $kriteria = $standard->kriteria;
                $nilai = $standard->nilai;

                // Mengambil nilai sesuai kriteria dari smartphone saat ini
                $value = $smartphone->$kriteria;
                // dd($value);

                // Menentukan tipe normalisasi (cost atau benefit)
                $tipe = $kriteria === 'harga' ? 'cost' : 'benefit';

                // Menghitung nilai normalisasi
                if ($tipe === 'cost') {
                    // Untuk kriteria harga, normalisasi adalah dengan membagi nilai terbesar dengan nilai saat ini
                    $maxValue = DB::table('smartphones')->min($kriteria);
                    $normalizedValue = round(($maxValue / $value) * 100, 0);
                } else {
                    // Untuk kriteria selain harga, normalisasi adalah dengan membagi nilai saat ini dengan nilai terbesar
                    $maxValue = DB::table('smartphones')->max($kriteria);
                    $normalizedValue = round(($value / $maxValue) * 100, 0);
                }

                // Menyimpan nilai normalisasi pada array
                $normalizedValues[$kriteria] = $normalizedValue;
            }

            // Menghitung nilai GAP pada metode Profile Matching
            $profileMatchingValues = [];
            foreach ($standards as $standard) {
                $kriteria = $standard->kriteria;
                $nilai = $standard->nilai;

                // Mengambil nilai normalisasi sesuai kriteria pada smartphone saat ini
                $normalizedValue = $normalizedValues[$kriteria];

                // Menghitung nilai GAP
                $gap = round($normalizedValue - $nilai, 2);

                // Mengambil nilai pemetaan GAP sesuai dengan nilai GAP
                $pemetaanGap = DB::table('pemetaan_gap')->where('gap', $gap)->first();
                $nilaiPemetaan = $pemetaanGap ? $pemetaanGap->nilai : null;

                // Menyimpan nilai GAP pada array
                $profileMatchingValues[$kriteria] = $gap;
                $profileMatchingValues['nilai_pemetaan_'.$kriteria] = $nilaiPemetaan;
            }

            // Menambahkan nilai GAP pada array nilai normalisasi
            $profileMatchingNormalizedValues[] = array_merge($normalizedValues, $profileMatchingValues);
        }

        // Menghitung nilai normalisasi bobot pada metode SAW
        // $totalWeight = DB::table('weights')->sum('bobot');
        $totalWeight = DB::table('weights')->whereBetween('id', [1, 8])->sum('bobot');
        // dd($totalWeight);
        $sawNormalizedWeights = [];
        $weights = DB::table('weights')->get();

        foreach ($weights as $weight) {
            $kriteria = $weight->kriteria;
            $bobot = $weight->bobot;

            // Menghitung nilai normalisasi bobot
            $normalizedWeight = round(($bobot / $totalWeight), 3);

            // Menyimpan nilai normalisasi bobot pada array
            $sawNormalizedWeights[$kriteria] = $normalizedWeight;
        }

        // Menghitung nilai normalisasi untuk setiap kriteria pada metode SAW
        $sawNormalizedValues = [];
        foreach ($smartphones as $smartphone) {
            $normalizedValues = [];
            $normalizedValues['alternatif'] = $smartphone->nama;

            foreach ($weights as $weight) {
                $kriteria = $weight->kriteria;

                // Mengambil nilai sesuai kriteria dari hasil profile matching pada smartphone saat ini
                $value = $profileMatchingNormalizedValues[$smartphone->id - 1][$kriteria];

                // Menghitung nilai maksimum dari nilai_pemetaan sesuai kriteria
                $maxValue = max(array_column($profileMatchingNormalizedValues, 'nilai_pemetaan_'.$kriteria));
                $maxValues[$kriteria] = $maxValue;

                // Menghitung nilai normalisasi
                $normalizedValue = round(($profileMatchingNormalizedValues[$smartphone->id - 1]['nilai_pemetaan_'.$kriteria] / $maxValues[$kriteria]), 2);
                // Menyimpan nilai normalisasi pada array
                $normalizedValues[$kriteria] = $normalizedValue;
            }

            // Menambahkan nilai normalisasi pada array nilai normalisasi
            $sawNormalizedValues[] = $normalizedValues;
        }

        // Menghitung nilai total pada metode SAW
        $sawTotalValues = [];
        foreach ($smartphones as $smartphone) {
            $totalValue = 0;

            foreach ($weights as $weight) {
                $kriteria = $weight->kriteria;

                // Mengambil nilai normalisasi sesuai kriteria pada smartphone saat ini
                $normalizedValue = $sawNormalizedValues[$smartphone->id - 1][$kriteria];

                // Mengambil nilai normalisasi bobot sesuai kriteria
                $normalizedWeight = $sawNormalizedWeights[$kriteria];

                // Menghitung nilai total
                $totalValue += $normalizedValue * $normalizedWeight;
                // dd($totalValue);
            }

            // Menambahkan nilai total pada array
            $sawTotalValues[] = $totalValue;
        }
        // dd($sawTotalValues);

        // Convert $smartphones object to array
        $smartphones = json_decode(json_encode($smartphones), true);
        // dd($smartphones);

        // Mengurutkan hasil SAW berdasarkan nilai total
        array_multisort($sawTotalValues, SORT_DESC, $smartphones);

        // Memberikan ranking pada hasil SAW
        $sawResults = [];
        // dd($sawResults);
        foreach ($smartphones as $index => $smartphone) {
            $sawResults[] = [
                'alternatif' => $smartphone['nama'],
                'Nilai Total' => $sawTotalValues[$index],
                'Ranking' => $index + 1,
            ];
        }

        // Mengembalikan hasil Profile Matching dan SAW
        return view('hasil', compact('profileMatchingNormalizedValues', 'sawResults'));
    }
}
