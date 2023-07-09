<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

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
    
    public function uploadVideo(StoreVideoRequest $request)
   {
        $video = $request->only('title','description','thumbnail','date_time','privacy','category','user_id');
        $fileName = $request->video->getClientOriginalName();
        $thumbNail = $request->thumbnail->getClientOriginalName();
        $video = Arr::add($video,'viewer',0);
        $video['thumbnail'] = $thumbNail;
        $video = Arr::add($video,'path',$fileName);
        $video = Arr::add($video,'user_id',Auth::user()->id);
        $isFileUploaded = Storage::disk('public')->put( 'videos/' . $fileName, file_get_contents($request->video));
        $isThumbnailUploaded = Storage::disk('public')->put( 'thumbnails/' . $thumbNail, file_get_contents($request->thumbnail));
        // File URL to access the video in frontend
        $url = Storage::disk('public')->url( 'videos/' . $fileName);
 
        if ($isFileUploaded && $isThumbnailUploaded) {
           $video = Video::create($video);
           return response()->json(['success' => true, 'message' => 'Uploaded video successfully','video' => $video],200);
        }
        return response()->json(['success' => false, 'message' => 'Video uploaded unsuccessful'],404);
    }
}
