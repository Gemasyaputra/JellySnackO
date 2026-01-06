<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Jelly SnackO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-primary: #063C0F;
            --color-secondary: #7B8D63;
            --color-light: #FFFBE2;
            --color-beige: #B7AF83;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #FFFBE2 0%, #f5f2dc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Decorations */
        body::before {
            content: '🍪';
            position: absolute;
            top: 10%;
            right: 15%;
            font-size: 120px;
            opacity: 0.08;
            transform: rotate(-20deg);
            animation: float 6s ease-in-out infinite;
        }

        body::after {
            content: '🥨';
            position: absolute;
            bottom: 10%;
            left: 10%;
            font-size: 100px;
            opacity: 0.08;
            transform: rotate(15deg);
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-20deg); }
            50% { transform: translateY(-20px) rotate(-25deg); }
        }

        /* Register Container */
        .register-container {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 1;
        }

        /* Register Card */
        .register-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-beige) 100%);
        }

        /* Brand Section */
        .brand-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--color-primary) 0%, #084d14 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.2);
        }

        .brand-icon i {
            font-size: 2.5rem;
            color: var(--color-light);
        }

        .brand-title {
            font-family: 'Merriweather', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--color-primary);
            margin-bottom: 0.5rem;
        }

        .brand-subtitle {
            color: var(--color-secondary);
            font-size: 0.95rem;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            color: var(--color-primary);
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.875rem 1.125rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: #fafafa;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--color-secondary);
            box-shadow: 0 0 0 0.25rem rgba(123, 141, 99, 0.15);
            background-color: #ffffff;
        }

        .form-control.is-invalid {
            border-color: #ef5350;
        }

        .invalid-feedback {
            color: #ef5350;
            font-size: 0.85rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .invalid-feedback::before {
            content: '⚠';
        }

        /* Password Requirements */
        .password-hint {
            font-size: 0.8rem;
            color: #999;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .password-hint i {
            font-size: 0.75rem;
        }

        /* Buttons */
        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, var(--color-primary) 0%, #084d14 100%);
            color: #ffffff;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Login Link */
        .login-section {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #f0f0f0;
            margin-bottom: 0.5rem;
        }

        .login-text {
            color: #666;
            font-size: 0.95rem;
        }

        .login-link {
            color: var(--color-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .login-link:hover {
            color: var(--color-secondary);
        }

        /* Responsive */
        @media (max-width: 576px) {
            body {
                padding: 2rem 1rem;
            }

            .register-card {
                padding: 2rem 1.5rem;
            }

            .brand-title {
                font-size: 1.5rem;
            }

            .brand-icon {
                width: 60px;
                height: 60px;
            }

            .brand-icon i {
                font-size: 2rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }
        }

        @media (max-height: 800px) {
            body {
                padding: 2rem 1rem;
                align-items: flex-start;
            }

            .register-card {
                margin: 1rem 0;
            }

            .brand-section {
                margin-bottom: 1.5rem;
            }

            .form-group {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            {{-- Brand Section --}}
            <div class="brand-section">
                <div class="brand-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h1 class="brand-title">Jelly SnackO</h1>
                <p class="brand-subtitle">Daftar untuk mulai berbelanja</p>
            </div>

            {{-- Register Form --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="username"
                        placeholder="nama@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        required 
                        autocomplete="new-password"
                        placeholder="Buat password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="password-hint">
                            <i class="bi bi-info-circle"></i>
                            Minimal 8 karakter
                        </div>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        required 
                        autocomplete="new-password"
                        placeholder="Ulangi password">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Register Button --}}
                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus"></i>
                    Daftar
                </button>
            </form>

            {{-- Login Link --}}
            <div class="login-section">
                <span class="login-text">Sudah punya akun? </span>
                <a href="{{ route('login') }}" class="login-link">Masuk sekarang</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>