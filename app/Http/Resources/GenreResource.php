<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class GenreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape(['id' => "string", 'name' => "string"])]
    public function toArray(mixed $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
