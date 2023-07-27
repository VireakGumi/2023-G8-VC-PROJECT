<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $followers = $user->followers;
        $listNotification = [];
        if($followers) {
            foreach ($followers as $follow) {
                $lists = $follow->channel->notification;
                foreach ($lists as $list) {
                    $list->video;
                    array_push($listNotification, $list);
                }
            }
            if($listNotification){
               return response()->json(['success' => true, 'message' => "Those are your notification", 'data' => $listNotification], 200 );
            }
            return response()->json(['success' => false, 'message' => "Don't have yet"], 404 );
        }
        return response()->json(['success' => false, 'message' => "You don't follow any yet"], 404 );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $notification = Notification::create([
            'user_id' => Auth::user()->id,
            'video_id' => $request->video_id,
            'channel_id' => $request->channel_id,
            'date_time' => $request->date_time
        ]);
        return response()->json(['success' => true, 'data' => $notification], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //

    }

    /**-
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
