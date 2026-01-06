<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jelly SnackO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

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

            0%,
            100% {
                transform: translateY(0) rotate(-20deg);
            }

            50% {
                transform: translateY(-20px) rotate(-25deg);
            }
        }

        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 480px;
            position: relative;
            z-index: 1;
        }

        /* Login Card */
        .login-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
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

        /* Session Status */
        .session-status {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border: 2px solid #66bb6a;
            border-radius: 12px;
            color: #2e7d32;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .session-status::before {
            content: '✓';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            background-color: #2e7d32;
            color: #ffffff;
            border-radius: 50%;
            font-weight: 700;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            color: var(--color-primary);
            font-weight: 600;
            font-size: 0.95rem;
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

        /* Checkbox */
        .remember-section {
            margin: 1.5rem 0;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            margin-right: 0.75rem;
            cursor: pointer;
            accent-color: var(--color-primary);
        }

        .checkbox-text {
            color: #666;
            font-size: 0.9rem;
        }

        /* Buttons */
        .btn-login {
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
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Links */
        .action-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .forgot-link {
            color: var(--color-secondary);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--color-primary);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 2rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }

        .divider span {
            padding: 0 1rem;
            color: #999;
            font-size: 0.85rem;
        }

        /* Register Link */
        .register-section {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #f0f0f0;
            margin-bottom: 0.5rem;
        }

        .register-text {
            color: #666;
            font-size: 0.95rem;
        }

        .register-link {
            color: var(--color-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .register-link:hover {
            color: var(--color-secondary);
        }

        /* Responsive */
        @media (max-width: 576px) {
            body {
                padding: 2rem 1rem;
            }

            .login-card {
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
        }

        @media (max-height: 700px) {
            body {
                padding: 2rem 1rem;
                align-items: flex-start;
            }

            .login-card {
                margin: 1rem 0;
            }

            .brand-section {
                margin-bottom: 1.5rem;
            }
        }

        /* ... style .btn-login yang sudah ada ... */

        /* Style Khusus Tombol Google */
        .btn-google {
            width: 100%;
            background-color: #ffffff;
            color: #4a4a4a;
            border: 2px solid #e0e0e0;
            /* Samakan tebal border dengan input */
            padding: 1rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            text-decoration: none;
            position: relative;
        }

        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #c0c0c0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            color: #000;
        }

        .btn-google:active {
            transform: translateY(0);
        }

        /* Mewarnai Icon Google agar khas */
        .btn-google i {
            font-size: 1.2rem;
            background: linear-gradient(135deg, #4285F4 0%, #EA4335 50%, #FBBC05 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            /* Jika browser tidak support gradient text, fallback ke warna merah Google */
            color: #EA4335;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            {{-- Brand Section --}}
            <div class="brand-section">
                <div class="brand-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h1 class="brand-title">Jelly SnackO</h1>
                <p class="brand-subtitle">Selamat datang kembali!</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Login Form --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                        autofocus autocomplete="username" placeholder="nama@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror" required
                        autocomplete="current-password" placeholder="Masukkan password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="remember-section">
                    <label class="checkbox-label">
                        <input type="checkbox" id="remember_me" name="remember" class="checkbox-input">
                        <span class="checkbox-text">Ingat saya</span>
                    </label>
                </div>

                {{-- Action Links --}}
                <div class="action-links">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Lupa password?
                        </a>
                    @endif
                </div>

                {{-- Login Button --}}
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk
                </button>
                {{-- Divider --}}
                <div class="divider">
                    <span>atau</span>
                </div>

                {{-- Google Login Button --}}
                <a href="{{ route('google.login') }}" class="btn-google">
                    <i class="bi bi-google"></i>
                    <span>Masuk dengan Google</span>
                </a>


            </form>

            {{-- Register Link --}}
            @if (Route::has('register'))
                <div class="register-section">
                    <span class="register-text">Belum punya akun? </span>
                    <a href="{{ route('register') }}" class="register-link">Daftar sekarang</a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
