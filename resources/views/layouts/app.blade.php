<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nusakita')</title>
    <link rel="icon" href="{{ secure_asset('lte/assets/img/favicon.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <!-- Font Rubik untuk dashboard -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap" rel="stylesheet">

</head>
<body>
    @include('layouts.navbar')
    <div class="row">
        <div class="col-md-10">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
        <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Telegram Login Widget -->
    <script async src="https://telegram.org/js/telegram-widget.js?7"
            data-telegram-login="@mrIndoBot" 
            data-size="large"
            data-radius="10"
            data-auth-url="{{ url('auth/telegram/callback') }}"
            data-request-access="write"></script>
</body>
</html>
