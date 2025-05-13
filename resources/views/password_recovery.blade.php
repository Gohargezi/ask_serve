@include('header')

<head>
  <link rel="stylesheet" href="{{ asset('CSS/login-style.css') }}">
</head>
<body>

  <div class="container">
    <h2>بازیابی رمز عبور</h2>
    <form action="{{route('password_recovery' , ['name' => 'name' , 'email' => 'email' , 'password' => 'password'])}}">
      <input type="text" name="name" placeholder="نام" required>
      <input type="email" name="email" placeholder="ایمیل" required>
      <input type="password" name="password" placeholder=" رمز عبور جدید" required>
      <button type="submit" class="btn btn-login">بازیابی</button>
    </form>
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
