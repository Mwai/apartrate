<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentsRequest;
use JWTAuth;

class CommentController extends Controller
{
    protected $user;

    public function __construct()
    {
        $token = JWTAuth::getToken();
        $this->user = JWTAuth::authenticate($token);
    }

    public function store(CommentsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = $input['user_id'] ?? $this->user->id;
        if ($comment = Comment::create($input)->load('user')) {
            return response()->json([
                'success' => true,
                'message' => 'Comment uploaded successfully',
                'data'    => $comment,
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Your comment was not posted successfully',
        ], 500);
    }
}
