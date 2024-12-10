@extends('adminlte::page')

@section('title', 'Form Pelanggaran')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Pelanggaran</h2>

    <form action="{{ route('pelanggaran.store') }}" method="POST" class="shadow p-4 rounded" style="max-width: 600px; margin: auto; background: #f9f9f9;">
        @csrf  <!-- CSRF Token -->
        <!-- Angkatan Textbox -->
        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan:</label>
            <input type="text" name="angkatan" id="angkatan" class="form-control">
        </div>

        <!-- Prodi Textbox -->
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi:</label>
            <input type="text" name="prodi" id="prodi" class="form-control">
        </div>

        <!-- NIM Textbox -->
        <div class="mb-3">
            <label for="nim" class="form-label">NIM:</label>
            <input type="text" name="nim" id="nim" class="form-control">
        </div>

        <!-- Nama Textbox -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <input type="text" name="nama" id="nama" class="form-control">
        </div>

        <!-- Poin Pelanggaran Dropdown -->
        <div class="mb-3">
            <label for="poin_pelanggaran" class="form-label">Jenis Pelanggaran:</label>
            <select name="list_pelanggaran_id" id="poin_pelanggaran" class="form-select">
                <option value="">Pilih Jenis Pelanggaran</option>
                @foreach ($poinPelanggaran as $poin)
                    <option value="{{ $poin->id }}" {{ old('list_pelanggaran_id') == $poin->id ? 'selected' : '' }}>
                        {{ $poin->nama_pelanggaran }} ({{ $poin->poin }} Poin)
                    </option>
                @endforeach
            </select>
            @if ($errors->has('poin_pelanggaran'))
                <div class="text-danger">{{ $errors->first('poin_pelanggaran') }}</div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>

@endsection

@section('css')
    <style>
        /* Membuat dropdown agar teks panjang dibungkus (wrap) dalam beberapa baris */
        #poin_pelanggaran {
            width: 100%;
            max-width: 100%; /* memastikan dropdown memanjang sesuai lebar kontainer */
        }

        #poin_pelanggaran option {
            white-space: normal; /* Membolehkan teks membungkus ke baris baru */
            word-wrap: break-word; /* Memungkinkan pemenggalan kata jika terlalu panjang */
            word-break: break-word; /* Untuk memastikan kata panjang terpecah jika perlu */
        }

    </style>
@endsection
