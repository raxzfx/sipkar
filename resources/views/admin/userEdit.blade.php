@extends('templateAdmin')
@section('title', 'Edit User')
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
            <h5 class="mb-0">Add User</h5>
          </div>
          <div class="card-body">
            <form action="{{route('admin.userUpdate', $users->id_user)}}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Nama Lengkap</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-fullname2" class="input-group-text"
                    ><i class="bx bx-user"></i
                  ></span>
                  <input
                    type="text"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    name="nama_lengkap"
                    placeholder="John Doe"
                    aria-label="John Doe"
                    aria-describedby="basic-icon-default-fullname2"
                    required
                    value="{{$users->nama_lengkap}}"
                  />
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-company">NIP</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-company2" class="input-group-text"
                    ><i class="bx bx-id-card"></i
                  ></span>
                  <input
                    type="number"
                    id="basic-icon-default-company"
                    class="form-control"
                    name="nip"
                    placeholder="masukan nip anda"
                    aria-label="masukan nip anda"
                    aria-describedby="basic-icon-default-company2"
                    value="{{$users->nip}}"
                    required
                  />
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-email">Email</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                  <input
                    type="text"
                    id="basic-icon-default-email"
                    class="form-control"
                    placeholder="john.doe"
                    name="email"
                    aria-label="john.doe"
                    value="{{$users->email}}"
                    aria-describedby="basic-icon-default-email2"
                    required
                  />
                  <span id="basic-icon-default-email2" class="input-group-text">@gmail.com</span>
                </div>
                <div class="form-text">You can use letters, numbers & periods</div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-phone">Phone No</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-phone2" class="input-group-text"
                    ><i class="bx bx-phone"></i
                  ></span>
                  <input
                    type="text"
                    id="basic-icon-default-phone"
                    class="form-control phone-mask"
                    name="no_telp"
                    value="{{$users->no_telp}}"
                    placeholder="0896 7777 8888"
                    aria-label="0896 7777 8888"
                    aria-describedby="basic-icon-default-phone2"
                    required
                  />
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label" for="basic-icon-default-message">Pilih Jabatan</label>
                <div class="input-group input-group-merge">
                  <span id="basic-icon-default-message2" class="input-group-text">
                    <i class="bx bx-briefcase"></i>
                  </span>
                  <select
                    id="basic-icon-default-message"
                    class="form-control"
                    name="jabatan"
                    aria-describedby="basic-icon-default-message2"
                  >
                    <option selected disabled>Pilih Jabatan</option>
                    @foreach ($jabatans as $jab)
                      <option value="{{ $jab }}" 
                        @if ($jab == old('jabatan', $users->jabatan)) selected @endif>
                        {{ $jab }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
              

              <div class="mb-5 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-lock"></i></span>
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    value="{{$users->password}}"
                    placeholder="Masukkan password"
                    aria-describedby="password"
                  />
                  <span class="input-group-text cursor-pointer" onclick="togglePassword()">
                    <i class="bx bx-hide" id="toggle-icon"></i>
                  </span>
                </div>
              </div>              
              
              <button type="submit" class="btn btn-primary">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection

<script>
  function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('toggle-icon');

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('bx-hide');
      icon.classList.add('bx-show');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('bx-show');
      icon.classList.add('bx-hide');
    }
  }
</script>