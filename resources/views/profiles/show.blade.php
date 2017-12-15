@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="page-header">
                    <h1>{{ $profileUser->name }}</h1>
                    <h4>Since {{ $profileUser->created_at->diffForHumans() }}</h4>
                </div>

                @forelse ($activities as $date => $activity)

                    <h3 class="page-header">{{ $date }}</h3>

                    @foreach ($activity as $record)
                        
                        @if (view()->exists("profiles.activities.{$record->type}"))
                            @include ("profiles.activities.{$record->type}", ['activity' => $record]) 
                        @endif

                    @endforeach

                @empty
                    <p class="alert alert-warning">No activity</p>
                @endforelse
                
            </div>
        </div>
    </div>

@endsection