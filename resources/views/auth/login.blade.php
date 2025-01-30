@extends('layouts.app')

@section('content')
<div class="login-wrapper">
    <div class="background-logo"></div>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="login-card">
                        
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary">Badan Pusat Statistik</h3>
                            <p class="text-muted">Selamat datang kembali! Silakan masuk ke akun Anda</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf
                            
                            <div class="form-group mb-4">
                                <label class="form-label">Email</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="nama@bps.go.id"
                                           value="{{ old('email') }}"
                                           required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label">password</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password"
                                           name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Masukkan password Anda"
                                           required>
                                    <span class="input-group-text cursor-pointer toggle-password">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg login-btn">
                                    <span class="btn-text">Masuk</span>
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #2575fc;
    --primary-dark: #1a5bbf;
    --secondary-color: #6b11cb;
    --card-bg: rgba(255, 255, 255, 0.95);
    --input-bg: #f8f9fa;
}

.login-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, 
        rgba(107, 17, 203, 0.05) 0%,
        rgba(37, 116, 252, 0.05) 100%);
    position: relative;
    overflow: hidden;
}

.background-logo {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80vh;
    height: 80vh;
    background-image: url("{{ asset('images/logo-bps.png') }}");
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    opacity: 0.05;
    pointer-events: none;
    z-index: 0;
}

.login-wrapper::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, 
        rgba(37, 116, 252, 0.03) 0%,
        rgba(107, 17, 203, 0.03) 100%);
    animation: rotate 30s linear infinite;
    z-index: 0;
}

.login-card {
    position: relative;
    background: var(--card-bg);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    z-index: 1;
}

.login-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
}



/* Rest of the existing styles remain the same */

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .login-card {
        margin: 1rem;
    }
    
    .brand-logo img {
        max-width: 60px;
    }

    .background-logo {
        width: 60vh;
        height: 60vh;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('input[type="password"]');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle eye icon
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
    
    // Add loading state to button on form submit
    const form = document.querySelector('.login-form');
    const button = form.querySelector('.login-btn');
    
    form.addEventListener('submit', function() {
        button.disabled = true;
        button.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Memproses...
        `;
    });
});
</script>
@endsection