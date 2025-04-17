@extends('templateAdmin')
@section('title', 'Edit Pelaporan')
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
            <h5 class="mb-0">Add Divisi</h5>
          </div>
          <div class="card-body">
            <form action="{{route('karyawan.pelaporanUpdate', $pelaporan->id_pelaporan)}}" method="POST">
                @csrf
                @method('PUT')
              
                <!-- Aktivitas -->
                <div class="mb-3">
                  <label class="form-label" for="aktivitas">Aktivitas</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-task"></i></span>
                    <textarea
                      id="aktivitas"
                      class="form-control"
                      name="aktivitas"
                      placeholder="Tulis aktivitas anda hari ini!"
                      aria-describedby="aktivitas-help"
                    >{{ $pelaporan->aktivitas }}</textarea>
                  </div>
                </div>
              
                <!-- Keterangan -->
                <div class="mb-3">
                  <label class="form-label" for="keterangan">Keterangan</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-detail"></i></span>
                    <textarea
                      id="keterangan"
                      class="form-control"
                      name="keterangan"
                      placeholder="Keterangan tambahan"
                      aria-describedby="keterangan-help"
                    >{{ $pelaporan->keterangan }}</textarea>
                  </div>
                </div>
              
                <!-- Tanggal -->
                <div class="mb-3">
                  <label class="form-label" for="tanggal_pelaporan">Tanggal Pelaporan</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input
                      type="date"
                      id="tanggal_pelaporan"
                      class="form-control"
                      name="tanggal_pelaporan"
                      value="{{ $pelaporan->tanggal_pelaporan }}"
                    />
                  </div>
                </div>
              
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
              
          </div>
        </div>
      </div>
    </div>
@endsection