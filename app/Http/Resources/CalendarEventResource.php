<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            'start' => Carbon::parse($this->start)->format('Y-m-d'),
            'end' => Carbon::parse($this->end)->format('Y-m-d'),
            'is_absent' => $this->is_absent,
            'user' => new UserResource($this->whenLoaded('user')),
        ];    
    }
}
