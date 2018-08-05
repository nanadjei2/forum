@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Thread</div>
                <div class="card-body">
                  <form action="{{ route('threads.store') }}" method="POST">
                    {{ csrf_field() }} {{ method_field('POST') }}
                    <div class="form-group">
                      <label for="title">Title:</label>
                      <input name="title" id="title" class="form-control @if($errors->has('title')) is-invalid @endif" type="text" placeholder="Enter title" 
                              value="{{ old('title', isset($thread->title) ? $thread->title : null) }}" required>
                      <span class="invalid-feedback"><strong>{{ $errors->first('title') }}</strong></span>
                    </div>  

                    <div class="form-group">
                      <label for="channel_id">Channel:</label>
                      <select name="channel_id" id="channel_id" class="form-control" required>
                          <option value="" class="disabled">-- Choose One --</option>
                        @foreach(App\Channel::all() as $channel)
                          <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                        @endforeach      
                      </select>
                      <span class="invalid-feedback"><strong>{{ $errors->first('channel_id') }}</strong></span>
                    </div>  

                    <div class="form-group">
                      <label for="body">Body:</label>
                      <textarea class="form-control @if($errors->has('body')) is-invalid @endif" placeholder="Write something" name="body" id="body" cols="10" rows="8" required>
                        {{ old('body') }}
                      </textarea>
                      <span class="invalid-feedback"><strong>{{ $errors->first('body') }}</strong></span>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
