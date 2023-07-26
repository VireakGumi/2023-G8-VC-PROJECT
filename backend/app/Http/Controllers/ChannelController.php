<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChannelRequest;
use App\Models\Channel;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSrcProfile($channels)
    {
        foreach ($channels as $channel) {
            if ($channel->profile) {
                $path=route('video.image', ['imagePath' => $channel->profile]);
                $extension = pathinfo($channel->profile, PATHINFO_EXTENSION);
                switch ($extension) {
                    case 'jpg':
                    case 'jpeg':
                        $channel->imageType = 'image/jpeg';
                        break;
                    case 'png':
                        $channel->imageType = 'image/png';
                        break;
                    case 'gif':
                        $channel->imageType = 'image/gif';
                        break;
                    case 'svg':
                        $channel->imageType = 'image/svg+xml';
                        break;
                    default:
                        $channel->imageType = '';
                        break;
                }
                $channel= Arr::add($channel, 'path', $path);    
            }
        }

        return $channels;
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role_id === 3) {
            $channels = Channel::get();
            $channels = $this->getSrcProfile($channels);
            return response()->json(['success' => true, 'message' => 'Get channels succesfully', 'data' => $channels], 200);
        }
        return response()->json(['success' => false, 'message' => "Can't get the channels"], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChannelRequest $request)
    {
        $user = Auth::user()->id;
        $request->merge(['user_id' => $user]);
        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $profileName = $profile->getClientOriginalName();
            $isProfileUpload = Storage::disk('public')->put('image/' . $profileName, file_get_contents($profile));
            if (!$isProfileUpload) {
                return response()->json(['success' => false, 'message' => 'Image upload failed'], 404);
            }
            $request->merge(['profile' => $profileName]);
        }
        $channel = Channel::create($request->input());

        if ($channel) {
            return response()->json(['success' => true, 'message' => 'Create Channel successfully', 'data' => $channel], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to create the channel'], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $channel = Channel::find($id);
        if ($channel && $channel->user_id == auth()->id()) {
            $path=route('video.image', ['imagePath' => $channel->profile]);
            $extension = pathinfo($channel->profile, PATHINFO_EXTENSION);
            switch ($extension) {
                case 'jpg':
                case 'jpeg':
                    $channel->imageType = 'image/jpeg';
                    break;
                case 'png':
                    $channel->imageType = 'image/png';
                    break;
                case 'gif':
                    $channel->imageType = 'image/gif';
                    break;
                case 'svg':
                    $channel->imageType = 'image/svg+xml';
                    break;
                default:
                    $channel->imageType = '';
                    break;
            }
            $channel= Arr::add($channel, 'path', $path);   
            return response()->json(['success' => true, 'message' => 'Get channel successfully', 'data' => $channel], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to get the channel'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreChannelRequest $request)
    {
        $channel = Auth::user()->channel;
        if ($channel) {
            $channel->update($request->all());
            return response()->json(['success' => true, 'message' => 'Create Channel successfully', 'data' => $channel], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to update your channel'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $channel = Auth::user()->channel()->find($id);
        if ($channel) {
            $channel->delete($channel);
            return response()->json(['success' => true, 'message' => 'Delete channel successfully'], 200);
        }
        return response()->json(['success' => false, 'message' => 'Failed to delete your channel'], 404);
    }
}
