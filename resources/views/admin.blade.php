@extends('layouts.master')

@section('body')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
      <p>Select Records Table to view and delete</p>
      <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin') }}">
        <?php echo csrf_field() ?>
        <div class="form-group form-group ">
            <div class="col-md-6">
              <select name="Option"  class="form-control">
                    <option value="users">Users</option>
                    <option value="articles">Articles</option>
              </select>
            </div>
            <div class="col-md-1">
                <button id="submitButton" type="submit" class="btn btn-primary">
                  Show
                </button>
            </div>
        </div>

        </form>
        <div>
          @if(isset($users))
          <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                          <form action="/delete/{{$user->id}}" method="post" role="form" class = "form">
                            <?php echo csrf_field() ?>
                            <input type="hidden" name="deleteId" value="{{$user->id}}">
                            <input type="hidden" name="deleteItem" value="user">
                            <button type="submit" class="btn btn-danger">Delete</button>
                          </form>

                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
          </div>
          @endif
          @if(isset($articles))
          <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>URL</th>
                        <th>Created at</th>
                        <th>Posted by</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($articles as $article)
                      <tr>
                        <td>{{$article->id}}</td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->url}}</td>
                        <td>{{$article->created_at}}</td>
                        <td>{{$article->name}}</td>
                        <td>
                          <form action="/delete/{{$article->id}}" method="post" role="form" class = "form">
                            <?php echo csrf_field() ?>
                            <input type="hidden" name="deleteId" value="{{$article->id}}">
                            <input type="hidden" name="deleteItem" value="article">
                            <button  type="submit" class="btn btn-danger">Delete</button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
          </div>
          @endif
        </div>
    </div>
</div>

@endsection
