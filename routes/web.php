<?php

use App\Http\Controllers\API\HasilLatihanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

//    Controller for siswa
Route::get('/siswa', [SiswaController::class, 'index'])->name('index-siswa');
Route::get('/siswa/{id}/show', [SiswaController::class, 'show'])->name('show-siswa');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('edit-siswa');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('update-siswa');
Route::get('/siswa/{id}', [SiswaController::class, 'destroy'])->name('destroy-siswa');

//    Controller for guru
Route::get('/guru', [GuruController::class, 'index'])->name('index-guru');
Route::get('/guru/create', [GuruController::class, 'create'])->name('create-guru');
Route::post('/guru', [GuruController::class, 'store'])->name('store-guru');
Route::get('/guru/{id}/edit', [GuruController::class, 'edit'])->name('edit-guru');
Route::put('/guru/{id}', [GuruController::class, 'update'])->name('update-guru');
Route::get('/guru/{id}', [GuruController::class, 'destroy'])->name('destroy-guru');

//    Controller for materi
Route::get('/materi', [MateriController::class, 'index'])->name('index-materi');
Route::get('/materi/create', [MateriController::class, 'create'])->name('create-materi');
Route::post('/materi', [MateriController::class, 'store'])->name('store-materi');
Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('edit-materi');
Route::put('/materi/{id}', [MateriController::class, 'update'])->name('update-materi');
Route::get('/materi/{id}', [MateriController::class, 'destroy'])->name('destroy-materi');

//    Controller for kurikulum
Route::get('/kurikulum', [KurikulumController::class, 'index'])->name('index-kurikulum');
Route::get('/kurikulum/create', [KurikulumController::class, 'create'])->name('create-kurikulum');
Route::post('/kurikulum', [KurikulumController::class, 'store'])->name('store-kurikulum');
Route::get('/kurikulum/{id}/edit', [KurikulumController::class, 'edit'])->name('edit-kurikulum');
Route::put('/kurikulum/{id}', [KurikulumController::class, 'update'])->name('update-kurikulum');
Route::get('/kurikulum/{id}', [KurikulumController::class, 'destroy'])->name('destroy-kurikulum');

//CONTROLLER FOR LATIHAN
Route::get('/indexlatihan', [LatihanController::class, 'indexLatihan'])->name('indexLatihan');
Route::get('/createlatihan', [LatihanController::class, 'createLatihan'])->name('createLatihan');
Route::post('/storelatihan', [LatihanController::class, 'storeLatihan'])->name('storeLatihan');
Route::get('/editlatihan/{ex}', [LatihanController::class, 'editLatihan'])->name('editLatihan');
Route::put('/updatelatihan/{ex}', [LatihanController::class, 'updateLatihan'])->name('updateLatihan');
Route::get('/deletelatihan/{ex}', [LatihanController::class, 'deleteLatihan'])->name('deleteLatihan');

Route::get('/createsoal', [LatihanController::class, 'createPertanyaan'])->name('createPertanyaan');
Route::post('/storesoal', [LatihanController::class, 'storePertanyaan'])->name('storePertanyaan');
Route::get('/editsoal/{qs}', [LatihanController::class, 'editPertanyaan'])->name('editPertanyaan');
Route::put('/updatesoal/{qs}', [LatihanController::class, 'updatePertanyaan'])->name('updatePertanyaan');
Route::get('/deletesoal/{qs}', [LatihanController::class, 'deletePertanyaan'])->name('deletePertanyaan');

Route::get('/finish', [LatihanController::class, 'finishLatihanPertanyaan'])->name('finishLatihanPertanyaan');
Route::get('/details/{ex}', [LatihanController::class, 'detailLatihanPertanyaan'])->name('detailLatihanPertanyaan');

Route::get('/addmoresoal/{ex}', [LatihanController::class, 'addMorePertanyaan'])->name('addMorePertanyaan');
Route::post('/storemoresoal/{ex}', [LatihanController::class, 'storeMorePertanyaan'])->name('storeMorePertanyaan');

Route::get('/status/update', [LatihanController::class, 'updateStatus'])->name('latihan.update.status');


Route::get('/hasilLatihan', [HasilLatihanController::class, 'index'])->name('index-hasilLatihan');
Route::get('/hasilLatihan/{id}/show', [HasilLatihanController::class, 'show'])->name('show-hasilLatihan');
Route::get('/hasilLatihan/{id}', [HasilLatihanController::class, 'destroy'])->name('destroy-hasilLatihan');
