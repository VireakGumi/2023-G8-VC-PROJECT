<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChannerlResource;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $channel = Channel::all();
        $channel = ChannerlResource::collection($channel);
        return response()->json(['success' => true, 'data' => $channel], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $channel = Channel::create([
            'name' => $request->name,
            'description' => $request->description,
            'date_time' => $request->date_time,
            'user_id' => $request->user_id
        ]);
        return response()->json(['success' => true, 'data' => $channel], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Channel $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
