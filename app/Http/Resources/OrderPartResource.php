<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPartResource extends JsonResource
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
            'name' => $this->name,
            'color' => $this->color,
            'count' => $this->count,
            'thickness' => $this->thickness + 0,
            'height' => $this->height + 0,
            'width' => $this->width + 0,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
        ];
    }
}
