<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Http\Resources\WorkshopResource;
use App\Http\Requests\StoreWorkshopRequest;
use App\Http\Requests\UpdateWorkshopRequest;
use App\Services\Contracts\WorkshopServiceInterface;

class WorkshopController extends Controller
{
    use ApiResponser;

    protected $workshopService;

    public function __construct(WorkshopServiceInterface $workshopService)
    {
        $this->workshopService = $workshopService;
    }

    public function list()
    {
        $workshops = $this->workshopService->listWorkshops();
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, WorkshopResource::collection($workshops));
    }

    public function store(StoreWorkshopRequest $request)
    {
        $workshop = $this->workshopService->storeWorkshop($request);
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, WorkshopResource::make($workshop));
    }

    public function show($id)
    {
        $workshop = $this->workshopService->showWorkshop($id);
        if (!$workshop) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, WorkshopResource::make($workshop));
    }

    public function update(UpdateWorkshopRequest $request, $id)
    {
        $workshop = $this->workshopService->showWorkshop($id);
        if (!$workshop) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        
        if (!$this->workshopService->isOwner($workshop)) {
            return $this->errorResponse(Response::HTTP_FORBIDDEN, trans('api.access denied'), Response::HTTP_FORBIDDEN);
        }

        $workshop = $this->workshopService->updateWorkshop($request, $workshop);
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, WorkshopResource::make($workshop));
    }

    public function revertStatus($id)
    {
        $workshop = $this->workshopService->revertStatus($id);
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, WorkshopResource::make($workshop));
    }
}
