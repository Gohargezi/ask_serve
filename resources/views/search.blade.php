@include('header')
<head>
  <link rel="stylesheet" href="{{ asset('CSS/search-style.css') }}">
</head>


<body>

  <div class="container">
    <div class="search-box">
      <h2>جست‌وجوی سازمان</h2>
      <form method="GET" action="{{route('search')}}">
        <div class="form-group">
          <label for="orgName">نام سازمان</label>
          <input type="text" id="orgName" name="name" placeholder="مثلاً شهرداری منطقه ۵" />
        </div>
        <div class="form-group">
          <label for="city">شهر</label>
          <input type="text" id="city" name="city" placeholder="مثلاً تهران" />
        </div>
        <button type="submit">جست‌وجو</button>
      </form>
    </div>
    

    @if($organizations->count() == 0 && request()->has('name') && request()->has('city'))
    <div class="not-found-card">
      <h2>سازمان مورد نظر یافت نشد</h2>
      <p>در صورتی که اطلاعات این سازمان در سامانه ثبت نشده، می‌توانید آن را اضافه کنید.</p>
      <a href="{{route('createorganization')}}" class="add-btn">افزودن سازمان جدید</a>
    </div>

    @elseif ($organizations->count() > 0 )
    @foreach ($organizations as $organization)
    <a href="{{route('organization' , $organization->id)}}" class="org-card-link">
      <div class="org-card">
        <div class="org-title">{{$organization->name}} / {{$organization->city}}</div>
        <div class="org-meta">
          <span class="rating">میانگین امتیاز: <strong>{{number_format($organization->score , 1)}}</strong> ⭐</span>
          <span class="comments">تعداد نظرات: <strong>{{$organization->number_of_raters}}</strong></span>
        </div>
      </div>
    </a>
    @endforeach
    @endif
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