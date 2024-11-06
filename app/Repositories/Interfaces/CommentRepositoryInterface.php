<?php

namespace App\Repositories\Interfaces;

use App\Models\Comment;
use Illuminate\Http\Request;

interface CommentRepositoryInterface
{
    
    public function get_comments($post_id);
    public function store(Request $request, $post_id);
    public function edit(Request $request, Comment $comment);

}