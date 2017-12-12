<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RecordsActivity;

class Favourite extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    public function favourited()
    {
        return $this->morphTo();
    }
}
