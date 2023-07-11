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
            'id' => $request->id,
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $request->thumbnail ,
            'date_time' => $request->date,
            'path' => $request->path ,
            'privacy' => $request->privacy,
            'categories_id' => new CategoriesResource($request->categories_id),
        ];
    }
}
