@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
          @foreach($profiles as $profil)
          <div class="col-md-6">
            <div class="panel panel-default panel-body">
          <center><img src="{{asset($profil->images)}}" alt="" width='160'>
          <h4>{{$profil->name}}</h4>
          <div class="row">
            <div class="col-xs-6">
          <a href="{{route('profiles.show',$profil->id)}}" class='btn btn-primary btn-block'>Zobacz profil</a>
            </div>
            <div class="col-xs-6">
          <a href="#" class='btn btn-primary btn-block'>Lubię to</a>
            </div>
          </div>
        </center>
            </div>
          </div>
          @endforeach
        </div>
            <center>{{$profiles->links()}}</center>
          </div>
            </div>
        </div>
    </div>
</div>
@endsection
