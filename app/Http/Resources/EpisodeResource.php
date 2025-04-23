<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeResource extends JsonResource
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
            'audio_url' => $this->audio_url,
            'duration' => $this->duration,
            'podcast_id' => $this->podcast_id,
            'created_at' => $this->created_at,
        ];
    }
}
