<?php

// app/Http/Controllers/RoomController.php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\RoomResource;
use App\Services\Contracts\RoomServiceInterface;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

class RoomController extends Controller
{
    use ApiResponser;

    protected $roomService;

    public function __construct(RoomServiceInterface $roomService)
    {
        $this->roomService = $roomService;
    }

    public function list(Request $request)
    {
        $rooms = $this->roomService->list($request);
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $rooms);
    }

    public function store(StoreRoomRequest $request)
    {
        $room = $this->roomService->store($request);
        if ($room->not_valid) {
            return $this->validationResponse(Response::HTTP_UNPROCESSABLE_ENTITY,__('api.validation failed'),Response::HTTP_UNPROCESSABLE_ENTITY,$order->errors);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $room);
    }

    public function show($id)
    {
        $room = $this->roomService->show($id);
        if (!$room) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $room);
    }

    public function update(UpdateRoomRequest $request, $id)
    {
        $room = $this->roomService->show($id);
        if (!$room) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }

        $room = $this->roomService->update($room, $request);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK,$room);
    }

    public function destroy($id)
    {
        $room = $this->roomService->show($id);
        if (!$room) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        $room = $this->roomService->delete($id);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, null);
    }
}
