@extends('adminlte::page')

@section('title', 'List Pelanggaran')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush
@section('content')
<h3 class="title text-center mb-4 pt-5 pb-1" style="color: #333;">Data Pelanggaran</h3>

<div class="container mt-2">
    <div class="card-body p-4">
        <table class="table text-center" style="border-collapse: separate; border-spacing: 0; width: 100%;">
            <thead>
                <tr style="background-color: #5AADC2; color: #fff; border-radius: 10px; box-shadow: 0px 4px 4px rgba(90, 173, 194, 0.16)">
                    <th style="border-top-left-radius: 10px; padding: 15px 20px; max-width: 150px; word-wrap: break-word;">Nama</th>
                    <th style="padding: 15px 20px; max-width: 100px; word-wrap: break-word;">NIM</th>
                    <th style="padding: 15px 20px; max-width: 200px; word-wrap: break-word;">Pelanggaran</th>
                    <th style="padding: 15px 20px; max-width: 80px; word-wrap: break-word;">Poin</th>
                    <th style="border-top-right-radius: 10px; padding: 15px 20px; max-width: 150px; word-wrap: break-word;">Status Pelanggaran</th>
                </tr>
            </thead>
            <tbody style="background-color: #E7FAFF; box-shadow: 0px 4px 6px rgba(90, 173, 194, 0.54); border-radius: 30px;">
                @foreach ($pelanggaran as $item)
                <tr style="background-color: #E7FAFF; border-bottom: 4px solid #fff; border-radius: 30px;">
                    <td style="padding: 15px;">{{ $item->user->nama }}</td>
                    <td style="padding: 15px; max-width: 100px; word-wrap: break-word;">{{ $item->user->nim }}</td>
                    <td style="padding: 15px; max-width: 200px; word-wrap: break-word;">{{ $item->listPelanggaran->nama_pelanggaran }}</td>
                    <td style="padding: 15px; max-width: 80px; word-wrap: break-word;">{{ $item->listPelanggaran->poin }}</td>
                    <td style="padding: 15px; max-width: 150px; word-wrap: break-word;">
                        <span>{{ $item->status }}</span>
                        <br>
                        <a href="{{ route('pelanggaran.showComments', $item->id) }}" class="btn btn-sm mt-2" style="background-color: #5AADC2; color: white;">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection