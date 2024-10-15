<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request) {
        $user_id = auth()->user()->id;

        Comment::create([
            'user_id' => $user_id,
            'post_id' => $request['post_id'],
            'comment' => $request['comment'],
        ]);

        return redirect()->route('post.show', $request['post_id']);
    }

    public function update(CommentUpdateRequest $request) {
        $comment = Comment::find($request['comment_id']);

        $comment->update([
            'comment' => $request['comment'],
        ]);

        return redirect()->route('post.show', $request['post_id']);
    }

    public function destroy($post_id, $comment_id) {
        Comment::find($comment_id)->delete();

        return redirect()->route('post.show', $post_id);
    }
}
