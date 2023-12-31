<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Http\Requests\EditVideoRequest;
use App\Models\Categories;
use App\Models\Channel;
use App\Models\User;
use App\Models\Video;
use App\Http\Controllers\NotificationController as NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSrc($videos)
    {
        foreach ($videos as $video) {
            $channel= Channel::find($video->channel_id);
            $path = storage_path() . '/app/public/videos/' . $video->path;
            $video->image =  $video->thumbnail;
            $video->thumbnail = route('video.image', ['imagePath' => $video->thumbnail]);
            $video->videoType = mime_content_type($path);
            $extension = pathinfo($video->thumbnail, PATHINFO_EXTENSION);
            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                    $video->imageType = 'image/jpeg';
                    break;
                case 'png':
                    $video->imageType = 'image/png';
                    break;
                case 'gif':
                    $video->imageType = 'image/gif';
                    break;
                case 'svg':
                    $video->imageType = 'image/svg+xml';
                    break;
                default:
                    $video->imageType = '';
                    break;
            }
            $video->src = route('video.play', ['id' => $video->id]);
            if ($channel) {
                $video->Channel_profile = route('video.image', ['imagePath' => $channel->profile]);
                $video->Channel_name = $channel->name;
            }
            $video->user;
        }
        return $videos;
    }
    public function getVideos()
    {
        $videos = Video::orderByDesc('date_time')
            ->orderByDesc('viewer')
            ->get();
        if ($videos->count() > 0) {
            $videos = $this->getSrc($videos);
        }
        return $videos;
    }
    public function getImage($imagePath)
    {
        $imageData = storage_path('app/public/image/' . $imagePath);

        $headers = [
            'Content-Type' => 'image/jpg',
        ];
        return response()->download($imageData, $imagePath, $headers);
    }
    public function playVideo($id)
    {
        $video = Video::find($id);
        if (isset($video)) {
            $path = storage_path() . '/app/public/videos/' . $video->path;

            $headers = [
                'Content-Type' => 'video/mp4',
            ];
            return response()->download($path, $video->path, $headers);
        }
        return response()->json(['success' => false, 'message' => 'Video is not found'], 404);
    }

    public function index(Request $request)
    {
        $page = $request->input('page') ?? 1; // Get the current page number from the request, or default to 1
        $perPage = 6; // Change the number 10 to the desired number of videos per page
        $videos = $this->getVideos()
            ->skip(($page - 1) * $perPage)
            ->take($perPage);

        if ($videos->count()) {
            return response()->json([
                'message' => 'Successful',
                'data' => $videos
            ], 200);
        }
        return response()->json(['success' => false, 'message' => 'This user dose not have any videos yet'], 404);
    }

    public function getVideoByCategory($id)
    {
        // return $id;
        $video = Video::find($id);
        if (isset($video)) {
            $category_id = $video->categories_id;
            $videos = Categories::find($category_id)->videos->where('id', "!=", $video->id);
            if ($videos->count()) {
                $videos = $this->getSrc($videos);
                return response()->json([
                    'message' => 'Successful',
                    'data' => $videos
                ], 200);
            }
            return response()->json(['success' => true, 'message' => "In this theme just hvae this " . $video->title . ' only', 'data' => $this->getVideos()], 200);
        }
        return response()->json(['success' => false, 'message' => 'Video is not found'], 404);
    }
    // get videos of user
    public function getVideosOfUser()
    {
        $videos = Auth::user()->channel->videos; 
        if ($videos->count()) {
            $videos = $this->getSrc($videos);
            return response()->json([
                'message' => 'Successful',
                'data' => $videos
            ], 200);
        }
        return response()->json(['success' => false, 'message' => 'You do not have any video yet'], 404);
    }
    // get videos content creator

    public function getVideosOfUserID($id)
    {
        $videos = User::find($id)->videos;
        if ($videos->count()) {
            $videos = $this->getSrc($videos);
            return response()->json([
                'message' => 'Successful',
                'data' => $videos
            ], 200);
        }
        return response()->json(['success' => false, 'message' => 'This user dose not have any videos yet'], 404);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $video = Video::find($id);
        if ($video) {
            $channel= Channel::find($video->channel_id);
            $path = storage_path() . '/app/public/videos/' . $video->path;
            $video->image = $video->thumbnail;
            $video->thumbnail = route('video.image', ['imagePath' => $video->thumbnail]);
            $video->videoType = mime_content_type($path);
            $video->src = route('video.play', ['id' => $video->id]);
            $video->user;
            if ($channel) {
                $video->Channel_profile = route('video.image', ['imagePath' => $channel->profile]);
                $video->Channel_name = $channel->name;
            }
            return response()->json([
                'message' => 'Successful',
                'data' => $video
            ], 200);
        }
        return response()->json(['success' => false, 'message' => 'Video not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, EditVideoRequest $request)
    {
        $video = $request->only([
            'title',
            'description',
            'date_time',
            'privacy',
            'categories_id'
        ]);
        $videos= Auth::user()->channel->videos()->find($id);
        if (!$videos) {
            return response()->json(['success' => false, 'message' => 'Error updating video'], 404);
        }
        if ($request->hasFile('thumbnail')) {
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = $thumbnail->getClientOriginalName();
                $isThumbnailUploaded = Storage::disk('public')->put('image/' . $thumbnailName, file_get_contents($thumbnail));
                if (!$isThumbnailUploaded) {
                    return response()->json(['success' => false, 'message' => 'Image upload failed'], 404);
                }
                if ($videos->thumbnail != $thumbnailName) {
                    // Only update the video thumbnail if the new thumbnail file is different from the existing one
                    $video['thumbnail'] = $thumbnailName;
                }
            }
        }
        $videos->update($video);
        return response()->json(['success' => true, 'message' => 'Video updated successfully', 'videos' => $videos], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $video = $user->channel->videos->find($id);
        if ($video) {
            $video->delete();
            return response()->json(['success' => true, 'message' => 'You have delete the successfully ',], 200);
        }
        return response()->json(['success' => false, 'message' => "The video is not your"], 404);
    }

    public function deleteVideo($id)
    {
        $videos = Video::find($id)->delete();
        return $videos;
    }

    public function uploadVideo(StoreVideoRequest $request)
    {

        $video = $request->only('title', 'description', 'thumbnail', 'date_time', 'privacy', 'categories_id');
        $fileName = $request->path->getClientOriginalName();
        $thumbNail = $request->thumbnail->getClientOriginalName();
        $video = Arr::add($video, 'viewer', 0);
        $video['thumbnail'] = $thumbNail;
        $video = Arr::add($video, 'path', $fileName);
        $video = Arr::add($video, 'channel_id', Auth::user()->channel->id);
        $isFileUploaded = Storage::disk('public')->put('videos/' . $fileName, file_get_contents($request->path));
        $isThumbnailUploaded = Storage::disk('public')->put('image/' . $thumbNail, file_get_contents($request->thumbnail));
        // File URL to access the video in frontend
        $url = Storage::disk('public')->url('videos/' . $fileName);
        if ($isFileUploaded && $isThumbnailUploaded) {
            $video = Video::create($video);
            $notificationController = new NotificationController();
            $request = new Request([
                'video_id' => $video->id,
                'channel_id' => Auth::user()->channel->id,
                'date_time' => $request->date_time
            ]);
            $response = $notificationController->store($request);
            return response()->json(['success' => true, 'message' => 'Uploaded video successfully', 'video' => $video], 200);
        }
        return response()->json(['success' => false, 'message' => 'Video uploaded unsuccessful'], 404);
    }
    ///search
    public function searchVideo($title)
    {
        $videos = Video::where('title', 'like', '%' . $title . '%')
            ->get();
        if ($videos->count()) {
            $this->getSrc($videos);
            return response()->json(['success' => true, 'message' => 'There are the result', 'data' => $videos], 200);
        }
        return response()->json(['success' => true, 'message' => 'There are some data', 'data' => Video::limit(12)->get()], 200);
    }
    public function videoRecommendation($id, $category_id, Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = 6;
        $select = Video::find($id);
        $videoList = Video::whereNotIn('id', [$id])
        ->orderByDesc('title', 'like', '%' . $select->title . '%')
        ->orderBy('title', 'desc')
        ->orderBy('date_time', 'desc')
        ->orderBy('viewer', 'desc')
        ->get();
        $recommendedVideos = $videoList->where('categories_id', $category_id);
        $otherVideos = $videoList->whereNotIn('id', $recommendedVideos->pluck('id'));
        $videos = $recommendedVideos->merge($otherVideos)
            ->skip(($page - 1) * $perPage)
            ->take($perPage);
        if ($videos->count()) {
            $videos = $this->getSrc($videos);
            return response()->json(['success' => true, 'message' => 'Here are the results', 'data' => $videos], 200);
        }
        return response()->json(['success' => false, 'message' => 'There is no data'], 404);
    }
    public function videoRecommendationHomePage($category, Request $request)
    {
        $page = $request->input('page') ?? 1; // Get the current page number from the request, or default to 1
        $perPage = 6; // Ch
        $video = Video::where('categories_id', $category)
            ->orderByDesc('date_time')
            ->orderByDesc('viewer')
            ->get();
        $videos = Video::whereNotIn('id', $video->pluck('id'))
            ->orderByDesc('date_time')
            ->orderByDesc('viewer')
            ->get();
        $video =$video->merge($videos)
            ->skip(($page - 1) * $perPage)
            ->take($perPage);
        if ($video->count()) {
            $video = $this->getSrc($video);
            return response()->json(['success' => true, 'message' => 'There are the result', 'data' => $video], 200);
        }
        return response()->json(['success' => false, 'message' => 'There is no data'],404);
    }
    public function storeViewer($id)
    {
        $video = Video::find($id);
        if ($video) {
            $video->update(['viewer' => $video->viewer + 1]);
            return response()->json(['success' => true, 'message' => 'Viewer has been stored'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Store viewer failed'], 404);
    }
    // public function getSrc($videos)
    // {
    //     foreach ($videos as $video) {
    //         $path = storage_path() . '/app/public/videos/' . $video->path;
    //         $video->thumbnail = route('video.image', ['imagePath' => $video->thumbnail]);
    //         $video->videoType = mime_content_type($path);
    //         $video->src = route('video.play', ['id' => $video->id]);
    //         $video->user;
    //     }
    //     return $videos;
    // }
}
