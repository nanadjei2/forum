
<div class="card mt-2">
    <div class="card-header flex justify-between">
        <div class="thread-owner-and-time">
            <a href="{{ route('profiles.show', $thread->creator->name) }}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...
        </div>
      <div class="favorite-btn">
          <form action="{{ route('reply.favorites', $reply->id) }}" method="POST">
              {{ csrf_field() }} {{ method_field('POST') }}
                <button class="btn btn-primary btn-sm" {{ $reply->isFavorited() ? 'disabled' : '' }} type="submit">
                    {{ $reply->favorites_count }} {{ str_plural('Favorite', $reply->favorites_count) }}
                </button>
          </form>
      </div>
    </div>
    <div class="card-body">
       <article>
         <div class="body">{{ $reply->body }}</div>
       </article> 
    </div>
</div>

   
