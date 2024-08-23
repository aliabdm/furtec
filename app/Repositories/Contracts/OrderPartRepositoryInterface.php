<?php
namespace App\Repositories\Contracts;

use App\Models\OrderPart;

interface OrderPartRepositoryInterface
{
    public function getById($id);
    public function create($request);
    public function update($request, $orderPart);
    public function delete($id);
}
