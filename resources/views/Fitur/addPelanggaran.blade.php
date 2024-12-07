@extends('adminlte::page')

@section('title', 'Form Pelanggaran')
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Pelanggaran</h2>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pelanggaran.store') }}" method="POST" class="shadow p-4 rounded" style="max-width: 600px; margin: auto; background: #f9f9f9;">
        @csrf

        <!-- Angkatan Dropdown -->
        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan:</label>
            <select name="angkatan" id="angkatan" class="form-select">
                <option value="">Pilih Angkatan</option>
                @foreach ($angkatans as $angkatan)
                    <option value="{{ $angkatan->angkatan }}" {{ old('angkatan') == $angkatan->angkatan ? 'selected' : '' }}>
                        {{ $angkatan->angkatan }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('angkatan'))
                <div class="text-danger">{{ $errors->first('angkatan') }}</div>
            @endif
        </div>

        <!-- Prodi Dropdown -->
        <div class="mb-3">
            <label for="prodi" class="form-label">Prodi:</label>
            <select name="prodi" id="prodi" class="form-select">
                <option value="">Pilih Prodi</option>
                <!-- Prodi will be updated using AJAX -->
            </select>
            @if ($errors->has('prodi'))
                <div class="text-danger">{{ $errors->first('prodi') }}</div>
            @endif
        </div>

        <!-- NIM Dropdown -->
        <div class="mb-3">
            <label for="nim" class="form-label">NIM:</label>
            <select name="nim" id="nim" class="form-select">
                <option value="">Pilih NIM</option>
                <!-- NIM will be updated using AJAX -->
            </select>
            @if ($errors->has('nim'))
                <div class="text-danger">{{ $errors->first('nim') }}</div>
            @endif
        </div>

        <!-- Nama Dropdown -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <select name="nama" id="nama" class="form-select">
                <option value="">Pilih Nama</option>
                <!-- Nama will be updated using AJAX -->
            </select>
            @if ($errors->has('nama'))
                <div class="text-danger">{{ $errors->first('nama') }}</div>
            @endif
        </div>

        <!-- Poin Pelanggaran Dropdown -->
        <div class="mb-3">
            <label for="poin_pelanggaran" class="form-label">Poin Pelanggaran:</label>
            <select name="poin_pelanggaran" id="poin_pelanggaran" class="form-select">
                <option value="">Pilih Poin Pelanggaran</option>
                @foreach ($poinPelanggaran as $poin)
                    <option value="{{ $poin->id }}" {{ old('poin_pelanggaran') == $poin->id ? 'selected' : '' }}>
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Update Prodi based on Angkatan selection
    $('#angkatan').change(function() {
        var angkatan = $(this).val();
        if (angkatan) {
            $.ajax({
                url: '/get-prodi/' + angkatan,
                type: 'GET',
                success: function(data) {
                    $('#prodi').empty();
                    $('#prodi').append('<option value="">Pilih Prodi</option>');
                    $.each(data, function(key, value) {
                        $('#prodi').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
        }
    });

    // Update NIM and Nama based on Prodi selection
    $('#prodi').change(function() {
        var prodi = $(this).val();
        if (prodi) {
            $.ajax({
                url: '/get-nim-nama/' + prodi,
                type: 'GET',
                success: function(data) {
                    $('#nim').empty();
                    $('#nim').append('<option value="">Pilih NIM</option>');
                    $('#nama').empty();
                    $('#nama').append('<option value="">Pilih Nama</option>');
                    $.each(data, function(index, value) {
                        $('#nim').append('<option value="'+ value.nim +'">'+ value.nim +'</option>');
                        $('#nama').append('<option value="'+ value.nama +'">'+ value.nama +'</option>');
                    });
                }
            });
        }
    });
</script>
@endsection
