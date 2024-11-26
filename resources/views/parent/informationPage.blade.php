@extends('layouts.app')

@section('title', 'Profil Mahasiswa')

@section('content')
<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4" style="border-bottom: 2px solid #ddd; padding-bottom: 10px; color: #333;">
                Data Mahasiswa
            </h3>
            <div class="row">
                <!-- Kolom Informasi -->
                <div class="col-md-6">
                    <div  class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Nama:</strong> 
                        <span class=" p-2 rounded">{{ $student['name'] }}</span>
                    </div>
                    <div  class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Angkatan:</strong> 
                        <span class="p-2 rounded">{{ $student['batch'] }}</span>
                    </div>
                    <div  class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>NIM:</strong> 
                        <span class="p-2 rounded">{{ $student['nim'] }}</span>
                    </div>
                    <div  class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Username:</strong> 
                        <span class="p-2 rounded">{{ $student['username'] }}</span>
                    </div>
                    <div  class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Email Akademik:</strong> 
                        <span class="p-2 rounded">{{ $student['email'] }}</span>
                    </div>
                    <div  class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Kelas:</strong> 
                        <span class="p-2 rounded">{{ $student['class'] }}</span>
                    </div>
                    <div  class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Program Studi:</strong> 
                        <span class="p-2 rounded">{{ $student['program'] }}</span>
                    </div>
                    <div  class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                        <strong>Wali Kelas:</strong> 
                        <span class="p-2 rounded">{{ $student['mentor'] }}</span>
                    </div>
                </div>
                <!-- Kolom Foto Profil -->
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="bg-secondary text-white d-flex justify-content-center align-items-center rounded" 
                        style="width: 200px; height: 200px; font-size: 14px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        Foto Profil Mahasiswa
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
