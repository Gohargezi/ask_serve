@include('header')

<head>
  <link rel="stylesheet" href="{{ asset('CSS/login-style.css') }}">
</head>
<body>


  <div class="container">
    <h2>ورود به سامانه Ask Seeve</h2>
    <form action="{{route('login' , ['email' => 'email' , 'password' => 'password'])}}">
      <input type="email" name="email" placeholder="ایمیل" required>
      <input type="password" name="password" placeholder="رمز عبور" required>
      <button type="submit" class="btn btn-login">ورود</button>
    </form>
    <a href="{{route('register')}}"> <button class="btn btn-register">ثبت نام</button></a>
    <a href="{{route('password_recovery')}}">بازیابی / تغییر رمز عبور </a>
  </div>

</body>
@include('footer')

@if (session('error') )
<script> 
  var message = "{{session('error')}}" ;
</script>
@include('popup')
@elseif (session('success'))
<script> 
  var message = "{{session('success')}}" ;
</script>
@include('popup')
@endif
