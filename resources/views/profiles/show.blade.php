@extends('layouts.app')
@section('content')
<div class="container">
<div class="row justify-content-center">
        <div class="col-8">
            <div class="page-header">
                <h3 class="profile-name">
                    {{ $profileUser->name }}
                </h3>
                <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
            </div>  

            <h2 class="py-4">Created Threads</h2>
            <div class="user-threads">
                @foreach($threads as $thread)
                <div class="card">
                    <div class="card-header flex">
                        <div class="user-and-thread-title flex-1">
                            <a href="{{ route('profiles.show', $thread->creator) }}">{{ $profileUser->name }}</a> Posted: {{ $thread->title }}                    
                        </div>
                        <span class="time">{{ $thread->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="card-body">{{ $thread->body }}</div>
                </div>
                @endforeach
            </div>
            <div class="row justify-content-center">
                {{ $threads->links() }}
            </div>
        </div>
    </div>
</div>
@endsection