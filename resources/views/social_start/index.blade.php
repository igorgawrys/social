@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
          <div class="panel-body">
            @if ($errors->has('content'))
                      <div class="text-danger">
                        {{$errors->first('content') }}
                                  </div>
             @endif
<form class="{{ $errors->has('content') ? ' has-error' : '' }}" action="{{route('social_start.store')}}" method="post">
 {{ csrf_field() }}
<textarea name="content" rows="8" cols="80" class='form-control' placeholder="Co u ciebie słychać?"></textarea>
<br/>
<input type="submit" name="" value="Opublikuj" class='btn btn-primary btn-block'>
</form>
          </div>
            </div>
            @if($friendc==0)
                        @foreach(DB::table('posts')->where('ower_id',Auth::user()->id)->get() as $post)
                        <div class="panel panel-default">
            <div class="panel-body">
              @if(Auth::user())
              @if(Auth::user()->id==$post->ower_id)
              <div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
              <ul aria-labelledby="dLabel" class="dropdown-menu">
            <li><a href="{{route('social_start.edit',$post->id)}}">Edytuj</a></li>
            <li><a href="{{ route('social_start.destroy',$post->id) }}"   onclick="event.preventDefault();document.getElementById('destroy-form{{$post->id}}').submit();">Skasuj</a></li>
<li><a href="#">Zapisz link</a></li>
            <form id="destroy-form{{$post->id}}" action="{{ route('social_start.destroy',$post->id) }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
              </ul></div>
            @else
            <div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
            <ul aria-labelledby="dLabel" class="dropdown-menu">
              <li><a href="#">Zapisz link</a></li>
            <li><a href="#">Zgłoś post</a></li>
            </ul></div>
            @endif
            @endif
            @if($post->updated_at==NULL)
            @else
            Zaktualizowane {{$post->updated_at}}
            @endif
              <div class="media">
                <div class="media-left">
                  <a href="#">
                    <img class="media-object" src="{{asset(DB::table('users')->where('id',$post->ower_id)->value('images'))}}" alt="" width="80">
                        </a>
                </div>
                  <div class="media-body">
                      <h4 class="media-heading"><a href="{{route('profiles.show',DB::table('users')->where('id',$post->ower_id)->value('id'))}}">{{DB::table('users')->where('id',$post->ower_id)->value('name')}}</a></h4>
                      <p><i class="fa fa-clock-o" aria-hidden="true"> </i> <a href="{{route('social_start.show',$post->id)}}">{{$post->created_at}} </a></p>
                  </div>
                </div>
              <br/>
              @if($post->images==NULL)
              @else
            <center><img src="{{asset($post->images)}}" alt="" width='400'></center>
            <br/>
            @endif
            @if($post->videos==NULL)
            @else
            <center>
              <div class="flowplayer">
                <video>
                  <source type="video/mp4"
                          src="{{asset($post->videos)}}">
                  </video>
              </div>
            </center>
            <br/>
            @endif
              <div class="panel panel-default panel-body">
              {{$post->content}}
              </div>
              @if(Auth::user())
              <hr>
              <form class="" action="{{route('comments.store')}}" method="post">
                    {{ csrf_field() }}
              <div class="media">
            <div class="media-left">
            <img class="media-object" src="{{asset(Auth::user()->images)}}" alt="" width="40">
            </div>
            <div class="media-body">
              @if ($errors->has('content2'))
                        <div class="text-danger">
                          {{$errors->first('content2') }}
                                    </div>
               @endif
            <textarea name="content2" rows="2" cols='10' class='media-heading form-control' placeholder="Skomentuj" required></textarea>
            </div>
              </div>
              <input type="submit" name="" value="Dodaj komentarz" class='btn btn-default pull-right'>
                          <input type="hidden" name="post_id" value="{{$post->id}}">
            </form>
              @endif
              <br/>

@foreach(DB::table('comments')->where('post_id',$post->id)->orderby('id','desc')->get() as $comment)
<hr>
<div class="pull-right">
@if(Auth::user())
@if(Auth::user()->id==$comment->ower_id)
<div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
<ul aria-labelledby="dLabel" class="dropdown-menu">
<li><a href="{{route('comments.edit',$comment->id)}}">Edytuj</a></li>
<li><a href=""   onclick="event.preventDefault();document.getElementById('destroy-form{{$comment->id}}').submit();">Skasuj</a></li>
<li><a href="#">Zapisz link</a></li>
<form id="destroy-form{{$comment->id}}" action="" method="POST" style="display: none;">
{{ csrf_field() }}
{{ method_field('DELETE') }}
</form>
</ul></div>
@else
<div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
<ul aria-labelledby="dLabel" class="dropdown-menu">
<li><a href="#">Zapisz link</a></li>
<li><a href="#">Zgłoś post</a></li>
</ul></div>
@endif
@endif
</div>
<div class="media">
<div class="media-left">
<img src="{{asset(DB::table('users')->where('id',$comment->ower_id)->value('images'))}}" alt="" width="40">
</div>
<div class="media-body">
    <h4 class="media-heading"><a href="{{route('profiles.show',DB::table('users')->where('id',$comment->ower_id)->value('id'))}}">{{DB::table('users')->where('id',$comment->ower_id)->value('name')}}</a></h4>
<p>{{$comment->content}}</p>
@if($comment->updated_at==NULL)
@else
Zaktualizowane {{$comment->updated_at}}
@endif
  <p><i class="fa fa-clock-o" aria-hidden="true"> </i> <a href="{{route('comments.show',$comment->id)}}">{{$comment->created_at}} </a></p>

</div>
</div>
  @endforeach
            </div>
                        </div>
                        @endforeach
                        @endif
            @foreach($friends as $friend)
            @foreach(DB::table('posts')->where('ower_id',$friend->one_friends_id)->orwhere('ower_id',$friend->two_friends_id)->orwhere('ower_id',Auth::user()->id)->orderBy('id','desc')->get() as $post)
            <div class="panel panel-default">
<div class="panel-body">
  @if(Auth::user())
  @if(Auth::user()->id==$post->ower_id)
  <div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
  <ul aria-labelledby="dLabel" class="dropdown-menu">
<li><a href="{{route('social_start.edit',$post->id)}}">Edytuj</a></li>
<li><a href="{{ route('social_start.destroy',$post->id) }}"   onclick="event.preventDefault();document.getElementById('destroy-form{{$post->id}}').submit();">Skasuj</a></li>
<li><a href="#">Zapisz link</a></li>

<form id="destroy-form{{$post->id}}" action="{{ route('social_start.destroy',$post->id) }}" method="POST" style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
  </ul></div>
@else
<div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
<ul aria-labelledby="dLabel" class="dropdown-menu">
  <li><a href="#">Zapisz link</a></li>
<li><a href="#">Zgłoś post</a></li>
</ul></div>
@endif
@endif
@if($post->updated_at==NULL)
@else
Zaktualizowane {{$post->updated_at}}
@endif
  <div class="media">
    <div class="media-left">
      <a href="#">
        <img class="media-object" src="{{asset(DB::table('users')->where('id',$post->ower_id)->value('images'))}}" alt="" width="80">
            </a>
    </div>
      <div class="media-body">
          <h4 class="media-heading"><a href="{{route('profiles.show',DB::table('users')->where('id',$post->ower_id)->value('id'))}}">{{DB::table('users')->where('id',$post->ower_id)->value('name')}}</a></h4>
            <p><i class="fa fa-clock-o" aria-hidden="true"> </i> <a href="{{route('social_start.show',$post->id)}}">{{$post->created_at}} </a></p>
      </div>
    </div>
  <br/>
  @if($post->images==NULL)
  @else
<center><img src="{{asset($post->images)}}" alt="" width='400'></center>
<br/>
@endif
@if($post->videos==NULL)
@else
<center>
  <div class="flowplayer">
    <video>
      <source type="video/mp4"
              src="{{asset($post->videos)}}">
      </video>
  </div>
</center>
<br/>
@endif
  <div class="panel panel-default panel-body">
  {{$post->content}}
  </div>
  @if(Auth::user())
  <hr>
  <form class="" action="{{route('comments.store')}}" method="post">
        {{ csrf_field() }}
  <div class="media">
<div class="media-left">
<img class="media-object" src="{{asset(Auth::user()->images)}}" alt="" width="40">
</div>
<div class="media-body">
  @if ($errors->has('content2'))
            <div class="text-danger">
              {{$errors->first('content2') }}
                        </div>
   @endif
<textarea name="content2" rows="2" cols='10' class='media-heading form-control' placeholder="Skomentuj" required></textarea>
</div>
  </div>
  <input type="submit" name="" value="Dodaj komentarz" class='btn btn-default pull-right'>
              <input type="hidden" name="post_id" value="{{$post->id}}">
</form>
  @endif
  <br/>

@foreach(DB::table('comments')->where('post_id',$post->id)->orderby('id','desc')->get() as $comment)
<hr>
<div class="pull-right">
@if(Auth::user())
@if(Auth::user()->id==$comment->ower_id)
<div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
<ul aria-labelledby="dLabel" class="dropdown-menu">
<li><a href="{{route('comments.edit',$comment->id)}}">Edytuj</a></li>
<li><a href=""   onclick="event.preventDefault();document.getElementById('destroy-form{{$comment->id}}').submit();">Skasuj</a></li>
<li><a href="#">Zapisz link</a></li>
<form id="destroy-form{{$comment->id}}" action="" method="POST" style="display: none;">
{{ csrf_field() }}
{{ method_field('DELETE') }}
</form>
</ul></div>
@else
<div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
<ul aria-labelledby="dLabel" class="dropdown-menu">
<li><a href="#">Zapisz link</a></li>
<li><a href="#">Zgłoś post</a></li>
</ul></div>
@endif
@endif

</div>
<div class="media">
<div class="media-left">
<img src="{{asset(DB::table('users')->where('id',$comment->ower_id)->value('images'))}}" alt="" width="40">
</div>
<div class="media-body">
  <h4 class="media-heading"><a href="{{route('profiles.show',DB::table('users')->where('id',$comment->ower_id)->value('id'))}}">{{DB::table('users')->where('id',$comment->ower_id)->value('name')}}</a></h4>
<p>{{$comment->content}}</p>
@if($comment->updated_at==NULL)
@else
Zaktualizowane {{$comment->updated_at}}
@endif
  <p><i class="fa fa-clock-o" aria-hidden="true"> </i> <a href="{{route('comments.show',$comment->id)}}">{{$comment->created_at}} </a></p>
</div>
</div>
@endforeach
</div>
            </div>
            @endforeach
            @endforeach
        </div>
    </div>
</div>
@endsection
