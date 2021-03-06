@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @forelse ($threads as $thread)
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="level">
                            <h3 class="flex"><a href="/{{ $thread->path() }}">{{ $thread->title }}</a></h3>

                            <strong>{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</strong>
                        </div> 

                    </div>

                    <div class="panel-body">

                        <div class="body">
                            {{ $thread->body }}
                        </div>
                        
                    </div>
                </div>
            @empty

                <h1 class="text-danger">There are no relevant threads</h1>
                
            @endforelse
        </div>
    </div>
</div>
@endsection
