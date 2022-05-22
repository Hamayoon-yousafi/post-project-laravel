@extends('layouts.app')

@section('content')
    <div class="container"> 
        <div class="row">
            <div class="col-8">
                @foreach ($posts as $post)
                    <div class="card" style="width: 100%; margin: 12px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }} <span style="background: silver; color: black;" class="badge">{{ $post->created_at->diffForHumans() }}</span></h5>   
                        <p class="card-text">{{ $post->body }}</p>
                        <footer class="blockquote-footer">By: {{ $post->user->name }}</cite></footer>
                        <p>{{ $post->likes->count() }} likes(s), {{ $post->comments->count() }} Comment(s)</p> 
                            
                            <div class="d-flex justify-content-between" style="width: 30%;"> 
                                <a href="{{ route("post.show", $post->id) }}" class="btn btn-success">Open Post</a> 
                                <form action="{{ route('like.create', $post->id) }}" method="POST">  
                                    @csrf
                                    @if (App\Models\Like::where(["user_id" => Auth::user()->id, "post_id" => $post->id])->count() == 1)
                                        <button class="btn btn-primary">Unlike</button>   
                                    @else
                                        <button class="btn btn-primary">Like</button>
                                    @endif
                                </form> 
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST"> 
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form> 
                            </div> 
                        </div> 
                    </div>
                @endforeach 
            </div>  
                 
            <div class="col-4">
                <form class="m-3" method="POST" action="{{ route('post.store') }}">
                    @csrf
                    <h3>Create your post</h3>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Post title" name="title">
                    </div>  
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Post</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="body"></textarea>
                    </div>
                    <button class="mt-3 btn btn-success">Post</button>
                </form>
                
            </div>
        </div>
    </div>
@endsection
