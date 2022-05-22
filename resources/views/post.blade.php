@extends('layouts.app')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-8"> 
            <h1>{{ $post->title }}</h1>
            <p>posted by: <span class="muted">{{ $post->user->name }}</span>, {{ $post->created_at->diffForHumans() }}</p>
            <p class="lead">{{ $post->body }}</p>
            <hr>
        </div>  
         
        <div class="col-4">
            <form class="m-3" method="POST" action="{{ route('comment.store', $post->id) }}">
                @csrf
                <h3>Comment on this post</h3>  
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Comment:</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
                </div>
                <button class="mt-3 btn btn-success">Comment</button>
            </form> 
        </div>
    </div>
    <div class="col-6">
        <h1 class="display1">Comments: </h1>
          @if ($post->comments->count() > 0)
                @foreach ($post->comments as $comment)
                    <div class="comment">
                        <h5 style="font-weight: bold;">{{ $comment->user->name }} <span class="badge badge-secondary" style="background: #2e2e2e;">{{ $comment->created_at->diffForHumans() }}</span></h5>
                        <p class="lead">{{ $comment->comment }}</p>  
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" style="margin-top: -10px; margin-bottom: 30px;"> 
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>  
                    </div>
                    <hr style="margin-top: -20px; margin-bottom: 20px;">
                @endforeach 
          @else
               No Comments yet!
          @endif
    </div>
</div>
@endsection

