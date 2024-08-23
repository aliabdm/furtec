<?php
namespace App\Services\Contracts;

interface WorkshopServiceInterface
{
    public function listWorkshops();
    public function storeWorkshop($request);
    public function showWorkshop($id);
    public function updateWorkshop($request, $id);
    public function revertStatus($id);
    public function isOwner($workshop);
}
