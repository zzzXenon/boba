@extends('adminlte::page') 

@section('title', 'List Pelanggaran')

@section('content')
<div class="container">
    <h1>Welcome to Dashboard Admin</h1>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif


<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4" style="border-bottom: 2px solid #ddd; padding-bottom: 10px; color: #333;">
                Data Pelanggaran
            </h3>
            <div class="row">
                @foreach ($pelanggaran as $item)
                    <div class="col-md-6">
                        <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                            <strong>Nama Mahasiswa:</strong>
                            <span class="p-2 rounded">{{ $item->user->nama }}</span>
                        </div>
                        <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                            <strong>NIM:</strong>
                            <span class="p-2 rounded">{{ $item->user->nim }}</span>
                        </div>
                        <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                            <strong>Prodi:</strong>
                            <span class="p-2 rounded">{{ $item->user->prodi }}</span>
                        </div>
                        <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                            <strong>Poin:</strong>
                            <span class="p-2 rounded">{{ $item->listPelanggaran->poin }}</span>
                        </div>
                        <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                            <strong>Deskripsi Pelanggaran:</strong>
                            <span class="p-2 rounded">{{ $item->listPelanggaran->nama_pelanggaran }}</span>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('pelanggaran.showComments', $item->id) }}" class="btn btn-info">
                                Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection