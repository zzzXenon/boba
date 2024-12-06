@extends('adminlte::page') 

@section('title', 'Detail Pelanggaran')

@section('content')
<div class="container mt-5">
    <div class="card border-0" style="border-radius: 7px; background-color: #E4E9EF; box-shadow: 0px 6px 8px rgba(0, 111, 255, 0.25);">
        <div class="card-body p-4">
            <h3 class="card-title text-center mb-4" style="border-bottom: 2px solid #ddd; padding-bottom: 10px; color: #333;">
                Detail Pelanggaran
            </h3>
            <div class="row">
              <div class="col-md-6">
                  <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                      <strong>Nama Mahasiswa:</strong>
                      <span class="p-2 rounded">{{ $pelanggaran->user->name }}</span>
                  </div>
                  <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                      <strong>NIM:</strong>
                      <span class="p-2 rounded">{{ $pelanggaran->user->nim }}</span>
                  </div>
                  <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                      <strong>Prodi:</strong>
                      <span class="p-2 rounded">{{ $pelanggaran->user->prodi }}</span>
                  </div>
                  <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                      <strong>Poin:</strong>
                      <span class="p-2 rounded">{{ $pelanggaran->listPelanggaran->poin }}</span>
                </div>
                  <div class="mb-3" style="border-radius: 7px; background-color: #D3E4FB;">
                      <strong>Detail Pelanggaran:</strong>
                      <span class="p-2 rounded">{{ $pelanggaran->listPelanggaran->nama_pelanggaran }}</span>
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
  <h4>Comments</h4>
  @foreach ($pelanggaran->comments as $comment)
  <div class="comment">
      <!-- Display the user's role and name -->
      <p><strong>({{ $comment->user->role }}) {{ $comment->user->nama }}</strong></p>
      <p>{{ $comment->comment }}</p>
      <p><em>{{ $comment->created_at->diffForHumans() }}</em></p>
  </div>
  @endforeach 


  <form action="{{ route('comments.store', $pelanggaran->id) }}" method="POST" class="mt-4">
      @csrf
      <div class="form-group">
          <textarea name="comment" class="form-control" placeholder="Add a comment"></textarea>
      </div>
      <button type="submit" class="btn btn-primary mt-2">Submit Comment</button>
  </form>
</div>
@endsection
