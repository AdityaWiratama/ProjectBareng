<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('user', [UserApiController::class,'index']);
Route::post('user/create', [UserApiController::class,'store']);
Route::put('user/update/{id}', [UserApiController::class,'update']);
Route::get('user/show/{id}', [UserApiController::class,'show']);
Route::delete('user/delete/{id}', [UserApiController::class,'destroy']);