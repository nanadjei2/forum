<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $channelId, Thread $thread)
    {
        $request->validate(\App\Reply::$rules);
    	$thread->addReply([
    			'user_id'	=>	auth()->id(),
    			'body'		=>	$request->body
    		]);
    	return back();
    }
}
