@extends('admin.dashboard')

@section('title', 'Quản lý Người Dùng')

@section('content')

<div class="container">
    <h1 class="mb-4 title-manager-user">Quản lý Người Dùng</h1>

    <!-- Button to open "Create User" Modal -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createUserModal">
        Thêm Người Dùng Mới
    </button>

    <table class="table table-bordered table-hover">
        <thead class="table-dark ">
            <tr>
                <th>
                    <a>
                        ID
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.users.index', ['sort_by' => 'name', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Tên
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.users.index', ['sort_by' => 'email', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Email
                        <i class="fa fa-arrow-up"></i>
                        <i class="fa fa-arrow-down"></i>
                    </a>
                </th>
                <th>
                    <a >
                        Vai Trò
                        
                    </a>
                </th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                        Sửa
                    </button>

                    <!-- Delete Form -->
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline-block;" id="delete-form-{{ $user->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser('{{ $user->id }}')">Xóa</button>
                    </form>

                    @if($user->is_active)
                    <a href="{{ route('admin.users.toggleActiveStatus', $user->id) }}" class="btn btn-warning btn-sm">Vô hiệu hóa</a>
                    @else
                    <a href="{{ route('admin.users.toggleActiveStatus', $user->id) }}" class="btn btn-success btn-sm">Kích hoạt</a>
                    @endif
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Chỉnh Sửa Người Dùng</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Vai Trò</label>
                                    <select name="role" class="form-control" id="role">
                                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật Khẩu</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" name="password_confirmation" required>
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

<!-- Create Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Người Dùng Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Vai Trò</label>
                        <select name="role" class="form-control" id="role">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
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
<!-- Thêm SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Thành công!',
        text: '{{ session("success") }}',
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Có lỗi xảy ra!',
        text: '{{ session("error") }}',
    });
</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Có lỗi xảy ra!',
        html: `
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            `
    });
</script>
@endif
@endsection
<style>
    /* Định dạng chung cho form */
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

    /* Ẩn icon khi chưa sắp xếp */
    th a i {
        display: none;
    }

    /* Hiển thị icon mũi tên khi sắp xếp */
    th a[aria-sort="ascending"] i.fa-arrow-up {
        display: inline-block;
    }

    th a[aria-sort="descending"] i.fa-arrow-down {
        display: inline-block;
    }

    .title-manager-user {
        font-size: 42px;
        font-weight: bold;
    }
</style>





<script>
    function deleteUser(userId) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa người dùng này?',
            text: 'Thao tác này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>