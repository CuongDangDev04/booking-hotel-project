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
            'pages' => $pages
        ]);
    }
    public function findAvailableRooms(Request $request)
    {

        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $adults = (int)$request->input('adults');
        $children = (int)$request->input('children');
        $guests = $adults + $children;
        // Logic tìm kiếm phòng trống
        $roomTypes = RoomType::where('occupancy', '>=', $guests)->get();

        $availableRooms = [];

        foreach ($roomTypes as $roomType) {
            $rooms = $roomType->rooms;
            foreach ($rooms as $room) {

                $isBooked = Booking::where('room_id', $room->room_id)
                    ->where(function ($query) use ($checkin, $checkout) {
                        $query->whereBetween('checkin', [$checkin, $checkout])
                            ->orWhereBetween('checkout', [$checkin, $checkout])
                            ->orWhereRaw('? BETWEEN checkin AND checkout', [$checkin])
                            ->orWhereRaw('? BETWEEN checkin AND checkout', [$checkout]);
                    })
                    ->exists();

                if (!$isBooked) {
                    $availableRooms[] = $room;
                }
            }
        }
        $roomTypeIdOfAvailableRooms = collect($availableRooms)->pluck('roomType_id')->unique();
        $roomTypesOfAvailableRooms = RoomType::whereIn('roomType_id', $roomTypeIdOfAvailableRooms)->get();

        $tmp = $roomTypesOfAvailableRooms;
        $perPage = 6;
        $currentPage = $request->get('page', 1);
        $total = $tmp->count();
        $pages = ceil($total / $perPage);

        $roomsForCurrentPage = $tmp->slice(($currentPage - 1) * $perPage, $perPage);
        return view('user.room-user', [
            'rooms' => $roomsForCurrentPage,
            'currentPage' => $currentPage,
            'pages' => $pages,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'adults' => $adults,
            'children' => $children
        ]);
        // return redirect('/');
    }

    public function show($roomType_id)
    {
        $roomType = RoomType::with('services')->find($roomType_id);
        return view('user.detail_room-user', [
            'roomType' => $roomType
        ]);
    }
}
