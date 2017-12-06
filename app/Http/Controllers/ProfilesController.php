<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        $profileUser = $user; // Because user variable may be used globally
        $threads = $profileUser->threads()->paginate(20);
        return view('profiles.show', compact(['profileUser', 'threads']));
    }
}
