<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $follower = Follower::get();
        return response()->json(['success' => true, 'message' => 'Get Follower successfully', 'data' => $follower], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $channel = Channel::find($request->channel_id);
        if ($channel) {
            $follower = Follower::where('user_id', $user_id)
                ->where('channel_id', $channel->id)
                ->first();
            if ($follower) {
                return response()->json(['success' => false, 'message' => 'You have already followed this channel.'],404);
            } else {
                if ($channel->user_id == $user_id) {
                    return response()->json(['success' => false, 'message' => 'You cannot follow your own channel.'],404);
                } else {
                    $follower = Follower::create([
                        'user_id' => $user_id,
                        'channel_id' => $channel->id,
                        'date_time' => $request->date_time
                    ]);
                    return response()->json(['success' => true, 'message' => 'You have successfully followed this channel.'], 200);
                }
            }
        }
        return response()->json(['success' => false, 'message' => "Can't find this channel"], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $followers = Channel::find($id)->followers;
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved the number of followers for the channel',
            'data' => $followers
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Follower $follower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $channel = Channel::find($id);
        if ($channel) {
            $follower = Follower::where('user_id', $user_id)
                ->where('channel_id', $channel->id)
                ->first();
            if ($follower) {
                $follower->delete();
                return response()->json(['success' => true, 'message' => 'Delete Follower successfully'], 200);
            }
        }
        return response()->json(['success' => false, 'message' => "Can't find this channel"], 404);
    }
}
