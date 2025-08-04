<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Laravel</title>
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
            <h3 class="mb-4 text-center text-md-start">Registrasi</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" class="form-control" id="password_confirmation" name="password" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-custom">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
