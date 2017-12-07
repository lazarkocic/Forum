@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1 class="text-primary">Create a thread</h1></div>

                <div class="panel-body">
                  <form action="/threads" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="channel-id">Channel:</label>
                      <select class="form-control" name="channel-id" required>
                        <option value="">Choose one...</option>
                        @foreach ($channels as $channel)
                          <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option> <!-- Old not working! -->
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="body">Title:</label>
                      <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required></input>
                    </div>
                    <div class="form-group">
                      <label for="body">Body:</label>
                      <textarea name="body" id="body" class="form-control" rows="8" required>{{ old('body') }}</textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Post</button>
                    </div>

                    @if (count($errors))
                      <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    @endif

                  </form>
                </div>

                <!-- <div class=""> -->

                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
@endsection
