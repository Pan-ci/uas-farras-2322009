<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(45deg, #6f42c1, #f78da7);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .container-box {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            max-width: 800px;
            width: 100%;
        }

        @media (min-width: 768px) {
            .container-box {
                flex-direction: row;
            }
        }

        .logo-side {
            background: linear-gradient(135deg, #6f42c1, #f78da7);
            color: white;
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .logo-text {
            font-size: 2rem;
            font-weight: bold;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .login-form {
            padding: 40px 30px;
            flex: 1;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #f78da7;
        }

        .btn-custom {
            background-color: #f78da7;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
        }

        .btn-custom:hover {
            background-color: #e05b6f;
        }

        .text-link {
            color: #6f42c1;
            text-decoration: none;
        }

        .text-link:hover {
            text-decoration: underline;
        }

        .form-check-label {
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container-box">
        <!-- Logo section -->
        <div class="logo-side">
            <div class="logo-text">BookSoul</div>
        </div>

        <!-- Form section -->
        <div class="login-form">
            <h3 class="mb-4 text-center text-md-start">Login ke Akun Anda</h3>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus autocomplete="email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-link">Lupa Sandi?</a>
                    @endif
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">Masuk</button>
                </div>

                <p class="text-center mt-4">Belum punya akun? <a href="{{ Route('register')}}" class="text-link">Daftar Sekarang</a></p>
            </form>
        </div>
    </div>

</body>
</html>
