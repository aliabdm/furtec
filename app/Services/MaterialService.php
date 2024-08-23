<?php
namespace App\Services;

use App\Http\Resources\MaterialResource;
use App\Services\Contracts\MaterialServiceInterface;
use App\Repositories\Contracts\MaterialRepositoryInterface;

class MaterialService implements MaterialServiceInterface
{
    protected $materialRepository;

    public function __construct(MaterialRepositoryInterface $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    public function listAllMaterials()
    {

        return MaterialResource::collection($this->materialRepository->getAll());
    }
}
