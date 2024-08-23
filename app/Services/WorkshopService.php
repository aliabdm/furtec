<?php
namespace App\Services;

use App\Http\Resources\WorkshopResource;
use App\Services\Contracts\WorkshopServiceInterface;
use App\Repositories\Contracts\WorkshopRepositoryInterface;

class WorkshopService implements WorkshopServiceInterface
{
    protected $workshopRepository;

    public function __construct(WorkshopRepositoryInterface $workshopRepository)
    {
        $this->workshopRepository = $workshopRepository;
    }

    public function listWorkshops()
    {
        return WorkshopResource::collection($this->workshopRepository->listWorkshopsByUserId(auth()->user()->id));
    }

    public function storeWorkshop($request)
    {
        $request->user_id = auth()->user()->id;
        $request->image = $request->hasFile('image') ? uploadFile('user', $request->file('image')) : null;

        return WorkshopResource::make($this->workshopRepository->createWorkshop($request));
    }

    public function showWorkshop($id)
    {
        $workshop = $this->workshopRepository->getWorkshopById($id);
        if (!$workshop) {
            return;
        }
        return WorkshopResource::make($workshop);
    }

    public function updateWorkshop($request, $workshop)
    {
        $workshop->image = $request->hasFile('image') ? uploadFile('user', $request->file('image'), $workshop->image) : $workshop->image;
        return WorkshopResource::make($this->workshopRepository->updateWorkshop($request, $workshop));
    }
    
    //TO DO
    public function revertStatus($id)
    {
        $workshop = $this->workshopRepository->getWorkshopById($id);
        $workshop->is_hidden = !$workshop->is_hidden;
        $workshop->save();

        return WorkshopResource::make($workshop);
    }

    public function isOwner($workshop)
    {
        if ($workshop->user_id != auth()->user()->id) {
            return false;
        }
        return true;
    }
}
