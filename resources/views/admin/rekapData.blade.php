@extends('templateAdmin')
@section('title', 'Rekap Data')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Hoverable Table rows -->
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hoverable rows</h5>
        <a href="{{ route('admin.rekap.export') }}" class="btn btn-danger btn-sm">
            <i class="bx bx-download me-1"></i> Export PDF
        </a>
        
      </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Penilaian</th>
            <th>Skor</th>
          </tr>
        </thead>
        @foreach ($penilaians as $user )
        <tbody class="table-border-bottom-0">
          <tr>
            <td>{{ ($penilaians->currentPage() - 1) * $penilaians->perPage() + $loop->iteration}}</td>
            <td>{{$user->qaryawan->nama_lengkap}}</td>
            <td>{{$user->tanggal_penilaian}}</td>
            <td>{{$user->skor}}</td>
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