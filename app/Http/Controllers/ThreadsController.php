<?php

namespace App\Http\Controllers;

use App\Thread;
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
    public function index(Request $request, \App\Channel $channel)
    {
        $threads = $this->getThreads($request, $channel);
        return view('threads.index')->with('threads', $threads);
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
        $request->validate(Thread::$rules);
        $thread = Thread::create([
            'user_id'       =>  auth()->id(),
            'channel_id'    =>  $request->channel_id,
            'title'         =>  $request->title,
            'body'          =>  $request->body
        ]);
        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     * @param  \App\thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channelId, Thread $thread)
    {
        return view('threads.show', [
            'thread' => $thread,
            'replies'   =>  $thread->replies()->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\thread  $thread
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
     * @param  \App\thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($channel, Thread $thread)
    {
        //$thread->replies()->delete(); //  Works fine buh thread model can do that automatically on Delete.
        
        // if($thread->user_id != auth()->id()) {
        //     return abort(403, 'You do not have permission to do this.'); // Works fine but done with polices
        // }
        
        $this->authorize('update', $thread);
        $thread->delete();
        if(request()->wantsJson()) return response([], 204);
        return redirect(route('threads.index'));
    }

    protected function getThreads(Request $request, $channel) {
        if($channel->exists) {
            // $channelId = \App\Channel::whereSlug($channel->slug)->first()->id;
            // $threads = Thread::where('channel_id', $channelId)->latest()->get();
            $threads = $channel->threads()->latest();
        } else {
            $threads = Thread::latest();            
        }
        // if request('by'), we should filter by the given username.
        if($username = $request->get('by')) {
            $user = \App\User::where('name', $username)->firstOrFail();
            $threads = $threads->where('user_id', $user->id);
        }
        return $threads->get();
    }
}
