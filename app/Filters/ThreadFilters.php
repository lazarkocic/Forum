<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

class ThreadFilters extends Filters
{
  protected $filters = ['by', 'popular'];

  protected function by($username)
  {
    $user = User::where('name', $username)->firstOrFail();
    return $this->query->where('user_id', $user->id);
  }

  protected function popular()
  {
    $this->query->getQuery()->orders = []; // Removing order by from query, so it can be overriden

    return $this->query->orderBy('replies_count', 'desc');
  }

}


?>
