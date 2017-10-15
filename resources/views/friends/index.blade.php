@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-body">
            <div class="row">
        @foreach($users as $user)
        <div class="col-md-6">
        <div class="panel panel-default panel-body">
<center><img src="{{asset($user->images)}}" alt="" width="160" height="160"></center>
<center><h4><a href="{{route('friends.show',$user->id)}}">{{$user->name}}</a></h4></center>
        </div>
</div>
        @endforeach
                    </div>

                    <center>{{$users->links()}}</center>
</div>
</div>
</div>
</div>
</div>
@endsection
