@extends('adminlte::page') 

@section('title', 'Detail Pelanggaran')

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush

@section('head')
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
@endsection

@section('content')
<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E7FAFF; box-shadow: 0px 4px 4px rgba(90, 173, 194, 0.54)">
        <div class="card-body p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="max-width: 150px; word-wrap: break-word;">Nama</th>
                        <th style="max-width: 100px; word-wrap: break-word;">NIM</th>
                        <th style="max-width: 150px; word-wrap: break-word;">Prodi</th>
                        <th style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Deskripsi Pelanggaran</th>
                        <th style="max-width: 80px; word-wrap: break-word;">Poin</th>
                        <th style="max-width: 30px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Tanggal</th>
                        <th style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Status</th>
                        <th style="max-width: 80px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Aksi</th>                        
                    </tr>
                </thead>
                <tbody>
                    <tr>

                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nama }}</td>
                        <td style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nim }}</td>
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->prodi }}</td>
                        <td style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">
                            {{ $pelanggaran->listPelanggaran->nama_pelanggaran }}
                        </td>
                        <td style="max-width: 80px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->listPelanggaran->poin }}</td>
                        <td>{{ $pelanggaran->created_at->format('d-m-Y') }}</td>
                        <td>
                            <!-- Status Badge -->
                            @if($pelanggaran->status == 'Belum Diperiksa')
                                <span class="badge badge-belum">Belum Diperiksa</span>
                            @elseif($pelanggaran->status == 'Diperiksa')
                                <span class="badge badge-diperiksa">Diperiksa</span>
                            @elseif($pelanggaran->status == 'Selesai')
                                <span class="badge badge-selesai">Selesai</span>
                            @endif
                        </td>
                        <td>
                            <!-- Status Update Action -->
                            <form action="{{ route('pelanggaran.update_status', $pelanggaran->id) }}" method="POST" class="d-inline-block" id="statusForm">
                              @csrf
                              <select name="status" class="form-select form-select-sm status-select" id="statusSelect">
                                  <option value="Belum Diperiksa" {{ $pelanggaran->status == 'Belum Diperiksa' ? 'selected' : '' }} class="select-belum">Belum Diperiksa</option>
                                  <option value="Diperiksa" {{ $pelanggaran->status == 'Diperiksa' ? 'selected' : '' }} class="select-diperiksa">Diperiksa</option>
                                  <option value="Selesai" {{ $pelanggaran->status == 'Selesai' ? 'selected' : '' }} class="select-selesai">Selesai</option>
                              </select>
                            </form>
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

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Tangkap event perubahan status pada select
    document.getElementById('statusSelect').addEventListener('change', function(e) {
        e.preventDefault();  // Menghentikan pengiriman form otomatis

        // Menampilkan SweetAlert2 untuk konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Status ini akan diperbarui!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Perbarui!',
            cancelButtonText: 'Tidak, Batalkan'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika konfirmasi Ya, kirimkan form
                document.getElementById('statusForm').submit();
            } else {
                // Jika konfirmasi No, reset select kembali
                document.getElementById('statusSelect').value = '{{ $pelanggaran->status }}';
            }
        });
    });
</script>
@endpush