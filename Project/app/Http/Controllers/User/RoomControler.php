<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomControler extends Controller
{
    public function index(Request $request)
    {
        $perPage = 6; // Số lượng phần tử mỗi trang
        $currentPage = $request->get('page', 1); // Lấy số trang hiện tại (mặc định là 1)

        // Lấy tất cả dữ liệu
        $rooms = RoomType::with('services')->get();

        // Tính tổng số trang
        $total = $rooms->count();
        $pages = ceil($total / $perPage);

        // Cắt dữ liệu cho trang hiện tại
        $roomsForCurrentPage = $rooms->slice(($currentPage - 1) * $perPage, $perPage);

        // Truyền dữ liệu sang View
        return view('user.room-user', [
            'rooms' => $roomsForCurrentPage,
            'currentPage' => $currentPage,
            'pages' => $pages,
        ]);
    }
}
