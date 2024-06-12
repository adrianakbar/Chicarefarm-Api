<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\DatakaryawanController;
use App\Http\Controllers\DatakelembabanController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ListtugasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ResetpasswordController;
use App\Http\Controllers\SpeedometerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('general.homepage');
});
Route::get('/login', [HomepageController::class, 'loginview']);
Route::get('/lupapassword', [LoginController::class, 'lupapasswordview']);
Route::post('/lupapassword', [ResetpasswordController::class, 'reset']);

Route::post('/owner/datakelembaban', [DatakelembabanController::class, 'sensordata']);

Route::get('/owner/datakelembaban', [DatakelembabanController::class, 'datakelembabanview_owner']);
Route::get('/owner/datakaryawan', [DatakaryawanController::class, 'datakaryawanview_owner']);
Route::get('/owner/listtugas', [ListtugasController::class, 'listtugasview_owner']);

Route::get('/kepalakandang/datakelembaban', [DatakelembabanController::class, 'datakelembabanview_kepalakandang']);
Route::get('/kepalakandang/listtugas', [ListtugasController::class, 'listtugasview_kepalakandang']);
Route::get('/kepalakandang/datakaryawan', [DatakaryawanController::class, 'datakaryawanview_kepalakandang']);


// Route::post('/updatecheckbox', [ListtugasController::class, 'updateCheckbox']);
Route::get('/dataspeedometer', [DatakelembabanController::class, 'speedometer']);
Route::get('/datatabel', [DatakelembabanController::class, 'datatabel']);
Route::get('/12data', [DatakelembabanController::class, 'tabelawal']);
Route::post('/createkaryawan', [DatakaryawanController::class, 'createdata']);
Route::put('/updatekaryawan/{id_karyawan}', [DatakaryawanController::class, 'updatedata']);
Route::get('/idkaryawan/{id_karyawan}', [DatakaryawanController::class, 'getidkaryawan']);
Route::delete('/deletekaryawan/{id_karyawan}', [DatakaryawanController::class, 'deletedata']);
Route::post('/createlisttugas', [ListtugasController::class, 'createdata']);
Route::delete('/deletelisttugas/{id_tugas}', [ListtugasController::class, 'deletedata']);
