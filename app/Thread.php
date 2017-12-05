<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
    protected $with = ['creator', 'channel'];
    
    protected static function boot()
    {
      parent::boot();

      static::addGlobalScope('replyCount', function($query) {
        $query->withCount('replies');
      });
    }

    public function path()
    {
      return "threads/{$this->channel->slug}/$this->id";
    }

    public function replies()
    {
      return $this->hasMany(Reply::class);
        // ->withCount('favourites')
        // ->with('owner'); // Local version of fetching favourites and owner with reply
    }

    public function creator()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
      return $this->belongsTo(Channel::class);
    }

    public function addReply($reply)
    {
      $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
      return $filters->apply($query);
    }
}
