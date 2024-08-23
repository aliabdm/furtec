<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PartResource;
use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;
use App\Services\Contracts\PartServiceInterface;

class PartController extends Controller
{
    use ApiResponser;

    protected $partService;

    public function __construct(PartServiceInterface $partService)
    {
        $this->partService = $partService;
    }

    public function list(Request $request, $id)
    {
        $parts = $this->partService->listParts($id, $request->color);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $parts);
    }

    public function listByColor($id, $color)
    {
        $parts = $this->partService->listPartsByColor($id, $color);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, PartResource::collection($parts));
    }

    public function store(StorePartRequest $request)
    {
        $part = $this->partService->storePart($request);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, PartResource::make($part));
    }

    public function show($id)
    {
        $part = $this->partService->showPart($id);

        if (!$part) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $part);
    }

    public function update(UpdatePartRequest $request, $id)
    {
        try {
            $part = $this->partService->showPart($id);
            if (!$part) {
                return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
            }
            $part = $this->partService->updatePart($request, $part);
        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, PartResource::make($part));
    }

    public function destroy($id)
    {
        try {
            $this->partService->deletePart($id);
        } catch (\Exception $e) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, null);
    }
}
