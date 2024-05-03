<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <title>@yield('title')</title>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .error-container {
      text-align: center;
      margin-top: 100px;
    }
    .error-heading {
      font-size: 72px;
      margin-bottom: 20px;
    }
    .error-message {
      font-size: 24px;
      color: #6c757d;
      margin-bottom: 30px;
    }
    .error-link {
      color: #007bff;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="error-container">
      <h1 class="error-heading text-primary">@yield('error')</h1>
      <p class="error-message">Oops ! @yield('oops')</p>
      <p>@yield('message')</p>
      <a href="{{ route('index') }}" class="error-link">Aller à la page d'accueil</a>
    </div>
  </div>
</body>
</html>
