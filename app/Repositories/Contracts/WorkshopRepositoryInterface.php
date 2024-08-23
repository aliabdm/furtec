<?php
namespace App\Repositories\Contracts;

interface WorkshopRepositoryInterface
{
    public function createWorkshop($request);
    public function getWorkshopById($id);
    public function updateWorkshop($request, $workshop);
    public function deleteWorkshop($id);
    public function listWorkshopsByUserId($userId);
}
