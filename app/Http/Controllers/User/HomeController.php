<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $popularRooms = Room::join('bookings', 'rooms.room_id', '=', 'bookings.room_id')
            ->join('room_types', 'rooms.roomType_id', '=', 'room_types.roomType_id')
            ->select('room_types.name as name', DB::raw('COUNT(bookings.room_id) as count'))
            ->groupBy('room_types.name')
            ->orderByDesc('count')
            ->get()->take(2);
        if ($popularRooms->count() < 3) {
            $roomType = RoomType::all();

            foreach ($roomType as $room) {
                $exists = $popularRooms->contains('name', $room->name);
                if (!$exists) {
                    $popularRooms->push([
                        'name' => $room->name,
                        'count' => 0,
                    ]);
                    if ($popularRooms->count() >= 3) {
                        break;
                    }
                }
            }
        }
        $roomArr = [];
        foreach ($popularRooms as $r) {
            $roomArr[] = ['name' => $r['name']];
        }
        $roomShow = RoomType::whereIn('name', $roomArr)->get();
        return view('user.home-user', ['roomShow' => $roomShow]);
    }
}
