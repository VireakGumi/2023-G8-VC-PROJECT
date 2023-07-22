<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Models\Like;
use App\Models\Video;
use Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        //
        $video = Video::find($id);
        if($video){
            $likes = $video->likes;
            return response()->json(['success' => true, 'message' => 'You have liked this video', 'data' => $likes],200);
        }
        return response()->json(['success' => true, 'message' => 'Video undefind'],404);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LikeRequest $request)
    {
        //

        $video = Video::find($request->video_id);
        if($video){
            $like= Like::create([
                'video_id' => $video->id,
                'user_id' => Auth::user()->id,
                'date_time' => $request->date_time
            ]);
            return response()->json(['success' => true, 'message' => 'You have liked this video', 'data' => $like],200);
        }
        return response()->json(['success' => true, 'message' => 'Video undefind'],404);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        //
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }
}
