<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderPartRequest;
use App\Http\Requests\UpdateOrderPartRequest;
use App\Services\Contracts\OrderPartServiceInterface;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;

class OrderPartController extends Controller
{
    use ApiResponser;

    protected $orderPartService;

    public function __construct(OrderPartServiceInterface $orderPartService)
    {
        $this->orderPartService = $orderPartService;
    }

    public function store(StoreOrderPartRequest $request)
    {
        $orderPart = $this->orderPartService->store($request);
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $orderPart);
    }

    public function show($id)
    {
        $orderPart = $this->orderPartService->show($id);
        if (!$orderPart) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $orderPart);
    }

    public function update(UpdateOrderPartRequest $request, $id)
    {
        $orderPart = $this->orderPartService->show($id);
        if (!$orderPart) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        $orderPart = $this->orderPartService->update($orderPart, $request);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK,$orderPart);
    }

    public function destroy($id)
    {
        $orderPart = $this->orderPartService->show($id);
        if (!$orderPart) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        $orderPart = $this->orderPartService->delete($id);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, null);
    }
}
