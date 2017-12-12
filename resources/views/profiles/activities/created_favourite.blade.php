@component ('profiles.activities.activity')

    @slot ('heading')
        Favourited reply from  
        <a href="/{{$activity->subject->favourited->path()}}">"{{ $activity->subject->favourited->thread->title }}"</a>
    @endslot

    @slot ('body')
        {{ $activity->subject->favourited->body }}
    @endslot

@endcomponent