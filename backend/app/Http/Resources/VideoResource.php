<?php

namespace App\Http\Resources;

use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => route('video.image', ['imagePath' => $this->thumbnail]) ,
            'date_time' => $this->date_time,
            'src' => route('video.play', ['id' => $this->id]),
            'path' => $this->path,
            'privacy' => $this->privacy,
            'viewer' => $this->viewer,
            'category' => new CategoriesResource($this->categories),
            'Channel_name' => Channel::find($this->channel_id)->name,
            'channel_id' => $this->channel_id,
            'Channel_profile' => route('video.image', ['imagePath' => ($this->Channel::find($this->channel_id)->profile)])
        ];
    }
}
