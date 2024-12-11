@extends('adminlte::page')

@section('title', 'Form Pelanggaran')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Form Pelanggaran</h2>

    <!-- Display Success -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Display Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pelanggaran.store') }}" method="POST" class="p-4 rounded" style="max-width: 600px; margin: auto; box-shadow: 0px 5px 8px rgba(90, 173, 194, 0.54)">
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
            <button type="submit" class="btn text-bold mt-5" style="background-color: #5AADC2; padding: 5px 22px; color: #ddd">Kirim</button>
        </div>
    </form>
</div>

@endsection

@section('css')
    <!-- CSS for Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
        /* Membuat dropdown agar teks panjang dibungkus (wrap) dalam beberapa baris */
        #poin_pelanggaran {
            width: 100%;
            max-width: 100%;
        }

        #poin_pelanggaran option {
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
        }
        <style>
    /* Ubah tinggi dropdown */
    .select2-container--default .select2-selection--single {
        height: 40px; /* Tinggi dropdown */
        line-height: 40px; /* Vertical alignment */
    }

    /* Ubah warna opsi saat kursor masuk */
    .select2-results__option--highlighted {
        background-color: #5AADC2 !important; /* Warna background */
        color: #fff !important; /* Warna teks */
    }

    /* Ubah tinggi opsi di dalam dropdown */
    .select2-results__option {
        padding: 10px; /* Jarak dalam opsi */
    }
</style>

    </style>
@endsection

@section('js')
    <!-- JS for Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#poin_pelanggaran').select2({
                placeholder: 'Pilih Jenis Pelanggaran',
                allowClear: true,
                width: '100%'  // Menyesuaikan lebar dropdown dengan container
            });
        });
    </script>
@endsection

