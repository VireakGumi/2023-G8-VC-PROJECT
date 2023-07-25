<?php

namespace App\Http\Controllers;

use App\Models\UserBlocked;
use Illuminate\Http\Request;

class UserBlockedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $userBlocke = UserBlocked::all();
        if ($userBlocke != null) {
            return Response()->json([
                'success' => true,
                'message' => 'successfully.',
                'data' => $userBlocke,
            ], 200);
        }
        return Response()->json([
            'success' => false,
            'message' => 'User blocked is empty.',
        ], 200);
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
    public function show(UserBlocked $userBlocked)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserBlocked $userBlocked)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserBlocked $userBlocked)
    {
        //
    }
}
