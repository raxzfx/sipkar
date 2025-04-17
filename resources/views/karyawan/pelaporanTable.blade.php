@extends('templateKaryawan')
@section('title', 'Table Pelaporan')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Hoverable Table rows -->
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Pelaporan Saya</h5>
        <a href="{{ route('karyawan.pelaporanAdd') }}" class="btn btn-primary btn-sm">Tambah Data</a>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Aktivitas</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse ($pelaporans as $laporan)
          <tr>
            <td>{{ ($pelaporans->currentPage() - 1) * $pelaporans->perPage() + $loop->iteration }}</td>
            <td>{{ $laporan->aktivitas }}</td>
            <td>{{ $laporan->keterangan }}</td>
            <td>{{ $laporan->tanggal_pelaporan }}</td>
            <td>
                @if ($laporan->status === 'proses')
                    <span class="badge bg-label-warning me-1">{{ $laporan->status }}</span>
                @else
                    <span class="badge bg-label-success me-1">{{ $laporan->status }}</span>
                @endif
            </td>
            <td>
                @if($laporan->status === 'proses')
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="icon-base bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('karyawan.pelaporanEdit', $laporan->id_pelaporan)}}">
                        <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                    </a>
                    <form action="{{ route('karyawan.pelaporanDelete', $laporan->id_pelaporan ) }}" method="POST" class="d-inline delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item delete-btn" onclick="return confirm('apa anda yakin ingin menghapus data tersebut?')">
                          <i class="icon-base bx bx-trash me-1"></i> Delete
                      </button>
                    </form>
                  </div>
                </div>
                @else
                  <span class="text-muted">Selesai</span>
                @endif
              </td>              
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center">Belum ada data pelaporan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="me-4 ms-4 mt-5">
         {{ $pelaporans->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->
</div>

@endsection
