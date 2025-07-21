<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RepotController;
use App\Http\Controllers\LandingPageContoller;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



use App\Models\Person;


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
        return view('landing_page');
    });

    Route::get('login', function () {
        return view('login');
    })->name('login');
 
    Route::post('/login', [UserController::class, 'loginProses'])->name('login.proses');

    Route::post('/register', [UserController::class, 'guestLogin'])->name('register');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

   
    

    Route::prefix('guest')->name('guest.')->group(function () {
        Route::get('/dashboard/guest', [RepotController::class, 'index'])->name('dashboard_guest');
        Route::get('/keluhan', [RepotController::class, 'create'])->name('keluhan');
        Route::post('/keluhan-tambah', [RepotController::class, 'store'])->name('keluhan.proses');
        Route::get('/komen', [CommentController::class, 'create'])->name('komen');
        Route::post('/komen-tambah', [CommentController::class, 'store'])->name('komen.proses');
        Route::get('/lihat-keluhan/{id}', [CommentController::class, 'show'])->name('keluhan.show');
        Route::get('/progres/{userId}', [RepotController::class, 'showUserComplaints'])->name('progres');
        Route::post('/repot/{id}/vote', [RepotController::class, 'vote'])->name('repot.vote');
        Route::delete('/hapus/{id}/', [RepotController::class, 'destroy'])->name('hapus');
    });

    Route::prefix('staff')->name('staff.')->group(function() {
        Route::get('dasboard/staff', [RepotController::class, 'indexStaff'])->name('dashboard_staff');
        Route::get('proses/{id}', [RepotController::class, 'prosesStaff'])->name('proses');
        Route::patch('staff/ubah/{id}', [RepotController::class, 'update'])->name('ubah.proses');
        Route::put('selesai/{id}', [RepotController::class, 'done'])->name('selesai.proses');
        Route::post('staff/history/{id}', [RepotController::class, 'storeHistory'])->name('history.store');
        Route::get('repots/export', [RepotController::class, 'export'])->name('export');

    });

    Route::prefix('headstaff')->name('headstaff.')->group(function() {
        Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('dashboard_admin');
        Route::get('proses/{id}', [AdminController::class, 'prosesHeadStaff'])->name('proses');
        Route::patch('headstaff/ubah/{id}', [AdminController::class, 'update'])->name('ubah.proses');
        Route::put('headstaff/selesai/{id}', [AdminController::class, 'done'])->name('headstaff.selesai.proses');
        Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::post('/reset-password/{id}', [UserController::class, 'resetPassword'])->name('reset');
        Route::get('/diagram', [UserController::class, 'diagram'])->name('diagram');
        Route::get('/buat-akun', [UserController::class, 'create'])->name('create');
        Route::post('/buat-akun/proses', [UserController::class, 'store'])->name('store');
    });
    
    
    // Route::prefix('headstaff')->name('headstaff.')->group(function() {
       


    // });


    
    
  