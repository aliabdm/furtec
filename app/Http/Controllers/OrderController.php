<?php
namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\Contracts\OrderServiceInterface;

class OrderController extends Controller
{
    use ApiResponser;

    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function list(Request $request, $id)
    {
        $user = auth()->user();
        $isOwnedWorkshop = $this->orderService->check($user,$id);
        if (!$isOwnedWorkshop) {
            return $this->errorResponse(Response::HTTP_FORBIDDEN, trans('api.access denied'), Response::HTTP_FORBIDDEN);
        }
        $orders = $this->orderService->list($id, $request->all());
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->store($request);
        if ($order->not_valid) {
            return $this->validationResponse(Response::HTTP_UNPROCESSABLE_ENTITY,__('api.validation failed'),Response::HTTP_UNPROCESSABLE_ENTITY,$order->errors);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $order);
    }

    public function show($id)
    {
        $order = $this->orderService->show($id);
        if (!$order) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $order);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $order = $this->orderService->show($id);
        if (!$order) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.record does not exist'), Response::HTTP_NOT_FOUND);
        }
        $isAllowed = $this->orderService->check(auth()->user(),$request->workshop_id);
        if (!$isAllowed) {
            return $this->errorResponse(Response::HTTP_FORBIDDEN, trans('api.access denied'), Response::HTTP_FORBIDDEN);
        }

        $order = $this->orderService->update($order, $request);

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK,$order);
    }
}
