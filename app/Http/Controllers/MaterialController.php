<?php
namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Services\Contracts\MaterialServiceInterface;

class MaterialController extends Controller
{
    use ApiResponser;

    protected $materialService;

    public function __construct(MaterialServiceInterface $materialService)
    {
        $this->materialService = $materialService;
    }

    public function list()
    {
        $materials = $this->materialService->listAllMaterials();
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), 200, $materials);
    }
}
