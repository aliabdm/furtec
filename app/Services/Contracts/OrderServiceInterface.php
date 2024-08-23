<?php
namespace App\Services\Contracts;

interface OrderServiceInterface
{
    public function list($workshopId, $filters = []);
    public function store($request);
    public function show($id);
    public function update($order,$request);
    public function check($user,$id);
}
