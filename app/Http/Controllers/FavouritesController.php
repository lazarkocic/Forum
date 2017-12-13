<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;
use App\Favourite;

class FavouritesController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function store(Reply $reply)
    {
        $reply->favourite();

        if (request()->expectsJson()) {
            return response(['status' => 'Favourited']);
        }

        return back();
    }

    public function destroy(Reply $reply)
    {
        $reply->unfavourite();
        
        if (request()->expectsJson()) {
            return response(['status' => 'Unfavourited']);
        }

        return back();
    }
}
