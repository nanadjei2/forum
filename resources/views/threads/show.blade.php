@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card">
        <div class="card-header">{{ $thread->title }}</div>

        <div class="card-body">
         <article>
           <div class="body">{{ $thread->body }}</div>
         </article> 
       </div>
     </div>
   </div>
 </div>
 <br>
   <div class="row justify-content-center">
      @foreach($thread->replies as $reply)
        @include('threads.reply')
      @endforeach
  </div><br>
    <div class="row justify-content-center">
      @auth
        <div class="col-8">
          <form action="{{ route('add_reply_to_thread', $thread->id) }}" method="POST">
            {{ csrf_field() }} {{ method_field('POST') }}
            <div class="form-group">
              <textarea class="form-control" placeholder="Have something  to say ?" name="body" id="" cols="6" rows="6" required=""></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-primary">Reply</button>
            </div>
          </form>
        </div>
      @else
        <p>Please <a href="{{ route('login') }}">sign in </a> to participate in this discussion...</p>
      @endauth
    </div>
</div>
@endsection
