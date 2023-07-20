<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoryResource;
use App\Models\history;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $history = Auth::user()->history()->get();
        $history = history::get();
        // return $history;
        $histories = HistoryResource::collection($history);
        if($histories->count() > 0) {	
            return response()->json(['success' => true, 'message' => 'Get all histories are successfully.', 'data' => $histories],200);
        }
        return response()->json(['success' => false, 'message' => "You don't have your history yet."], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $history= history::create([
            'video_id' => $request->video_id,
            'user_id' => Auth::user()->id
        ]);
        return response()->json(['success' => true, 'message' => 'Store history is successfully ', 'data' => $history],200);
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
        $history=Auth::user()->history->find($id);
        if ($history){
            $history->delete();
            return response()->json(['success' => true, 'message' => 'Delete history successfully ']);
        }
        return response()->json(['success' => false, 'message' => 'Delete history is unsuccessful ']);

    }
}
