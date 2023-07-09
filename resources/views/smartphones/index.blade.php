@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Daftar Smartphone</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Chipset</th>
                    <th>GPU</th>
                    <th>Ram</th>
                    <th>Rom</th>
                    <th>Kamera</th>
                    <th>Kapasitas Baterai</th>
                    <th>Tahun Rilis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($smartphones as $smartphone)
                    <tr>
                        <td>{{ $smartphone->id }}</td>
                        <td>{{ $smartphone->nama }}</td>
                        <td>{{ $smartphone->harga }}</td>
                        <td>{{ $smartphone->chipset }}</td>
                        <td>{{ $smartphone->GPU }}</td>
                        <td>{{ $smartphone->ram }}</td>
                        <td>{{ $smartphone->rom }}</td>
                        <td>{{ $smartphone->kamera }}</td>
                        <td>{{ $smartphone->kapasitas_baterai }}</td>
                        <td>{{ $smartphone->tahun_rilis }}</td>
                        <td>
                            <a href="{{ route('smartphones.saw', ['id' => $smartphone->id]) }}"
                                class="btn btn-primary">Hitung SAW</a>
                            <a href="{{ route('smartphones.profile_matching', ['id' => $smartphone->id]) }}"
                                class="btn btn-success">Hitung Profile Matching</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
