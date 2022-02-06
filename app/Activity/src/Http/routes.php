<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Activity\Http\Api\v1\LogActivity\LogActivityProcedure;
use App\Activity\Http\Api\v1\FindActivity\FindActivityProcedure;

Route::rpc('/api/v1', [LogActivityProcedure::class, FindActivityProcedure::class])
    ->middleware(['json', 'auth:sanctum']);
