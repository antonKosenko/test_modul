<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreateRequest;
use App\Models\Comments;
use Illuminate\Http\Request;
use \Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @param CommentCreateRequest $request
     * @return Comments
     */
    public function store(CommentCreateRequest $request)
    {
        $comment = new Comments($request->validated());
        $comment->user_id = Auth::id();
        $comment->save();

        return $comment;
    }
}
