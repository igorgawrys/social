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
               @foreach($comment as $comment)
<form class="{{ $errors->has('content2') ? ' has-error' : '' }}" action="{{route('comments.update',$comment->id)}}" method="post">
 {{ csrf_field() }}
 {{ method_field('PUT') }}
<textarea name="content2" rows="2" cols="10" class='form-control' placeholder="Co u ciebie słychać?">{{$comment->content}}</textarea>
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
