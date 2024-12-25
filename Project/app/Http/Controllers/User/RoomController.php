<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 6;
        $currentPage = $request->get('page', 1);

        $rooms = RoomType::with('services')->get();

        $total = $rooms->count();
        $pages = ceil($total / $perPage);

        $roomsForCurrentPage = $rooms->slice(($currentPage - 1) * $perPage, $perPage);

        return view('user.room-user', [
            'rooms' => $roomsForCurrentPage,
            'currentPage' => $currentPage,
            'pages' => $pages,
        ]);
    }
    // public function findAvailableRooms(Request $request)
    // {
    //     $checkin = $request->input('checkin');
    //     $checkout = $request->input('checkout');
    //     $adults = $request->input('adults');
    //     $children = $request->input('children');
    //     $guests = $adults + $children;

    //     // Logic tìm kiếm phòng trống
    //     $roomTypes = RoomType::where('occupancy', '>=', $guests)->get();
    //     $availableRooms = [];

    //     foreach ($roomTypes as $roomType) {
    //         $rooms = $roomType->rooms;
    //         foreach ($rooms as $room) {
    //             $isBooked = Booking::getAll()
    //                 ->where(function ($query) use ($checkin, $checkout) {
    //                     $query->whereBetween('checkin_date', [$checkin, $checkout])
    //                         ->orWhereBetween('checkout_date', [$checkin, $checkout])
    //                         ->orWhereRaw('? BETWEEN checkin_date AND checkout_date', [$checkin])
    //                         ->orWhereRaw('? BETWEEN checkin_date AND checkout_date', [$checkout]);
    //                 })
    //                 ->exists();

    //             if (!$isBooked) {
    //                 if ($room->occupancy >= $guests) {
    //                     $availableRooms[] = $room;
    //                 }
    //             }
    //         }
    //     }
    //     $perPage = 6;
    //     $currentPage = $request->get('page', 1);
    //     $total = collect($availableRooms)->count();
    //     $pages = ceil($total / $perPage);

    //     $roomsForCurrentPage = collect($availableRooms)->slice(($currentPage - 1) * $perPage, $perPage);


    //     return view('user.room-user', [
    //         'rooms' => $roomsForCurrentPage,
    //         'currentPage' => $currentPage,
    //         'pages' => $pages,
    //         'checkin' => $checkin,
    //         'checkout' => $checkout,
    //         'adults' => $adults,
    //         'children' => $children,
    //     ]);
    // }
}
