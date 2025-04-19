@extends('templateAdmin')
@section('title', 'Table Pelaporan')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Hoverable Table rows -->
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tabel Pelaporan</h5>
        <a href="{{ route('admin.pelaporanAdd') }}" class="btn btn-primary btn-sm">Add Data</a>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Aktivitas</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Lampiran</th>
            <th>Nilai</th>
            <th>Nilai akhir</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach ($pelaporans as $laporan)
          <tr>
            <td>{{ ($pelaporans->currentPage() - 1) * $pelaporans->perPage() + $loop->iteration }}</td>
            <td>{{ $laporan->kode_unik }}</td>
            <td>{{ $laporan->user->nama_lengkap }}</td>
            <td>{{ $laporan->aktivitas }}</td>
            <td>{{ $laporan->keterangan }}</td>
            <td>{{ $laporan->tanggal_pelaporan }}</td>
            <td>
              @if ($laporan->status === 'pending')
                <span class="badge bg-warning text-dark">Pending</span>
              @elseif ($laporan->status === 'selesai')
                <span class="badge bg-success">Selesai</span>
              @elseif ($laporan->status === 'revisi')
                <span class="badge bg-info text-dark">Revisi</span>
              @elseif ($laporan->status === 'ditolak')
                <span class="badge bg-danger">Ditolak</span>
              @else
                <span class="badge bg-secondary">{{ ucfirst($laporan->status) }}</span>
              @endif
            </td>
            

            <!-- Button Trigger Modal -->
            <td>
              <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailModal{{ $laporan->id_pelaporan }}">
                <i class="bx bx-show"></i> Lihat
              </button>
            </td>

            <!-- Update Status Dropdown -->
            <td>
              @if ($laporan->status === 'ditolak')
                -
              @elseif ($laporan->status === 'selesai')
                - 
              @else
              <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#statusModal{{ $laporan->id_pelaporan }}">
                <i class="bx bx-edit"></i> Nilai
              </button>
              @endif
            </td>

            <td>
              @if ($laporan->status === 'pending')
                nilai belum ada
              @else
              {{$laporan->nilai_akhir ?? 'nilai belum ada'}}
              @endif
            </td>

            <td>
              @if ($laporan->status === 'selesai')
                selesai
              @elseif ($laporan->status === 'ditolak')
                submit ulang!
              @elseif ($laporan->status === 'pending')
                menunggu review
              @else
                <a href="{{ route('admin.pelaporanEdit', $laporan->id_pelaporan) }}" class="btn btn-sm btn-primary">
                  <i> edit lampiran </i>
                </a>
              @endif
            </td>
            
            
          </tr>

          <!-- Modal Detail -->
          <div class="modal fade" id="detailModal{{ $laporan->id_pelaporan }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $laporan->id_pelaporan }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalDetailLabel{{ $laporan->id_pelaporan }}"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                  @if ($laporan->file)
                 
                  @php
                    $ext = pathinfo($laporan->file, PATHINFO_EXTENSION);
                    $url = asset('uploads/pelaporan/' . $laporan->file); // <-- pastikan ini sesuai lokasi
                  @endphp
                
                  @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <img src="{{ $url }}" alt="File Gambar" class="img-fluid rounded" style="max-height: 300px;">
                  @elseif ($ext === 'pdf')
                    <iframe src="{{ $url }}" width="100%" height="400px"></iframe>
                  @else
                  <div class="text-center">
                    <a href="{{ $url }}" target="_blank" class="btn btn-lg btn-outline-primary">
                      <i class="bx bx-download"></i> Unduh File ({{ strtoupper($ext) }})
                    </a>
                  </div>
                  
                  @endif
                @endif
                
                
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
              </div>
            </div>
          </div>
      <!-- Modal Nilai & Komentar -->
<div class="modal fade" id="statusModal{{ $laporan->id_pelaporan }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $laporan->id_pelaporan }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.pelaporanUpdateStatus', $laporan->id_pelaporan) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-header">
          <h5 class="modal-title" id="statusModalLabel{{ $laporan->id_pelaporan }}">Nilai Laporan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">

          @foreach ($kategoris as $index => $kategori)
          <div class="mb-3">
            <label class="form-label">{{ $kategori->nama_kategori }} (0 - 100)</label>
            <input type="number" name="nilai[]" class="form-control" min="0" max="100" required>
          </div>
        @endforeach
        

          <div class="mb-3">
            <label for="komentar" class="form-label">Komentar</label>
            <textarea name="komentar" class="form-control" rows="3" placeholder="Beri komentar jika perlu..."></textarea>
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


        @endforeach
        
        </tbody>
      </table>
      <div class="me-4 ms-4 mt-4">
        {{ $pelaporans->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->

  <!-- Table Histori Laporan -->
<div class="card mt-4">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Histori Laporan</h5>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table  table-hover">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Aktivitas</th>
          <th>Status</th>
          <th>Komentar</th>
          <th>Nilai Akhir</th>
          <th>Tanggal Update</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($historiPelaporans as $index => $histori)
          <tr>
            <td>{{ ($historiPelaporans->currentPage() - 1) * $historiPelaporans->perPage() + $loop->iteration }}</td>
            <td>{{ $histori->user->nama_lengkap ?? '-' }}</td>
            <td>{{ $histori->aktivitas ?? '-' }}</td>
            <td>
              @if ($histori->status === 'revisi')
                <span class="badge bg-info text-dark">Revisi</span>
              @elseif ($histori->status === 'selesai')
                <span class="badge bg-success">Selesai</span>
              @elseif ($histori->status === 'ditolak')
                <span class="badge bg-danger">Ditolak</span>
              @else
                <span class="badge bg-secondary">{{ ucfirst($histori->status) }}</span>
              @endif
            </td>
            <td>{{ $histori->komentar ?? '-' }}</td>
            <td>{{ $histori->nilai_akhir ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($histori->created_at)->format('d M Y H:i') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center">Tidak ada histori laporan.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="me-4 ms-4 mt-4">
      {{ $historiPelaporans->links() }}
    </div>
  </div>
</div>

</div>

@endsection
