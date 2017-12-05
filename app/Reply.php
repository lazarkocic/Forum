<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  use Favouritable;

  protected $guarded = [];
  protected $with = ['owner', 'favourites'];

  public function thread()
  {
    return $this->belongsTo(Thread::class);
  }

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');
  }
}
