@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          @if(Auth::user())
          @endif
            <div class="panel panel-default">
          <div class="panel-body">
          @foreach($profiles2 as $profil)
          <div class="media">
  <div class="media-left">
  <img src="{{asset($profil->images)}}" alt="" width='128' height="128">
  </div>
  <div class="media-body">
    <h4 class="media-heading"><a href="{{route('profiles.show',$profil->id)}}">{{$profil->name}}</a></h4>
    <p>Płeć:@if($profil->sex==0) Kobieta @endif @if($profil->sex==1) Mężczyzna @endif</p>
    <p>Email:{{$profil->email}}</p>
    </div>
</div>
          @endforeach
          </div>
        </div>
    <div class="panel panel-default panel-body">
      @if(DB::table('friends')->where('one_friends_id',$profil->id)->orwhere('two_friends_id',$profil->id)->count()==0)
      <center><h4>Ten profil nie ma żadnych znajomych</h4></center>
      @else
        <h4>Znajomi:</h4>
      @endif
      <div class="row">
      @foreach(DB::table('friends')->where('status','success')->where('one_friends_id',$profil->id)->orwhere('two_friends_id',$profil->id)->paginate(4) as $friend)
     @if($friend->one_friends_id==$profil->id)
     <div class="col-md-6">
       <center>
<div class="panel panel-default panel-body">
  <img src="{{asset(DB::table('users')->where('id',$friend->two_friends_id)->value('images'))}}" alt="">
   <a href="{{route('profiles.show',$friend->two_friends_id)}}"><h4>{{DB::table('users')->where('id',$friend->two_friends_id)->value('name')}}</h4></a>
</div>
</center>
     </div>
@endif
@if($friend->two_friends_id==$profil->id)
<div class="col-md-6">
  <div class="panel panel-default panel-body">
  <center>
    <img src="{{asset(DB::table('users')->where('id',$friend->one_friends_id)->value('images'))}}" alt="">
    <a href="{{route('profiles.show',$friend->one_friends_id)}}"><h4>{{DB::table('users')->where('id',$friend->one_friends_id)->value('name')}}</h4></a>
  </center>
  </div>
</div>
@endif
  @endforeach
</div>
    <center>{{DB::table('friends')->where('one_friends_id',$profil->id)->orwhere('two_friends_id',$profil->id)->paginate(4)->links()}}</center>
      </div>
        </div>
    </div>
</div>
@endsection
