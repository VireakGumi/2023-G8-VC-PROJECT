<?php

namespace App\Http\Controllers;

use App\Models\PlayList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayListController extends Controller
{

    public function getPlayListOfUser()
    {
        $playlists = Auth::user()->playlists;
        if ($playlists->count()) {
            foreach ($playlists as $playlist) {
                $playlist->videoPlayLists;
                foreach ($playlist as $item) {
                    $playlist->video;
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
                $playlist->videoPlayLists;
                foreach ($playlist as $item) {
                    $playlist->video;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PlayList $playList)
    {
        //
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