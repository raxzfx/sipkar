@extends('templateAdmin')
@section('title', 'Table Karyawan')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Hoverable Table rows -->
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hoverable rows</h5>
        <a href="{{ route('admin.karyawanAdd') }}" class="btn btn-primary btn-sm">Add Data</a>
      </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Divisi</th>
            <th>action</th>
          </tr>
        </thead>
        @foreach ($karyawans as $karyawan )
        <tbody class="table-border-bottom-0">
          <tr>
            <td>{{ ($karyawans->currentPage() - 1) * $karyawans->perPage() + $loop->iteration}}</td>
            <td>{{$karyawan->user->nama_lengkap}}</td>
            <td>{{$karyawan->divisi->nama_divisi}}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('admin.karyawanEdit', $karyawan->id_karyawan)}}">
                      <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                  </a>
                  <form action="{{ route('admin.karyawanDelete', $karyawan->id_karyawan ) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item delete-btn" onclick="return confirm('apa anda yakin ingin menghapus data tersebut?')">
                        <i class="icon-base bx bx-trash me-1"></i> Delete
                    </button>
                </form>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
        @endforeach
      </table>
      <div class="me-4 ms-4 mt-5">
             {{ $karyawans->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->
    </div>
    
@endsection