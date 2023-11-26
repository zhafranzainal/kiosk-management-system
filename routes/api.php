<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BankController;
use App\Http\Controllers\Api\SaleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\KioskController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\BusinessTypeController;
use App\Http\Controllers\Api\CourseStudentsController;
use App\Http\Controllers\Api\UserComplaintsController;
use App\Http\Controllers\Api\KioskParticipantController;
use App\Http\Controllers\Api\UserApplicationsController;
use App\Http\Controllers\Api\UserTransactionsController;
use App\Http\Controllers\Api\KioskApplicationsController;
use App\Http\Controllers\Api\BusinessTypeKiosksController;
use App\Http\Controllers\Api\BankKioskParticipantsController;
use App\Http\Controllers\Api\KioskParticipantSalesController;
use App\Http\Controllers\Api\KioskKioskParticipantsController;
use App\Http\Controllers\Api\KioskParticipantComplaintsController;

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

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})->name('api.user');

Route::name('api.')->middleware('auth:sanctum')->group(function () {

    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    Route::apiResource('applications', ApplicationController::class);
    Route::apiResource('banks', BankController::class);

    // Bank Kiosk Participants
    Route::get('/banks/{bank}/kiosk-participants', [BankKioskParticipantsController::class, 'index'])->name('banks.kiosk-participants.index');
    Route::post('/banks/{bank}/kiosk-participants', [BankKioskParticipantsController::class, 'store'])->name('banks.kiosk-participants.store');

    Route::apiResource('business-types', BusinessTypeController::class);

    // BusinessType Kiosks
    Route::get('/business-types/{businessType}/kiosks', [BusinessTypeKiosksController::class, 'index'])->name('business-types.kiosks.index');
    Route::post('/business-types/{businessType}/kiosks', [BusinessTypeKiosksController::class, 'store'])->name('business-types.kiosks.store');

    Route::apiResource('complaints', ComplaintController::class);
    Route::apiResource('courses', CourseController::class);

    // Course Students
    Route::get('/courses/{course}/students', [CourseStudentsController::class, 'index'])->name('courses.students.index');
    Route::post('/courses/{course}/students', [CourseStudentsController::class, 'store'])->name('courses.students.store');

    Route::apiResource('kiosks', KioskController::class);

    // Kiosk Kiosk Participants
    Route::get('/kiosks/{kiosk}/kiosk-participants', [KioskKioskParticipantsController::class, 'index'])->name('kiosks.kiosk-participants.index');
    Route::post('/kiosks/{kiosk}/kiosk-participants', [KioskKioskParticipantsController::class, 'store'])->name('kiosks.kiosk-participants.store');

    // Kiosk Applications
    Route::get('/kiosks/{kiosk}/applications', [KioskApplicationsController::class, 'index'])->name('kiosks.applications.index');
    Route::post('/kiosks/{kiosk}/applications', [KioskApplicationsController::class, 'store'])->name('kiosks.applications.store');

    Route::apiResource('kiosk-participants', KioskParticipantController::class);

    // KioskParticipant Complaints
    Route::get('/kiosk-participants/{kioskParticipant}/complaints', [KioskParticipantComplaintsController::class, 'index'])->name('kiosk-participants.complaints.index');
    Route::post('/kiosk-participants/{kioskParticipant}/complaints', [KioskParticipantComplaintsController::class, 'store'])->name('kiosk-participants.complaints.store');

    // KioskParticipant Sales
    Route::get('/kiosk-participants/{kioskParticipant}/sales', [KioskParticipantSalesController::class, 'index'])->name('kiosk-participants.sales.index');
    Route::post('/kiosk-participants/{kioskParticipant}/sales', [KioskParticipantSalesController::class, 'store'])->name('kiosk-participants.sales.store');

    Route::apiResource('sales', SaleController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('users', UserController::class);

    // User Applications
    Route::get('/users/{user}/applications', [UserApplicationsController::class, 'index'])->name('users.applications.index');
    Route::post('/users/{user}/applications', [UserApplicationsController::class, 'store'])->name('users.applications.store');

    // User Transactions
    Route::get('/users/{user}/transactions', [UserTransactionsController::class, 'index'])->name('users.transactions.index');
    Route::post('/users/{user}/transactions', [UserTransactionsController::class, 'store'])->name('users.transactions.store');

    // User Complaints
    Route::get('/users/{user}/complaints', [UserComplaintsController::class, 'index'])->name('users.complaints.index');
    Route::post('/users/{user}/complaints', [UserComplaintsController::class, 'store'])->name('users.complaints.store');
});
