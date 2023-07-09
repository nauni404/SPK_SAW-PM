@extends('layouts.main')
@section('content')
    <div class="container">
        <h1 class="mt-5 mb-3">Sistem Pendukung Keputusan Pemilihan Smartphone</h1>
        <p class="lead">Selamat datang di website SPK Pemilihan Smartphone menggunakan metode SAW dan Profile Matching.
        </p>
        <p class="mb-4">Silakan pilih metode yang ingin Anda gunakan:</p>
        <a href="{{ route('calculate') }}" class="btn btn-primary mb-3">Hitung Hasil</a>
        <a href="{{ route('calculateSAW') }}" class="btn btn-primary mb-3">Hitung SAW</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama Smartphone</th>
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
                @foreach ($smartphones as $smartphone)
                    <tr>
                        <td>{{ $smartphone->nama }}</td>
                        <td>{{ $smartphone->harga }}</td>
                        <td>{{ $smartphone->chipset }}</td>
                        <td>{{ $smartphone->GPU }}</td>
                        <td>{{ $smartphone->ram }}</td>
                        <td>{{ $smartphone->rom }}</td>
                        <td>{{ $smartphone->kamera }}</td>
                        <td>{{ $smartphone->kapasitas_baterai }}</td>
                        <td>{{ $smartphone->tahun_rilis }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
