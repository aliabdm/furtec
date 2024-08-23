<?php
namespace App\Repositories\Contracts;

interface RoomPartRepositoryInterface
{
    public function getById($id);
    public function create($request);
    public function update($request, $roomPart);
    public function delete($id);
}
