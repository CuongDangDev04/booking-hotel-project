@extends('admin.dashboard')

@section('title', 'Quản lí phòng')

@section('content')
<div class="container">
    <h1 class="mb-4">Quản lý danh sách các phòng</h1>

    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createRoomModal">
        Thêm Phòng Mới
    </button>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>
                    <a href="{{ route('admin.rooms.index', ['sort_by' => 'room_id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        ID
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.rooms.index', ['sort_by' => 'roomNo', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Số Phòng
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.rooms.index', ['sort_by' => 'roomType', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Loại Phòng
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.rooms.index', ['sort_by' => 'status', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Trạng Thái
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.rooms.index', ['sort_by' => 'floor', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Tầng
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
            <tr>
                <td>{{ $room->room_id }}</td>
                <td>{{ $room->roomNo }}</td>
                <td>{{ $room->roomType->name ?? 'N/A' }}</td>
                <td>{{ $room->status ? 'Trống' : 'Đang sử dụng' }}</td>
                <td>{{ $room->floor }}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRoomModal{{ $room->room_id }}">
                        Sửa
                    </button>

                    <form action="{{ route('admin.rooms.destroy', $room->room_id) }}" method="POST" id="delete-form-{{ $room->room_id }}" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $room->room_id }}')">
                            Xóa
                        </button>
                    </form>

                </td>
            </tr>

            <!-- Modal Chỉnh Sửa -->
            <div class="modal fade" id="editRoomModal{{ $room->room_id }}" tabindex="-1" aria-labelledby="editRoomModalLabel{{ $room->room_id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.rooms.update', $room->room_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Chỉnh sửa phòng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="roomNo" class="form-label">Số Phòng</label>
                                    <input type="text" name="roomNo" class="form-control" value="{{ old('roomNo', $room->roomNo) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="roomType_id" class="form-label">Loại Phòng</label>
                                    <select name="roomType_id" class="form-select">
                                        @foreach ($roomTypes as $roomType)
                                        <option value="{{ $roomType->roomType_id }}" {{ $room->roomType_id == $roomType->roomType_id ? 'selected' : '' }}>
                                            {{ $roomType->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng Thái</label>
                                    <select name="status" class="form-select">
                                        <option value="1" {{ $room->status ? 'selected' : '' }}>Trống</option>
                                        <option value="0" {{ !$room->status ? 'selected' : '' }}>Đang sử dụng</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="floor" class="form-label">Tầng</label>
                                    <input type="text" name="floor" class="form-control" value="{{ old('floor', $room->floor) }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Thêm Mới -->
<div class="modal fade" id="createRoomModal" tabindex="-1" aria-labelledby="createRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.rooms.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Phòng Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="roomNo" class="form-label">Số Phòng</label>
                        <input type="text" name="roomNo" class="form-control" value="{{ old('roomNo') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="roomType_id" class="form-label">Loại Phòng</label>
                        <select name="roomType_id" class="form-select">
                            @foreach ($roomTypes as $roomType)
                            <option value="{{ $roomType->roomType_id }}">{{ $roomType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select name="status" class="form-select">
                            <option value="1">Trống</option>
                            <option value="0">Đang sử dụng</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="floor" class="form-label">Tầng</label>
                        <input type="number" name="floor" class="form-control" value="{{ old('floor') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmDelete(roomId) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa phòng này?',
            text: 'Thao tác này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form after confirmation
                document.getElementById('delete-form-' + roomId).submit();
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    '@if ($errors->any())'
    Swal.fire({
        title: 'Lỗi!',
        html: `<ul style="text-align: center;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>`,
        icon: 'error',
        confirmButtonText: 'Đóng'
    });
    '@endif'
</script>
@endsection
<style>
    .mb-4 {
        font-size: 42px;
        font-weight: bold;
    }

    .container {
        margin-top: 50px;
    }

    .table {
        font-family: 'Arial', sans-serif;
        font-size: 14px;
    }

    .table-dark {
        background-color: #343a40;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    th a {
        color: white;
        text-decoration: none;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    th a:hover {
        text-decoration: underline;
    }

    th i {
        margin-left: 5px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
    }

    td {
        vertical-align: middle;
    }

    .btn {
        font-size: 14px;
    }

    .modal-header {
        background-color: #f8f9fa;
    }

    .form-control {
        border-radius: 5px;
        padding: 8px;
    }

    .btn-close {
        background-color: transparent;
        border: none;
        color: #000;
    }

    th a i {
        display: none;
    }

    th a[aria-sort="ascending"] i.fa-arrow-up {
        display: inline-block;
    }

    th a[aria-sort="descending"] i.fa-arrow-down {
        display: inline-block;
    }
</style>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    function deleteRoomType(roomTypeId) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa loại phòng này?',
            text: 'Thao tác này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + roomTypeId).submit();
            }
        });
    }
</script>
<script>
    function confirmDelete(roomId) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa phòng này?',
            text: 'Thao tác này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form after confirmation
                document.getElementById('delete-form-' + roomId).submit();
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>