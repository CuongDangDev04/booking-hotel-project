<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminReceiptController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminRoomTypeController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\RoomController;
use App\Models\Booking;
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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('user.about-user');
});
Route::get('/contact', function () {
    return view('user.contact-user');
});
Route::get('/room', [RoomController::class, 'index']);
Route::get('/find-rooms', [RoomController::class, 'findAvailableRooms'])->name('find.rooms');
Route::get('/room/{room}', [RoomController::class, 'show'])->name('room.show');


Route::get('/test', function () {
    return view('user.test');
});

Route::post('payment', [BookingController::class, 'payment'])->name('payment.room');
Route::post('/payment-success', [BookingController::class, 'paymentSuccess'])->name('payment.success');
Route::post('/booking', [BookingController::class, 'bookingRoom'])->name('booking.room');
Route::get('/dashboard', function () {
    $user = auth()->user();
    $bookings = Booking::where('user_id', $user->id)->get();
    return view('dashboard', compact('user', 'bookings'));
})->middleware(['auth', 'verified', 'check.active'])->name('dashboard');

Route::middleware('auth', 'check.active')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';

Route::middleware(['auth', 'check.active'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user-info', [DashboardController::class, 'userInfo'])->name('dashboard.userInfo');
    Route::get('/dashboard/bookings', [DashboardController::class, 'bookings'])->name('dashboard.bookings');
});
Route::delete('/user/bookings/{id}', [BookingController::class, 'cancelBooking'])
    ->name('user.bookings.cancel');
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('room-types', AdminRoomTypeController::class);
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
});
Route::get('/admin/users/{id}/toggle-active', [AdminUserController::class, 'toggleActiveStatus'])->name('admin.users.toggleActiveStatus');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('rooms', AdminRoomController::class);
});

Route::get('admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');

Route::post('admin/bookings/{id}/update-status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');

Route::delete('admin/bookings/{id}', [AdminBookingController::class, 'destroy'])->name('admin.bookings.destroy');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('services', AdminServiceController::class)->except(['show']);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('receipts', [AdminReceiptController::class, 'index'])->name('receipts.index');

    Route::get('receipts/{id}', [AdminReceiptController::class, 'show'])->name('receipts.show');
});
Route::delete('admin/receipts/{id}', [AdminReceiptController::class, 'destroy'])->name('admin.receipts.destroy');
Route::get('/admin/receipts/{id}/export', [AdminReceiptController::class, 'exportPDF'])->name('admin.receipts.export');
