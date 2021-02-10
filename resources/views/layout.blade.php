<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="container">
        <a class="navbar-brand mr-3">Campaign Manager</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<div class="container">
    @yield('content')
    <hr>
    <footer>
        <div class="row">
            <div class="col-md-12 text-md-right">
                <p>Copyright &copy; {{ date('Y') }}</p>
            </div>
        </div>
    </footer>
</div>
<!-- React JS -->
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
