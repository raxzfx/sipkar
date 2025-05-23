@extends('templateAdmin')
@section('title', 'Table User')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Hoverable Table rows -->
   <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hoverable rows</h5>
        <a href="{{ route('admin.userAdd') }}" class="btn btn-primary btn-sm">Add Data</a>
      </div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Email</th>
            <th>No telp</th>
            <th>Jabatan</th>
            <th>action</th>
          </tr>
        </thead>
        @foreach ($users as $user )
        <tbody class="table-border-bottom-0">
          <tr>
            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration}}</td>
            <td>{{$user->nama_lengkap}}</td>
            <td>{{$user->nip}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->no_telp}}</td>
            <td>

              @if ($user->jabatan == 'admin')
              <span class="badge bg-label-primary me-1">{{$user->jabatan}}</span>
              @elseif ($user->jabatan == 'tim penilai')
              <span class="badge bg-label-info me-1">{{$user->jabatan}}</span>
              @elseif ($user->jabatan == 'kepsek')
              <span class="badge bg-label-warning me-1">{{$user->jabatan}}</span>
              @else
              <span class="badge bg-label-danger me-1">{{$user->jabatan}}</span>
              @endif
            
            </td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="icon-base bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{route('admin.userEdit', $user->id_user)}}">
                      <i class="icon-base bx bx-edit-alt me-1"></i> Edit
                  </a>
                  <form action="{{ route('admin.userDelete', $user->id_user ) }}" method="POST" class="d-inline delete-form">
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
             {{ $users->links() }}
      </div>
    </div>
  </div>
  <!--/ Hoverable Table rows -->
    </div>
    
@endsection