<?php
namespace App\Repositories;

use App\Models\OrderPart;
use App\Repositories\Contracts\OrderPartRepositoryInterface;

class OrderPartRepository implements OrderPartRepositoryInterface
{
    public function getById($id)
    {
        return OrderPart::find($id);
    }

    public function create($request)
    {
        $orderPart = new OrderPart();
        $orderPart->order_id = $request->order_id;
        $orderPart->material_id = $request->material_id;
        $orderPart->name = $request->name;
        $orderPart->color = $request->color;
        $orderPart->count = $request->count;
        $orderPart->thickness = $request->thickness;
        $orderPart->height = $request->height;
        $orderPart->width = $request->width;
        $orderPart->image = $request->image;
        $orderPart->save();

        return $orderPart;
    }

    public function update($request, $orderPart)
    {
        $orderPart->order_id = $request->order_id;
        $orderPart->material_id = $request->material_id;
        $orderPart->name = $request->name;
        $orderPart->color = $request->color;
        $orderPart->count = $request->count;
        $orderPart->thickness = $request->thickness;
        $orderPart->height = $request->height;
        $orderPart->width = $request->width;
        $orderPart->image = $request->image;
        $orderPart->save();

        return $orderPart;
    }

    public function delete($id)
    {
        $orderPart = OrderPart::find($id);
        return $orderPart->delete();
    }
}
