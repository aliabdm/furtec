<?php
namespace App\Services\Contracts;

use App\Models\Part;

interface PartServiceInterface
{
    public function listParts(int $workshopId, ?string $color);
    public function listPartsByColor(int $workshopId, string $color);
    public function storePart($request);
    public function updatePart($request, $part);
    public function deletePart(int $id);
    public function showPart(int $id);
}
