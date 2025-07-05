<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', [App\Http\Controllers\AuthController::class, 'me']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('/user',[App\Http\Controllers\UserController::class, 'getUser']);
    Route::post('/user/add',[App\Http\Controllers\UserController::class, 'addUser']);
    //harusnya menggunakan Route::delete
    Route::get('/user/{id}',[App\Http\Controllers\UserController::class, 'deleteUser']);
    Route::patch('/userUpdate/{id}',[App\Http\Controllers\UserController::class, 'updateUser']);
});


Route::controller(App\Http\Controllers\WisataController::class)->prefix('wisata')->middleware(["auth:api"])->group(function()
{
    Route::get('/','getWisata');
    Route::post('/add','postWisata');
    Route::patch('/update/{id}','updateWisata');
    Route::delete('/delete/{id}','delete');
});
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

 Route::get('/userWisata',[App\Http\Controllers\WisataController::class,'getWisata']);

