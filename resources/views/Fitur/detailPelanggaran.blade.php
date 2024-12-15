@extends('adminlte::page') 

@section('title', 'Detail Pelanggaran')

@section('head')
    <!-- Add external stylesheets here -->
    <style>
        .badge-belum {
            background-color: #dc3545;
            color: #fff;
        }
        .badge-diperiksa {
            background-color: #ffc107;
            color: #000;
        }
        .badge-selesai {
            background-color: #28a745;
            color: #fff;
        }
    </style>

@section('content')
<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="max-width: 150px; word-wrap: break-word;">Nama</th>
                        <th style="max-width: 100px; word-wrap: break-word;">NIM</th>
                        <th style="max-width: 150px; word-wrap: break-word;">Prodi</th>
                        <th style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Deskripsi Pelanggaran</th>
                        <th style="max-width: 80px; word-wrap: break-word;">Poin</th>
<<<<<<< Updated upstream
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
=======
                        <th style="max-width: 30px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Tanggal</th>
                        <th style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Status</th>                     
>>>>>>> Stashed changes
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggaranList as $pelanggaran)
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nama }}</td>
                        <td style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nim }}</td>
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->prodi }}</td>
                        <td style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->listPelanggaran->nama_pelanggaran }}</td>
                        <td style="max-width: 80px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->listPelanggaran->poin }}</td>
                        <td>{{ $pelanggaran->created_at->format('d-m-Y') }}</td>
                        <td>
                            <!-- Status Badge -->
                            @if($pelanggaran->status == 'Sedang diproses')
                                <span class="badge badge-belum">Sedang diproses</span>
                            @elseif($pelanggaran->status == 'Selesai')
                                <span class="badge badge-selesai">Selesai</span>
                            @endif
                        </td>
                        <td>
<<<<<<< Updated upstream
                            <!-- Status Update Form -->
                            <form action="{{ route('pelanggaran.update_status', $pelanggaran->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="Belum Diperiksa" {{ $pelanggaran->status == 'Belum Diperiksa' ? 'selected' : '' }}>Belum Diperiksa</option>
                                    <option value="Diperiksa" {{ $pelanggaran->status == 'Diperiksa' ? 'selected' : '' }}>Diperiksa</option>
                                    <option value="Selesai" {{ $pelanggaran->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </td>
                    @endforeach
                    <tr>
                        
                        
=======
>>>>>>> Stashed changes
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<<<<<<< Updated upstream
<div class="container mt-5">
  <h4>Tanggapan Sebelumnya</h4>
    @foreach ($pelanggaran->comments as $comment)
    <div class="comment mb-3 p-3 border rounded">
        <!-- Display the user's role and name -->
        <p>
            <strong>({{ $comment->user->role }}) {{ $comment->user->nama }}</strong>
            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
        </p>
        <!-- Display the comment text -->
        <p>{{ $comment->comment }}</p>

        <!-- Check and display download link if a file is attached -->
        @if ($comment->file_path)
            <p><strong>File Name:</strong> {{ $comment->file }}</p>
            <p>
                <a href="{{ asset('storage/files/' . $comment->file) }}" class="btn btn-sm btn-success" download>
                    Download Attached File
                </a>
            </p>
        @endif
    </div>
    @endforeach
=======
@if ($pelanggaran->level !== null)
    <!-- Show comments if level is not null -->
    <div class="container mt-5">
        <h4>Tanggapan Sebelumnya</h4>
        @foreach ($pelanggaran->comments as $comment)
            <div class="comment mb-3 p-3 border rounded">
                <p>
                    <strong>({{ $comment->user->role }}) {{ $comment->user->nama }}</strong>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </p>
                <p>{{ $comment->comment }}</p>

                @if ($comment->file_path)
                    <p>
                        <a href="{{ asset('storage/files/' . $comment->file) }}" class="btn btn-sm mt-2" style="background-color: #5AADC2; color: white;" download>
                            Download Attached File
                        </a>
                    </p>
                @endif
            </div>
        @endforeach
    </div>
@else
    <!-- NOTHING -->
@endif
>>>>>>> Stashed changes

@if ($pelanggaran->level === null)
    <!-- NOTHIGN -->
@elseif ($pelanggaran->level !== "Level 5")
    @if ($pelanggaran->level == "Level 2" && Auth::user()->role == 'Kemahasiswaan')
        <form action="{{ route('pelanggaran.storeComment', $pelanggaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="comment" class="form-label">Tanggapan:</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
            </div>

<<<<<<< Updated upstream
  <form action="{{ route('pelanggaran.storeComment', $pelanggaran->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="comment" class="form-label">Tanggapan:</label>
        <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Lampirkan File (Optional):</label>
        <input type="file" name="file" id="file" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Kirim</button>
</form>

=======
            <div class="mb-3">
                <label for="file" class="form-label">Lampirkan File (Opsional):</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>

            <div class="form-group mt-3">
                <!-- Action buttons for level update -->
                <button type="submit" name="action" value="level_3" class="btn btn-primary">Kirim ke Komdis</button>
                <button type="submit" name="action" value="level_4" class="btn btn-success">Kirim ke Rektor</button>
            </div>
        </form>
    @else
        <form action="{{ route('pelanggaran.storeComment', $pelanggaran->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="comment" class="form-label">Tanggapan:</label>
                <textarea name="comment" id="comment" class="form-control" rows="4" required>{{ old('comment') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Lampirkan File (Opsional):</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    @endif
>>>>>>> Stashed changes
</div>
@endif

@endsection
<<<<<<< Updated upstream

@section('script')
<script>
    function toggleStatus(id, currentStatus) {
    let newStatus = '';
    let button = document.querySelector(`#row-${id} .btn-toggle-status`);

    // Update status and button text based on the current status
    if (currentStatus === 'Belum Diperiksa') {
        newStatus = 'Diperiksa';
        button.textContent = 'Selesai';
        button.classList.remove('btn-warning');
        button.classList.add('btn-success');
    } else if (currentStatus === 'Diperiksa') {
        newStatus = 'Selesai';
        button.textContent = 'Belum Diperiksa';
        button.classList.remove('btn-success');
        button.classList.add('btn-danger');
    } else if (currentStatus === 'Selesai') {
        newStatus = 'Belum Diperiksa';
        button.textContent = 'Diperiksa';
        button.classList.remove('btn-danger');
        button.classList.add('btn-warning');
    }

    // Ask for confirmation before proceeding
    if (newStatus) {
        if (confirm(`Apakah Anda yakin ingin mengubah status pelanggaran ini menjadi ${newStatus}?`)) {
            // Submit the form with the new status
            const form = button.closest('form');
            form.querySelector('select[name="status"]').value = newStatus;
            form.submit();
        } else {
            // Revert button text and classes if canceled
            if (newStatus === 'Diperiksa') {
                button.textContent = 'Selesai';
                button.classList.remove('btn-success');
                button.classList.add('btn-warning');
            } else if (newStatus === 'Selesai') {
                button.textContent = 'Belum Diperiksa';
                button.classList.remove('btn-warning');
                button.classList.add('btn-danger');
            } else if (newStatus === 'Belum Diperiksa') {
                button.textContent = 'Diperiksa';
                button.classList.remove('btn-danger');
                button.classList.add('btn-success');
            }
        }
    }
  }
</script>
@endsection
=======
>>>>>>> Stashed changes
