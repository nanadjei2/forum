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
                @foreach($activities as $activity)
                    @include("profiles.activities.$activity->type")
                @endforeach
            </div>
            <div class="row justify-content-center">
                {{-- $threads->links() --}}
            </div>
        </div>
    </div>
</div>
@endsection