<?php

namespace App\Repositories;

use App\Models\RoomPart;
use App\Repositories\Contracts\RoomPartRepositoryInterface;

class RoomPartRepository implements RoomPartRepositoryInterface
{
    public function getById($id)
    {
        return RoomPart::find($id);
    }

    public function create($request)
    {
        $roomPart = new RoomPart();
        $roomPart->room_id = $request->room_id;
        $roomPart->material_id = $request->material_id;
        $roomPart->name = $request->name;
        $roomPart->color = $request->color;
        $roomPart->count = $request->count;
        $roomPart->thickness = $request->thickness;
        $roomPart->height = $request->height;
        $roomPart->width = $request->width;
        $roomPart->image = $request->image;
        $roomPart->save();

        return $roomPart;
    }


    public function update($request, $roomPart)
    {
        $roomPart->room_id = $request->room_id;
        $roomPart->material_id = $request->material_id;
        $roomPart->name = $request->name;
        $roomPart->color = $request->color;
        $roomPart->count = $request->count;
        $roomPart->thickness = $request->thickness;
        $roomPart->height = $request->height;
        $roomPart->width = $request->width;
        $roomPart->image = $request->image;
        $roomPart->save();

        return $roomPart;
    }

    public function delete($id)
    {
        $roomPart = RoomPart::find($id);
        return $roomPart->delete();
    }
}
