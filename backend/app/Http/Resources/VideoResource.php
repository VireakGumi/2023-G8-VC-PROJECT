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
<<<<<<< HEAD
            'thumbnail' => $this->thumbnail,
            'date_time' => $this->date,
            'path' => $this->path,
            'privacy' => $this->privacy,
            'categories_id' => new CategoriesResource($this->categories_id),
=======
            'thumbnail' => route('video.image', ['imagePath' => $this->thumbnail]) ,
            'date_time' => $this->date_time,
            'src' => route('video.play', ['id' => $this->id]),
            'path' => $this->path,
            'privacy' => $this->privacy,
            'category' => new CategoriesResource($this->categories),
>>>>>>> 1ee7bd2a612998ab807eab98b7169bfad5ba98d9
        ];
    }
}
