<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RecordsActivity;

class Reply extends Model
{
  use Favouritable, RecordsActivity;

  protected $guarded = [];
  protected $with = ['owner', 'favourites'];
  protected $appends = ['favouritesCount', 'isFavourited']; // Appends attributes when casted to JSON, function must have name getIsFavouritedAttributes

  public function thread()
  {
    return $this->belongsTo(Thread::class);
  }

  public function owner()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function path()
  {
      return $this->thread->path() . "#reply-{$this->id}";
  }
}
