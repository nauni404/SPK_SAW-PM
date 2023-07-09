@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Hasil</h2>
        <br>
        <h3>Metode Profile Matching</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Harga</th>
                    <th>Chipset</th>
                    <th>GPU</th>
                    <th>RAM</th>
                    <th>ROM</th>
                    <th>Kamera</th>
                    <th>Kapasitas Baterai</th>
                    <th>Tahun Rilis</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($profileMatchingNormalizedValues); --}}
                @foreach ($profileMatchingNormalizedValues as $result)
                    <tr>
                        <td>{{ $result['alternatif'] }}</td>
                        <td>{{ $result['nilai_pemetaan_harga'] }}</td>
                        <td>{{ $result['nilai_pemetaan_chipset'] }}</td>
                        <td>{{ $result['nilai_pemetaan_GPU'] }}</td>
                        <td>{{ $result['nilai_pemetaan_ram'] }}</td>
                        <td>{{ $result['nilai_pemetaan_rom'] }}</td>
                        <td>{{ $result['nilai_pemetaan_kamera'] ?? 0 }}</td>
                        <td>{{ $result['nilai_pemetaan_kapasitas_baterai'] ?? 0 }}</td>
                        <td>{{ $result['nilai_pemetaan_tahun_realis'] ?? 0 }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <h3>Metode SAW</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai Total</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($sawResults); --}}
                @foreach ($sawResults as $result)
                    <tr>
                        <td>{{ $result['alternatif'] }}</td>
                        <td>{{ $result['Nilai Total'] }}</td>
                        <td>{{ $result['Ranking'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
