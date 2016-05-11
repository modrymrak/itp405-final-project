@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row col-md-10 col-md-offset-1">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
      <?php echo csrf_field() ?>
      <div class="form-group">
        <div class="col-md-4">
          <input type="text" class="form-control" name="q" >
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary">
              Search
            </button>
        </div>
      </div>
    </form>
  </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <table class="table table-hover">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Posted by</th>
                  <th>Posted on</th>
                  <th>Country</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($articles as $article)
                <tr>
                  <td>{{$article->title}}</td>
                  <td>{{$article->name}}</td>
                  <td>{{$article->created_at}}</td>
                  <td>{{$article->country_name}}</td>
                  <td><a href="{{$article->url}}" target="_blank" ><button type="button" class="btn btn-success">Link</button></a></td>
                  <td><a id="commentFor{{$article->id}}" href="article/{{$article->id}}"><button type="button" class="btn btn-info">Comments</button></a></td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
    </div>
</div>

@endsection
