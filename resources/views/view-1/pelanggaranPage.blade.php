@extends('layouts.app')

@section('title', 'Tabel Pelanggaran')

@section('content')
<div class="container mt-5">
        <div class="card-body">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Pelanggaran</th>
                        <th>Poin</th>
                        <th>Status Pelanggaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mencuri Laptop yang bukan miliknya</td>
                        <td>75</td>
                        <td>
                            <span class="text-warning">kasus sedang diproses oleh kemahasiswaan</span> <br>
                            <button class="btn btn-primary btn-sm mt-2">Lihat</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Bermesraan dengan lawan jenis</td>
                        <td>50</td>
                        <td>
                            <span class="text-success">Kasus Selesai</span> <br>
                            <button class="btn btn-primary btn-sm mt-2">Lihat</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
@endsection
