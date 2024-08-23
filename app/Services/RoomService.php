<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\RoomResource;
use App\Repositories\RoomPartRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreRoomPartRequest;
use App\Services\Contracts\RoomServiceInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;

class RoomService implements RoomServiceInterface
{
    protected $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository)
    {
        $this->roomRepository = $roomRepository;
    }

    public function list($request)
    {
        $user = auth()->user();
        $rooms = $this->roomRepository->getAllRooms($user->id, $user->role_id, $request->name);
        $collection = RoomResource::collection($rooms);
        return $rooms;
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $request->user_id = $user->role_id == Role::WORKER ? $user->workshop->user_id : $user->id;
            $request->image = $request->hasFile('image') ? uploadFile('room', $request->file('image')) : null;
            $room = $this->roomRepository->create($request);
            if ($request->room_parts) {
                foreach ($request->room_parts as $roomPart) {
                    $validator = Validator::make($roomPart, (new StoreRoomPartRequest)->rules());

                    if ($validator->fails()) {
                        return (object)['not_valid' => true, 'errors' => $validator->errors()];
                    }
                    $newRoomPart = (object) $roomPart;
                    $newRoomPart->room_id = $room->id;
                    $newRoomPart->image = !empty($orderPart['image']) ? uploadFile('roomPart', $roomPart['image']) : null;
                    $roomPartRepository = resolve(RoomPartRepository::class);
                    $roomPartRepository->create($newRoomPart);
                }
            }

            DB::commit();
            return RoomResource::make($room);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function show($id)
    {
        $room = $this->roomRepository->getById($id);
        if (!$room) {
            return;
        }

        return RoomResource::make($room);
    }

    public function update($room, $request)
    {
        $userId = auth()->user()->id;
        $request->image = $request->hasFile('image') ? uploadFile('room', $request->file('image'), $room->image) : $room->image;

        return RoomResource::make($this->roomRepository->update($request, $room));
    }

    public function destroy($id)
    {
        $this->roomRepository->delete($id);
    }
}
