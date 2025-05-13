@include('header')

<head>
  <link rel="stylesheet" href="{{ asset('CSS/main-style.css') }}">
</head>
<body>


  <main class="container">
    <section class="intro">
      <h1>سامانه ارزیابی خدمات عمومی</h1>
      <img src="image.jpg" alt="تصویر مربوط به خدمات عمومی" class="intro-image" />
      <p>
        Ask Seeve بستری آنلاین برای جمع‌آوری نظرات شما درباره خدمات ارائه‌شده توسط سازمان‌های دولتی و عمومی است. هدف ما ارتقای کیفیت خدمات از طریق شنیدن صدای مردم و تحلیل بازخوردهای واقعی است.
        در این سامانه می‌توانید تجربه‌های خود را از ادارات، بانک‌ها، شهرداری‌ها و دیگر نهادهای عمومی ثبت و مشاهده کنید.
      </p>
    </section>

    <section >
      <h2 class="container">۵ سازمان برتر از دید کاربران</h2>
      @foreach ($organizations as $organization)
      <div class="org-card">
        <div class="org-title">{{$organization->name}} / {{$organization->city}} </div>
        <div class="org-meta">
          <span class="rating">میانگین امتیاز: <strong>{{number_format($organization->score , 1)}}</strong> ⭐</span>
          <span class="comments">تعداد نظرات: <strong>{{$organization->number_of_raters}}</strong></span>
        </div>
      </div>
      @endforeach
    </section>
  </main>

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