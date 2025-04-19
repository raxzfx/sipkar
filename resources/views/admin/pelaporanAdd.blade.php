@extends('templateAdmin')
@section('title', 'Add User')
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
            <h5 class="mb-0">Add Pelaporan</h5>
          </div>
          <div class="card-body">
            <form action="{{route('admin.pelaporanStore')}}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label class="form-label" for="divisi">Nama Karyawan</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                  <select name="user_id" id="divisi" class="form-control" required>
                    <option disabled selected> Pilih Karyawan </option>
                    @foreach($users as $karyawan)
                      <option value="{{ $karyawan->id_user }}">{{ $karyawan->nama_lengkap }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
             
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-message">Aktivitas</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-message2" class="input-group-text"
                    ><i class="bx bx-task"></i
                  ></span>
                  <textarea
                    id="basic-icon-default-message"
                    class="form-control"
                    name="aktivitas"
                    placeholder="tulis aktivitas anda hari ini!"
                    aria-label="tulis aktivitas anda hari ini!"
                    aria-describedby="basic-icon-default-message2"
                  ></textarea>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-message">Keterangan</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-message2" class="input-group-text"
                    ><i class="bx bx-detail"></i
                  ></span>
                  <textarea
                    id="basic-icon-default-message"
                    class="form-control"
                    name="keterangan"
                    placeholder="keterangan"
                    aria-label="keterangan"
                    aria-describedby="basic-icon-default-message2"
                  ></textarea>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-company">Tanggal Pelaporan</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text"
                    ><i class="bx bx-calendar"></i
                  ></span>
                  <input
                    type="date"
                    id="basic-icon-default-company"
                    class="form-control"
                    name="tanggal_pelaporan"
                    placeholder="ACME Inc."
                    aria-label="ACME Inc."
                    aria-describedby="basic-icon-default-company2"
                  />
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label" for="formFile">Lampiran File</label>
                <input class="form-control" type="file" name="file" id="formFile" />
                <small class="text-muted">Format: PDF, DOCX, JPG, PNG, dll.</small>
              </div>
              
              
              <button type="submit" class="btn btn-primary">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection