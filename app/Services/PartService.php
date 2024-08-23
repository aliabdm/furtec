<?php
namespace App\Services;

use App\Http\Resources\PartResource;
use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;
use App\Services\Contracts\PartServiceInterface;
use App\Repositories\Contracts\PartRepositoryInterface;

class PartService implements PartServiceInterface
{
    protected $partRepository;

    public function __construct(PartRepositoryInterface $partRepository)
    {
        $this->partRepository = $partRepository;
    }

    public function listParts(int $workshopId, ?string $color)
    {
        $parts = $this->partRepository->getPartsByWorkshopId($workshopId, $color);
        $collection = PartResource::collection($parts);

        return $parts;
    }

    public function listPartsByColor(int $workshopId, string $color)
    {
        return PartResource::collection($this->partRepository->getPartsByColor($workshopId, $color));
    }

    public function storePart($request)
    {
        $request->image = $request->hasFile('image') ? uploadFile('part', $request->file('image')) : null;

        return PartResource::make($this->partRepository->create($request));
    }

    public function updatePart($request, $part)
    {
        $request->image = $request->hasFile('image') ? uploadFile('part', $request->file('image'), $part->image) : $part->image;

        return PartResource::make($this->partRepository->update($request, $part));
    }

    public function deletePart(int $id)
    {
        $part = $this->partRepository->findById($id);
        if (!$part) {
            throw new \Exception('Part not found');
        }

        $this->partRepository->delete($part);
    }

    public function showPart($id)
    {
        $part = $this->partRepository->findById($id);
        if (!$part) {
            return;
        }
        return PartResource::make($part);
    }
}
