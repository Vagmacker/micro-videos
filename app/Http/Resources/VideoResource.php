<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(mixed $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'year_launched' => $this->year_launched,
            'opened' => $this->opened,
            'rating' => $this->rating,
            'duration' => $this->duration,
            'categories' => CategoryResource::collection($this->categories),
            'genres' => CategoryResource::collection($this->genres)
        ];
    }
}
