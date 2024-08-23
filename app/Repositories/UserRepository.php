<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findById($id)
    {
        return User::find($id);
    }

    public function findByUsername($username)
    {
        return User::where('username', $username)->first();
    }

    public function create($request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->workshop_id = $request->workshop_id;
        $user->is_active = $request->is_active;
        $user->image = $request->image;
        $user->certificate = $request->certificate;
        $user->password = $request->password;
        $user->save();

        return $user;
    }

    public function update($user,$request)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->workshop_id = $request->workshop_id;
        $user->is_active = $request->is_active;
        $user->image = $request->image;
        $user->certificate = $request->certificate;
        $user->password = $request->password ?? $user->password;

        $user->save();

        return $user;
    }

    public function getWorkersByWorkshops(array $workshopIds)
    {
        return User::whereIn('workshop_id', $workshopIds)->get();
    }

    public function getUserByWorkshopId($workshopId)
    {
        return User::where('workshop_id',$workshopId)->first();
    }

}
