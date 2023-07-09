@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Hasil Perhitungan Profile Matching</h2>
        <h3>Smartphone: {{ $smartphone->nama }}</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Standar Nilai</th>
                    <th>Nilai Atribut</th>
                    <th>Skor Kriteria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($standards as $standard)
                    <tr>
                        <td>{{ $standard->kriteria }}</td>
                        <td>{{ $standard->nilai }}</td>
                        <td>{{ $smartphone->{$standard->kriteria} }}</td>
                        <td>{{ $criteriaMatches[$standard->kriteria] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Kesesuaian</th>
                    <th>{{ $totalMatch }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
