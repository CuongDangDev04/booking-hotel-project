@extends('admin.dashboard')

@section('title', 'Quản lí phòng')

@section('content')
<div class="container">
    <h1 class="mb-4 title-manager-room">Quản lý danh sách các loại phòng</h1>

    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createRoomTypeModal">
        Thêm Phòng Mới
    </button>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>
                    <a href="{{ route('admin.room-types.index', ['sort_by' => 'roomType_id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        ID
                        <span class="sort-icons">
                            <i class="fa fa-arrow-up {{ $sortBy === 'roomType_id' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortBy === 'roomType_id' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                        </span>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.room-types.index', ['sort_by' => 'name', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Tên
                        <span class="sort-icons">
                            <i class="fa fa-arrow-up {{ $sortBy === 'name' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortBy === 'name' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                        </span>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.room-types.index', ['sort_by' => 'price', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Giá
                        <span class="sort-icons">
                            <i class="fa fa-arrow-up {{ $sortBy === 'price' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortBy === 'price' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                        </span>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.room-types.index', ['sort_by' => 'occupancy', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Số Người
                        <span class="sort-icons">
                            <i class="fa fa-arrow-up {{ $sortBy === 'occupancy' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortBy === 'occupancy' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                        </span>
                    </a>
                </th>
                <th>Mô tả</th>
                <th>Dịch Vụ</th>

                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roomTypes as $roomType)
            <tr>
                <td>{{ $roomType->roomType_id }}</td>
                <td>{{ $roomType->name }}</td>
                <td>{{ $roomType->price }}</td>
                <td>{{ $roomType->occupancy }}</td>
                <td>{{ $roomType->description }}</td>
                <td style="width: 300px;">
                    @foreach ($roomType->services as $service)
                    <span class="badge bg-primary">{{ $service->name }}</span>
                    @endforeach
                </td>

                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRoomTypeModal{{ $roomType->roomType_id }}">
                        Sửa
                    </button>

                    <form action="{{ route('admin.room-types.destroy', $roomType->roomType_id) }}" method="POST" style="display:inline-block;" id="delete-form-{{ $roomType->roomType_id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteRoomType('{{ $roomType->roomType_id }}')">Xóa</button>

                    </form>

                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editRoomTypeModal{{ $roomType->roomType_id }}" tabindex="-1" aria-labelledby="editRoomTypeModalLabel{{ $roomType->roomType_id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.room-types.update', $roomType->roomType_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Chỉnh Sửa Loại Phòng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $roomType->name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô Tả</label>
                                    <textarea name="description" class="form-control" id="description">{{ old('description', $roomType->description) }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Giá</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('price', $roomType->price) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="occupancy" class="form-label">Số Người</label>
                                    <input type="number" name="occupancy" class="form-control" value="{{ old('occupancy', $roomType->occupancy) }}" required>
                                </div>
                                <!-- Danh sách dịch vụ trong modal sửa -->
                                <div class="mb-3">
                                    <label class="form-label">Dịch Vụ</label>
                                    <div>
                                        @foreach ($services as $service)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->service_id }}"
                                                id="service_{{ $service->service_id }}"
                                                {{ in_array($service->service_id, $roomType->services->pluck('service_id')->toArray()) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="service_{{ $service->service_id }}">
                                                {{ $service->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
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
    <div class="pagination">
        {{ $roomTypes->links() }}
    </div>
    <style>
        .pagination .text-gray-700:first-child {
            display: none !important;
        }
    </style>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createRoomTypeModal" tabindex="-1" aria-labelledby="createRoomTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.room-types.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Loại Phòng Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="occupancy" class="form-label">Số Người</label>
                        <input type="number" name="occupancy" class="form-control" id="occupancy" value="{{ old('occupancy') }}" required>
                    </div>
                    <!-- Danh sách dịch vụ trong modal thêm -->
                    <div class="mb-3">
                        <label class="form-label">Dịch Vụ</label>
                        <div>
                            @foreach ($services as $service)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="services[]" value="{{ $service->service_id }}"
                                    id="service_{{ $service->service_id }}">
                                <label class="form-check-label" for="service_{{ $service->service_id }}">
                                    {{ $service->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<style>
    .title-manager-room {
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

    .sort-icons {
        margin-left: 5px;
    }

    .sort-icons i {
        font-size: 12px;
        color: #ccc;
    }

    .sort-icons i.active {
        color: #000;
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
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + roomTypeId).submit();
            }
        });
    }
</script>