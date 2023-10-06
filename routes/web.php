<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', [ReservationController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/vehicle/export', [VehicleController::class, 'exportToExcel'])->name('vehicle.export');
Route::get('/reservations/export', [ReservationController::class, 'exportToExcel'])->name('reservations.export');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('vehicle', VehicleController::class);
    Route::resource('reservations', ReservationController::class);
    Route::get('/reservations/{reservation}/approve-by-supervisor', [ReservationController::class, 'approval_by_supervisor'])->name('reservations.approve_by_supervisor');
    Route::get('/reservations/{reservation}/approve-by-manager', [ReservationController::class, 'approval_by_manager'])->name('reservations.approve_by_manager');
    Route::post('/reservations/{reservation}/reject', [ReservationController::class, 'reject'])->name('reservations.reject');
});



require __DIR__ . '/auth.php';
