<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Services\Contracts\RoomPartServiceInterface;
use App\Http\Requests\StoreRoomPartRequest;
use App\Http\Requests\UpdateRoomPartRequest;

class RoomPartController extends Controller
{
    use ApiResponser;

    protected $roomPartService;

    public function __construct(RoomPartServiceInterface $roomPartService)
    {
        $this->roomPartService = $roomPartService;
    }

    public function store(StoreRoomPartRequest $request)
    {
        $roomPart = $this->roomPartService->store($request);
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $roomPart);
    }

    public function show($id)
    {
        $roomPart = $this->roomPartService->show($id);
        if (!$roomPart) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $roomPart);
    }

    public function update(UpdateRoomPartRequest $request, $id)
    {
        $roomPart = $this->roomPartService->show($id);
        if (!$roomPart) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        $roomPart = $this->roomPartService->update($roomPart, $request);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK,$roomPart);
    }

    public function destroy($id)
    {
        $roomPart = $this->roomPartService->show($id);
        if (!$roomPart) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        $roomPart = $this->roomPartService->delete($id);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, null);
    }
}
