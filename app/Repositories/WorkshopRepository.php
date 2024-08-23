<?php
namespace App\Repositories;

use App\Models\Workshop;
use App\Repositories\Contracts\WorkshopRepositoryInterface;

class WorkshopRepository implements WorkshopRepositoryInterface
{
    public function createWorkshop($request)
    {
        $workShop = new WorkShop();
        $workShop->user_id = $request->user_id;
        $workShop->image = $request->image;
        foreach (LANGUAGES as $lang) {
            $workShop->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
            $workShop->translateOrNew($lang['code'])->content = trim($request->get('content_' . $lang['code']));
        }
        $workShop->save();

        return $workShop;
    }

    public function getWorkshopById($id)
    {
        return Workshop::where('id',$id)->first();
    }

    public function updateWorkshop($request, $workshop)
    {
        foreach (LANGUAGES as $lang) {
            $workshop->translateOrNew($lang['code'])->title = trim($request->get('title_' . $lang['code']));
            $workshop->translateOrNew($lang['code'])->content = trim($request->get('content_' . $lang['code']));
        }
        $workshop->save();

        return $workshop;
    }

    public function deleteWorkshop($id)
    {
        $workshop = $this->getWorkshopById($id);
        $workshop->delete();
    }

    public function listWorkshopsByUserId($userId)
    {
        return Workshop::where('user_id', $userId)
            ->where('is_hidden', false)
            ->get();
    }
}
