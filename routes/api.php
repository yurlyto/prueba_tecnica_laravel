<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EntidadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('contacto')->group(function () {
    Route::apiResource('contactos', ContactoController::class);
    Route::put('contactos/{contacto}', [ContactoController::class, 'update']);
    Route::delete('contactos/{contacto}', [ContactoController::class, 'destroy']);
    Route::get('contactos/{contacto}/edit', [ContactoController::class, 'edit']);
});

Route::prefix('entidad')->group(function () {
    Route::apiResource('entidades', EntidadController::class);
    Route::put('entidades/{entidad}', [EntidadController::class, 'update']);
    Route::delete('entidades/{entidad}', [EntidadController::class, 'destroy']);
    Route::get('entidades/{entidad}/edit', [EntidadController::class, 'edit']);
});