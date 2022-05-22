<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $comment = new Comment();
        $validatedData = $request->validate([ 
            'comment' => 'required',
        ]); 
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $postId;
        
        $comment->fill($validatedData);
        $comment->save();

        return redirect(route('post.show', $postId));
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect(route('post.show', $comment->post_id));
    }
}
