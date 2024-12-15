@extends('adminlte::page')

@section('title', 'List Pelanggaran')

@section('content')
<<<<<<< Updated upstream
<h3 class="title text-center mb-4 pt-5 pb-1" style="color: #333;">Data Pelanggaran</h3>

<div class="container mt-2">
    <div class="card-body p-4">
        <table class="table text-center" style="border-collapse: separate; border-spacing: 0; width: 100%;">
            <thead>
                <tr style="background-color: #5AADC2; color: #fff; border-radius: 10px; box-shadow: 0px 4px 4px rgba(90, 173, 194, 0.16)">
                    <th style="border-top-left-radius: 10px; padding: 15px 20px; max-width: 150px; word-wrap: break-word;">Nama</th>
                    <th style="padding: 15px 20px; max-width: 100px; word-wrap: break-word;">NIM</th>
                    <th style="padding: 15px 20px; max-width: 200px; word-wrap: break-word;">Pelanggaran</th>
                    <th style="padding: 15px 20px; max-width: 80px; word-wrap: break-word;">Poin</th>
                    <th style="border-top-right-radius: 10px; padding: 15px 20px; max-width: 150px; word-wrap: break-word;">Status Pelanggaran</th>
                </tr>
            </thead>
            <tbody style="background-color: #E7FAFF; box-shadow: 0px 4px 6px rgba(90, 173, 194, 0.54); border-radius: 30px;">
                @forelse ($pelanggaranList as $item)
                <tr style="background-color: #E7FAFF; border-bottom: 4px solid #fff; border-radius: 30px;">
                    <td style="padding: 15px;">{{ $item->user->nama }}</td>
                    <td style="padding: 15px; max-width: 100px; word-wrap: break-word;">{{ $item->user->nim }}</td>
                    <td style="padding: 15px; max-width: 200px; word-wrap: break-word;">{{ $item->listPelanggaran->nama_pelanggaran }}</td>
                    <td style="padding: 15px; max-width: 80px; word-wrap: break-word;">{{ $item->listPelanggaran->poin }}</td>
                    <td style="padding: 15px; max-width: 150px; word-wrap: break-word;">
                        <span>{{ $item->status }}</span>
                        <br>
                        <a href="{{ route('pelanggaran.showComments', $item->id) }}" class="btn btn-sm mt-2" style="background-color: #5AADC2; color: white;">Lihat</a>
                    </td>
                </tr>
                @empty
                <p class="text-center">Mahasiswa tidak memiliki pelanggaran.</p>
                @endforelse
            </tbody>
        </table>
        
    </div>
</div>
@endsection
=======
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
>>>>>>> Stashed changes
