<?php
namespace App\Services\Contracts;

interface RoomPartServiceInterface
{
    public function store($request);
    public function show($id);
    public function update($roomPart, $request);
    public function delete($id);
}
