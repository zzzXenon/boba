@extends('layouts.app')

@section('title', 'Form Pelanggaran')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Pelanggaran</h2>
    <form action="{{ route('pelanggaran.store') }}" method="POST" class="shadow p-4 rounded" style="max-width: 600px; margin: auto; background: #f9f9f9;">
        @csrf

        <!-- Angkatan Dropdown -->
        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan:</label>
            <select name="angkatan" id="angkatan" class="form-select">
                <option value="">Pilih Angkatan</option>
                @foreach ($angkatans as $angkatan)
                    <option value="{{ $angkatan }}">{{ $angkatan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Prodi Dropdown -->
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi:</label>
            <select name="prodi" id="prodi" class="form-select">
                <option value="">Pilih Prodi</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi }}">{{ $prodi }}</option>
                @endforeach
            </select>
        </div>

        <!-- NIM Dropdown -->
        <div class="mb-3">
            <label for="nim" class="form-label">NIM:</label>
            <select name="nim" id="nim" class="form-select">
                <option value="">Pilih NIM</option>
                @foreach ($nims as $nim)
                    <option value="{{ $nim }}">{{ $nim }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nama Dropdown -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <select name="nama" id="nama" class="form-select">
                <option value="">Pilih Nama</option>
                @foreach ($names as $name)
                    <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Detail Pelanggaran -->
        <div class="mb-3">
            <label for="detail_pelanggaran" class="form-label">Detail Pelanggaran:</label>
            <textarea name="detail_pelanggaran" id="detail_pelanggaran" rows="4" class="form-control"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>
@endsection
