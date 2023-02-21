@extends('layouts.main')

@section('container')

{{-- <div class="row justify-content-center">
    <div class="col-md-4">

       
        
        <main class="form-signin w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center">Please login</h1>
            <form action="/login" method="post">
                @csrf
                <div class="form-floating">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <small class="d-block text-center mt-3">Not registered? <a href="/register" class="text-decoration-none">Register Now!</a></small>
        </main>


    </div>
</div> --}}

<div class="row justify-content-center">
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

        <div class="mb-3 card" style="margin-bottom: 30px; border: none; border-radius: 5px; box-shadow: 0px 0 50px rgba(0, 0, 0, 0.1);">
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
</div>


 

@endsection