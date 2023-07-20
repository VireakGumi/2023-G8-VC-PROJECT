<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportResource;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
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
    public function show(string $id)
    {
        //
    }

    /**
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
        $report = Report::find($id)->delete();
        return $report;
        // 

        // $user = Auth::user();
        // $report = $user->$reports->find($id);
        // if ($report != null) {
        //     $report->delete();
        //     return response()->json(['success' => true, 'message' => 'You have delete the successfully ',], 200);
        // }
        // return response()->json(['success' => false, 'message' => "The video is not your"], 404);
    }
    public function getVideos()
    {
        $reports = Report::all();
        $reports = ReportResource::collection($reports);
        return response()->json(['success' => true, 'message' => "There are your report", 'data' => $reports], 200);
    }
}
