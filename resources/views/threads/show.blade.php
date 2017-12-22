@extends('layouts.app')

@section('content')
<thread-view :initial-replies-count="{{ $thread->replies->count() }}" inline-template>
  <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="panel panel-default">

            <div class="panel-heading">
              <div class="level">

                
                <div class="flex">

                  <a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:
                  <strong>{{ $thread->title }}</strong>

                </div>

                @can ('update', $thread)
                <form method="POST" action="/{{ $thread->path() }}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <button type="submit" class="btn btn-danger">Delete</button>

                </form>
                @endcan
              </div>
              
            </div>

            <div class="panel-body">
                {{ $thread->body }}
            </div>

          </div>

          <replies :data="{{ $thread->replies }}" @removed="repliesCount--"></replies>

          {{-- @foreach ($replies as $reply) --}}
          {{--  @include ('threads.reply') --}
          {{-- @endforeach --}}

          {{--{{ $replies->links() }}--}}

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
                {{ str_plural('Reply', $thread->replies_count) }} number: <span v-text="repliesCount"></span>
            </div>

          </div>

        </div>
      </div>


  </div>
</thread-view>
@endsection
