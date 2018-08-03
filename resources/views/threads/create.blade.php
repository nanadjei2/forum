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
                      <input name="title" id="title" class="form-control" type="text" placeholder="Enter title">
                    </div>  
                    <div class="form-group">
                      <label for="body">Body:</label>
                      <textarea class="form-control" placeholder="Write something" name="body" id="body" cols="10" rows="8"></textarea>
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
