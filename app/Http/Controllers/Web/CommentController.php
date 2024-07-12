<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->post_id = $post->id;
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('posts.show', $comment->post_id);
    }

    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update', $comment);

        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return redirect()->route('posts.show', $comment->post_id);
    }
}
