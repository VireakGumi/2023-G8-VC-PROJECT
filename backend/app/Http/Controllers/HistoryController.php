<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoryResource;
use App\Models\history;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1; // Get the current page number from the request, or default to 1
        $perPage = 6; // Change the number 10 to the desired number of videos per page
        $history = Auth::user()->history()
            ->orderByDesc('date_time')
            ->skip(($page - 1) * $perPage)
            ->take($perPage)->get();
        $histories = HistoryResource::collection($history);
        if ($histories->count() > 0) {
            return response()->json(['success' => true, 'message' => 'Get all histories are successfully.', 'data' => $histories], 200);
        }
        return response()->json(['success' => false, 'message' => "You don't have your history yet."], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $video = Auth::user()->history()->where('video_id', $request->video_id)->first();
        if ($video) {
            $video->delete();
        }
        $history = history::create([
            'video_id' => $request->video_id,
            'date_time' => $request->date_time,
            'user_id' => Auth::user()->id
        ]);
        return response()->json(['success' => true, 'message' => 'Store history is successfully '], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(history $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, history $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $id)
    {
        $history = Auth::user()->history->find($id);
        if ($history) {
            $history->delete();
            return response()->json(['success' => true, 'message' => 'Delete history successfully ']);
        }
        return response()->json(['success' => false, 'message' => 'Delete history is unsuccessful ']);
    }
}
