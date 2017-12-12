<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use App\Reply;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($channelId, Thread $thread)
    {
        $this->validate(request(), [
          'body' => 'required'
        ]);

        $thread->addReply([
          'body' => request('body'),
          'user_id' => auth()->id()
        ]);

        return back()->with('flash', 'Replied!');
    }

    public function destroy(Reply $reply)     
    {
        // if ($reply->user_id != auth()->id()) {
        //   return response([], 403);
        // }
        $this->authorize('update', $reply);

        $reply->delete();

        return back();
    }

    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update(request(['body']));
    }

}
