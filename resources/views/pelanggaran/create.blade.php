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

    // Fungsi untuk mengupdate dropdown berdasarkan data yang diterima
    function updateDropdown(dropdownId, data, key) {
        const dropdown = document.getElementById(dropdownId);
        // Kosongkan semua opsi yang ada sebelumnya
        dropdown.innerHTML = `<option value="">Pilih ${dropdownId.charAt(0).toUpperCase() + dropdownId.slice(1)}</option>`;

        // Tambahkan opsi baru
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item[key];
            option.textContent = item[key];  // Tampilkan value pada opsi
            dropdown.appendChild(option);
        });
    }

    // Fungsi untuk update nama berdasarkan NIM
    function updateNameFromNim() {
        const nim = document.getElementById('nim').value;
        
        // Cari nama yang sesuai dengan NIM
        const selectedMahasiswa = mahasiswaData.find(item => item.nim === nim);

        if (selectedMahasiswa) {
            document.getElementById('nama').value = selectedMahasiswa.nama;
        }
    }

    // Fungsi untuk update NIM berdasarkan nama
    function updateNimFromName() {
        const nama = document.getElementById('nama').value;

        // Cari NIM yang sesuai dengan nama
        const selectedMahasiswa = mahasiswaData.find(item => item.nama === nama);

        if (selectedMahasiswa) {
            document.getElementById('nim').value = selectedMahasiswa.nim;
        }
    }
</script>
@endsection

@endsection
