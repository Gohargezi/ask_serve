@include('header')
<head>
  <link rel="stylesheet" href="{{ asset('CSS/admin_panel-style.css') }}">
</head>
<body>

  <div class="cards-container">
    @if ($unpublishedOrganizations->count() + $unpublishedComments->count() == 0)
      <h1>هیچ درخواستی برای تایید یا رد وجود ندارد</h1>
    @endif
    @foreach($unpublishedOrganizations as $organization)
      <div class="card">
        <h3>{{$organization->name}} / {{$organization->city}}</h3>
        <div class="btn-container">
          <a href="{{route('publishOrganization' , ['organization_id' => $organization->id])}}" class="btn btn-accept">تایید</a>
          <a href="{{route('rejectOrganization' , ['organization_id' => $organization->id])}}" class="btn btn-reject">رد</a>
        </div>
      </div>
    @endforeach

    @foreach($unpublishedComments as $comment)
    <div class="card">
      <h3>{{$comment->author}}</h3>
      <p>{{$comment->comment}}</p>
      <div class="btn-container">
        <a href="{{route('publishComment' , ['comment_id' => $comment->id])}}" class="btn btn-accept">تایید</a>
        <a href="{{route('rejectComment' , ['comment_id' => $comment->id])}}" class="btn btn-reject">رد</a>
      </div>
    </div>
    @endforeach

  </div>

</body>
</html>

@include('footer')




