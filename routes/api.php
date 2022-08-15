<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// User route
Route::post('/login', [loginController::class, 'login']);

//Route::get('user','loginController@getUser');

// Route::get('/viewDetail/{id}', [JobController::class, 'viewDetailVacancy'])->name('viewDetailVacancy');
// Route::post('/delete/{id}', [JobController::class, 'deleteVacancy'])->name('deleteVacancy');