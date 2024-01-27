<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use App\Modules\Tasks\TaskRepository;
use App\Modules\DiningTable\DiningTableRepository;
use App\Modules\Reservation\ReservationRepository;
use Illuminate\Support\ServiceProvider;
use App\Modules\Tasks\TaskRepositoryInterface;
use App\Modules\Tasks\TaskService;
use App\Modules\Tasks\TaskServiceInterface;
use App\Modules\DiningTable\DiningTableRepositoryInterface;
use App\Modules\DiningTable\DiningTableService;
use App\Modules\DiningTable\DiningTableServiceInterface;
use App\Modules\Reservation\ReservationRepositoryInterface;
use App\Modules\Reservation\ReservationService;
use App\Modules\Reservation\ReservationServiceInterface;
use App\Models\Sanctum\PersonalAccessToken;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(DiningTableRepositoryInterface::class, DiningTableRepository::class);
        $this->app->bind(DiningTableServiceInterface::class, DiningTableService::class);        
        $this->app->bind(ReservationRepositoryInterface::class, ReservationRepository::class);
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
        //Sanctum::ignoreMigrations;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
