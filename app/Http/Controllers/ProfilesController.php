<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Activity;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        $profileUser = $user; // Because user variable may be used globally

        $activities = Activity::feed($profileUser);
        //$activities = $this->getActivity($profileUser);

        //return $activities;

        return view('profiles.show', compact(['profileUser', 'activities']));
    }
}
