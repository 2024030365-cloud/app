<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\V1\UserController;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

Route::prefix('/{tenant}')->middleware([
    'api',
    InitializeTenancyByPath::class, 
])->group(function() {

   Route::post('/api/login', [LoginController::class, 'login']);
    Route::post('/api/v1/users', [UserController::class, 'store']);

    Route::middleware(['auth:api', 'acceso'])->prefix('api/v1')->group(function () {
        
        Route::apiResource('users', UserController::class)->except(['store']);
        
    });
});
