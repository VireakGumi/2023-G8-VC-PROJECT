<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'user'=> $this->user,
            'video'=> new VideoResource($this->video),
            'comment'=>$this->comment,
            'type_report'=>$this->type_of_report,
            'content'=>$this->content_video
        ];
    }
}
