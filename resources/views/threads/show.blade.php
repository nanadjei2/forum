@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-left">
    <div class="col-8">
      <div class="card">
        <div class="card-header"><a href="#">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}</div>

        <div class="card-body">
         <article>
           <div class="body">{{ $thread->body }}</div>
         </article> 
       </div>
     </div>
     <br>
       @foreach($thread->replies as $reply)
          @include('threads.reply')
       @endforeach
     <br>
     <div class="post-reply">
      @auth
      <form action="{{ route('add_reply_to_thread', [$thread->channel_id, $thread->id]) }}" method="POST">
        {{ csrf_field() }} {{ method_field('POST') }}
        <div class="form-group">
          <textarea class="form-control" placeholder="Have something  to say ?" name="body" id="" cols="6" rows="6" required=""></textarea>
        </div>
        <div class="form-group">
          <button class="btn btn-primary">Reply</button>
        </div>
      </form>
      @else
        <p>Please <a href="{{ route('login') }}">sign in </a> to participate in this discussion...</p>
      @endauth
    </div>
  </div>

  <div class="col-4">
    <div class="card">
        <!-- <div class="card-header"><a href="#">{{ $thread->creator->name }}</a> posted: {{ $thread->title }}</div> -->
        <div class="card-body">
         <div class="card-header">
          comments <p>This thread was published : {{ $thread->created_at->diffForHumans() }} by 
              <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies()->count() }} comments</p>
         </div> 
       </div>
     </div>
  </div>

  </div>
</div>
@endsection
