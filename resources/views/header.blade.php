<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ask Seeve</title>
  <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v30.1.0/dist/font-face.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('CSS/header-style.css') }}">
</head>
<body>

<header>
  <div class="menu-icon" onclick="toggleMenu()">
    <div></div>
    <div></div>
    <div></div>
  </div>
  <nav id="nav">
    <a href="{{route('main')}}">صفحه اصلی</a>
    <a href="{{route('search')}}">جستجو</a>
    @if(session('UserID'))
    <a href="{{route('logout')}}">خروج</a>
    @else
    <a href="{{route('login')}}">ورود</a>
    @endif
  </nav>
  <div class="logo">Ask Serve</div>
</header>

<script>
  function toggleMenu() {
    const nav = document.getElementById('nav');
    nav.classList.toggle('active');
  }
</script>

</body>
</html>
