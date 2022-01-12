<?php

use App\Http\Controllers\API\AuthSiswaController;
use App\Http\Controllers\API\DataApiController;
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

Route::post('/register', [AuthSiswaController::class, 'register']);
Route::post('/login', [AuthSiswaController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::put('/update/{id}', [AuthSiswaController::class, 'update']);
    Route::get('/profile', [AuthSiswaController::class, 'profile']);
    Route::get('/logout', [AuthSiswaController::class, 'logout']);
});

Route::get('/materi/kelas7', [DataApiController::class, 'materi7']);
Route::get('/materi/kelas8', [DataApiController::class, 'materi8']);
Route::get('/materi/kelas9', [DataApiController::class, 'materi9']);

Route::get('/kurikulum/kelas7', [DataApiController::class, 'kurikulum7']);
Route::get('/kurikulum/kelas8', [DataApiController::class, 'kurikulum8']);
Route::get('/kurikulum/kelas9', [DataApiController::class, 'kurikulum9']);

Route::get('/latihan', [DataApiController::class, 'latihan']);
