@include('header')
<head>
  <link rel="stylesheet" href="{{ asset('CSS/create_organization.blade-style.css') }}">
</head>

<body>


  <div class="container">
    <div class="org-create-form">
      <h2>ثبت سازمان جدید </h2>
      <form action="{{route('createorganization')}}" method="POST">
        @csrf
        <div class="form-group">
          <label for="orgName">نام سازمان</label>
          <input type="text" id="orgName" name="name" placeholder="مثلاً شهرداری منطقه ۵" />
        </div>
        <div class="form-group">
          <label for="city">شهر</label>
          <input type="text" id="city" name="city" placeholder="مثلاً تهران" />
        </div>
        <button type="submit">ثبت</button>
      </form>
    </div>
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
