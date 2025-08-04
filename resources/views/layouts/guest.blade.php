<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="container-box">
            {{ $slot }}
        </div>
    </body>
</html>
