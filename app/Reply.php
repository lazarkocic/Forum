<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  protected $guarded = [];

  public function thread()
  {
    return $this->belongsTo(Thread::class);
  }

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function favourites()
  {
    return $this->morphMany(Favourite::class, 'favourited');
  }

  public function favourite()
  {
    $this->favourites()->create(['user_id' => auth()->id()]);
  }
}
