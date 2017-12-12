<div id="reply-{{ $reply->id }}" class="panel panel-default">

  <div class="panel-heading">
    <div class="level">

      <div class="flex">

        <a href="/profiles/{{ $reply->owner->name }}">{{ $reply->owner->name }}</a> said
        <strong>{{ $reply->created_at->diffForHumans() }}</strong>

      </div>
      
      <div>
        <form method="POST" action="/replies/{{ $reply->id }}/favourites">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-default" {{ $reply->isFavourited() ? 'disabled' : '' }}>
          {{ $reply->favourites_count }} {{ str_plural('Favourite', $reply->favourites_count) }}
          </button>
        </form>

      </div>


    </div>

  </div>

  <div class="panel-body">
    {{ $reply->body }}
  </div>

  @can ('update', $reply)
  <div class="panel-footer">

    <form method="POST" action="/replies/{{ $reply->id }}">

      {{ csrf_field() }}
      {{ method_field('DELETE') }}
  
      <button type="submit" class="btn btn-danger btn-xs">Delete</button>
    
    </form>

  </div>
  @endcan
</div>
