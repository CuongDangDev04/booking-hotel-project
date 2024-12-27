<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\RoomControler;
use App\Http\Controllers\User\RoomController;
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


Route::get('/', function () {
    return view('user.home-user');
});
Route::get('/about', function () {
    return view('user.about-user');
});
Route::get('/contact', function () {
    return view('user.contact-user');
});
Route::get('/room', [RoomController::class, 'index']);
Route::get('/find-rooms', [RoomController::class, 'findAvailableRooms'])->name('find.rooms');
Route::get('/room/{room}', [RoomController::class, 'show'])->name('room.show');
Route::get('/booking', function () {
    return view('user.booking-user');
});
Route::post('/booking', [BookingController::class, 'bookingRoom'])->name('booking.room');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
