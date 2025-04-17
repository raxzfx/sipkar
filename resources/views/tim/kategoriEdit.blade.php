@extends('templateTim')
@section('title', 'Edit kategori')
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
            <form action="{{route('tim.kategoriUpdate', $kategori->id_kategori_penilaian)}}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Nama Kategori</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text"
                    ><i class="bx bx-user"></i
                  ></span>
                  <input
                    type="text"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    name="nama_kategori"
                    value="{{$kategori->nama_kategori}}"
                    placeholder="John Doe"
                    aria-label="John Doe"
                    aria-describedby="basic-icon-default-fullname2"
                    required
                  />
                </div>
              </div>      
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Nilai</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text"
                    ><i class="bx bx-user"></i
                  ></span>
                  <input
                    type="number"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    name="nilai"
                    value="{{$kategori->nilai}}"
                    placeholder="John Doe"
                    aria-label="John Doe"
                    aria-describedby="basic-icon-default-fullname2"
                    required
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