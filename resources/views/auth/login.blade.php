<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Poli Kesehatan</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .brand-wrapper {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            color: white;
            padding: 2.5rem;
            text-align: center;
        }
        
        .form-control, .input-group-text {
            border: none;
            padding: 12px;
        }
        
        .input-group-text {
            background-color: #f8f9fa;
        }
        
        .form-control:focus {
            box-shadow: none;
            border: 1px solid #0d6efd;
        }
        
        .btn-login {
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
        
        .link-blue {
            color: #0d6efd;
            transition: all 0.3s ease;
        }
        
        .link-blue:hover {
            color: #0a58ca;
            text-decoration: underline !important;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 1rem;
            padding: 8px 16px;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .back-link:hover {
            transform: translateX(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .logo-icon {
            background-color: rgba(255, 255, 255, 0.2);
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card login-card border-0">
                    <div class="row g-0">
                        <div class="col-lg-5">
                            <div class="brand-wrapper h-100 d-flex flex-column justify-content-center">
                                <div class="logo-icon">
                                    <i class="fas fa-hospital fa-2x"></i>
                                </div>
                                <h2 class="fw-bold mb-2">Poli Kesehatan</h2>
                                <p class="mb-0 opacity-75">Sistem Informasi Manajemen Klinik</p>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="card-body p-5">
                                <div class="text-center mb-4">
                                    <h3 class="fw-bold">Selamat Datang</h3>
                                    <p class="text-muted">Silakan login untuk mengakses akun Anda</p>
                                </div>

                                <!-- Tampilkan pesan error jika ada -->
                                @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                <!-- PENTING: Pastikan method="POST" dan CSRF token ada -->
                                <form action="/auth/login" method="POST">
                                    <!-- CSRF Token -->
                                    @csrf

                                    <!-- Email -->
                                    <div class="mb-4">
                                        <label for="email" class="form-label fw-bold">Email</label>
                                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text border-0">
                                                <i class="fas fa-envelope text-primary"></i>
                                            </span>
                                            <input type="email" class="form-control border-0" id="email" name="email" required
                                                autocomplete="email" autofocus placeholder="Masukkan email Anda">
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label fw-bold">Password</label>
                                        <div class="input-group shadow-sm rounded-3 overflow-hidden">
                                            <span class="input-group-text border-0">
                                                <i class="fas fa-lock text-primary"></i>
                                            </span>
                                            <input type="password" class="form-control border-0" id="password" name="password" required
                                                placeholder="Masukkan password Anda">
                                        </div>
                                    </div>

                                    <!-- Remember me -->
                                    <div class="mb-4 form-check">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Ingat Saya</label>
                                    </div>

                                    <!-- Submit button -->
                                    <div class="d-grid gap-2 mb-4">
                                        <button type="submit" class="btn btn-primary btn-login">
                                            <i class="fas fa-sign-in-alt me-2"></i>Masuk
                                        </button>
                                    </div>

                                    <!-- Register and forgot password links -->
                                    <div class="text-center">
                                        <p class="mb-2">
                                            <a href="/auth/register" class="text-decoration-none link-blue">
                                                <i class="fas fa-user-plus me-1"></i> Belum memiliki akun? Register
                                            </a>
                                        </p>
                                        <p class="mb-0">
                                            <a href="/auth/forgot-password" class="text-decoration-none link-blue">
                                                <i class="fas fa-key me-1"></i> Lupa Kata Sandi?
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Back to home link -->
                <div class="text-center">
                    <a href="/" class="text-decoration-none back-link">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>