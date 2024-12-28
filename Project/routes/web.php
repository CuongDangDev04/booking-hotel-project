<?php

use App\Http\Controllers\Admin\AdminRoomTypeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookingController;
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
})->name('home');
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

Route::get('/hehe', function () {
    return view('user.payment-user');
});
Route::post('/booking', [BookingController::class, 'bookingRoom'])->name('booking.room');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'check.active'])->name('dashboard');

Route::middleware('auth', 'check.active')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';



Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('room-types', AdminRoomTypeController::class);
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
});
Route::get('/admin/users/{id}/toggle-active', [AdminUserController::class, 'toggleActiveStatus'])->name('admin.users.toggleActiveStatus');
