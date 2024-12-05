@extends('adminlte::page') 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Pelanggaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #5a82c1;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn-detail {
            background-color: #5a82c1;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-detail:hover {
            background-color: #476a9e;
        }
    </style>
</head>
<body>
    <h1>Info Pelanggaran Mahasiswa</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Prodi</th>
                <th>Poin</th>
                <th>Pelanggaran</th>
            </tr>
        </thead>
        <tbody>
            {{-- Loop through pelanggaran data --}}
            @foreach ($pelanggarans as $pelanggaran)
                <tr>
                    <td>{{ $pelanggaran->nama_mahasiswa }}</td>
                    <td>{{ $pelanggaran->nim }}</td>
                    <td>{{ $pelanggaran->prodi }}</td>
                    <td>{{ $pelanggaran->poin }}</td>
                    <td>
                        {{ $pelanggaran->deskripsi }}
                        <a href="{{ route('pelanggaran.detail', ['id' => $pelanggaran->id]) }}" class="btn-detail">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
