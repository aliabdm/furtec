<?php
namespace App\Services\Contracts;

interface RoomServiceInterface
{
    public function list($request);
    public function store($request);
    public function show($id);
    public function update($room,$request);
    public function destroy($id);
}
