<?php
namespace App\Repositories\Contracts;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function getById($id);
    public function getAllByWorkshopId($workshopId, $filters = []);
    public function create($request);
    public function update($request, $order);
    public function log($order,$request);
}
