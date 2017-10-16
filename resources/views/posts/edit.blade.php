@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
          <div class="panel-body">
            @if ($errors->any())
                       @foreach ($errors->all() as $error)
                        <div class="text-danger">
                          {{ $error }}
                                    </div>
                       @endforeach
               @endif
               @foreach($post as $post)
<form class="{{ $errors->has('content') ? ' has-error' : '' }}" action="{{route('posts.update',$post->id)}}" method="post">
 {{ csrf_field() }}
 {{ method_field('PUT') }}
<textarea name="content" rows="8" cols="80" class='form-control' placeholder="Co u ciebie słychać?">{{$post->content}}</textarea>
<br/>
<input type="submit" name="" value="Zaktualizuj" class='btn btn-primary btn-block'>
</form>
          </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
