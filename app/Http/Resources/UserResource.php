<?php

namespace App\Http\Resources;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'is_active' => $this->is_active ? true:false,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'certificate' => $this->certificate ? asset('storage/' . $this->certificate) : null,
            'role' => new RoleResource($this->role)
        ];

        if (isset($this->token)) {
            $data['token'] = $this->token;
        }
        if ($this->role->id == Role::WORKER) {
            $data['workshop'] = new WorkshopResource($this->workshop);
        }

        return $data;
    }
}
