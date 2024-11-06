<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostRepository implements PostRepositoryInterface
{
    public function get_posts(Request $request)
    {
        $keyword = $request->keyword;

        $posts = Post::with(['user:id,name'])
                ->when(isset($keyword), function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%");
                $query->orwhere('content', 'like', "%{$keyword}%");
            })
            ->orderBy('id', 'DESC')->paginate(5);

            return $posts;
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user()->id
        ]);

        return $post;
    }

    public function edit(Request $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return $post;
    }

}