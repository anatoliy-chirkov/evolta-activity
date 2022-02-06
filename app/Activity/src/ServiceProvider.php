<?php

declare(strict_types=1);

namespace App\Activity;

use App\Activity\Models\ActivityReadStorage;
use App\Activity\Persistence\ActivityPdoRepository;

final class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }

    public function register(): void
    {
        $this->app->bind(ActivityReadStorage::class, ActivityPdoRepository::class);
    }
}
