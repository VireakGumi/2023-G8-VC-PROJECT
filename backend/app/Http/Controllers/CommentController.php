<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Models\Video;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $video = Video::find($id);
        if($video){
            $comments = $video->comments;
            foreach($comments as $comment){
                $comment->user;
            }
            return response()->json(['success' => true, 'message' => 'You have liked this video', 'data' => $comments],200);
        }
        return response()->json(['success' => true, 'message' => 'Video undefind'],404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $video = Video::find($request->video_id);
        if($video){
            $commnet= Comment::create([
                'comment_text' => $request->comment_text,
                'video_id' => $video->id,
                'user_id' => Auth::user()->id,
                'date_time' => $request->date_time
            ]);
            return response()->json(['success' => true, 'message' => 'You have liked this video', 'data' => $commnet],200);
        }
        return response()->json(['success' => true, 'message' => 'Video undefind'],404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
