@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
          Article Comments
        </div>
          <div class="panel-body col-md-12">
              <div class="col-md-4">
                <p>Title:</p>
                  <p>  Posted on:</p>
                  <p>Posted by:</p>
                  <p>Country:</p>
                  <p>Url: </p>
              </div>
              <div class="col-md-8">
                <p> {{$article[0]->title}}</p>
                <p>  {{$article[0]->created_at}}</p>
                <p>  {{$article[0]->name}}</p>
                <p>   {{$article[0]->country_name}}</p>
                <a href="{{$article[0]->url}}" target="_blank"> {{$article[0]->url}} </a>
              </div>
            </div>
    </div>
  </div>
  <div class="col-md-8 col-md-offset-2">
    <form class="form-horizontal" role="form" method="POST" action="/article/{{$id}}">
      <?php echo csrf_field() ?>
        <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
          <div class="col-md-4">
            <input type="text" class="form-control" name="content" value="{{ old('content') }}" >
            @if ($errors->has('content'))
                <span class="help-block">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
          </div>
          <div class="col-md-1">
              <button type="submit" class="btn btn-primary">
                POST
              </button>
          </div>
        </div>
    </form>
    <div class="panel-group">
    @foreach ($comments as $comment)
      <div class="panel panel-primary">
          <div class="panel-body">
            {{$comment->text}}
          </div>
          <div class="panel-footer">
            By {{$comment->user_name}} on {{$comment->created_at}}
          </div>
      </div>
    @endforeach
    </div>
  </div>

</div>
@endsection
