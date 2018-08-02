 <div class="col-md-8 col-md-offset-2">
  <div class="card">
    <div class="card-header pull-right">
      <a href="javascript::void(0)">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</div>
      <div class="card-body">
       <article>
         <div class="body">{{ $reply->body }}</div>
       </article> 
       <hr>
     </div>
   </div>
 </div>