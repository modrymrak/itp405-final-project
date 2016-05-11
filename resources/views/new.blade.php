@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
            <div class="panel-heading">
              Add New Article
            </div>
            <div class="panel-body">
              <form class="form-horizontal" role="form" method="POST" action="{{ url('/new') }}">
                <?php echo csrf_field() ?>
                @if(isset($success))
                  <p style="color:green">Article added succesfully</p>
                @endif
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">
                      Title
                    </label>
                    <div class="col-md-6">
                      <input type="text"  class="form-control" name="title" value="{{ old('title') }}">
                      @if ($errors->has('title'))
                          <span class="help-block">
                              <strong>{{ $errors->first('title') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
                <div class="form-group {{ $errors->has('url') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">
                      URL
                    </label>
                    <div class="col-md-6">
                      <input type="url"  class="form-control" name="url" value="{{ old('url') }}">
                      @if ($errors->has('url'))
                          <span class="help-block">
                              <strong>{{ $errors->first('url') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
                <div class="form-group form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                    <label class="col-md-2 control-label">
                      Country
                    </label>
                    <div class="col-md-6">
                      <select name="country"  class="form-control">
                        @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->country_name}}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('country'))
                          <span class="help-block">
                              <strong>{{ $errors->first('country') }}</strong>
                          </span>
                      @endif
                    </div>
                </div>
                <div class="form-group">
                  <div class=" col-md-4 col-md-offset-2">
                    <button id="submitButton" type="submit" class="btn btn-primary ">
                        Add
                    </button>
                  </div>
                </div>
              </form>
            </div>
      </div>
    </div>
  </div>
</div>
@endsection
