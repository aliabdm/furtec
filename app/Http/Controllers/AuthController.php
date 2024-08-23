<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\WorkerResource;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Contracts\UserServiceInterface;

class AuthController extends Controller
{
    use ApiResponser;

    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $WorkshopWorkerAndExist = $this->userService->check($request);
        if ($WorkshopWorkerAndExist) {
            return $this->errorResponse(Response::HTTP_BAD_REQUEST, 'Workshop already has a worker', Response::HTTP_BAD_REQUEST);
        }
        $user = $this->userService->register($request);
        $token = $user->createToken($user->username)->plainTextToken;
        $userResource = UserResource::make($user);
        $userResource->token = $token;
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $userResource);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->userService->login($request->validated());
        if (!$user) {
            return $this->errorResponse(Response::HTTP_UNAUTHORIZED, trans('api.public.Invalid credentials'), Response::HTTP_UNAUTHORIZED);
        }

        $token = $user->createToken($user->username)->plainTextToken;
        $userResource = UserResource::make($user);
        $userResource->token = $token;

        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, $userResource);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $this->userService->updateProfile($user, $request);
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, UserResource::make($user));
    }

    public function updateUserById($id, UpdateProfileRequest $request)
    {
        $user = $this->userService->updateUserById($id, $request->validated());
        if (!$user) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.user does not exist'), Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, UserResource::make($user));
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        if (!$user) {
            return $this->errorResponse(Response::HTTP_NOT_FOUND, trans('api.user does not exist'), Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, UserResource::make($user));
    }

    public function getWorkers()
    {
        $workers = $this->userService->getWorkers();
        return $this->successResponse(Response::HTTP_OK, trans('api.public.done'), Response::HTTP_OK, WorkerResource::collection($workers));
    }
}
