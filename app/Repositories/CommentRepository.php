<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\Request;

class CommentRepository implements CommentRepositoryInterface
{
    public function get_comments($post_id)
    {
        $comments = Comment::with(['user:id,name'])
        ->where('post_id', $post_id)
        ->orderBy('id', 'DESC')
        ->paginate(5);

        return $comments;
    }

    public function store(Request $request, $post_id)
    {
        $data = [
            'comment' => $request->input('comment'),
            'post_id' => $post_id,
            'user_id' => $request->user()->id
        ];

        $comment = Comment::create($data);
        return $comment;
    }

    public function edit(Request $request, Comment $comment)
    {

        $comment->comment = $request->comment;
        $comment->save();
        return $comment;
    }

}