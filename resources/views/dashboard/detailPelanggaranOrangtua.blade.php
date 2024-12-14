@extends('adminlte::page') 

@section('title', 'Detail Pelanggaran')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endpush
@favicon
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
                        <th style="max-width: 80px; word-wrap: break-word;">Poin</th>
                        <th style="max-width: 30px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Tanggal</th>
                        <th style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Status</th>
                        <th style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Deskripsi Pelanggaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nama }}</td>
                        <td style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->nim }}</td>
                        <td style="max-width: 150px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->user->prodi }}</td>
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
  <div class="comment">
      <!-- Display the user's role and name -->
      <p><strong>({{ $comment->user->role }}) {{ $comment->user->nama }}</strong></p>
      <p>{{ $comment->comment }}</p>
      <p><em>{{ $comment->created_at->diffForHumans() }}</em></p>
  </div>
  @endforeach 

</div>
@endsection
