<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ItemController::class)->group(function(){
    Route::get('/items','index');
    Route::post('/item','store');
    Route::get('/item/{id}','show');
    Route::put('/item/{id}','update');
    Route::delete('item/{id}','destroy');
});

Route::prefix('auth')->group(function(){
    Route::post('login',[AuthController::class,'login']);
    Route::post('register',[AuthController::class,'register']);

});
