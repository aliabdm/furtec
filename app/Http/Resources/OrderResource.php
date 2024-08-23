<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $status =
        return [
            'id' => $this->id,
            'name' => $this->name,
            'receiver_name' => $this->receiver_name,
            'phone' => $this->phone,
            'note' => $this->note,
            'task_id' => $this->task_id,
            'status' => $this->status,
            'status_text' => $this->status_text,
            'delivery_date' => Carbon::parse($this->delivery_date)->format('Y-m-d'),
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'workshop' => new WorkshopResource($this->workshop),
            'room' => new RoomResource($this->room),
            'created_by' => new UserResource($this->createdBy),
            'order_parts' => OrderPartResource::collection($this->orderParts)
        ];
    }
}
