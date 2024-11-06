<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    private $postRepository;

    /** 
    * PostController constructor
    * inject post repository in class to interact with post model
    *
    * @param PostRepositoryInterface $postRepository
    *
    */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * this method to return add post page and add new post to database.
     * 
     * @param Request $request
     * 
     */
    public function add_post(Request $request)
    {

        $type = 'Add New';

        if ($request->method() == 'GET') {

            return view('pages.add-edit-post', compact('type'));
        } else {
            
            $request->validate([
                'title' => ['required'],
                'content' => ['required']
            ]);
            
            try {

                $post = $this->postRepository->store($request);

                return redirect('/dashboard')
                        ->with('success', 'Your post added successfully!');

            } catch (\Exception $e) {

                return back()->withErrors($e->getMessage());
            }

        }
    }

    /**
     * this method to return edit post page and add edit post in database.
     * 
     * @param Request $request
     * @param Post $post
     * 
     */
    public function edit_post(Request $request, Post $post)
    {
        $type = 'Edit';

        if ($request->method() == 'GET') {

            return view('pages.add-edit-post', compact('type','post'));
        } else {

            $request->validate([
                'title' => ['required'],
                'content' => ['required']
            ]);
            
            try {

                $post = $this->postRepository->edit($request, $post); 

                return redirect('/dashboard')
                        ->with('success', 'Your post edited successfully!');

            } catch (\Exception $e) {

                return back()->withErrors($e->getMessage());
            }

        }
    }

    /**
     * delete post.
     * 
     * @param Post $post
     * 
     */
    public function delete_post(Post $post)
    {
        try {

            $post->delete();
            return redirect()
                        ->back()
                        ->with('success', 'Your post deleted successfully!');
        } catch (\Exception $e) {
            
            return back()->withErrors($e->getMessage());
        }

    }
}
