<?php
namespace App\Repositories;

use App\Models\Part;
use Illuminate\Support\Collection;
use App\Http\Resources\PartResource;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Contracts\PartRepositoryInterface;

class PartRepository implements PartRepositoryInterface
{
    public function getPartsByWorkshopId(int $workshopId, ?string $color)
    {
        $query = Part::query()->where('workshop_id', $workshopId);

        if ($color) {
            $query->where('color', 'like', '%' . $color . '%');
        }
        $parts = $query->paginate();

        return $parts;
    }

    public function getPartsByColor(int $workshopId, string $color)
    {
        return Part::where('workshop_id', $workshopId)
            ->where('color', 'like', '%' . $color . '%')
            ->get();
    }

    public function findById($id)
    {
        return Part::where('id',$id)->first();
    }

    public function create($request)
    {
        $part = new Part();
        $part->workshop_id = $request->workshop_id;
        $part->material_id = $request->material_id;
        $part->name = $request->name;
        $part->color = $request->color;
        $part->count = $request->count;
        $part->thickness = $request->thickness;
        $part->height = $request->height;
        $part->width = $request->width;
        $part->image = $request->image;
        $part->save();
        return $part;
    }

    public function update($request,$part)
    {
        $part = new Part();
        $part->workshop_id = $request->workshop_id;
        $part->material_id = $request->material_id;
        $part->name = $request->name;
        $part->color = $request->color;
        $part->count = $request->count;
        $part->thickness = $request->thickness;
        $part->height = $request->height;
        $part->width = $request->width;
        $part->image = $request->image;
        $part->save();
        return $part;
    }

    public function delete(Part $part)
    {
        $part->delete();
    }
}
