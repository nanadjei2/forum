@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Threads</div>

                <div class="card-body">
                    @foreach($threads as $thread)
                       <article>
                        <div class="level">
                          <a href="{{ $thread->path() }}">
                             <h4>{{ $thread->title }}</h4>
                          </a>
                         </div>
                             <div class="body">{{ $thread->body }}</div>
                             <strong>{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</strong>
                       </article>
                       <hr>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
