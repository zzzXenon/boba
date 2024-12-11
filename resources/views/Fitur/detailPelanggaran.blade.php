@extends('adminlte::page') 

@section('title', 'Detail Pelanggaran')

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
                        <th style="max-width: 80px; word-wrap: break-word;">Poin</th>
                        <th style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Deskripsi Pelanggaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nama }}</td>
                        <td style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nim }}</td>
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->prodi }}</td>
                        <td style="max-width: 80px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->listPelanggaran->poin }}</td>
                        <td style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">
                            {{ $pelanggaran->listPelanggaran->nama_pelanggaran }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

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

</div>
@endsection
