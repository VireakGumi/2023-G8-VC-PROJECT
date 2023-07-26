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
        $reports = Report::create([
            'user_id' => Auth::user()->id,
            'video_id' => $request->video_id,
            'comment' => $request->comment,
            'type_of_report' => $request->type_of_report,
            'content_video' => $request->content_video
        ]);
        return $reports;
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
        // $report = Auth::user()->report->find($id);
        // $report ->delete();
        $report = Report::find($id)->delete();
        return $report;
    }
    public function getVideos()
    {
        $reports = Report::all();
        $reports = ReportResource::collection($reports);
        return response()->json(['success' => true, 'message' => "There are your report", 'data' => $reports], 200);
    }
}
