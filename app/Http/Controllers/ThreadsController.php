<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Channel;
use App\Filters\ThreadFilters;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
      $threads = $this->getThreads($channel, $filters);

      if (request()->wantsJson()) {
        return $threads;
      }

      return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //dd(request()->all());

      $this->validate($request, [
        'title' => 'required',
        'body' => 'required',
        'channel_id' => 'exists:channels,id' // Validation 'required' not working!!!
      ]);

      //dd(request()->all());

      $thread = Thread::create([
        'user_id' => auth()->id(),
        'channel_id' => request('channel-id'),
        'title' => request('title'),
        'body' => request('body')
      ]);

      return redirect('/'.$thread->path())
        ->with('flash', 'Your thread has been published');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
        //return $thread->load('replies');
        return view('threads.show', [
          'thread' => $thread,
          'replies' => $thread->replies()->paginate(20)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    { 
        //$thread->replies()->delete(); // Deleted in Thread boot method
        // if ($thread->user_id !=  auth()->id()) {
        //   /*if (request()->wantsJson()) {
        //     return response(['status' => 'Permission denied'], 403);
        //   }
        //   return redirect('/login');*/

        //   abort(403, 'You don\'t have permission to do this.');
        // }
        $this->authorize('update', $thread);
        $thread->delete();

        if (request()->wantsJson()) {
          return response([], 204);
        }

        return redirect('/threads');
        
    }

    public function getThreads(Channel $channel, ThreadFilters $filters)
    {
      $threads = Thread::latest()->filter($filters);

      if ($channel->exists) {
        $threads->where('channel_id', $channel->id);
      }

      //dd($threads->toSql()); // Return sql query from eloquent, easy to see where something wrong
      return $threads->get();
    }
}
