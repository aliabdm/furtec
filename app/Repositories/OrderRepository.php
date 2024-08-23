<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderLog;
use App\Repositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllByWorkshopId($workshopId, $filters = [])
    {
        $query = Order::where('workshop_id', $workshopId);

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->paginate();
    }

    public function getById($id)
    {
        return Order::where('id',$id)->first();
    }
    
    public function create($request)
    {
        $order = new Order();
        $order->created_by = auth()->user()->id;
        $order->name = $request->name;
        $order->receiver_name = $request->receiver_name;
        $order->phone = $request->phone;
        $order->note = $request->note;
        $order->task_id = $request->task_id;
        $order->room_id = $request->room_id;
        $order->workshop_id = $request->workshop_id;
        $order->status = $request->status;
        $order->delivery_date = $request->delivery_date;
        $order->image = $request->image;
        $order->save();

        return $order;
    }

    public function update($request, $order)
    {
        $order->name = $request->name;
        $order->receiver_name = $request->receiver_name;
        $order->phone = $request->phone;
        $order->note = $request->note;
        $order->task_id = $request->task_id;
        $order->room_id = $request->room_id;
        $order->workshop_id = $request->workshop_id;
        $order->status = $request->status;
        $order->delivery_date = $request->delivery_date;
        $order->image = $request->hasFile('image') ? uploadFile('order', $request->file('image'), $order->image) : $order->image;
        $order->save();
        return $order;
    }

    public function log($order,$request)
    {
        $orderLog = new OrderLog();
        $orderLog->from = $order->status;
        $orderLog->to = $request->status;
        $orderLog->order_id = $order->id;
        $orderLog->updated_by = auth()->user()->id;
        $orderLog->save();
    }
}
