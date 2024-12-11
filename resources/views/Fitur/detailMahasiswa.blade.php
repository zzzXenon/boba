@extends('adminlte::page')

@section('title', 'Detail Pelanggaran')

@section('content')
<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4" style="border-bottom: 2px solid #ddd; padding-bottom: 10px; color: #333;">
                Detail Pelanggaran
            </h3>

            @forelse ($pelanggaranList as $pelanggaran)
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                            <strong>Pelanggaran:</strong>
                            <span class="p-2 rounded">{{ $pelanggaran->listPelanggaran->nama_pelanggaran }}</span>
                        </div>
                        <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                            <strong>Poin:</strong>
                            <span class="p-2 rounded">{{ $pelanggaran->listPelanggaran->poin }}</span>
                        </div>
                        <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                            <strong>Status Pelanggaran:</strong>
                            <span class="p-2 rounded">{{ $pelanggaran->status }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">Mahasiswa tidak memiliki pelanggaran.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
