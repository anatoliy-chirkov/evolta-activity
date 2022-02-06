<?php

declare(strict_types=1);

namespace App\Project;

use App\Project\Console\RegisterProject;

final class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');
    }

    public function register(): void
    {
        $this->commands([
            RegisterProject::class,
        ]);
    }
}
