@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row col-md-10 col-md-offset-1">
    <p>The Guardian Article Search</p>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/guardian') }}">
      <?php echo csrf_field() ?>
      <div class="form-group">
        <div class="col-md-4">
          <input type="text" class="form-control" name="q" >
        </div>
        <div class="col-md-1">
            <button id="submitSearch" type="submit" class="btn btn-primary">
              Search
            </button>
        </div>
      </div>
    </form>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <table class="table table-hover">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Posted on</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($articles as $article)
                <tr>
                  <td>{{$article->webTitle}}</td>
                  <td>{{$article->webPublicationDate}}</td>
                  <td><a href="{{$article->webUrl}}" target="_blank" ><button type="button" class="btn btn-success">Link</button></a></td>
                  <td>
                    <form action="/new" method="post" role="form" class = "form">
                      <?php echo csrf_field() ?>
                      <input type="hidden" name="title" value="{{$article->webTitle}}">
                      <input type="hidden" name="url" value="{{$article->webUrl}}">
                      <input type="hidden" name="guardian" value="true">
                      <button id="submitButton" type="submit" class="btn btn-info">Add to site</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
    </div>
  </div>
</div>

@endsection
