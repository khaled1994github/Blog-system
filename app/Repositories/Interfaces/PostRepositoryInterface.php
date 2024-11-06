<?php

namespace App\Repositories\Interfaces;

use App\Models\Post;
use Illuminate\Http\Request;

interface PostRepositoryInterface
{
    
    public function get_posts(Request $request);
    public function store(Request $request);
    public function edit(Request $request, Post $post);

}
