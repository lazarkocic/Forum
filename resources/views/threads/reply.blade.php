<reply :attributes="{{ $reply }}" inline-template v-cloak>

  <div id="reply-{{ $reply->id }}" class="panel panel-default">

    <div class="panel-heading">
      <div class="level">

        <div class="flex">

          <a href="/profiles/{{ $reply->owner->name }}">{{ $reply->owner->name }}</a> said
          <strong>{{ $reply->created_at->diffForHumans() }}</strong>

        </div>
        
        @if (auth()->check())
          <div>

            <favourite :reply="{{ $reply }}"></favourite>

          </div>
        @endif

      </div>

    </div>

    <div class="panel-body">
      <div v-if="editing">
        <div class="form-group">
          <textarea class="form-control" v-model="body"></textarea>
        </div>
        <button class="btn btn-xs btn-link" @click="update">Update</button>
        <button class="btn btn-xs btn-link" @click="editing = false">Cancel</button>        
      </div>
      <div v-else v-text="body">
      </div>
    </div>

    @can ('update', $reply)
    <div class="panel-footer level">

      <button class="btn btn-xs mr1" @click="editing = true"> Edit</button>
      <button class="btn btn-danger btn-xs" @click="destroy">Delete</button>

    </div>
    @endcan
  </div>

</reply>
