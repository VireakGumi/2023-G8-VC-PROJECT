<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
<<<<<<< HEAD
            'video_id' => new VideoResource($this->video_id),
=======
            'user_id' => $this->user_id,
            'date_time' => $this->date_time,
            'video' => new VideoResource($this->video),
>>>>>>> 1ee7bd2a612998ab807eab98b7169bfad5ba98d9
        ];
    }
}
