<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkerResource extends JsonResource
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
            'username' => $this->username,
            'name' => $this->name,
            'workshop_name' => $this->workshop->translateOrDefault()->title,
            'is_active' => $this->is_active ? true:false,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'role' => new RoleResource($this->role)
        ];
    }
}
