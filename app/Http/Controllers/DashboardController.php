<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return redirect('/dashboard/user-info');
    }

    public function userInfo()
    {
        $user = auth()->user();
        return view('userInfo', compact('user'));
    }

    public function bookings()
    {
        $user = auth()->user();
        $bookings = Booking::where('user_id', $user->id)->get();
        return view('bookings', compact('bookings'));
    }
}
