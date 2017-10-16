@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-body">
              @foreach($comments as $comment)
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
@elseif(Auth::user()->role==1)
<div class="dropdown pull-right"><div id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></div>
<ul aria-labelledby="dLabel" class="dropdown-menu">
<li><a href="{{route('comments.edit',$comment->id)}}">Edytuj</a></li>
<li><a href="{{route('comments.destroy',$comment->id)}}"   onclick="event.preventDefault();document.getElementById('destroy-form{{$comment->id}}').submit();">Skasuj</a></li>
<li><a href="#">Zapisz link</a></li>
<form id="destroy-form{{$comment->id}}" action="{{route('comments.destroy',$comment->id)}}" method="POST" style="display: none;">
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
<img src="{{asset(DB::table('users')->where('id', $comment->ower_id)->value('images'))}}" alt="" width="40">
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
    </div>
</div>
@endsection
