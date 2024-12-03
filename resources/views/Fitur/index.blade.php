@extends('layouts.app')

@section('title', 'Daftar Pelanggaran')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Pelanggaran</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Angkatan</th>
                <th>Prodi</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Detail Pelanggaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggarans as $pelanggaran)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pelanggaran->angkatan }}</td>
                <td>{{ $pelanggaran->prodi }}</td>
                <td>{{ $pelanggaran->nim }}</td>
                <td>{{ $pelanggaran->nama }}</td>
                <td>{{ $pelanggaran->detail_pelanggaran }}</td>
                <td>
                    <!-- Add buttons or links for actions like edit, delete -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
