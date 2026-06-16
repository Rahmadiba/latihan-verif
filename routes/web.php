<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
 
    Route::get('/dashboard', [AppointmentController::class, 'konsuliDashboard'])->name('konsuli.dashboard');
    Route::get('/booking/{konselor_id}', [AppointmentController::class, 'showBookingForm'])->name('konsuli.booking');
    Route::post('/booking', [AppointmentController::class, 'storeBooking'])->name('konsuli.booking.store');
    Route::delete('/booking/{id}', [AppointmentController::class, 'destroyBooking'])->name('konsuli.booking.destroy');

     Route::get('/konselor/dashboard', [AppointmentController::class, 'konselorDashboard'])->name('konselor.dashboard');
    Route::post('/booking/{id}/{status}', [AppointmentController::class, 'updateStatus'])->name('konselor.update_status');
});