<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayListRequest;
use App\Http\Requests\StoreVideoPlayListRequest;
use App\Http\Resources\VideoPlayList;
use App\Http\Resources\VideoResource;
use App\Models\PlayList;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayListController extends Controller
{


    public function getPlayListOfUser()
    {
        $playlists = Auth::user()->playlists;
        if ($playlists->count()) {
            foreach ($playlists as $playlist) {
                $lists = $playlist->videoPlayLists;
                $playlist->image = route('video.image', ['imagePath' => $lists[0]->video->thumbnail]);
                foreach ($lists as $item) {
                    $video = $item->video;
                    $video->src = route('video.play', ['id' => $video->id]);
                    $video->thumbnail = route('video.image', ['imagePath' => $video->thumbnail]);
                }
            }
            return response()->json(['success' => true, 'message' => "There are your playlist", 'data' => $playlists], 200);
        }
        return response()->json(['success' => false, 'message' => "You don't have playlist yet"], 404);
    }
    public function getPlayListOfUserID($id)
    {
        $playlists = User::find($id)->playlists;
        if ($playlists->count()) {
            foreach ($playlists as $playlist) {
                $lists = $playlist->videoPlayLists;
                $playlist->image = route('video.image', ['imagePath' => $lists[0]->video->thumbnail]);
                foreach ($lists as $item) {
                    $video = $item->video;
                    $video->src = route('video.play', ['id' => $video->id]);
                    $video->thumbnail = route('video.image', ['imagePath' => $video->thumbnail]);
                }
            }
            return response()->json(['success' => true, 'message' => "There are your playlist", 'data' => $playlists], 200);
        }
        return response()->json(['success' => false, 'message' => "You don't have playlist yet"], 404);
    }
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
    public function store(StorePlayListRequest $request)
    {
        //
        $playlist = PlayList::create([
            'title' => $request->title,
            'user_id' => Auth::user()->id
        ]);
        if (isset($playlist)) {
            return response()->json(['success' => true, 'message' => 'Create playlist is successfully ', 'data' => $playlist], 200);
        }
        return response()->json(['success' => false, 'message' => "Create playlist fail"], 404);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $playlist = Auth::user()->playlists->find($id);
        if (isset($playlist)) {
            $lists = $playlist->videoPlayLists;
            $playlist->image = route('video.image', ['imagePath' => $lists[0]->video->thumbnail]);
            foreach ($lists as $item) {
                $video = $item->video;
                $video->src = route('video.play', ['id' => $video->id]);
                $video->thumbnail = route('video.image', ['imagePath' => $video->thumbnail]);
            }
            return response()->json(['success' => true, 'message' => "There are your playlist", 'data' => $playlist], 200);
        }

        return response()->json(['success' => false, 'message' => "Playlist not found"], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlayList $playList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlayList $playList)
    {
        //
    }
}