<?php
namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findById($id);
    public function findByUsername($username);
    public function create($request);
    public function update($user,$request);
    public function getWorkersByWorkshops(array $workshopIds);
    public function getUserByWorkshopId($workshopId);
}
