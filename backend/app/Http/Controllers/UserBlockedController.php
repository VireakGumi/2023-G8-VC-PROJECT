<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserBlocked;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UserBlockedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userBlocked = UserBlocked::all();
        return response()->json([
            'success' => true,
            'message' => 'Blocked users retrieved successfully.',
            'data' => $userBlocked,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        // Find the user with the given ID
        $user = User::find($id);

        // Check if a UserBlocked record already exists with the same blocked_user_id
        $existingBlock = UserBlocked::where('blocked_user_id', $user->id)->first();
        if ($existingBlock) {
            // A UserBlocked record already exists with the same blocked_user_id
            return 'User is already blocked';
        }

        // Create a new UserBlocked record for the user
        $userblock = UserBlocked::create([
            'blocked_user_id' => $user->id,
            'date_time' => Carbon::now()
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Blocked users retrieved successfully.',
            'data' => $userblock,
        ], 200);
    }
    /**
     * Display the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserBlocked $userBlocked)
    {
        //
    }

    public function show()
    {
        //

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $unBlock = UserBlocked::where('blocked_user_id', $id)->first();
        if ($unBlock) {
            $unBlock->delete();
        }
        return "null";
    }
    public function getblock()
    {
        $userBlocked = UserBlocked::all();
        $blockedUserIds = $userBlocked->pluck('blocked_user_id')->toArray(); // get an array of blocked user ids
        $blockedUsers = User::whereIn('id', $blockedUserIds)->get(); // get all the users who have been blocked
        return response()->json([
            'success' => true,
            'message' => 'Request is successfully.',
            'data' => $blockedUsers,
        ], 200);
    }
}
