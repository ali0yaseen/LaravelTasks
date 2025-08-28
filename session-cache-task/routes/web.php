<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionCacheController;

Route::post('/preferences/store', [SessionCacheController::class, 'storePreferences']);
Route::get('/preferences', [SessionCacheController::class, 'getPreferences']);

Route::get('/hotels', [SessionCacheController::class, 'getHotels']);
Route::post('/hotels', [SessionCacheController::class, 'addHotel']);
Route::put('/hotels/{id}', [SessionCacheController::class, 'updateHotel']);
Route::delete('/hotels/{id}', [SessionCacheController::class, 'deleteHotel']);
