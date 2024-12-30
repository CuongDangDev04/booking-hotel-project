@extends('admin.dashboard')

@section('title', 'Quản lý Dịch Vụ')

@section('content')
<div class="container">
    <h1 class="mb-4 title-manager-service">Quản lý Dịch Vụ</h1>

    <!-- Add Service Button -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        Thêm Dịch Vụ
    </button>

    <!-- Services Table -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>
                    <a href="{{ route('admin.services.index', ['sort_by' => 'service_id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        ID
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </th>
                <th><a href="{{ route('admin.services.index', ['sort_by' => 'name', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        ID
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a></th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
            <tr>
                <td>{{ $service->service_id }}</td>
                <td>{{ $service->name }}</td>
                <td style="width: 200px;">
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editServiceModal{{ $service->service_id }}">
                        Sửa
                    </button>

                    <!-- Delete Button -->
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $service->service_id }}')">Xóa</button>

                    <form id="delete-form-{{ $service->service_id }}" action="{{ route('admin.services.destroy', $service->service_id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                </td>
            </tr>

            <!-- Edit Service Modal -->
            <div class="modal fade" id="editServiceModal{{ $service->service_id }}" tabindex="-1" aria-labelledby="editServiceModalLabel{{ $service->service_id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.services.update', $service->service_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Sửa Dịch Vụ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên Dịch Vụ</label>
                                    <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
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

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Dịch Vụ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Dịch Vụ</label>
                        <input type="text" name="name" class="form-control" required>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(serviceId) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa dịch vụ này?',
            text: 'Thao tác này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + serviceId).submit();
            }
        });
    }
</script>


<style>
    .title-manager-service {
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
        color: white;
    }
</style>