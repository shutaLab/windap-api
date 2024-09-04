<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CalendarEventResource extends JsonResource
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
            'content' => $this->content,
            'start' => $this->start,
            'end' => $this->end,
            'is_absent' => $this->is_absent,
            'user' => new UserResource($this->whenLoaded('user')),
        ];    
    }
}
