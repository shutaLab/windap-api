<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WindNoteResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'favorites' => NoteFavoriteResource::collection($this->whenLoaded('noteFavorites')),
        ];
    }
}
