<?php
namespace App\Services;

use App\Http\Resources\RoomPartResource;
use App\Services\Contracts\RoomPartServiceInterface;
use App\Repositories\Contracts\RoomPartRepositoryInterface;

class RoomPartService implements RoomPartServiceInterface
{
    protected $roomPartRepository;

    public function __construct(RoomPartRepositoryInterface $roomPartRepository)
    {
        $this->roomPartRepository = $roomPartRepository;
    }

    public function store($request)
    {
        $request->image = $request->hasFile('image') ? uploadFile('roomPart', $request->file('image')) : null;

        return RoomPartResource::make($this->roomPartRepository->create($request));
    }

    public function show($id)
    {
        return $this->roomPartRepository->getById($id);
    }

    public function update($roomPart,$request)
    {
        $request->image = $request->hasFile('image') ? uploadFile('roomPart', $request->file('image'), $roomPart->image) : $roomPart->image;
        return RoomPartResource::make($this->roomPartRepository->update($request, $roomPart));
    }

    public function delete($id)
    {
        return $this->roomPartRepository->delete($id);
    }
}
