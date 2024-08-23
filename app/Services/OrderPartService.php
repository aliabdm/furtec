<?php
namespace App\Services;

use App\Http\Resources\OrderPartResource;
use App\Services\Contracts\OrderPartServiceInterface;
use App\Repositories\Contracts\OrderPartRepositoryInterface;

class OrderPartService implements OrderPartServiceInterface
{
    protected $orderPartRepository;

    public function __construct(OrderPartRepositoryInterface $orderPartRepository)
    {
        $this->orderPartRepository = $orderPartRepository;
    }

    public function store($request)
    {
        $request->image = $request->hasFile('image') ? uploadFile('orderPart', $request->file('image')) : null;
        return OrderPartResource::make($this->orderPartRepository->create($request));
    }

    public function show($id)
    {
        return OrderPartResource::make($this->orderPartRepository->getById($id));
    }

    public function update($orderPart,$request)
    {
        $request->image = $request->hasFile('image') ? uploadFile('orderPart', $request->file('image'), $orderPart->image) : $orderPart->image;
        return OrderPartResource::make($this->orderPartRepository->update($request, $orderPart));
    }

    public function delete($id)
    {
        return $this->orderPartRepository->delete($id);
    }
}
