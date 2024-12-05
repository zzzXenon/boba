@extends('adminlte::page')

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
                <!-- Opsi NIM akan diupdate secara dinamis -->
            </select>
        </div>

        <!-- Nama Dropdown -->
        <div class="mb-3">
            <label for="nama" class="form-label">Nama:</label>
            <select name="nama" id="nama" class="form-select">
                <option value="">Pilih Nama</option>
                <!-- Opsi Nama akan diupdate secara dinamis -->
            </select>
        </div>

        <!-- Poin Pelanggaran Dropdown (dari tabel poin_pelanggaran) -->
        <div class="mb-3">
            <label for="poin_pelanggaran" class="form-label">Poin Pelanggaran:</label>
            <select name="poin_pelanggaran" id="poin_pelanggaran" class="form-select">
                <option value="">Pilih Poin Pelanggaran</option>
                @foreach ($poinPelanggaran as $poin)
                    <option value="{{ $poin->id }}">{{ $poin->nama_pelanggaran }} ({{ $poin->poin }} Poin)</option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Ketika dropdown angkatan atau prodi berubah
    document.getElementById('angkatan').addEventListener('change', updateMahasiswaOptions);
    document.getElementById('prodi').addEventListener('change', updateMahasiswaOptions);

    // Ketika dropdown nim atau nama berubah
    document.getElementById('nim').addEventListener('change', updateNameFromNim);
    document.getElementById('nama').addEventListener('change', updateNimFromName);

    let mahasiswaData = [];  // Menyimpan data mahasiswa yang sudah diambil

    function updateMahasiswaOptions() {
        // Ambil nilai dari dropdown angkatan dan prodi
        const angkatan = document.getElementById('angkatan').value;
        const prodi = document.getElementById('prodi').value;

        // Cek apakah kedua dropdown angkatan dan prodi sudah dipilih
        if (angkatan && prodi) {
            // Kirim request AJAX untuk mendapatkan data mahasiswa berdasarkan angkatan dan prodi
            fetch(`/pelanggaran/get-mahasiswa?angkatan=${angkatan}&prodi=${prodi}`)
                .then(response => response.json())
                .then(data => {
                    mahasiswaData = data;  // Simpan data mahasiswa yang diterima
                    // Update opsi di dropdown NIM dan Nama
                    updateDropdown('nim', data, 'nim');
                    updateDropdown('nama', data, 'nama');
                })
                .catch(error => console.log('Error:', error));
        }
    }

    // Fungsi untuk memperbarui dropdown berdasarkan data yang diterima
    function updateDropdown(elementId, data, valueKey) {
        const dropdown = document.getElementById(elementId);
        dropdown.innerHTML = `<option value="">Pilih ${elementId.charAt(0).toUpperCase() + elementId.slice(1)}</option>`;  // Reset dropdown
        
        data.forEach(mahasiswa => {
            const option = document.createElement('option');
            option.value = mahasiswa[valueKey];
            option.textContent = mahasiswa.nama;
            dropdown.appendChild(option);
        });
    }

    // Fungsi untuk update nama dari NIM
    function updateNameFromNim() {
        const selectedNim = document.getElementById('nim').value;
        const selectedMahasiswa = mahasiswaData.find(mahasiswa => mahasiswa.nim == selectedNim);
        if (selectedMahasiswa) {
            document.getElementById('nama').value = selectedMahasiswa.nama;
        }
    }

    // Fungsi untuk update NIM dari nama
    function updateNimFromName() {
        const selectedNama = document.getElementById('nama').value;
        const selectedMahasiswa = mahasiswaData.find(mahasiswa => mahasiswa.nama == selectedNama);
        if (selectedMahasiswa) {
            document.getElementById('nim').value = selectedMahasiswa.nim;
        }
    }
</script>
@endsection
