@extends('templateAdmin')
@section('title', 'Table Pelaporan')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Hoverable Table rows -->
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hoverable rows</h5>
        <a href="{{ route('admin.pelaporanAdd') }}" class="btn btn-primary btn-sm">Add Data</a>
      </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Aktivitas</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>update status</th>
          </tr>
        </thead>
        @foreach ($pelaporans as $laporan )
        <tbody class="table-border-bottom-0">
          <tr>
            <td>{{ ($pelaporans->currentPage() - 1) * $pelaporans->perPage() + $loop->iteration}}</td>
            <td>{{$laporan->user->nama_lengkap}}</td>
            <td>{{$laporan->aktivitas}}</td>
            <td>{{$laporan->keterangan}}</td>
            <td>{{$laporan->tanggal_pelaporan}}</td>
            <td>
                @if ($laporan->status == 'proses')
                <span class="badge bg-label-warning me-1">{{$laporan->status}}</span>
                @else
                <span class="badge bg-label-success me-1">{{$laporan->status}}</span>
                @endif
            </td>

         <td>
  <div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
      <i class="icon-base bx bx-dots-vertical-rounded"></i>
    </button>
    <div class="dropdown-menu">
      <form action="{{ route('admin.pelaporanUpdateStatus', $laporan->id_pelaporan) }}" method="POST">
        @csrf
        @method('PATCH')
        <button type="submit" class="dropdown-item">
          @if ($laporan->status == 'proses')
            <i class="bx bx-check-circle me-1"></i> Tandai Selesai
          @else
            <i class="bx bx-time-five me-1"></i> Tandai Proses
          @endif
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
             {{ $pelaporans->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->
    </div>
    
@endsection