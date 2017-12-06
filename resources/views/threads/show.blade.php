@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-default">

          <div class="panel-heading">
            <a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:
            <strong>{{ $thread->title }}</strong>
          </div>

          <div class="panel-body">
              {{ $thread->body }}
          </div>

        </div>

        @foreach ($replies as $reply)
          @include ('threads.reply')
        @endforeach

        {{ $replies->links() }}

        <hr>

        @if (auth()->check())
          <form action="/threads/{{ $thread->channel->id }}/{{$thread->id}}/replies" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="body">Body:</label>
              <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Post</button>
            </div>
          </form>
        @else
          <p>Please <a href="{{ route('login') }}">sign in</a> to participate</p>
        @endif
      </div>

      <div class="col-md-4">

        <div class="panel panel-default">

          <div class="panel-heading">
            Details:
          </div>

          <div class="panel-body">
              This thread was published {{ $thread->created_at->diffForHumans() }} <br>
              by <a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> <br><br>
              {{ str_plural('Reply', $thread->replies_count) }} number: {{ $thread->replies_count }}
          </div>

        </div>

      </div>
    </div>


</div>
@endsection
