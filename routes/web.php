<?php

use App\Http\Controllers\KelolaSiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('/data_siswa')->name('data_siswa.')->group(function(){
    Route::get('data', [StudentController::class, 'index'])->name('data');
    Route::get('/tambah', [StudentController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [StudentController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [StudentController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [StudentController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus{id}', [StudentController::class, 'destroy'])->name('hapus');
});

Route::prefix('/kelola_siswa')->name('kelola_siswa.')->group(function(){
    Route::get('/akun',[KelolaSiswaController::class, 'index'])->name('siswa');
    Route::get('/tambah', [KelolaSiswaController::class, 'create'])->name('tambah');
    Route::post('/tambah/proses', [KelolaSiswaController::class, 'store'])->name('tambah.proses');
    Route::get('/ubah/{id}', [KelolaSiswaController::class, 'edit'])->name('ubah');
    Route::patch('/ubah/{id}/proses', [KelolaSiswaController::class, 'update'])->name('ubah.proses');
    Route::delete('/hapus{id}', [KelolaSiswaController::class, 'destroy'])->name('hapus');
});