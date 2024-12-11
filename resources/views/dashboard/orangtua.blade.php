@extends('adminlte::page')

@section('title', 'Profil Mahasiswa')

@section('content')
<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
            
            <!-- First Row: Title "Data Mahasiswa" -->
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="title" style="color: #333; border-bottom: 2px solid #ddd; padding-bottom: 10px;">Data Mahasiswa</h3>
                </div>
            </div>
            
            <!-- Second Row: Data - Left column for photo, right column for details -->
            <div class="row">
                
                <!-- Second Column: Data -->
                <div class="col-md-8">
                    <div class="mb-3" style="border-radius: 7px; background-color: #BBE3ED;">
                        <strong>Nama:</strong> 
                        <span class="p-2 rounded">{{ $user->nama }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #BBE3ED;">
                        <strong>Angkatan:</strong> 
                        <span class="p-2 rounded">{{ $user->angkatan }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #BBE3ED;">
                        <strong>NIM:</strong> 
                        <span class="p-2 rounded">{{ $user->nim }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #BBE3ED;">
                        <strong>Username:</strong> 
                        <span class="p-2 rounded">{{ $user->username }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #BBE3ED;">
                        <strong>Email Akademik:</strong> 
                        <span class="p-2 rounded">{{ $user->email }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #BBE3ED;">
                        <strong>Kelas:</strong> 
                        <span class="p-2 rounded">{{ $user->kelas }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #BBE3ED;">
                        <strong>Program Studi:</strong> 
                        <span class="p-2 rounded">{{ $user->prodi }}</span>
                    </div>
                    <div class="mb-3" style="border-radius: 7px; background-color: #BBE3ED;">
                        <strong>Wali Kelas:</strong> 
                        <span class="p-2 rounded">{{ $user->wali }}</span>
                    </div>
                </div>

                <!-- First Column: Photo -->
                <div class="col-md-4 text-center">
                    <img src="{{ asset($user->image ? $user->image : 'images/default-image.jpg') }}" 
                         alt="Foto Mahasiswa" 
                         class="img-fluid" 
                         style="max-width: 300px; border: 3px solid #ddd; background-color: #fff; border-radius: 17px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
