<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AuthController;


/* för att styra in i record, track & auth controllerna. samt anropar metod middleware på de som kräver inlogg*/
Route::resource('record', RecordController::class)->middleware('auth:sanctum');
Route::resource('track', TrackController::class)->middleware('auth:sanctum');

/* för att hämta tracks till specifik record */
Route::get('/gettracks/{id}', [RecordController::class, 'getTracksByRecord'])->middleware('auth:sanctum');

/*för att registrera användare*/
Route::post('/register', [AuthController::class, 'register']);
/*för att logga in */
Route::post('/login', [AuthController::class, 'login']);
/*för att logga ut */
Route::post('/logout', [AuthController::class, 'logout']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
