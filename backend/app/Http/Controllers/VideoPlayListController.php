<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoPlayListRequest;
use App\Models\VideoPlayList;
use Auth;
use Illuminate\Http\Request;

class VideoPlayListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoPlayListRequest $request)
    {
        //
        $user = Auth::user();
        $playlist = $user->playlists->find($request->play_list_id);
        if(isset($playlist)) {
            $videoStore= VideoPlayList::create([
                'video_id' => $request->video_id,
                'play_list_id' => $request->play_list_id
            ]);
            if (isset($videoStore)) {
                return response()->json(['success' => true, 'message' => 'Create playlist is successfully.', 'data' => $videoStore],200);
            }
            return response()->json(['success' => false, 'message' => "Fail to add video to playlist."], 404);
        }
        return response()->json(['success' => false, 'message' => "You need to create playlist first."], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoPlayList $videoPlayList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoPlayList $videoPlayList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoPlayList $videoPlayList)
    {
        //
    }
}
