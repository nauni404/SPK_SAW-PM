@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Hasil Perhitungan SAW</h2>
        <h3>Smartphone: {{ $smartphone->nama }}</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Bobot</th>
                    <th>Nilai Atribut</th>
                    <th>Skor Kriteria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($weights as $weight)
                    <tr>
                        <td>{{ $weight->kriteria }}</td>
                        <td>{{ $weight->bobot }}</td>
                        <td>{{ $smartphone->{$weight->kriteria} }}</td>
                        <td>{{ $criteriaScores[$weight->kriteria] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Skor</th>
                    <th>{{ $totalScore }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
