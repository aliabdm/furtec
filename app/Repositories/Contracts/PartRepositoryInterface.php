<?php
namespace App\Repositories\Contracts;

use App\Models\Part;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface PartRepositoryInterface
{
    public function getPartsByWorkshopId(int $workshopId, ?string $color);
    public function getPartsByColor(int $workshopId, string $color);
    public function findById($id);
    public function create($request);
    public function update($request,$part);
    public function delete(Part $part);
}
