<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GoGlary') }} - @yield('title', 'Login')</title>

    <!-- GoGlary CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/goglary.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">

    <!-- Guest Layout Styles -->
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9eef5 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .guest-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 420px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .guest-header {
            background: linear-gradient(135deg, #59ab6e 0%, #56ae6c 100%);
            color: white;
            padding: 30px 40px 20px;
            text-align: center;
        }

        .guest-header .logo {
            font-size: 32px;
            font-weight: 500;
            margin-bottom: 10px;
            color: white;
        }

        .guest-header h1 {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 5px;
        }

        .guest-header p {
            font-size: 14px;
            margin: 0;
            opacity: 0.9;
        }

        .guest-body {
            padding: 40px;
        }

        .guest-footer {
            background: #f8f9fa;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }

        .guest-footer a {
            color: #59ab6e;
            text-decoration: none;
            font-weight: 500;
        }

        .guest-footer a:hover {
            text-decoration: underline;
        }

        /* Form Styles */
        .form-control {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            height: 48px;
        }

        .form-control:focus {
            border-color: #59ab6e;
            box-shadow: 0 0 0 0.2rem rgba(89, 171, 110, 0.25);
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        /* Input Group Fix */
        .input-group {
            position: relative;
            display: flex;
        }

        .input-group-text {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-right: none;
            color: #6c757d;
            border-radius: 8px 0 0 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            z-index: 4;
        }

        .input-group .form-control {
            border-radius: 0 8px 8px 0;
            border-left: none;
            flex: 1;
        }

        .input-group .form-control:focus {
            border-color: #59ab6e;
            box-shadow: 0 0 0 0.2rem rgba(89, 171, 110, 0.25);
            z-index: 3;
        }

        .input-group .form-control:focus + .input-group-text,
        .input-group:focus-within .input-group-text {
            border-color: #59ab6e;
        }

        /* Button Styles */
        .btn-guest {
            background: linear-gradient(135deg, #59ab6e 0%, #56ae6c 100%);
            border: none;
            border-radius: 8px;
            padding: 14px;
            width: 100%;
            color: white;
            font-weight: 500;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-guest:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(89, 171, 110, 0.3);
            color: white;
        }

        /* Checkbox Styles */
        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            border-radius: 4px;
            border: 2px solid #dee2e6;
        }

        .form-check-input:checked {
            background-color: #59ab6e;
            border-color: #59ab6e;
        }

        .form-check-label {
            margin: 0;
            font-size: 14px;
            color: #495057;
            cursor: pointer;
        }

        /* Alert Styles */
        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            color: #856404;
        }

        /* Links */
        .text-link {
            color: #59ab6e;
            text-decoration: none;
            font-weight: 500;
        }

        .text-link:hover {
            text-decoration: underline;
            color: #56ae6c;
        }

        /* Mobile Responsive */
        @media (max-width: 576px) {
            .guest-container {
                margin: 10px;
                max-width: none;
            }

            .guest-header,
            .guest-body,
            .guest-footer {
                padding-left: 30px;
                padding-right: 30px;
            }

            .guest-header h1 {
                font-size: 20px;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .guest-container {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Form Labels */
        .form-label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* Error Messages */
        .text-danger {
            font-size: 12px;
            margin-top: 5px;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="guest-container">
        <div class="guest-header">
            <div class="logo">GoGlary</div>
            <h1>@yield('page-title', 'Welcome Back')</h1>
            <p>@yield('page-subtitle', 'Please sign in to continue')</p>
        </div>

        <div class="guest-body">
            @yield('content')
        </div>

        <div class="guest-footer">
            @yield('footer')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    @stack('scripts')
</body>
</html>
