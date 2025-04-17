@extends('templateAdmin')
@section('title', 'Table Kategori')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Hoverable Table rows -->
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hoverable rows</h5>
        <a href="{{ route('admin.kategoriAdd') }}" class="btn btn-primary btn-sm">Add Data</a>
      </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama kategori</th>
            <th>Nilai</th>
            <th>action</th>
          </tr>
        </thead>
        @foreach ($kategoris as $kategori )
        <tbody class="table-border-bottom-0">
          <tr>
            <td>{{ ($kategoris->currentPage() - 1) * $kategoris->perPage() + $loop->iteration}}</td>
            <td>{{$kategori->nama_kategori}}</td>
            <td>{{$kategori->nilai}}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('admin.kategoriEdit', $kategori->id_kategori_penilaian)}}">
                      <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                  </a>
                  <form action="{{ route('admin.kategoriDelete',  $kategori->id_kategori_penilaian) }}" method="POST" class="d-inline delete-form">
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
             {{ $kategoris->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->
    </div>
    
@endsection