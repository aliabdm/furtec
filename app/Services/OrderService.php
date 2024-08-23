<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\OrderResource;
use App\Repositories\WorkshopRepository;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreOrderPartRequest;
use App\Services\Contracts\OrderServiceInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\OrderPartRepository;

class OrderService implements OrderServiceInterface
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function list($workshopId, $filters = [])
    {
        $orders = $this->orderRepository->getAllByWorkshopId($workshopId, $filters);
        $collection = OrderResource::collection($orders);

        return $orders;
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $request->status = Order::PENDING;
            $request->delivery_date = Carbon::parse($request->delivery_date)->toDateTimeString();
            $request->image = $request->hasFile('image') ? uploadFile('order', $request->file('image')) : null;
            $order = $this->orderRepository->create($request);
            if ($request->order_parts) {
                $orderParts = collect($request->order_parts);
                foreach ($orderParts as $key => $orderPart) {
                    $validator = Validator::make($orderPart, (new StoreOrderPartRequest())->rules());
                    if ($validator->fails()) {
                        return (object)['not_valid' => true, 'errors' => $validator->errors()];
                    }
                    $newOrderPart = (object) $orderPart;
                    $newOrderPart->order_id = $order->id;
                    $newOrderPart->image = !empty($orderPart['image']) ? uploadFile('orderPart', $orderPart['image']) : null;
                    $orderPartRepository = resolve(OrderPartRepository::class);
                    $orderPartRepository->create($newOrderPart);
                }
            }
            DB::commit();
            return OrderResource::make($order);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $order = $this->orderRepository->getById($id);
        if (!$order) {
            return;
        }

        return OrderResource::make($order);
    }

    public function update($order, $request)
    {
        if ($request->status !== $order->status) {
            $this->orderRepository->log($order, $request);
        }
        $request->delivery_date = Carbon::parse($request->delivery_date)->toDateTimeString();
        $request->image = $request->hasFile('image') ? uploadFile('order', $request->file('image'), $order->image) : $order->image;
        return OrderResource::make($this->orderRepository->update($request, $order));
    }

    public function check($user, $id)
    {
        $workshopRepository = resolve(WorkshopRepository::class);
        $workshop = $workshopRepository->getWorkshopById($id);
        if ($user->role_id == Role::WORKER) {
            $isAllowed = $workshop->workers()->where('user_id', $user->id)->exist();
        } else {
            $isAllowed = $workshop->user_id == $user->id ? true : false;
        }

        return $isAllowed;
    }
}
