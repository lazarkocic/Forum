<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

abstract class Filters
{
  protected $request, $query;
  protected $filters = [];

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  public function apply($query)
  {
    $this->query = $query;

    //dd($this->request->only($this->filters));
    //dd($this->getFilters());

    foreach ($this->getFilters() as $filter => $value) {
      if (method_exists($this, $filter)) {
        $this->$filter($value);
      }
    }

    return $this->query;
  }

  public function getFilters()
  {
    return $this->request->only($this->filters);
  }
}

?>
