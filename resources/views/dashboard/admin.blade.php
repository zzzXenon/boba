@extends('adminlte::page')

@section('title', 'List Pelanggaran')

@section('content')
<h3 class="title text-center mb-4 pt-5 pb-1" style="color: #333;"> Data Pelanggaran </h3>

<div class="container mt-2">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
        
            <!-- Table for displaying pelanggaran data -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Poin</th>
                        <th style="max-width: 5px; word-wrap: break-word;">Deskripsi Pelanggaran</th> <!-- Set max width -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggaran as $item)
                    <tr>
                        <td>{{ $item->user->nama }}</td>
                        <td>{{ $item->user->nim }}</td>
                        <td>{{ $item->user->prodi }}</td>
                        <td>{{ $item->listPelanggaran->poin }}</td>
                        <td class="text-center"> <!-- Apply text-center class to center the content -->
                            <!-- Displaying Deskripsi Pelanggaran with a button below -->
                            <span>{{ $item->listPelanggaran->nama_pelanggaran }}</span>
                            <br> <!-- Line break to separate description and button -->
                            <a href="{{ route('pelanggaran.showComments', $item->id) }}" class="btn btn-info btn-sm mt-2">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
