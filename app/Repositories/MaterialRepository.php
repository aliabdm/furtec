<?php
namespace App\Repositories;

use App\Models\Material;
use App\Repositories\Contracts\MaterialRepositoryInterface;

class MaterialRepository implements MaterialRepositoryInterface
{
    public function getAll()
    {
        return Material::all();
    }
}
