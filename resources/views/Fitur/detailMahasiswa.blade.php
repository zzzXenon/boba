@extends('adminlte::page')

@section('title', 'List Pelanggaran')

@section('content')
<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E7FAFF; box-shadow: 0px 4px 4px rgba(90, 173, 194, 0.54)">
        <div class="card-body p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Pelanggaran</th>
                        <th style="max-width: 80px; word-wrap: break-word;">Poin</th>
                        <th style="max-width: 30px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Tanggal</th>
                        <th style="max-width: 100px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="max-width: 200px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">
                            {{ $pelanggaran->listPelanggaran->nama_pelanggaran }}
                        </td>
                        <td style="max-width: 80px; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis;">{{ $pelanggaran->listPelanggaran->poin }}</td>
                        <td>{{ $pelanggaran->created_at->format('d-m-Y') }}</td>
                        <td>
                            @if($pelanggaran->status == 'Sedang diproses')
                                <span>Kasus belum diproses</span>
                            @elseif($pelanggaran->status == 'Selesai')
                                <span>Kasus sudah selesai diproses</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container mt-5">
  <div class="timeline">
      @foreach ($pelanggaranLogs as $log)
          <div class="timeline-item">
              <div class="timeline-date">
                  {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y, H:i') }}
              </div>
              <div class="timeline-content">
                  <p>
                      {{ $log->user_role }} : {{ $log->user_nama }}
                  </p>

                  @if($log->action === 'New Comment Added')
                      <p>
                        {{ $log->details }}
                      </p>
                      <a href="{{ route('pelanggaranMahasiswa.detail', $log->pelanggaran_id) }}" 
                          class="btn btn-sm mt-2" 
                          style="background-color: #5AADC2; color: white;">
                          Lihat
                      </a>

                  @elseif($log->action === 'Update Status')
                      @if(str_contains($log->details, "to 'Diperiksa'"))
                          sedang memeriksa kasus pelanggaran
                      @elseif(str_contains($log->details, "to 'Selesai'"))
                          menutup kasus pelanggaran
                      @endif

                  @endif
              </div>
          </div>
      @endforeach
  </div>
</div>

@endsection
