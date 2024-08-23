<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\Contracts\UserServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function check($request)
    {
        if ($request->workshop_id) {
            $existingWorker = $this->userRepository->getUserByWorkshopId($request->workshop_id);
            if ($existingWorker) {
                return true;
            }
        }
        return false;
    }
    public function register($request)
    {
        $request->password = Hash::make($request->password);
        $request->image = $request->hasFile('image') ? uploadFile('user', $request->file('image')) : null;
        $request->certificate =  $request->hasFile('certificate') ? uploadFile('user', $request->file('certificate')) : null;
        $request->is_active = $request->role_id != Role::OWNER ? true : false;
        return $this->userRepository->create($request);
    }

    public function login(array $data)
    {
        $user = $this->userRepository->findByUsername($data['username']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return null;
        }
        return $user;
    }

    public function updateProfile(User $user,$request)
    {
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $request->is_active = isset($request->is_active ) ? $request->is_active : $user->is_active;
        $request->image = $request->hasFile('image') ? uploadFile('user', $request->file('image'), $user->image) : $user->image;
        $request->certificate = $request->hasFile('certificate') ? uploadFile('user', $request->file('certificate'), $user->certificate) : $user->certificate;

        return $this->userRepository->update($user, $request);
    }

    public function updateUserById($id, array $data)
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            return null;
        }
        $this->updateProfile($user, $data);
        return $user;
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function getWorkers()
    {
        $user = auth()->user();
        $workshops = $user->workshops->pluck('id')->toArray();
        return $this->userRepository->getWorkersByWorkshops($workshops)->all();
    }
}
