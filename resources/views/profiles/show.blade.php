@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-header">
        <h3 class="profile-name">
            {{ $profileUser->name }}
        </h3>
            <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
    </div>  

    <h2 class="py-4">Created Threads</h2>
    <div class="user-threads">
        @foreach($profileUser->threads as $thread)
        <div class="card">
            <div class="card-header">{{ $thread->title }}</div>
            <div class="card-body">{{ $thread->body }}</div>
        </div>
        @endforeach
    </div>
</div>
@endsection