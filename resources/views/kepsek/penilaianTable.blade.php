@extends('templateKepsek')
@section('title', 'Table Penilaian')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Hoverable Table rows -->
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hoverable rows</h5>
        <a href="{{ route('kepsek.penilaianAdd') }}" class="btn btn-primary btn-sm">Add Data</a>
      </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Penilai</th>
            <th>kategori</th>
            <th>tanggal penilaian</th>
            <th>skor</th>
            <th>action</th>
          </tr>
        </thead>
        @foreach ($penilaians as $nilai )
        <tbody class="table-border-bottom-0">
          <tr>
            <td>{{ ($penilaians->currentPage() - 1) * $penilaians->perPage() + $loop->iteration}}</td>
            <td>{{$nilai->qaryawan->nama_lengkap}}</td>
            <td>{{$nilai->tim_penilai->nama_lengkap}}</td>
            <td>{{$nilai->kategori->nama_kategori}}</td>
            <td>{{$nilai->tanggal_penilaian}}</td>
            <td>{{$nilai->skor}}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <form action="{{ route('kepsek.penilaianDelete',  $nilai->id_nilai) }}" method="POST" class="d-inline delete-form">
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
             {{ $penilaians->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->
    </div>
    
@endsection