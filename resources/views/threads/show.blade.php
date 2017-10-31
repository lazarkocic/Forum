@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">

          <div class="panel-heading">
            <a href="#">{{ $thread->creator->name }}</a> posted:
            <strong>{{ $thread->title }}</strong>
          </div>

          <div class="panel-body">
              {{ $thread->body }}
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        @foreach ($thread->replies as $reply)
          @include ('threads.reply')
        @endforeach
      </div>
    </div>

    <hr>

    @if (auth()->check())
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <form action="/threads/{{$thread->id}}/replies" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="body">Body:</label>
              <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Post</button>
            </div>
          </form>
        </div>
      </div>
    @endif
</div>
@endsection
