<?php

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
Route::get('/room', function () {
    return view('user.room-user');
});
Route::get('/booking', function () {
    return view('user.booking-user');
});
