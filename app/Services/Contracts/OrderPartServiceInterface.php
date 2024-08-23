<?php
namespace App\Services\Contracts;

interface OrderPartServiceInterface
{
    public function store($request);
    public function show($id);
    public function update($orderPart, $request);
    public function delete($id);
}
