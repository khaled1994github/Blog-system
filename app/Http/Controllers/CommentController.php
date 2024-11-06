<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\CommentRepositoryInterface;


class CommentController extends Controller
{
    private $commentRepository;

    /** 
    * PostController constructor
    * inject post repository in class to interact with post model
    *
    * @param CommentRepositoryInterface $commentRepository
    *
    */
    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }
    public function get_comments($post_id, $status = 0)
    {
        $comments = $this->commentRepository->get_comments($post_id);
        
        $returnHTML = view('partials.comments', ['comments' => $comments])->render();
        
        if ($status) {

            return response()->json([
                "data" => $comments,
                "comments" => $returnHTML,
                "status" => $status
            ]);

        } else {

            return response()->json([
                "data" => $comments,
                "comments" => $returnHTML
            ]);
        }
    }

    /**
     * Add comment.
     * 
     * @param Request $request
     * @param int $post_id
     * 
     */
    public function add_comments(Request $request, $post_id)
    {
        try {

            $comment = $this->commentRepository->store($request, $post_id);
            return $this->get_comments($post_id, 1);

        } catch (\Exception $e) {

            return back()->withErrors($e->getMessage());
        }
        
    }

    /**
     * Delete comment.
     * 
     * @param Comment $comment
     * 
     */
    public function delete_comments(Comment $comment)
    {
        $del = $comment->delete();
        return $this->get_comments($comment->post->id, 1);
    }

     /**
     * Edit comment.
     * 
     * @param Request $request
     * @param Comment $comment
     * 
     */
    public function update_comments(Request $request, Comment $comment)
    {
        try {

            $comment = $this->commentRepository->edit($request, $comment);
            return $comment;

        } catch (\Exception $e) {

            return back()->withErrors($e->getMessage());
        }
    }


}
