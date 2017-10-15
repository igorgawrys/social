@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-body">
                @if($searchc==0)
                <div class="panel panel-default panel-body">
<center><h4>Nie znaleziono wyników dla:{{$q}}</h4></center>
                </div>
                @else
              Około {{$searchc}} wyników
                @endif
            <div class="row">
        @foreach($search as $searchs)
        <div class="col-md-6">
        <div class="panel panel-default panel-body">
<center><img src="{{asset($searchs->images)}}" alt="" width="160" height="160"></center>
<center><h4><a href="{{route('profiles.show',$searchs->id)}}">{{$searchs->name}}</a></h4></center>
        </div>
</div>
        @endforeach
                    </div>

                    <center>{{$search->appends(array('q' => $q))->links()}}</center>
</div>
</div>
</div>
</div>
</div>
@endsection
