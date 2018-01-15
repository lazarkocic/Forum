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

          <replies  :data="{{ $thread->replies }}" 
                    @removed="repliesCount--"
                    @added="repliesCount++"></replies>

          {{-- @foreach ($replies as $reply) --}}
          {{--  @include ('threads.reply') --}
          {{-- @endforeach --}}

          {{--{{ $replies->links() }}--}}

          <hr>

          
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
