@include('header')
<head>
    <link rel="stylesheet" href="{{ asset('CSS/organization-style.css') }}">
</head>

<body>

  <div class="container">
    <div class="org-card">
        <div class="org-title">{{$organization->name}} / {{$organization->city}} </div>
        <div class="org-meta">
          <span class="rating">میانگین امتیاز: <strong>{{number_format($organization->score , 1)}}</strong> ⭐</span>
          <span class="comments">تعداد نظرات: <strong>{{$organization->number_of_raters}}</strong></span>
        </div>
    </div>

    @if(session('UserID'))
    <div class="comment-form-card">
        <form action="{{route('createcomment')}}" method="POST">
            @csrf
            <input type="hidden" name="organization_id" value="{{$organization->id}}">
            <h2>ثبت نظر شما</h2>
            <label for="comment-text">متن نظر:</label>
            <textarea id="comment-text" rows="5" placeholder="تجربه خود را بنویسید..." name="comment" required ></textarea>
            <label for="rating">امتیاز شما:</label>
            <select id="rating" name="score" required>
                <option value="5">انتخاب امتیاز</option>
                <option value="5">⭐⭐⭐⭐⭐ (عالی)</option>
                <option value="4">⭐⭐⭐⭐ (خوب)</option>
                <option value="3">⭐⭐⭐ (متوسط)</option>
                <option value="2">⭐⭐ (ضعیف)</option>
                <option value="1">⭐ (خیلی ضعیف)</option>
            </select>
            <button type="submit">ارسال نظر</button>
        </form>
    </div>
    @else
    <div class="login-required-card">
        <p class="login-message">
            برای ثبت نظر و بازخورد ، لطفاً ابتدا وارد حساب کاربری خود شوید یا یک حساب جدید بسازید.
        </p>
        <div class="login-actions">
            <a href="{{route('login')}}" class="login-btn">ورود</a>
            <a href="{{route('register')}}" class="signup-btn">ثبت‌نام</a>
        </div>
    </div>
    @endif


    @foreach ($comments as $comment)
        <div class="comment-card">
            <div class="comment-author">{{$comment->author}}</div>
            <div class="comment-content">
            {{$comment->comment}}
            </div>
            <div class="comment-meta">
            <span class="comment-rating">امتیاز: <strong>{{$comment->organization_score}}</strong> ⭐</span>
            @if(session('UserID'))
            <a href="{{route('feedbackcomment' , ['comment_id' => $comment->id , 'feedback' => true])}}" class="comment-card-link">
                <span class="likes">👍 <strong>{{$comment->likes_count}}</strong></span>
            </a>
            <a href="{{route('feedbackcomment' , ['comment_id' => $comment->id , 'feedback' => false])}}" class="comment-card-link">
                <span class="dislikes">👎 <strong>{{$comment->dislikes_count}}</strong></span>
            </a>
            @else
            <span class="likes">👍 <strong>{{$comment->likes_count}}</strong></span>
            <span class="dislikes">👎 <strong>{{$comment->dislikes_count}}</strong></span>
            @endif
            </div>
        </div>      
    @endforeach
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