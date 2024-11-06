<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\PostRepositoryInterface;

class DashboardController extends Controller
{
    private $postRepository;

    /** 
    * DashboardController constructor
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
     * return dashboard view with posts.
     * 
     * @param Request $request
     * 
     */
    public function index(Request $request)
    {
        $posts = $this->postRepository->get_posts($request); /* interact with model via post repository */ 
        return view('pages.dashboard', compact('posts'));
    }
    
}
