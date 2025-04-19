@extends('templateAdmin')
@section('title', 'Dashboard Admin')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Congratulations {{ Auth::user()->nama_lengkap }}! 🎉</h5>
              <p class="mb-4">
                You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in
                your profile.
              </p>
              <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="../assets/img/illustrations/man-with-laptop-light.png"
                height="140"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
              />
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Profile Report Card -->
<div class="col-12 col-md-8 col-lg-12 col-xxl-12 order-3 order-md-2 profile-report">
  <div class="row">
    <!-- Card 1 -->
    <div class="col-md-6 col-xl-3 mb-4 payments">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
             <i class="bx bx-group bx-sm text-primary"></i>

            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown">
                <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="{{route('admin.userTable')}}">View More</a>
             
              </div>
            </div>
          </div>
          <p class="mb-1">Jumlah karyawan</p>
          <h4 class="card-title mb-3">{{ $karyawans }}</h4>
         
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-6 col-xl-3 mb-4 transactions">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <i class="bx bx-spreadsheet bx-sm text-primary"></i>

            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt2" data-bs-toggle="dropdown">
                <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('admin.pelaporanTable')}}">View More</a>
             
              </div>
            </div>
          </div>
          <p class="mb-1">pelaporan kinerja - pending</p>
          <h4 class="card-title mb-3">{{ $pelaporans }}</h4>

        </div>
      </div>
    </div>

    <!-- Card 3 (copy of Payments, can be edited) -->
    <div class="col-md-6 col-xl-3 mb-4 payments">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <i class="bx bx-spreadsheet bx-sm text-primary"></i>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown">
                <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="{{route('admin.pelaporanTable')}}">View More</a>
             
              </div>
            </div>
          </div>
          <p class="mb-1">Pelaporan kinerja - Revisi</p>
          <h4 class="card-title mb-3">{{$pelaporanr}}</h4>
         
        </div>
      </div>
    </div>

    <!-- Card 4 (copy of Transactions, can be edited) -->
    <div class="col-md-6 col-xl-3 mb-4 transactions">
      <div class="card h-100">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between mb-4">
            <div class="avatar flex-shrink-0">
              <i class="bx bx-spreadsheet bx-sm text-primary"></i>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown">
                <i class="icon-base bx bx-dots-vertical-rounded text-body-secondary"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('admin.pelaporanTable')}}">View More</a>
             
              </div>
            </div>
          </div>
          <p class="mb-1">Pelaporan kinerja - Selesai</p>
          <h4 class="card-title mb-3">{{$pelaporand}}</h4>
        </div>
      </div>
    </div>
  </div>
</div>


  </div>
</div>
@endsection
