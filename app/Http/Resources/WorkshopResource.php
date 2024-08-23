<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\WorkerResource;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkshopResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_en' => $this->translateOrDefault('en')->title ?? null,
            'title_ar' => $this->translateOrDefault('ar')->title  ?? null,
            'content_en' => $this->translateOrDefault('en')->content  ?? null,
            'content_ar' => $this->translateOrDefault('ar')->content  ?? null,
            'image' => ($this->image) ? asset('storage/' . $this->image):null,
            'owner' => UserResource::make($this->owner),
            'workers' => WorkerResource::collection($this->workers)
        ];
    }
}
