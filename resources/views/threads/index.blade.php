@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-10 px-0">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                    @foreach($threads as $thread)
                       <article>
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
                             <div class="body">{{ $thread->body }}</div>      
                       </article>
                       <hr>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
