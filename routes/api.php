<?php

use App\Http\Controllers\API\AuthSiswaController;
use App\Http\Controllers\API\DataApiController;
use App\Http\Controllers\API\HasilLatihanController;
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

    Route::get('/materi/{id_kelas}', [DataApiController::class, 'materi']);
    Route::get('/sub-materi/{nm_materi}', [DataApiController::class, 'subMateri']);

    Route::get('/kurikulum/{id_kelas}', [DataApiController::class, 'kurikulum']);

    Route::get('/latihan/{id_kelas}', [DataApiController::class, 'latihan']);
    Route::get('/pertanyaan/{id_latihan}', [DataApiController::class, 'pertanyaan']);

    Route::post('/hasil-latihan', [HasilLatihanController::class, 'create']);

    Route::get('/hasil-latihan/{id_latihan}/{id_siswa}', [DataApiController::class, 'hasilLatihan']);
});
