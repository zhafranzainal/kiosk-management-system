<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\KioskParticipantController;

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
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('/')->middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('applications', ApplicationController::class);
    Route::resource('banks', BankController::class);
    Route::resource('business-types', BusinessTypeController::class);
    Route::resource('complaints', ComplaintController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('kiosks', KioskController::class);
    Route::resource('kiosk-participants', KioskParticipantController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('students', StudentController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('users', UserController::class);
});
