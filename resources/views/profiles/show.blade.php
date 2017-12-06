@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="page-header">
                    <h1>{{ $profileUser->name }}</h1>
                    <h4>Since {{ $profileUser->created_at->diffForHumans() }}</h4>
                </div>

                @foreach ($threads as $thread)

                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <div class="level">

                                <strong class="flex">{{ $thread->title }}</strong>
                                <small>{{ $thread->created_at->diffForHumans() }}</small>

                            </div>
                            
                        </div>

                        <div class="panel-body">
                            {{ $thread->body }}
                        </div>

                    </div>

                @endforeach

                {{ $threads->links() }}
            </div>
        </div>
    </div>

@endsection