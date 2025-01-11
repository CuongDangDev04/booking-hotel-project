@extends('admin.dashboard')

@section('title', 'Quản lý Liên Hệ')

@section('content')

<style>
    .title-ct {
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

<div class="container">
    <h1 class="mb-4 title-ct">Quản lý Liên Hệ</h1>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'id', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        ID
                        <span class="sort-icons">
                            <i class="fa fa-arrow-up {{ $sortBy === 'id' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortBy === 'id' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                        </span>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'name', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Họ Tên
                        <span class="sort-icons">
                            <i class="fa fa-arrow-up {{ $sortBy === 'name' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortBy === 'name' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                        </span>
                    </a>
                </th>
                <th>
                    <a href="{{ route('admin.contacts.index', ['sort_by' => 'email', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                        Email
                        <span class="sort-icons">
                            <i class="fa fa-arrow-up {{ $sortBy === 'email' && $sortOrder === 'asc' ? 'active' : '' }}"></i>
                            <i class="fa fa-arrow-down {{ $sortBy === 'email' && $sortOrder === 'desc' ? 'active' : '' }}"></i>
                        </span>
                    </a>
                </th>
                <th>Tiêu Đề</th>
                <th>Tin Nhắn</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->subject }}</td>
                <td>{{ $contact->message }}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $contact->id }}')">Xóa</button>
                    <form id="delete-form-{{ $contact->id }}" action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $contacts->links() }}
    </div>
    <style>
        .pagination .text-gray-700 {
            display: none !important;
        }
    </style>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(contactId) {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn xóa?',
            text: 'Thao tác này không thể hoàn tác!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xác nhận',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + contactId).submit();
            }
        });
    }
</script>
@endsection
