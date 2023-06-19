@extends('layouts.main')

@section('container')

<section class="section register min-vh-100 d-flex flex-column align-items-center">
    <div class="container mt-3">
      <p class="text-center pb-0 display-4 welcome-title" style="color: white; font-weight: bold; text-shadow: 2px 2px 4px #000">SELAMAT DATANG DI SISTEM INFORMASI MANAJERIAL KEPEGAWAIAN KANTOR DESA WANAKARSA</p>
    </div>

  <div class="container-fluid mt-5">
    <div class="row justify-content-center">
      <div class="mt-3 col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session()->has('loginError'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
          Swal.fire({
            icon: 'error',
            title: 'Login gagal',
            text: 'Username atau password yang Anda masukan salah!',
          });
        </script>
        @endif

        <div class="card mb-3" style="opacity: 0.9;">
          <div class="card-body">
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4">Login ke Akun Anda!</h5>
              <p class="text-center small">Silakan masukan username dan password untuk login</p>
            </div>

            <form class="row g-3 needs-validation" action="/login" method="post">
              @csrf
              <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                  <input type="string" class="form-control" name="username" class="form-control @error('username') is-invalid @enderror" id="username" autofocus required value="{{ old('username') }}">
                  @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>

              <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <div class="form-group">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus value="{{ old('password') }}">
                  <span id="togglePassword" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
              </div>

              <div class="col-12">
                <button class="btn btn-primary btn-block" type="submit">Login</button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>

</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('#togglePassword').click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var passwordInput = $('#password');
      var passwordFieldType = passwordInput.attr('type');
      var passwordFieldTypeUpdated = passwordFieldType === 'password' ? 'text' : 'password';
      passwordInput.attr('type', passwordFieldTypeUpdated);
    });
  });

</script>


@endsection
