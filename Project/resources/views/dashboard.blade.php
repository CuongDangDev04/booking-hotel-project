<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-md-3">
                        <div class="card" style="border: none;">

                            <div class="card-body">
                                <ul class="list-group mt-5">
                                    <style>
                                        .list-group-item+.list-group-item {
                                            border-top-width: 1px;
                                        }
                                    </style>
                                    <li class="list-group-item mb-3">
                                        <a href="{{ route('dashboard.userInfo') }}">Thông tin người dùng</a>
                                    </li>
                                    <li class="list-group-item mb-3">
                                        <a href="{{ route('dashboard.bookings') }}">Lịch sử đặt phòng</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="col-md-9">
                        <div class="card">

                            <div class="card-body">
                                @yield('content') <!-- Content area where specific content is loaded -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>