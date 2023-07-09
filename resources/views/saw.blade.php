@extends('layouts.main')
@section('content')
    <div class="container">
        <h1 class="mt-5 mb-3">Metode SAW - Peringkat Smartphone</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Nama Smartphone</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankings as $ranking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ranking->nama }}</td>
                        <td>{{ $ranking->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
