@extends('adminlte::page')

@section('title', 'Profil Mahasiswa')

@section('content')
<div class="container">
    <h1>Welcome to Dashboard Orang Tua</h1>
</div>

<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4" style="border-bottom: 2px solid #ddd; padding-bottom: 10px; color: #333;">
                Data Mahasiswa
            </h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Nama:</strong> 
                        <span class="p-2 rounded">{{ $user->nama }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Angkatan:</strong> 
                        <span class="p-2 rounded">{{ $user->angkatan }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>NIM:</strong> 
                        <span class="p-2 rounded">{{ $user->nim }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Username:</strong> 
                        <span class="p-2 rounded">{{ $user->username }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Email Akademik:</strong> 
                        <span class="p-2 rounded">{{ $user->email }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Kelas:</strong> 
                        <span class="p-2 rounded">{{ $user->kelas }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Program Studi:</strong> 
                        <span class="p-2 rounded">{{ $user->prodi }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Wali Kelas:</strong> 
                        <span class="p-2 rounded">{{ $user->wali }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
