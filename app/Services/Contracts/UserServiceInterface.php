<?php
namespace App\Services\Contracts;

use App\Models\User;

interface UserServiceInterface
{
    public function register($request);
    public function login(array $data);
    public function updateProfile(User $user, array $data);
    public function updateUserById($id, array $data);
    public function getUserById($id);
    public function getWorkers();
    public function check($request);
}
