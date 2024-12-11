@extends('adminlte::page')

@section('title', 'Update Pelanggaran')

@section('head')
    <!-- Add external stylesheets here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
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

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container mt-5">
        <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-4" style="border-bottom: 2px solid #ddd; padding-bottom: 10px; color: #333;">
                    Update Status Pelanggaran
                </h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggaranList as $pelanggaran)
                        <tr>
                            <td>{{ $pelanggaran->user->nama ?? 'N/A' }}</td>
                            <td>{{ $pelanggaran->listPelanggaran->nama_pelanggaran ?? 'N/A' }}</td>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
