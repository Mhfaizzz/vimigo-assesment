<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [ApiController::class, 'loginUser']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('/user', [ApiController::class, 'create']);
    Route::get('/user', [ApiController::class, 'profile']);
    Route::put('/users/{id}', [ApiController::class, 'update']);
    Route::delete('/users/{id}', [ApiController::class, 'destroy']);
    
    
    Route::get('/users', [ApiController::class, 'filter']);
    
    Route::post('/bulkcreate', [ApiController::class, 'createUsers']);
    Route::post('/bulkupdate', [ApiController::class, 'updateUsers']);
    Route::post('/bulkdelete', [ApiController::class, 'deleteUsers']);
});



