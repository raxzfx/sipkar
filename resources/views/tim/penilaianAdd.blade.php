@extends('templateTim')
@section('title', 'Penilaian karyawan')
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
            <h5 class="mb-0">Add Nilai</h5>
          </div>
          <div class="card-body">
            <form action="{{route('tim.penilaianStore')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label class="form-label" for="divisi">Nama Karyawan</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                  <select name="karyawan" id="divisi" class="form-control" required>
                    <option disabled selected> Pilih Karyawan </option>
                    @foreach($karyawans as $karyawan)
                      <option value="{{ $karyawan->id_user }}">{{ $karyawan->nama_lengkap }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="divisi">Kategori Penilaian</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-list-check"></i></span>
                  <select name="kategori_id" id="divisi" class="form-control" required>
                    <option disabled selected> Pilih Karyawan </option>
                    @foreach($kategori as $kategori)
                      <option value="{{ $kategori->id_kategori_penilaian }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-company">Skor</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text"
                    ><i class="bx bx-calculator"></i
                  ></span>
                  <input
                    type="number"
                    id="basic-icon-default-company"
                    class="form-control"
                    name="skor"
                    placeholder="ACME Inc."
                    aria-label="ACME Inc."
                    aria-describedby="basic-icon-default-company2"
                  />
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-company">Tanggal Penilaian</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text"
                    ><i class="bx bx-calendar"></i
                  ></span>
                  <input
                    type="date"
                    id="basic-icon-default-company"
                    class="form-control"
                    name="tanggal_penilaian"
                    placeholder="ACME Inc."
                    aria-label="ACME Inc."
                    aria-describedby="basic-icon-default-company2"
                  />
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection