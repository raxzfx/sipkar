@extends('templateAdmin')
@section('title', 'Add Karyawan')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="col-xl">
    <div class="card mb-4">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Add Karyawan</h5>
      </div>
      <div class="card-body">
        <form action="{{ route('admin.karyawanStore') }}" method="POST">
          @csrf

          {{-- Select Divisi --}}
          <div class="mb-3">
            <label class="form-label" for="divisi">Pilih Divisi</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-building"></i></span>
              <select name="divisi_id" id="divisi" class="form-control" required>
                <option disabled selected>-- Pilih Divisi --</option>
                @foreach($divisis as $divisi)
                  <option value="{{ $divisi->id_divisi }}">{{ $divisi->nama_divisi }}</option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- Select User --}}
          <div class="mb-3">
            <label class="form-label" for="user">Pilih User (Jabatan: Karyawan)</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-user"></i></span>
              <select name="user_id" id="user" class="form-control" required>
                <option disabled selected>-- Pilih User --</option>
                @foreach($users as $user)
                  <option value="{{ $user->id_user }}">{{ $user->nama_lengkap }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
