<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Soulful Deen')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body
  {
    background:#fbfaf7
  }
  </style>
</head>
<body>
 {{-- <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="/">Soulful Deen</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navmenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/chat">Chat</a></li>
        <li class="nav-item"><a class="nav-link" href="/quran/search">Quran</a></li>
        <li class="nav-item"><a class="nav-link" href="/hadith/search">Hadith</a></li>
        @guest
          <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="/register">Register</a></li>
        @else
           @if(Auth::user()->isAdmin())
            <li class="nav-item"><a class="nav-link" href="/admin">Admin</a></li>
          @endif
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li>
                <form method="POST" action="/logout">@csrf<button class="dropdown-item">Logout</button></form>
              </li>
            </ul>
          </li>
        @endguest --}}
      </ul>
    </div>
  </div>
</nav>

 <div class="container mt-4">
  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html> 
