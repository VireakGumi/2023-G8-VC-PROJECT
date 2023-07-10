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
        $history = Auth::user()->histories;
        $histories = HistoryResource::collection($history);
        return response()->json(['success' => true, 'message' => 'Get all histories are successfully.', 'data' => $histories],200);
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
    public function destroy(history $history)
    {
        //
    }
}
