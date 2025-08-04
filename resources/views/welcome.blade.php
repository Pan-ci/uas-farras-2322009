<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero-section {
            background: linear-gradient(45deg, #6f42c1, #f78da7);
            color: white;
            padding: 100px 0;
        }
        .hero-text {
            font-size: 3rem;
            font-weight: bold;
        }
        .btn-custom {
            background-color: #f78da7;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1.2rem;
            border-radius: 5px;
            text-transform: uppercase;
        }
        .btn-custom:hover {
            background-color: #e05b6f;
        }
    </style>
</head>
<body>

    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-text">Selamat Datang di BookSoul!</h1>
            <p class="lead mt-4">Membaca buku dengan jiwa</p>
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="btn btn-custom mt-4"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="btn btn-custom mt-4"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="btn btn-custom mt-4">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    </section>

    <footer class="text-center py-4">
        <p>&copy; 2025 BookSoul. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
