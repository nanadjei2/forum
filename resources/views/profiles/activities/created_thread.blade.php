<div class="card my-2">
    <div class="card-header flex">
        <div class="user-and-thread-title flex-1">    
            {{ $profileUser->name }} published a reply
        </div>
        <span class="time">{{ $activity->created_at->diffForHumans() }}</span>
    </div>
    <div class="card-body">{{ $activity->subject->body }}</div>
</div>