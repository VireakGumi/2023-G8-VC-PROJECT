<?php

namespace App\Http\Resources;

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
        ];
    }
}
