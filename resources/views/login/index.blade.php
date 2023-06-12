@extends('layouts.main')

@section('container')


<section class="section register min-vh-100 d-flex flex-column align-items-center">
    <div class="container mt-3">
        <h3 class="text-center pb-0 display-4" style="color: white; font-weight: bold; text-shadow: 2px 2px 4px #000">SELAMAT DATANG DI SISTEM INFORMASI MANAJERIAL KEPEGAWAIAN KANTOR DESA WANAKARSA</h3>
    </div>

    <div class="container mt-5">
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
                title: 'Error',
                text: '{{ session('loginError') }}',
                });
                </script>
            @endif

        
         
            <div class="card mb-3" style="opacity: 0.9;">
                

                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Login ke Akun Anda!</h5>
                        <p class="text-center small">Silakan masukan email dan password untuk login</p>
                    </div>

                    <form class="row g-3 needs-validation" action="/login" method="post">
                        @csrf
                        <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <input type="email" class="form-control" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email@example.com" autofocus required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div>
                        </div>

                        <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="password" required>
                        </div>

                        <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit">Login</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
      </div>
    </div>

</section>

{{-- <div class="container">

    
	<div class="d-flex justify-content-center h-100">
        @if(session()->has('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
         @endif
    
        @if(session()->has('loginError'))
            <script>
                alert("{{ session('loginError') }}");
            </script>
        @endif
		<div class="card">
			<div class="card-header">
				<h3>Login</h3>
			</div>
			<div class="card-body">
				<form action="/login" method="post">
                    @csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" class="form-control" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="email@example.com" autofocus required value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" id="password" placeholder="password" required>
					</div>
					
					<div class="form-group">
						<input type="submit" class="btn float-right login_btn">
					</div>
				</form>
			</div>
		</div>

        
	</div>
</div> --}}

{{-- <div class="row justify-content-center">
    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif
    
        @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto text-decoration-none">
            <img src="/image/logo.png" alt="">
            <span class="d-block d-lg-block">SIM Kepegawaian</span>
            </a>
        </div><!-- End Logo -->

        <div class="mb-3 card" style="margin-bottom: 30px; border: none; border-radius: 5px; box-shadow: 0px 0 50px rgba(0, 0, 0, 0.1); background-color: rgba(255, 255, 255, 0.5);">
            <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                </div>

                <form class="row g-3 needs-validation" action="/login" method="post">
                    @csrf

                    <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group has-validation">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    </div>

                    <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                    <p class="small mb-0 text-decoration-none">Don't have account? <a href="/register">Create an account</a></p>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div> --}}


 

@endsection