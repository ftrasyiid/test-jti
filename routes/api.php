<?php

use App\Http\Controllers\JTIFormAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/jti-forms', [JTIFormAPIController::class, 'store'])->name('api.jti.store');
    Route::post('/auto-jti-forms', [JTIFormAPIController::class, 'auto'])->name('api.jti.auto');

    Route::get('/jti-forms', [JTIFormAPIController::class, 'index'])->name('api.jti');
    Route::get('/jti-forms/{id}', [JTIFormAPIController::class, 'show'])->name('api.jti.show');
    Route::put('/jti-forms/{id}', [JTIFormAPIController::class, 'update'])->name('api.jti.update');
    Route::delete('/jti-jti/{id}', [JTIFormAPIController::class, 'delete'])->name('api.jti.destroy');
});