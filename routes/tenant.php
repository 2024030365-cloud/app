<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\UserController;

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->prefix('api')->group(function () {

    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/v1/users', [UserController::class, 'store']);
    Route::middleware('auth:api')->group(function () {
        
        Route::apiResource('v1/users', UserController::class)->except(['store']);
        
    });
});