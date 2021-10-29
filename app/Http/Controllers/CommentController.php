<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'text' => ['required'],
            'post_id' => ['required', 'exists:posts,id'],
        ]);
        $comment = new Comment;
        $comment->text = $request->input('text');
        $comment->post_id = $request->input('post_id');
        $comment->user_id = Auth::id();
        $comment->save();

        return back();
    }
    public function destroy(Comment $comment){
        $comment->delete();
            return redirect()->back();

    }
}
