<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;


class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function playVideo($id)
    {
        $video = Video::find($id);
        $path = storage_path(). '/app/public/videos/' . $video->path;

        $headers = [
            'Content-Type' => 'video/mp4',
        ];
        return response()->download($path, $video->path, $headers);
    }
    
        public function index()
    {
        //
        $videos = Video::all()->take(20);
        if($videos->count() > 0) {
            foreach ($videos as $video) {
                $path = storage_path(). '/app/public/videos/' . $video->path;
                $video->videoType = mime_content_type($path);
                $video->src = route('video.play', ['id' => $video->id]);
            }
            return response()->json([
                'message' => 'Successful',
                'data' => $videos,
            ],200);
        }
        return response()->json([
            'message' => 'No data '
        ],404);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
    }
}
