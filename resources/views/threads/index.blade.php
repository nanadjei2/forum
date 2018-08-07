@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    @foreach($threads as $thread)
    <div class="col-10 px-0 py-4">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-10">
              <a href="{{ $thread->path() }}">
                <h4>{{ $thread->title }}</h4>
              </a>
            </div>
            <div class="col-2">
              <a href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>
            </div>
          </div>
        </div>

        <div class="card-body">
         <div class="body">{{ $thread->body }}</div>   
       </div>
     </div>
   </div>
   @endforeach
 </div>
</div>
@endsection
