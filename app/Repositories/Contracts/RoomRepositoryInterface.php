<?php
namespace App\Repositories\Contracts;

interface RoomRepositoryInterface
{
    public function getAllRooms($userId, $roleId, $name);
    public function create($request);
    public function getById($id);
    public function update($request, $room);
    public function delete($id);
}
