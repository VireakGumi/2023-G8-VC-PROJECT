<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Models\Categories;
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
        if(isset($video)){
            $path = storage_path() . '/app/public/videos/' . $video->path;
    
            $headers = [
                'Content-Type' => 'video/mp4',
            ];
            return response()->download($path, $video->path, $headers);
        }
        return response()->json(['success' => false, 'message' => 'Video is not found'], 404);
    }

    public function index()
    {
        //
        $videos = Video::limit(12)->get();
        if ($videos->count() > 0) {
            foreach ($videos as $video) {
                $path = storage_path() . '/app/public/videos/' . $video->path;
                $video->videoType = mime_content_type($path);
                $video->src = route('video.play', ['id' => $video->id]);
            }
            return response()->json([
                'message' => 'Successful',
                'data' => $videos,
            ], 200);
        }
        return response()->json([
            'message' => 'No data'
        ], 404);
    }

    public function getVideoByCategory($id)
    {
        $video = Video::find($id);
        if (isset($video)) {
            $category_id = $video->categories_id;
            $videos = Categories::find($category_id)->videos->where('id', "!=", $video->id);
            if ($videos->count()) {
                return response()->json([
                    'message' => 'Successful',
                    'data' => $videos
                ], 200);
            }
            return response()->json(['success' => false, 'message' => "In this theme just hvae this " . $video->title . ' only', ], 404);
        }
        return response()->json(['success' => false, 'message' => 'Video is not found'], 404);
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
        $video = $request->only('title','description','thumbnail','date_time','privacy','categories_id');
        $fileName = $request->video->getClientOriginalName();
        $thumbNail = $request->thumbnail->getClientOriginalName();
        $video = Arr::add($video, 'viewer', 0);
        $video['thumbnail'] = $thumbNail;
        $video = Arr::add($video,'path',$fileName);
        $video = Arr::add($video,'user_id',Auth::user()->id);
        $isFileUploaded = Storage::disk('public')->put( 'videos/' . $fileName, file_get_contents($request->video));
        $isThumbnailUploaded = Storage::disk('public')->put( 'thumbnails/' . $thumbNail, file_get_contents($request->thumbnail));
        // File URL to access the video in frontend
        $url = Storage::disk('public')->url('videos/' . $fileName);

        if ($isFileUploaded && $isThumbnailUploaded) {
           $video = Video::create($video);
           return response()->json(['success' => true, 'message' => 'Uploaded video successfully','video' => $video],200);
        }
        return response()->json(['success' => false, 'message' => 'Video uploaded unsuccessful'],404);
    }
    ///search
    public function searchVideo($title)
    {
        $videos = Video::where('title', 'like', '%' . $title . '%')
            ->orWhere('user_id', 'like', '%' . $title . '%')
            ->get();
        if ($videos->count()) {
            return response()->json(['success' => true, 'message' => 'There are the result', 'data' => $videos], 200);
        }
        return response()->json(['success' => true, 'message' => 'There are some data', 'data' => Video::limit(12)->get()], 200);


    }
}