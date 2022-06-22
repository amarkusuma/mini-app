<?php

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/fakultas', [App\Http\Controllers\FakultasController::class, 'index'])->name('fakultas');
Route::get('/fakultas-create', [App\Http\Controllers\FakultasController::class, 'create'])->name('fakultas-create');
Route::post('/fakultas-store', [App\Http\Controllers\FakultasController::class, 'store'])->name('fakultas-store');
Route::get('/fakultas-datatable', [App\Http\Controllers\FakultasController::class, 'fakultas'])->name('fakultas-datatable');
Route::get('/fakultas-edit/{id}', [App\Http\Controllers\FakultasController::class, 'edit'])->name('fakultas-edit');
Route::post('/fakultas-update/{id}', [App\Http\Controllers\FakultasController::class, 'update'])->name('fakultas-update');
Route::post('/fakultas-delete/{id}', [App\Http\Controllers\FakultasController::class, 'delete'])->name('fakultas-delete');

Route::get('/jurusan', [App\Http\Controllers\JurusanController::class, 'index'])->name('jurusan');
Route::get('/jurusan-datatable', [App\Http\Controllers\JurusanController::class, 'jurusan'])->name('jurusan-datatable');
Route::get('/jurusan-create', [App\Http\Controllers\JurusanController::class, 'create'])->name('jurusan-create');
Route::post('/jurusan-store', [App\Http\Controllers\JurusanController::class, 'store'])->name('jurusan-store');
Route::get('/jurusan-edit/{id}', [App\Http\Controllers\JurusanController::class, 'edit'])->name('jurusan-edit');
Route::post('/jurusan-update/{id}', [App\Http\Controllers\JurusanController::class, 'update'])->name('jurusan-update');
Route::post('/jurusan-delete/{id}', [App\Http\Controllers\JurusanController::class, 'delete'])->name('jurusan-delete');

Route::get('/dosen', [App\Http\Controllers\DosenController::class, 'index'])->name('dosen');
Route::get('/dosen-datatable', [App\Http\Controllers\DosenController::class, 'dosen'])->name('dosen-datatable');
Route::get('/dosen-create', [App\Http\Controllers\DosenController::class, 'create'])->name('dosen-create');
Route::post('/dosen-store', [App\Http\Controllers\DosenController::class, 'store'])->name('dosen-store');
Route::get('/dosen-edit/{id}', [App\Http\Controllers\DosenController::class, 'edit'])->name('dosen-edit');
Route::post('/dosen-update/{id}', [App\Http\Controllers\DosenController::class, 'update'])->name('dosen-update');
Route::post('/dosen-delete/{id}', [App\Http\Controllers\DosenController::class, 'delete'])->name('dosen-delete');

Route::get('/mahasiswa', [App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa');
Route::get('/mahasiswa-datatable', [App\Http\Controllers\MahasiswaController::class, 'mahasiswa'])->name('mahasiswa-datatable');
Route::get('/mahasiswa-create', [App\Http\Controllers\MahasiswaController::class, 'create'])->name('mahasiswa-create');
Route::post('/mahasiswa-store', [App\Http\Controllers\MahasiswaController::class, 'store'])->name('mahasiswa-store');
Route::get('/mahasiswa-edit/{id}', [App\Http\Controllers\MahasiswaController::class, 'edit'])->name('mahasiswa-edit');
Route::post('/mahasiswa-update/{id}', [App\Http\Controllers\MahasiswaController::class, 'update'])->name('mahasiswa-update');
Route::post('/mahasiswa-delete/{id}', [App\Http\Controllers\MahasiswaController::class, 'delete'])->name('mahasiswa-delete');

Route::get('/cities/{prov_id}', [App\Http\Controllers\LocationController::class, 'cities'])->name('cities');
Route::get('/districts/{city_id}', [App\Http\Controllers\LocationController::class, 'districts'])->name('districts');
Route::get('/subdistricts/{prov_id}', [App\Http\Controllers\LocationController::class, 'subdistricts'])->name('subdistricts');

Route::get('/password-change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'index'])->name('password-change');
Route::post('/password-change', [App\Http\Controllers\Auth\ChangePasswordController::class, 'passwordChange'])->name('password-change');
