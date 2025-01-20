@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-4x text-primary mb-3"></i>
                        <h3>Login</h3>
                        <p class="text-muted">Silakan masuk ke akun Anda</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" name="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    placeholder="Email"
                                    value="{{ old('email') }}" 
                                    required 
                                    autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" name="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="Password" 
                                    required>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection