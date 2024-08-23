<?php
namespace App\Repositories;

use App\Models\Role;
use App\Models\Room;
use App\Repositories\Contracts\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    public function getAllRooms($userId, $roleId, $name)
    {
        $rooms = Room::query();

        if ($roleId == Role::WORKER) {
            $rooms = $rooms->withWorkerInWorkshop($userId);
        } else {
            $rooms = $rooms->where('user_id', $userId);
        }

        if ($name) {
            $rooms = $rooms->where('name', 'like', '%' . $name . '%');
        }

        return $rooms->paginate();
    }

    public function getById($id)
    {
        return Room::where('id',$id)->first();
    }

    public function create($request)
    {
        $room = new Room();
        $room->user_id = $request->user_id;
        $room->name = $request->name;
        $room->image = $request->image;
        $room->save();

        return $room;
}

    public function update($request, $room)
    {
        $room->name = $request->name;
        $room->image = $request->image;
        $room->save();

        return $room;
    }

    public function delete($id)
    {
        $room = Room::find($id);
        return $room->delete();
    }
}
