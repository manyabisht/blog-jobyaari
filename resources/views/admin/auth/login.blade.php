@extends('layouts.public')

@section('title', 'Admin Login')

@section('content')
    <section class="auth-screen py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-5">
                    <div class="auth-card bg-white shadow-sm border">
                        <div class="mb-4">
                            <span class="eyebrow">Admin Panel</span>
                            <h1 class="h3 fw-bold mt-2">Sign in to manage blogs</h1>
                            <p class="text-muted mb-0">Use the seeded admin account from the README.</p>
                        </div>

                        <form action="{{ route('admin.login.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 d-inline-flex justify-content-center align-items-center gap-2">
                                <i data-lucide="log-in" class="icon"></i>
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
