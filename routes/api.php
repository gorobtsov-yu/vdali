<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmploymentController;
use App\Http\Controllers\Api\Favorites\FavoriteEmploymentController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\RegistrationRequestController;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\Tests\AssociativeTestController;
use App\Http\Controllers\Api\Tests\DefaultTestController;
use App\Http\Controllers\Api\Tests\OpenTestController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VacancyController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function () {
    Route::middleware('auth:web')->group(function () {

        Route::get('/users/me', [UserController::class, 'me']);
        Route::patch('/users/me', [UserController::class, 'updateMe']);

        Route::apiResource('/users', UserController::class)
            ->where(['user' => '[a-zA-Z0-9_]+']);

        Route::apiResource('/vacancies', VacancyController::class)
            ->where(['vacancy' => '[0-9]+']);

        /**
         * Two test specs:
         * - Special (associative, open)
         * - Unified (klimov and others)
         */
        Route::prefix('tests')->group(function () {
            // associative
            Route::get('/associative', [AssociativeTestController::class, 'show']);
            Route::post('/associative/submit', [AssociativeTestController::class, 'store']);

            // open
            Route::get('/open', [OpenTestController::class, 'show']);
            Route::post('/open/submit', [OpenTestController::class, 'store']);

            // default (submit-only)
            Route::post('/{test}/submit', [DefaultTestController::class, 'store'])
                ->where(['test' => '[a-z]+']);

            // default (unified)
            Route::apiResource('/', TestController::class)
                ->parameters(['' => 'test'])
                ->where(['test' => '[a-z]+']);
        });

        Route::apiResource('employments', EmploymentController::class)
            ->where(['employment' => '[0-9]+']);

        Route::prefix('favorites/employments')->group(function () {
            Route::get('/', [FavoriteEmploymentController::class, 'index']);
            Route::post('/', [FavoriteEmploymentController::class, 'store']);
            Route::delete('/', [FavoriteEmploymentController::class, 'destroy']);
        });

        Route::prefix('history')->group(function () {
            Route::get('/employments', [HistoryController::class, 'employments']);
        });

        Route::prefix('recommendations')->group(function () {
            Route::get('/employments', [RecommendationController::class, 'employments']);
        });
    });

    Route::post('/registration-requests', [RegistrationRequestController::class, 'store']);

    Route::prefix('/auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:web');
    });
});
