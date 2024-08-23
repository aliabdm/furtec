<?php

namespace App\Providers;

use App\Services\PartService;
use App\Services\RoomService;
use App\Services\UserService;
use App\Services\OrderService;
use App\Services\MaterialService;
use App\Services\RoomPartService;
use App\Services\WorkshopService;
use App\Services\OrderPartService;
use App\Repositories\PartRepository;
use App\Repositories\RoomRepository;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Services\Contracts\RoomServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\MaterialRepository;
use App\Repositories\RoomPartRepository;
use App\Repositories\WorkshopRepository;
use App\Repositories\OrderPartRepository;
use App\Services\Contracts\RoomPartServiceInterface;
use App\Repositories\Contracts\RoomRepositoryInterface;
use App\Services\Contracts\PartServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Repositories\Contracts\RoomPartRepositoryInterface;
use App\Services\Contracts\OrderServiceInterface;
use App\Services\Contracts\MaterialServiceInterface;
use App\Services\Contracts\WorkshopServiceInterface;
use App\Services\Contracts\OrderPartServiceInterface;
use App\Repositories\Contracts\PartRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\MaterialRepositoryInterface;
use App\Repositories\Contracts\WorkshopRepositoryInterface;
use App\Repositories\Contracts\OrderPartRepositoryInterface;

class OopServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MaterialRepositoryInterface::class, MaterialRepository::class);
        $this->app->bind(MaterialServiceInterface::class, MaterialService::class);

        $this->app->bind(OrderPartRepositoryInterface::class, OrderPartRepository::class);
        $this->app->bind(OrderPartServiceInterface::class, OrderPartService::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);

        $this->app->bind(PartRepositoryInterface::class, PartRepository::class);
        $this->app->bind(PartServiceInterface::class, PartService::class);

        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(RoomServiceInterface::class, RoomService::class);

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(RoomPartRepositoryInterface::class, RoomPartRepository::class);
        $this->app->bind(RoomPartServiceInterface::class, RoomPartService::class);

        $this->app->bind(WorkshopServiceInterface::class, WorkshopService::class);
        $this->app->bind(WorkshopRepositoryInterface::class, WorkshopRepository::class);
    }

    public function boot()
    {
        //
    }
}
