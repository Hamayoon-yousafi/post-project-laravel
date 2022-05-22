<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function create($postId)
    { 
        if(Like::where(["user_id" => Auth::user()->id, "post_id" => $postId])->count() == 1) {
            $like = Like::where(["user_id" => Auth::user()->id, "post_id" => $postId]);
            $like->delete();
        } else {
            $like = new Like();
            $like->post_id = $postId;
            $like->user_id = Auth::user()->id;
            $like->save();
        };

        return redirect('post');
    }
}
