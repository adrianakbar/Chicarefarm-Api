<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DatakaryawanController;
use App\Http\Controllers\Api\ListtugasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('profil', [AuthController::class, 'profil']);
});

Route::get('datakaryawan', [DatakaryawanController::class, 'index']);
Route::get('datakaryawan/{id_karyawan}', [DatakaryawanController::class, 'show']);

Route::middleware(['jwt'])->group(function () {
    Route::post('datakaryawan', [DatakaryawanController::class, 'store']);
    Route::put('datakaryawan/{id_karyawan}', [DatakaryawanController::class, 'update']);
    Route::delete('datakaryawan/{id_karyawan}', [DatakaryawanController::class, 'destroy']);

    Route::post('listtugas', [ListtugasController::class, 'store']);
    Route::put('listtugas/{id_tugas}', [ListtugasController::class, 'updateCheckbox']);
    Route::delete('listtugas/{id_tugas}', [ListtugasController::class, 'destroy']);
});
